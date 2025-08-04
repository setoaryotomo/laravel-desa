<!-- resources/views/rumah/edit.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    form label{
      font-weight:bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Profile</h3>
                    <a href="/dashboard" class="btn btn-sm btn-secondary float-right">Kembali</a>
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

                <div class="card-body">
                    <form method="POST" action="/profile/{{ auth()->user()->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email', auth()->user()->email) }}" readonly>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{-- <button type="reset" class="btn btn-secondary me-md-2">Reset Perubahan</button> --}}
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection