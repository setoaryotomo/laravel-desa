<!-- resources/views/rumah/edit.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    form label{
      font-weight:bold;
    }
    .password-input-group {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #6c757d;
    }
    .password-toggle:hover {
        color: #495057;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Password</h3>
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
                @if (session('error'))
                <script>
                    Swal.fire({
                        title: "Gagal",
                        text: "{{ session()->get('error') }}",
                        icon: "error"
                    });
                </script>   
                @endif

                <div class="card-body">
                    <form method="POST" action="/change-password/{{ auth()->user()->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="old_password" class="form-label">Password Lama</label>
                                <div class="password-input-group">
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" 
                                           id="old_password" name="old_password">
                                    <button type="button" class="password-toggle" data-target="old_password">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                @error('old_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <div class="password-input-group">
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                           id="new_password" name="new_password">
                                    <button type="button" class="password-toggle" data-target="new_password">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Font Awesome if not already loaded
        if (!document.querySelector('link[href*="font-awesome"]')) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css';
            document.head.appendChild(link);
        }

        // Toggle password visibility
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    // icon.classList.remove('fa-eye');
                    // icon.classList.add('fa-eye-slash');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    // icon.classList.remove('fa-eye-slash');
                    // icon.classList.add('fa-eye');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    });
</script>

@endsection