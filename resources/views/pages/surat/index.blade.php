@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data surat</h1>
        <a href="/surat/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah surat</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nik</th>
                            <th>Jenis Surat</th>
                            <th>keterangan</th>
                            {{-- <th>telepon</th> --}}
                            {{-- <th>email</th> --}}
                            {{-- <th>lampiran</th> --}}
                            <th>status</th>
                            {{-- <th>Nama</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($surats as $surat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $surat->nama }}</td>
                            <td>{{ $surat->nik }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>{{ $surat->keterangan }}</td>
                            {{-- <td>{{ $surat->telepon }}</td> --}}
                            {{-- <td>{{ $surat->email }}</td> --}}
                            {{-- <td>{{ $surat->lampiran }}</td> --}}
                            <td>{{ $surat->status }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('surat.edit', $surat->id) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    {{-- <a href="{{ route('surat.delete', $surat->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-eraser"></i>
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $surat->id }}">
                                        <i class="fas fa-eraser"></i> Delete
                                    </button>
                                </div>
                                {{-- <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            </td>
                        </tr>
                            @include('pages.surat.confirmation-delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
{{-- </div> --}}
@endsection