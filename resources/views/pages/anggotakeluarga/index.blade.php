@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Anggota Keluarga</h1>
    <div class="mt-2 mt-sm-0">
        @isset($penghuni)
            <a href="{{ route('rumah.penghuni.index', $rumah->id) }}" class="d-inline-block btn btn-sm btn-secondary shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> <span class="d-none d-md-inline">Kembali</span>
            </a>
            <a href="{{ route('penghuni.anggotakeluarga.create', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id]) }}" 
                class="d-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> <span class="">Tambah Anggota</span>
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
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama</th>
                                <th class="d-none d-md-table-cell">NIK</th>
                                <th class="text-center d-none d-sm-table-cell">Jenis Kelamin</th>
                                <th class="d-none d-lg-table-cell">Status Keluarga</th>
                                <th class="d-none d-xl-table-cell text-center">Tgl Lahir</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotakeluargas as $anggotakeluarga)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="{{ $anggotakeluarga->nama }}">
                                        {{ $anggotakeluarga->nama }}
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $anggotakeluarga->nik }}</td>
                                <td class="text-center d-none d-sm-table-cell">{{ $anggotakeluarga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="d-none d-lg-table-cell">
                                    <div class="text-truncate" style="max-width: 120px;" title="{{ ucwords($anggotakeluarga->status_keluarga) }}">
                                        {{ ucwords($anggotakeluarga->status_keluarga) }}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell text-center">{{ \Carbon\Carbon::parse($anggotakeluarga->tgl_lahir)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                        <a href="{{ route('penghuni.anggotakeluarga.edit', [
                                            'rumah' => $rumah->id, 
                                            'penghuni' => $anggotakeluarga->penghuni_id, 
                                            'anggotakeluarga' => $anggotakeluarga->id
                                            ]) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-warning"
                                           title="Edit Anggota Keluarga">
                                            <i class="fas fa-pen d-md-none"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationDelete-{{ $anggotakeluarga->id }}"
                                                title="Hapus Anggota Keluarga">
                                            <i class="fas fa-eraser d-md-none"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.anggotakeluarga.confirmation-delete', ['anggotakeluarga' => $anggotakeluarga])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection