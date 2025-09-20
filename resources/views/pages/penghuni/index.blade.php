@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Penghuni (KK)</h1>
    <div class="mt-2 mt-sm-0">
        @isset($rumah)
            <a href="{{ route('rumah.index') }}" class="d-inline-block btn btn-sm btn-secondary shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> <span class="d-none d-md-inline">Kembali</span>
            </a>
            <a href="{{ route('rumah.penghuni.create', $rumah->id) }}" class="d-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> <span class="d-md-inline">Tambah Penghuni</span>
            </a>
        @endisset
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            {{-- <div class="card-body p-0 p-sm-3"> --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Foto</th>
                                <th>Nama</th>
                                {{-- <th class="text-center d-none d-md-table-cell">NIK</th> --}}
                                {{-- <th class="text-center d-none d-md-table-cell">Jenis Kelamin</th> --}}
                                <th class="text-center d-none d-lg-table-cell">Status Penghuni</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penghunis as $penghuni)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $penghuni->foto) }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 80px; width: auto;">
                                </td>
                                <td>
                                    <div class="text-truncate" title="{{ $penghuni->nama }}">
                                        {{ $penghuni->nama }}
                                    </div>
                                </td>
                                {{-- <td class="text-center d-none d-md-table-cell">{{ $penghuni->nik }}</td> --}}
                                {{-- <td class="d-none d-md-table-cell">
                                    {{ $penghuni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td> --}}
                                <td class="text-center d-none d-lg-table-cell">
                                    <div class="text-truncate" title="{{ ucwords($penghuni->status_penghuni) }} - {{ $penghuni->is_kepala_keluarga == '1' ? 'Kepala Keluarga' : 'Anggota Keluarga' }}">
                                        {{ ucwords($penghuni->status_penghuni) }} - {{ $penghuni->is_kepala_keluarga == '1' ? 'Kepala Keluarga' : 'Anggota Keluarga' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('penghuni.anggotakeluarga.index', ['rumah' => $penghuni->rumah_id, 'penghuni' => $penghuni->id]) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-success" 
                                           title="Lihat Anggota Keluarga">
                                            <i class="fas fa-users"></i>
                                            <span class="d-none d-md-inline">Anggota</span>
                                        </a>
                                        <a href="{{ route('rumah.penghuni.edit', ['rumah' => $penghuni->rumah_id, 'penghuni' => $penghuni->id]) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-warning"
                                           title="Edit Penghuni">
                                            <i class="fas fa-pen"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationDelete-{{ $penghuni->id }}"
                                                title="Hapus Penghuni">
                                            <i class="fas fa-eraser"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.penghuni.confirmation-delete', ['penghuni' => $penghuni])
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection