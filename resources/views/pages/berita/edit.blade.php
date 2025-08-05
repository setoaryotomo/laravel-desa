<!-- resources/views/berita/edit.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    form label{
      font-weight:bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data berita</h3>
                    <a href="{{ route('berita.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('berita.update', $berita->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="foto_berita" class="form-label">Foto Tampak Depan berita</label>
                            
                            @if($berita->foto_berita)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $berita->foto_berita) }}" 
                                         class="img-thumbnail" style="max-width: 300px;">
                                    <div class="form-check mt-2" style="display: none">
                                        <input class="form-check-input" type="checkbox" 
                                               id="hapus_foto" name="hapus_foto">
                                        <label class="form-check-label" for="hapus_foto">
                                            Hapus foto saat disimpan
                                        </label>
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" class="form-control @error('foto_berita') is-invalid @enderror" 
                                   id="foto_berita" name="foto_berita" 
                                   accept="image/jpeg,image/png">
                            <small class="text-muted">Format: JPEG/PNG, Maksimal 2MB</small>
                            @error('foto_berita')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="judul" class="form-label">Judul Berita</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                       id="judul" name="judul" 
                                       value="{{ old('judul', $berita->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                       id="tanggal" name="tanggal" 
                                       value="{{ old('tanggal', $berita->tanggal) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label">Deskripsi Berita</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                    id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                                @error('deskripsi')
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

<!-- Script untuk menampilkan preview gambar baru -->
<script>
    document.getElementById('foto_berita').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hapus preview lama jika ada
                const oldPreview = document.getElementById('current-image-preview');
                if (oldPreview) oldPreview.style.display = 'none';
                
                // Buat atau update preview baru
                let preview = document.getElementById('new-image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'new-image-preview';
                    preview.className = 'mt-3';
                    preview.innerHTML = '<h6>Preview Gambar Baru:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                    event.target.parentNode.appendChild(preview);
                }
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection