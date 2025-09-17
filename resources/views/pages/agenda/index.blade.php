@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Agenda</h1>
    <a href="/agenda/create" class="btn btn-sm btn-primary shadow-sm mt-2 mt-sm-0">
        <i class="fas fa-plus fa-sm text-white-50"></i> <span class="">Tambah Agenda</span>
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
                                <th class="d-none d-md-table-cell">Deskripsi</th>
                                <th class="text-center d-none d-lg-table-cell">Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendas as $agenda)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $agenda->judul }}">
                                        {{ $agenda->judul }}
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <div class="text-truncate" style="max-width: 300px;" title="{{ $agenda->deskripsi }}">
                                        {{ $agenda->deskripsi }}
                                    </div>
                                </td>
                                <td class="text-center d-none d-lg-table-cell">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                        <a href="{{ route('agenda.edit', $agenda->id) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-warning"
                                           title="Edit Agenda">
                                            <i class="fas fa-pen"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationDelete-{{ $agenda->id }}"
                                                title="Hapus Agenda">
                                            <i class="fas fa-eraser"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.agenda.confirmation-delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection