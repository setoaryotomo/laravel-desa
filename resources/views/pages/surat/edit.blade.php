<!-- resources/views/surat/edit.blade.php -->
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
                        <h3 class="card-title">Edit Data surat</h3>
                        <a href="{{ route('surat.index') }}" class="btn btn-sm btn-secondary float-right">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('surat.update', $surat->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama', $surat->nama) }}" required
                                        readonly>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nik" class="form-label">nik</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        id="nik" name="nik" value="{{ old('nik', $surat->nik) }}" required
                                        readonly>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="telepon" class="form-label">telepon</label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon', $surat->telepon) }}" required
                                        readonly>
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $surat->email) }}" required
                                        readonly>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                    <input type="text" class="form-control @error('jenis_surat') is-invalid @enderror"
                                        id="jenis_surat" name="jenis_surat"
                                        value="{{ old('jenis_surat', $surat->jenis_surat) }}" required readonly>
                                    @error('jenis_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        id="keterangan" name="keterangan"
                                        value="{{ old('keterangan', $surat->keterangan) }}" required readonly>
                                    @error('keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    @if ($surat->status == 3)
                                        <label for="lampiran" class="form-label">File Surat</label>
                                    @elseif ($surat->status != 4)
                                        <label for="lampiran" class="form-label">Upload File Surat</label>
                                    @elseif ($surat->status == 4)
                                        <label for="lampiran" class="form-label" style="color: red">Permohonan Surat Ditolak</label>
                                    @endif

                                    @if ($surat->lampiran)
                                        <div class="mb-2">
                                            @if (pathinfo($surat->lampiran, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $surat->lampiran) }}" target="_blank"
                                                    class="btn btn-sm btn-info">Lihat file_surat (PDF)</a>
                                            @else
                                                <img src="{{ asset('storage/' . $surat->lampiran) }}" class="img-thumbnail"
                                                    style="width: 300px;">
                                            @endif
                                            <div style="display: none" class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="hapus_file_surat"
                                                    name="hapus_file_surat">
                                                <label class="form-check-label" for="hapus_file_surat">
                                                    Hapus file saat disimpan
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($surat->status == 2 || $surat->status == 1)
                                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                            id="lampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">Format: PDF, JPG, PNG, Maksimal 2MB</small>
                                        @error('lampiran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                            </div>

                            @if ($surat->status == 2 || $surat->status == 1)
                                <div class="d-grid gap-2 d-md-flex">
                                    {{-- <button type="reset" class="btn btn-secondary me-md-2">Reset Perubahan</button> --}}
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            @endif

                            @if ($surat->status == 1)
                            <br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    {{-- <a href="{{ route('surat.tolak', $surat->id) }}"
                                        class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-danger" title="Tolak Surat">
                                        <i class="fas fa-times"></i>
                                        <span class="">Tolak Surat</span>
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmationTolak-{{ $surat->id }}"
                                                title="Tolak Surat">
                                            <i class="fas fa-times"></i>
                                            <span class="">Tolak Surat</span>
                                    </button>
                                </div>
                            @endif
                            @if ($surat->status == 2)
                            <br>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('surat.mail', $surat->id) }}"
                                        class="d-inline-block mr-1 mr-sm-2 btn btn-sm btn-success" title="Kirim Surat">
                                        <i class="fas fa-paper-plane"></i>
                                        <span class="">Kirim Surat</span>
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.surat.confirmation-tolak')

    <!-- Script untuk menampilkan preview gambar baru -->
    <script>
        // Script untuk menampilkan preview file_surat jika berupa gambar
        document.getElementById('lampiran').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Hide current file_surat preview if exists
                    const currentPreview = document.getElementById('current-file_surat-preview');
                    if (currentPreview) currentPreview.style.display = 'none';

                    let preview = document.getElementById('new-file_surat-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'new-file_surat-preview';
                        preview.className = 'mt-3';

                        // if (file.type.match('image.*')) {
                        //     preview.innerHTML = '<h6>Preview file_surat Baru:</h6><img src="" class="img-thumbnail" style="max-width: 300px;">';
                        // } else {
                        //     preview.innerHTML = '<h6>File file_surat Baru:</h6><p>' + file.name + '</p>';
                        // }

                        event.target.parentNode.appendChild(preview);
                    }

                    if (file.type.match('image.*')) {
                        preview.querySelector('img').src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
