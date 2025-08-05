<!-- resources/views/agenda/create.blade.php -->
@extends('layouts.app')

@section('content')
    <style>
        form label {
            font-weight: bold;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data agenda Baru</h3>
                        <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('agenda.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="foto_agenda" class="form-label">Foto Tampak Depan agenda</label>
                                    <input type="file" class="form-control @error('foto_agenda') is-invalid @enderror"
                                        id="foto_agenda" name="foto_agenda" accept="image/jpeg,image/png">
                                    <small class="text-muted">Format: JPEG/PNG, Maksimal 2MB</small>
                                    @error('foto_agenda')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="judul" class="form-label">Judul agenda</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        id="judul" name="judul" value="{{ old('judul') }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="deskripsi" class="form-label">Deskripsi agenda</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                        id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                {{-- <button type="reset" class="btn btn-secondary me-md-2">Reset</button> --}}
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan preview gambar -->
    <script>
        document.getElementById('foto_agenda').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Cek jika sudah ada preview sebelumnya
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'image-preview';
                        preview.className = 'mt-3';
                        preview.innerHTML =
                            '<h6>Preview Gambar:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                        event.target.parentNode.appendChild(preview);
                    }
                    preview.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
