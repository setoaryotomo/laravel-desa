@extends('layouts.app')

@section('content')

<style>
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        width: auto;
        max-width: 350px;
        padding: 15px;
        border-radius: 5px;
        transition: opacity 0.5s ease;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button> --}}
    </div>
@endif

<div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Surat</h1>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('surat.index') }}">
            <div class="row g-2">
                {{-- Filter Status --}}
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <select name="status" class="form-control">
                        <option value="">-- Filter Status --</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Proses</option>
                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disetujui</option>
                        <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Terkirim</option>
                        <option value="4" {{ request('status') == 4 ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- Search --}}
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="Cari nama / NIK...">
                </div>

                {{-- Tombol --}}
                <div class="col-12 col-md-3">
                    <div class="d-grid d-sm-flex gap-2">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('surat.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
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
                                <th class="">Jenis Surat</th>
                                <th class="d-none d-xl-table-cell">Keterangan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($surats as $surat)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-truncate" style="max-width: 120px;" title="{{ $surat->nama }}">
                                        {{ $surat->nama }}
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">{{ $surat->nik }}</td>
                                <td class="">
                                    <div class="text-truncate" title="{{ $surat->jenis_surat }}">
                                        {{ $surat->jenis_surat }}
                                    </div>
                                </td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="text-truncate" style="max-width: 150px;" title="{{ $surat->keterangan }}">
                                        {{ $surat->keterangan }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($surat->status == 1)
                                        <span class="badge badge-warning">Proses</span>
                                    @elseif($surat->status == 2)
                                        <span class="badge badge-primary">Disetujui</span>
                                    @elseif($surat->status == 3)
                                        <span class="badge badge-success">Terkirim</span>
                                    @elseif($surat->status == 4)
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-nowrap justify-content-center">
                                        <a href="{{ route('surat.edit', $surat->id) }}" 
                                           class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-primary"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                            <span class="d-none d-md-inline">View</span>
                                        </a>
                                        
                                        @if($surat->status == 2)
                                            <a href="{{ route('surat.mail', $surat->id) }}" 
                                               class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-success"
                                               title="Kirim Surat">
                                                <i class="fas fa-paper-plane"></i>
                                                <span class="d-none d-md-inline">Send</span>
                                            </a>
                                        @endif

                                        {{-- <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationDelete-{{ $surat->id }}">
                                            <i class="fas fa-eraser"></i> Delete
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            @include('pages.surat.confirmation-delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

<script>
    // Otomatis hilangkan alert setelah beberapa detik
    setTimeout(function () {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000); // 3 detik
</script>

@endsection