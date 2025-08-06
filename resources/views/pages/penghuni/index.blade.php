@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penghuni (KK)</h1>
    <div>
        @isset($rumah)
            <a href="{{ route('rumah.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
            <a href="{{ route('rumah.penghuni.create', $rumah->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Penghuni
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
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>No HP</th>
                            <th>Tgl Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penghunis as $penghuni)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penghuni->nama }}</td>
                            <td>{{ $penghuni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $penghuni->agama }}</td>
                            <td>{{ $penghuni->no_hp }}</td>
                            <td>{{ \Carbon\Carbon::parse($penghuni->tgl_lahir)->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('penghuni.anggotakeluarga.index', ['rumah' => $penghuni->rumah_id, 'penghuni' => $penghuni->id]) }}" class="d-inline-block mr-2 btn btn-sm btn-info">
                                        <i class="fas fa-user"></i> Anggota
                                    </a>
                                    {{-- @if($penghuni->rumah) --}}
                                        <a href="{{ route('rumah.penghuni.edit', ['rumah' => $penghuni->rumah_id, 'penghuni' => $penghuni->id]) }}" 
                                           class="d-inline-block mr-2 btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    {{-- @endif --}}
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmationDelete-{{ $penghuni->id }}">
                                        <i class="fas fa-eraser"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('pages.penghuni.confirmation-delete', ['penghuni' => $penghuni])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection