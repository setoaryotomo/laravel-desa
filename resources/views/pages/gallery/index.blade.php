@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data gallery</h1>
        <a href="/gallery/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah gallery</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            {{-- <th>Nama</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gallerys as $gallery)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $gallery->foto_gallery) }}" style="width: 200px" alt=""></td>
                            <td>{{ $gallery->judul }}</td>
                            <td>{{ $gallery->deskripsi }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    {{-- <a href="{{ route('gallery.delete', $gallery->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-eraser"></i>
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $gallery->id }}">
                                        <i class="fas fa-eraser"></i> Delete
                                    </button>
                                </div>
                                {{-- <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            </td>
                        </tr>
                            @include('pages.gallery.confirmation-delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
{{-- </div> --}}
@endsection