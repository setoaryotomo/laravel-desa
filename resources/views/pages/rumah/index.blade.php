@extends('layouts.app')

@section('content')
{{-- <div class="container-fluid"> --}}
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between mb-4">
        <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Data Rumah</h1>
        <div class="d-flex gap-2">
            @php
                $user = Auth::user();
            @endphp
    
            {{-- Jika role RW (3) => tampilkan filter RT --}}
            @if ($user->role_id == 3)
                <form method="GET" action="{{ route('rumah.index') }}" class="d-flex">
                    <select name="rt" class="form-control form-control-sm mr-2">
                        <option value="">Semua RT</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('rt') == $i ? 'selected' : '' }}>RT {{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary mr-2">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                </form>
            @endif
    
            {{-- Jika role Admin atau lainnya, tampilkan filter RT & RW --}}
            @if ($user->role_id != 3 && $user->role_id != 4)
                <form method="GET" action="{{ route('rumah.index') }}" class="d-flex">
                    <select name="rt" class="form-control form-control-sm mr-2">
                        <option value="">Semua RT</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('rt') == $i ? 'selected' : '' }}>RT {{ $i }}</option>
                        @endfor
                    </select>
                    <select name="rw" class="form-control form-control-sm mr-2">
                        <option value="">Semua RW</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{ request('rw') == $i ? 'selected' : '' }}>RW {{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary mr-2">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>
                </form>
            @endif
    
            {{-- Tambah Rumah (tetap muncul untuk semua role) --}}
            <a href="{{ route('rumah.create') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm"></i> <span class="d-none d-md-inline">Tambah Rumah</span>
            </a>
        </div>
    </div>
    
    

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                {{-- <div class="card-body p-4"> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Alamat Lengkap</th>
                                    <th class="text-center">RT/RW</th>
                                    <th class="text-center">No Rumah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rumahs as $rumah)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 300px;" title="{{ $rumah->alamat_lengkap }} No. {{ $rumah->no_rumah }}">
                                                {{ $rumah->alamat_lengkap }} No. {{ $rumah->no_rumah }}
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $rumah->rt }}/{{ $rumah->rw }}</td>
                                        <td class="text-center">{{ $rumah->no_rumah }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('rumah.penghuni.index', $rumah->id) }}" 
                                                   class="d-inline-block mr-2 btn btn-sm btn-info" 
                                                   title="Lihat Penghuni">
                                                    <i class="fas fa-user"></i> <span class="d-none d-md-inline mr-2">Penghuni</span>
                                                </a>
                                                <a href="{{ route('rumah.edit', $rumah->id) }}" 
                                                   class="d-inline-block mr-2 btn btn-sm btn-warning" 
                                                   title="Edit Rumah">
                                                    <i class="fas fa-pen"></i> <span class="d-none d-md-inline mr-2">Edit</span>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#confirmationDelete-{{ $rumah->id }}" 
                                                        title="Hapus Rumah">
                                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline mr-2">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('pages.rumah.confirmation-delete', ['rumah' => $rumah])
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Belum ada data rumah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection