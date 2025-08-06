<!-- resources/views/gallery/edit.blade.php -->
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
                    <h3 class="card-title">Edit Data gallery</h3>
                    <a href="{{ route('gallery.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror" 
                                       id="jenis_surat" name="jenis_surat" 
                                       value="{{ old('jenis_surat', $gallery->jenis_surat) }}" required>
                                @error('jenis_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" 
                                       id="keterangan" name="keterangan" 
                                       value="{{ old('keterangan', $gallery->keterangan) }}" required>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="template" class="form-label">Template</label>
                                <textarea class="form-control @error('template') is-invalid @enderror"
                                    id="template" name="template" required>{{ old('template', $gallery->template) }}</textarea>
                                @error('template')
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
    document.getElementById('foto_gallery').addEventListener('change', function(event) {
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