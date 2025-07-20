@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rumah</h1>
        <a href="/rumah/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alamat</th>
                            <th>RT/RW</th>
                            <th>No Rumah</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rumahs as $rumah)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rumah->alamat_lengkap }} No. {{ $rumah->no_rumah }}</td>
                            <td>{{ $rumah->rt }}/{{ $rumah->rw }}</td>
                            <td>{{ $rumah->no_rumah}}</td>
                            <td>{{ $rumah->sertifikat_an }}</td>
                            {{-- <td><img src="{{ asset('storage/' . $rumah->foto_tampak_depan) }}" alt=""></td> --}}
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('rumah.edit', $rumah->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    {{-- <a href="{{ route('rumah.delete', $rumah->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-eraser"></i>
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $rumah->id }}">
                                        <i class="fas fa-eraser"></i>
                                    </button>
                                </div>
                                {{-- <a href="{{ route('rumah.edit', $rumah->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            </td>
                        </tr>
                            @include('pages.rumah.confirmation-delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
{{-- </div> --}}
@endsection