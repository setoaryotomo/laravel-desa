<!-- resources/views/user/create.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    form label{
      font-weight:bold;
    }
    .dynamic-field {
        display: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data user</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            

                            <div class="col-md-6">
                                <label for="role_id" class="form-label">Role</label>
                                    <select class="form-control @error('role_id') is-invalid @enderror" 
                                            id="role_id" name="role_id" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="3" {{ old('role_id', $user->role_id) == '3' ? 'selected' : '' }}>RW</option>
                                        <option value="4" {{ old('role_id', $user->role_id) == '4' ? 'selected' : '' }}>RT</option>
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>

                                <div class="col-md-3 dynamic-field" id="rw-field">
                                    <label for="rw" class="form-label">RW</label>
                                    <select class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw">
                                        <option value="">Pilih RW</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('rw',$user->rw) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 dynamic-field" id="rt-field">
                                    <label for="rt" class="form-label">RT</label>
                                    <select class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt">
                                        <option value="">Pilih RT</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('rt',$user->rt) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            {{-- <div class="col-md-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" value="{{ old('password' , $user->password) }}" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('user.index') }}" ><button type="button" class="btn btn-secondary me-md-2 mr-1">Kembali</button></a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role_id');
        const rwField = document.getElementById('rw-field');
        const rtField = document.getElementById('rt-field');
        const rwSelect = document.getElementById('rw');
        const rtSelect = document.getElementById('rt');
        
        // Function to handle role selection change
        function handleRoleChange() {
            const roleId = roleSelect.value;
            
            // Hide all dynamic fields first
            rwField.style.display = 'none';
            rtField.style.display = 'none';
            rwSelect.removeAttribute('required');
            rtSelect.removeAttribute('required');
            
            // Show fields based on selected role
            if (roleId === '3') { // RW
                rwField.style.display = 'block';
                rwSelect.setAttribute('required', 'required');
            } else if (roleId === '4') { // RT
                rwField.style.display = 'block';
                rtField.style.display = 'block';
                rwSelect.setAttribute('required', 'required');
                rtSelect.setAttribute('required', 'required');
            }
        }
        
        // Initial call to set correct fields based on existing value
        if (roleSelect.value) {
            handleRoleChange();
        }
        
        // Add event listener for role selection change
        roleSelect.addEventListener('change', handleRoleChange);
    });
</script>

@endsection