@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Berita</h1>
    <a href="/berita/create" class="btn btn-sm btn-primary shadow-sm mt-2 mt-sm-0">
        <i class="fas fa-plus fa-sm text-white-50"></i> <span class="d-none d-md-inline">Tambah Berita</span>
    </a>
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
                                <th>Judul</th>
                                <th class="d-none d-lg-table-cell">Deskripsi</th>
                                <th class="text-center d-none d-lg-table-cell">Gambar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritas as $berita)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $berita->judul }}">
                                        {{ $berita->judul }}
                                    </div>
                                </td>
                                <td class="d-none d-lg-table-cell">
                                    <div class="text-truncate" style="max-width: 300px;" title="{{ $berita->deskripsi }}">
                                        {{ $berita->deskripsi }}
                                    </div>
                                </td>
                                <td class="text-center d-none d-lg-table-cell">
                                    <img src="{{ asset('storage/' . $berita->foto_berita) }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 80px; width: auto;" 
                                         alt="Gambar Berita">
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                        <a href="{{ route('berita.edit', $berita->id) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-warning"
                                           title="Edit Berita">
                                            <i class="fas fa-pen"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationDelete-{{ $berita->id }}"
                                                title="Hapus Berita">
                                            <i class="fas fa-eraser"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.berita.confirmation-delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection