@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data jenissurat</h1>
        <a href="/jenissurat/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah jenissurat</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Surat</th>
                            <th>keterangan</th>
                            {{-- <th>Nama</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenissurats as $jenissurat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jenissurat->jenis_surat }}</td>
                            <td>{{ $jenissurat->keterangan }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('jenissurat.edit', $jenissurat->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    {{-- <a href="{{ route('jenissurat.delete', $jenissurat->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-eraser"></i>
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $jenissurat->id }}">
                                        <i class="fas fa-eraser"></i> Delete
                                    </button>
                                </div>
                                {{-- <a href="{{ route('jenissurat.edit', $jenissurat->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            </td>
                        </tr>
                            @include('pages.jenissurat.confirmation-delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
{{-- </div> --}}
@endsection