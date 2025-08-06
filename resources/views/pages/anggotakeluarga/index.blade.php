@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Anggota Keluarga</h1>
    <div>
        @isset($penghuni)
            <a href="{{ route('rumah.penghuni.index', $rumah->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
            <a href="{{ route('penghuni.anggotakeluarga.create', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id]) }}" 
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota Keluarga
            </a>
        @endisset
    </div>
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
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Anggota Keluarga</th>
                            {{-- <th>Agama</th> --}}
                            {{-- <th>No HP</th> --}}
                            <th>Tgl Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggotakeluargas as $anggotakeluarga)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggotakeluarga->nama }}</td>
                            <td>{{ $anggotakeluarga->nik }}</td>
                            <td>{{ $anggotakeluarga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ ucwords($anggotakeluarga->status_keluarga) }}</td>
                            {{-- <td>{{ $anggotakeluarga->agama }}</td> --}}
                            {{-- <td>{{ $anggotakeluarga->no_hp }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($anggotakeluarga->tgl_lahir)->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('penghuni.anggotakeluarga.edit', [
                                        'rumah' => $rumah->id, 
                                        'penghuni' => $anggotakeluarga->penghuni_id, 
                                        'anggotakeluarga' => $anggotakeluarga->id
                                        ]) }}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmationDelete-{{ $anggotakeluarga->id }}">
                                        <i class="fas fa-eraser"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('pages.anggotakeluarga.confirmation-delete', ['anggotakeluarga' => $anggotakeluarga])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection