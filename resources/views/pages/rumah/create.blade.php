<!-- resources/views/rumah/create.blade.php -->
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
                    <h3 class="card-title">Tambah Data Rumah Baru</h3>
                    {{-- <a href="{{ route('rumah.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a> --}}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rumah.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                       id="alamat_lengkap" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" required>
                                @error('alamat_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="sertifikat_an" class="form-label">Sertifikat Atas Nama</label>
                                <input type="text" class="form-control @error('sertifikat_an') is-invalid @enderror" 
                                       id="sertifikat_an" name="sertifikat_an" value="{{ old('sertifikat_an') }}" required>
                                @error('sertifikat_an')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="no_rumah" class="form-label">Nomor Rumah</label>
                                <input type="text" class="form-control @error('no_rumah') is-invalid @enderror" 
                                       id="no_rumah" name="no_rumah" value="{{ old('no_rumah') }}" required>
                                @error('no_rumah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror" 
                                       id="rt" name="rt" value="{{ old('rt') }}" required>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror" 
                                       id="rw" name="rw" value="{{ old('rw') }}" required>
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" 
                                       id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" required>
                                @error('kelurahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" 
                                       id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" required>
                                @error('kode_pos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="luas_tanah" class="form-label">Luas Tanah (m²)</label>
                                <input type="number" step="0.01" class="form-control @error('luas_tanah') is-invalid @enderror" 
                                       id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah') }}" required>
                                @error('luas_tanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi" class="form-label">Link Lokasi</label>
                                <input type="text" step="0.01" class="form-control @error('lokasi') is-invalid @enderror" 
                                       id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude (Opsional)</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" 
                                       id="latitude" name="latitude" value="{{ old('latitude') }}">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude (Opsional)</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                                       id="longitude" name="longitude" value="{{ old('longitude') }}">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="mb-3">
                            <label for="foto_tampak_depan" class="form-label">Foto Tampak Depan Rumah</label>
                            <input type="file" class="form-control @error('foto_tampak_depan') is-invalid @enderror" 
                                   id="foto_tampak_depan" name="foto_tampak_depan" accept="image/jpeg,image/png">
                            <small class="text-muted">Format: JPEG/PNG, Maksimal 2MB</small>
                            @error('foto_tampak_depan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('rumah.index') }}" ><button type="button" class="btn btn-secondary me-md-2 mr-1">Kembali</button></a>
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
    document.getElementById('foto_tampak_depan').addEventListener('change', function(event) {
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
                    preview.innerHTML = '<h6>Preview Gambar:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                    event.target.parentNode.appendChild(preview);
                }
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection