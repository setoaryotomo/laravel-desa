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
                    <h3 class="card-title">Edit Data Rumah</h3>
                    {{-- <a href="{{ route('rumah.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a> --}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rumah.update', $rumah->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                       id="alamat_lengkap" name="alamat_lengkap" 
                                       value="{{ old('alamat_lengkap', $rumah->alamat_lengkap) }}" required>
                                @error('alamat_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="sertifikat_an" class="form-label">Sertifikat Atas Nama</label>
                                <input type="text" class="form-control @error('sertifikat_an') is-invalid @enderror" 
                                       id="sertifikat_an" name="sertifikat_an" 
                                       value="{{ old('sertifikat_an', $rumah->sertifikat_an) }}" required>
                                @error('sertifikat_an')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            
                            <div class="col-md-2">
                                <label for="no_rumah" class="form-label">Nomor Rumah</label>
                                <input type="text" class="form-control @error('no_rumah') is-invalid @enderror" 
                                       id="no_rumah" name="no_rumah" 
                                       value="{{ old('no_rumah', $rumah->no_rumah) }}" required>
                                @error('no_rumah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                       id="rt" name="rt" value="{{ old('rt', $rumah->rt) }}" required>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                       id="rw" name="rw" value="{{ old('rw', $rumah->rw) }}" required>
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" 
                                       id="kelurahan" name="kelurahan" 
                                       value="{{ old('kelurahan', $rumah->kelurahan) }}" required>
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                       id="kode_pos" name="kode_pos" 
                                       value="{{ old('kode_pos', $rumah->kode_pos) }}" required>
                                @error('kode_pos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="luas_tanah" class="form-label">Luas Tanah (m²)</label>
                                <input type="number" step="0.01" class="form-control @error('luas_tanah') is-invalid @enderror" 
                                       id="luas_tanah" name="luas_tanah" 
                                       value="{{ old('luas_tanah', $rumah->luas_tanah) }}" required>
                                @error('luas_tanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">lokasi</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                       id="lokasi" name="lokasi" 
                                       value="{{ old('lokasi', $rumah->lokasi) }}">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto_tampak_depan" class="form-label">Foto Tampak Depan Rumah</label>
                            
                            @if($rumah->foto_tampak_depan)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $rumah->foto_tampak_depan) }}" 
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
                            
                            <input type="file" class="form-control @error('foto_tampak_depan') is-invalid @enderror" 
                                   id="foto_tampak_depan" name="foto_tampak_depan" 
                                   accept="image/jpeg,image/png">
                            <small class="text-muted">Format: JPEG/PNG, Maksimal 2MB</small>
                            @error('foto_tampak_depan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{-- <button type="reset" class="btn btn-secondary me-md-2">Reset Perubahan</button> --}}
                            <a href="{{ route('rumah.index') }}" ><button type="button" class="btn btn-secondary me-md-2 mr-1">Kembali</button></a>
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
    document.getElementById('foto_tampak_depan').addEventListener('change', function(event) {
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