@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Akun</h1>
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-success shadow-sm mt-2">
            <i class="fas fa-plus fa-sm"></i> <span class="">Tambah user</span>
        </a>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ session()->get('success') }}",
                icon: "success"
            });
        </script>
    @endif
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div style="overflow-x: auto">
                        <table class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- <td>
                                            @if ($user->status == 'approved')
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 10px">
                                                @if ($user->status == 'approved')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationReject-{{ $user->id }}">
                                                        Non-aktifkan Akun
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-outline-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationApprove-{{ $user->id }}">
                                                        Aktifkan Akun
                                                    </button>
                                                @endif

                                            </div>
                                        </td> --}}
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                
                                                <a href="{{ route('user.edit', $user->id) }}" 
                                                   class="d-inline-block mr-2 btn btn-sm btn-warning" 
                                                   title="Edit user">
                                                    <i class="fas fa-pen"></i> <span class="d-none d-md-inline mr-2">Edit</span>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#confirmationDelete-{{ $user->id }}" 
                                                        title="Hapus user">
                                                    <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline mr-2">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('pages.account-list.confirmation-approve')
                                    @include('pages.account-list.confirmation-reject')
                                    @include('pages.account-list.confirmation-delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- </div> --}}
@endsection
