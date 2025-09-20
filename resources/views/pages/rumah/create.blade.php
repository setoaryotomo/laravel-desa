<!-- resources/views/rumah/create.blade.php -->
@extends('layouts.app')

@section('content')

<style>
    form label{
      font-weight:bold;
    }
    #map {
        height: 400px;
        width: 100%;
        margin-top: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    .map-container {
        margin-bottom: 20px;
    }
    .custom-map-controls {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    .leaflet-control-geocoder-form input {
        width: 250px !important;
        border-radius: 4px;
        border: 1px solid #ced4da;
        padding: 5px 10px;
    }
    .leaflet-top.leaflet-right {
        margin-top: 10px;
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Rumah Baru</h3>
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
                                <select class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" required>
                                    <option value="" disabled {{ old('rt') == '' ? 'selected' : '' }}>Pilih RT</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('rt') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-2">
                                <label for="rw" class="form-label">RW</label>
                                <select class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" required>
                                    <option value="" disabled {{ old('rw') == '' ? 'selected' : '' }}>Pilih RW</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('rw') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
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
                                       id="kode_pos" name="kode_pos" value="50149" readonly>
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
                                <div class="input-group">
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required readonly>
                                    <button type="button" class="btn btn-outline-secondary" id="copy-location-link">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Peta untuk memilih lokasi -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Pilih Lokasi di Peta</label>
                                <div class="map-container">
                                    <div id="map"></div>
                                    <div class="custom-map-controls d-none">
                                        <button type="button" id="locate-me" class="btn btn-sm btn-info">
                                            <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saya Sekarang
                                        </button>
                                        <small class="text-muted ms-2">Klik pada peta untuk menandai lokasi rumah</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" 
                                       id="latitude" name="latitude" value="{{ old('latitude') }}" required readonly>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                                       id="longitude" name="longitude" value="{{ old('longitude') }}" required readonly>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto_tampak_depan" class="form-label">Foto Tampak Depan Rumah</label>
                            <input type="file" class="form-control @error('foto_tampak_depan') is-invalid @enderror" 
                                   id="foto_tampak_depan" name="foto_tampak_depan" accept="image/jpeg,image/png">
                            <small class="text-muted">Format: JPEG/PNG, Maksimal 2MB</small>
                            @error('foto_tampak_depan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="image-preview" class="mt-3 d-none">
                                <h6>Preview Gambar:</h6>
                                <img src="" class="img-thumbnail" style="max-width: 300px;">
                            </div>
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

<!-- Load Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet Control Geocoder -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<!-- Load Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta
        const map = L.map('map').setView([-7.0051, 110.4381], 13);

        // Tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = null;

        function placeMarker(lat, lng) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', function() {
                const pos = marker.getLatLng();
                updateCoordinates(pos.lat, pos.lng);
            });
            updateCoordinates(lat, lng);
        }

        function updateCoordinates(lat, lng) {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('lokasi').value = `https://www.google.com/maps?q=${lat},${lng}`;
        }

        // Klik peta
        map.on('click', function(e) {
            placeMarker(e.latlng.lat, e.latlng.lng);
        });

        // Locate Me
        document.getElementById('locate-me').addEventListener('click', function() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 15);
                    placeMarker(lat, lng);
                }, function() {
                    alert('Tidak bisa mendapatkan lokasi Anda.');
                });
            }
        });

        // Copy link lokasi
        document.getElementById('copy-location-link').addEventListener('click', function() {
            const locationInput = document.getElementById('lokasi');
            locationInput.select();
            document.execCommand('copy');
            alert('Link lokasi berhasil disalin!');
        });

        // Preview gambar
        document.getElementById('foto_tampak_depan').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.classList.remove('d-none');
                    preview.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Search box (Leaflet Control Geocoder)
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        })
        .on('markgeocode', function(e) {
            const bbox = e.geocode.bbox;
            const center = e.geocode.center;
            map.fitBounds(bbox);
            placeMarker(center.lat, center.lng);
        })
        .addTo(map);

        // Jika ada old data
        @if(old('latitude') && old('longitude'))
            placeMarker({{ old('latitude') }}, {{ old('longitude') }});
        @endif
    });
</script>

@endsection