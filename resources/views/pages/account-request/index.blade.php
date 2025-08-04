@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
        
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 10px">
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationReject-{{ $user->id }}">
                                            Tolak
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmationApprove-{{ $user->id }}">
                                            Setuju
                                        </button>
                                    </div>
                                </td>
                            </tr>
                                @include('pages.account-request.confirmation-approve')
                                @include('pages.account-request.confirmation-reject')
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