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
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button> --}}
    </div>
@endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data surat</h1>
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
                            <th>status</th>
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
                            <td>
                                @if($surat->status == 1)
                                    <span class="badge badge-warning">Dalam Proses</span>
                                @elseif($surat->status == 2)
                                    <span class="badge badge-primary">Disetujui</span>
                                @elseif($surat->status == 3)
                                    <span class="badge badge-success">Terkirim</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('surat.edit', $surat->id) }}" class="d-inline-block mr-2 btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    
                                    @if($surat->status == 2)
                                        <a href="{{ route('surat.mail', $surat->id) }}" class="d-inline-block mr-2 btn btn-sm btn-success">
                                            <i class="fas fa-paper-plane"></i> Send
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
    }, 3000); // 5 detik
</script>

@endsection
