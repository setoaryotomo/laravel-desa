<!-- resources/views/pages/penghuni/create.blade.php -->
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
                    <h3 class="card-title">Tambah Data Penghuni Baru</h3>
                    {{-- <a href="{{ route('penghuni.anggotakeluarga.index', $penghuni->id) }}" class="btn btn-sm btn-secondary float-right">Kembali</a> --}}
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('penghuni.anggotakeluarga.store', ['rumah' => $rumah->id, 'penghuni' => $penghuni->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" 
                                       id="nik" name="nik" value="{{ old('nik') }}" required>
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="status_keluarga" class="form-label">Status Keluarga</label>
                                <select class="form-control @error('status_keluarga') is-invalid @enderror" 
                                        id="status_keluarga" name="status_keluarga" required>
                                    <option value="">Pilih Status</option>
                                    <option value="istri" {{ old('status_keluarga') == 'istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="anak" {{ old('status_keluarga') == 'anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="cucu" {{ old('status_keluarga') == 'cucu' ? 'selected' : '' }}>Cucu</option>
                                </select>
                                @error('status_keluarga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" 
                                       id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-control @error('agama') is-invalid @enderror" 
                                        id="agama" name="agama" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                       id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="no_wa" class="form-label">Nomor WhatsApp (Opsional)</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror" 
                                       id="no_wa" name="no_wa" value="{{ old('no_wa') }}">
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                                <select class="form-control @error('pendidikan') is-invalid @enderror" 
                                        id="pendidikan" name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="Blm/tidak" {{ old('pendidikan') == 'Blm/tidak' ? 'selected' : '' }}>Belum/Tidak Sekolah</option>
                                    <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="Diploma" {{ old('pendidikan') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                    <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
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
                                    <option value="MENIKAH" {{ old('status_martial') == 'MENIKAH' ? 'selected' : '' }}>Menikah</option>
                                    <option value="JANDA/DUDA" {{ old('status_martial') == 'JANDA/DUDA' ? 'selected' : '' }}>Janda/Duda</option>
                                    <option value="BELUM MENIKAH" {{ old('status_martial') == 'BELUM MENIKAH' ? 'selected' : '' }}>Belum Menikah</option>
                                </select>
                                @error('status_martial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <select class="form-control @error('pekerjaan') is-invalid @enderror" 
                                        id="pekerjaan" name="pekerjaan" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="swasta" {{ old('pekerjaan') == 'swasta' ? 'selected' : '' }}>Swasta</option>
                                    <option value="pns" {{ old('pekerjaan') == 'pns' ? 'selected' : '' }}>PNS</option>
                                    <option value="guru" {{ old('pekerjaan') == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="dosen" {{ old('pekerjaan') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                    <option value="pensiunan" {{ old('pekerjaan') == 'pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                    <option value="ibu rumah tangga" {{ old('pekerjaan') == 'ibu rumah tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                    <option value="lainnya" {{ old('pekerjaan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tempat_kerja" class="form-label">Tempat Bekerja</label>
                                <input type="text" class="form-control @error('tempat_kerja') is-invalid @enderror" 
                                       id="tempat_kerja" name="tempat_kerja" value="{{ old('tempat_kerja') }}">
                                @error('tempat_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="row mb-3">
                            

                            

                            <div class="col-md-6">
                                <label for="file_ktp" class="form-label">Upload KTP (Opsional)</label>
                                <input type="file" class="form-control @error('file_ktp') is-invalid @enderror" 
                                       id="file_ktp" name="file_ktp" accept=".jpg,.jpeg,.png">
                                <small class="text-muted">Format: JPG, PNG, Maksimal 2MB</small>
                                @error('file_ktp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary mr-1">Kembali</button></a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
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
                let preview = document.getElementById('ktp-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'ktp-preview';
                    preview.className = 'mt-3';
                    preview.innerHTML = '<h6>Preview KTP:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                    event.target.parentNode.appendChild(preview);
                }
                preview.querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    
</script>
@endsection