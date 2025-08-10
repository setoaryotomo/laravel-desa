<!-- resources/views/pages/penghuni/edit.blade.php -->
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
                        <h3 class="card-title">Edit Data Penghuni</h3>
                        {{-- <a href="{{ route('rumah.penghuni.index', $rumah->id) }}" class="btn btn-sm btn-secondary float-right">Kembali</a> --}}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('rumah.penghuni.update', [$rumah->id, $penghuni->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="status_penghuni" class="form-label">Status Penghuni</label>
                                    <select class="form-control @error('status_penghuni') is-invalid @enderror"
                                        id="status_penghuni" name="status_penghuni" required>
                                        <option value="">Pilih Status</option>
                                        <option value="pemilik rumah"
                                            {{ old('status_penghuni', $penghuni->status_penghuni) == 'pemilik rumah' ? 'selected' : '' }}>
                                            Pemilik Rumah</option>
                                        <option value="kontrak"
                                            {{ old('status_penghuni', $penghuni->status_penghuni) == 'kontrak' ? 'selected' : '' }}>
                                            Kontrak</option>
                                        <option value="boro"
                                            {{ old('status_penghuni', $penghuni->status_penghuni) == 'boro' ? 'selected' : '' }}>
                                            Boro</option>
                                    </select>
                                    @error('status_penghuni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="is_kepala_keluarga" class="form-label">Status dalam Keluarga</label>
                                    <select class="form-control @error('is_kepala_keluarga') is-invalid @enderror"
                                        id="is_kepala_keluarga" name="is_kepala_keluarga" required>
                                        <option value="">Pilih Status</option>
                                        <option value="1"
                                            {{ old('is_kepala_keluarga', $penghuni->is_kepala_keluarga) == '1' ? 'selected' : '' }}>
                                            Kepala Keluarga</option>
                                        <option value="0"
                                            {{ old('is_kepala_keluarga', $penghuni->is_kepala_keluarga) == '0' ? 'selected' : '' }}>
                                            Anggota Keluarga</option>
                                    </select>
                                    @error('is_kepala_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $penghuni->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ old('nik', $penghuni->nik) }}" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L"
                                            {{ old('jenis_kelamin', $penghuni->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', $penghuni->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                        id="tgl_lahir" name="tgl_lahir"
                                        value="{{ old('tgl_lahir', $penghuni->tgl_lahir) }}" required>
                                    @error('tgl_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="agama" class="form-label">Agama</label>
                                    <select class="form-control @error('agama') is-invalid @enderror" id="agama"
                                        name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam"
                                            {{ old('agama', $penghuni->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen"
                                            {{ old('agama', $penghuni->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                                        </option>
                                        <option value="Katolik"
                                            {{ old('agama', $penghuni->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                                        </option>
                                        <option value="Hindu"
                                            {{ old('agama', $penghuni->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha"
                                            {{ old('agama', $penghuni->agama) == 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu"
                                            {{ old('agama', $penghuni->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                    @error('agama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ old('no_hp', $penghuni->no_hp) }}"
                                        required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="no_wa" class="form-label">Nomor WhatsApp (Opsional)</label>
                                    <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                        id="no_wa" name="no_wa" value="{{ old('no_wa', $penghuni->no_wa) }}">
                                    @error('no_wa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan"
                                        name="pendidikan" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Blm/tidak"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'Blm/tidak' ? 'selected' : '' }}>
                                            Belum/Tidak Sekolah</option>
                                        <option value="SD"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'SD' ? 'selected' : '' }}>SD
                                        </option>
                                        <option value="SMP"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP
                                        </option>
                                        <option value="SMA"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA
                                        </option>
                                        <option value="Diploma"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'Diploma' ? 'selected' : '' }}>
                                            Diploma</option>
                                        <option value="S1"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'S1' ? 'selected' : '' }}>S1
                                        </option>
                                        <option value="S2"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'S2' ? 'selected' : '' }}>S2
                                        </option>
                                        <option value="S3"
                                            {{ old('pendidikan', $penghuni->pendidikan) == 'S3' ? 'selected' : '' }}>S3
                                        </option>
                                    </select>
                                    @error('pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="status_martial" class="form-label">Status Perkawinan</label>
                                    <select class="form-control @error('status_martial') is-invalid @enderror"
                                        id="status_martial" name="status_martial" required>
                                        <option value="">Pilih Status</option>
                                        <option value="MENIKAH"
                                            {{ old('status_martial', $penghuni->status_martial) == 'MENIKAH' ? 'selected' : '' }}>
                                            Menikah</option>
                                        <option value="JANDA/DUDA"
                                            {{ old('status_martial', $penghuni->status_martial) == 'JANDA/DUDA' ? 'selected' : '' }}>
                                            Janda/Duda</option>
                                        <option value="BELUM MENIKAH"
                                            {{ old('status_martial', $penghuni->status_martial) == 'BELUM MENIKAH' ? 'selected' : '' }}>
                                            Belum Menikah</option>
                                    </select>
                                    @error('status_martial')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <select class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan"
                                        name="pekerjaan" required>
                                        <option value="">Pilih Pekerjaan</option>
                                        <option value="swasta"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'swasta' ? 'selected' : '' }}>
                                            Swasta</option>
                                        <option value="pns"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'pns' ? 'selected' : '' }}>PNS
                                        </option>
                                        <option value="guru"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'guru' ? 'selected' : '' }}>Guru
                                        </option>
                                        <option value="dosen"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'dosen' ? 'selected' : '' }}>Dosen
                                        </option>
                                        <option value="pensiunan"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'pensiunan' ? 'selected' : '' }}>
                                            Pensiunan</option>
                                        <option value="ibu rumah tangga"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'ibu rumah tangga' ? 'selected' : '' }}>
                                            Ibu Rumah Tangga</option>
                                        <option value="lainnya"
                                            {{ old('pekerjaan', $penghuni->pekerjaan) == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tempat_kerja" class="form-label">Tempat Bekerja</label>
                                    <input type="text"
                                        class="form-control @error('tempat_kerja') is-invalid @enderror"
                                        id="tempat_kerja" name="tempat_kerja"
                                        value="{{ old('tempat_kerja', $penghuni->tempat_kerja) }}">
                                    @error('tempat_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="file_ktp" class="form-label">Upload KTP (Opsional)</label>
                                    {{-- @if ($penghuni->file_ktp)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $penghuni->file_ktp) }}" 
                                         class="img-thumbnail" style="width: 400px;">
                                            <div style="display: none" class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="hapus_ktp"
                                                    name="hapus_ktp">
                                                <label class="form-check-label" for="hapus_ktp">
                                                    Hapus foto saat disimpan
                                                </label>
                                            </div>
                                        </div>
                                    @endif --}}
                                    @if (pathinfo($penghuni->file_ktp))
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $penghuni->file_ktp) }}" target="_blank"
                                            class="btn btn-sm btn-info">Lihat File KTP</a>
                                        </div>
                                    @endif
                                    
                                    <input type="file" class="form-control @error('file_ktp') is-invalid @enderror"
                                        id="file_ktp" name="file_ktp" accept=".jpg,.jpeg,.png">
                                    <small class="text-muted">Format: JPG, PNG, Maksimal 2MB</small>
                                    @error('file_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="kartu_keluarga" class="form-label">Upload Kartu Keluarga
                                        (Opsional)</label>
                                    @if ($penghuni->kartu_keluarga)
                                        <div class="mb-2">
                                            @if (pathinfo($penghuni->kartu_keluarga))
                                                <a href="{{ asset('storage/' . $penghuni->kartu_keluarga) }}"
                                                    target="_blank" class="btn btn-sm btn-info">Lihat File KK</a>
                                            @else
                                                <img src="{{ asset('storage/' . $penghuni->kartu_keluarga) }}"
                                                    class="img-thumbnail" style="width: 300px;">
                                            @endif
                                            <div style="display: none" class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="hapus_kk"
                                                    name="hapus_kk">
                                                <label class="form-check-label" for="hapus_kk">
                                                    Hapus file saat disimpan
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file"
                                        class="form-control @error('kartu_keluarga') is-invalid @enderror"
                                        id="kartu_keluarga" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Format: PDF, JPG, PNG, Maksimal 2MB</small>
                                    @error('kartu_keluarga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="foto" class="form-label">Upload Foto </label>
                                    @if ($penghuni->foto)
                                        <div class="mb-2" id="image-preview-container">
                                            <img id="current-image-preview" src="{{ asset('storage/' . $penghuni->foto) }}"
                                                class="img-thumbnail" style="width: 400px;">
                                            <div style="display: none" class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="hapus_foto"
                                                    name="hapus_foto">
                                                <label class="form-check-label" for="hapus_foto">
                                                    Hapus foto saat disimpan
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" accept=".jpg,.jpeg,.png">
                                    <small class="text-muted">Format: JPG, PNG, Maksimal 2MB</small>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('rumah.penghuni.index', $rumah->id) }}"><button type="button"
                                        class="btn btn-secondary mr-1">Kembali</button></a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk menampilkan preview gambar KTP
        document.getElementById('file_ktp').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Hide current KTP preview if exists
                    const currentPreview = document.getElementById('current-ktp-preview');
                    if (currentPreview) currentPreview.style.display = 'none';

                    let preview = document.getElementById('new-ktp-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'new-ktp-preview';
                        preview.className = 'mt-3';
                        preview.innerHTML =
                            '<h6>Preview KTP Baru:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                        event.target.parentNode.appendChild(preview);
                    }
                    preview.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Script untuk menampilkan preview KK jika berupa gambar
        document.getElementById('kartu_keluarga').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Hide current KK preview if exists
                    const currentPreview = document.getElementById('current-kk-preview');
                    if (currentPreview) currentPreview.style.display = 'none';

                    let preview = document.getElementById('new-kk-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'new-kk-preview';
                        preview.className = 'mt-3';

                        if (file.type.match('image.*')) {
                            preview.innerHTML =
                                '<h6>Preview KK Baru:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                        } else {
                            preview.innerHTML = '<h6>File KK Baru:</h6><p>' + file.name + '</p>';
                        }

                        event.target.parentNode.appendChild(preview);
                    }

                    if (file.type.match('image.*')) {
                        preview.querySelector('img').src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const container = document.getElementById('image-preview-container');
                
                // Hide current image if exists
                const currentPreview = document.getElementById('current-image-preview');
                if (currentPreview) currentPreview.style.display = 'none';
                
                // Check if new preview already exists
                let newPreview = document.getElementById('new-image-preview');
                
                if (!newPreview) {
                    // Create new preview if doesn't exist
                    newPreview = document.createElement('img');
                    newPreview.id = 'new-image-preview';
                    newPreview.className = 'img-thumbnail';
                    newPreview.style.maxWidth = '300px';
                    container.insertBefore(newPreview, container.firstChild);
                }
                
                // Set the new image source
                newPreview.src = e.target.result;
                newPreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
@endsection
