<!DOCTYPE html>
<html lang="en">

<style>
    /* Search Section */
.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-box input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    font-size: 16px;
}

.search-box select {
    width: 120px;
    padding: 10px;
    border: 1px solid #dee2e6;
    border-radius: 4px;
}

.search-results {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.result-item {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    transition: all 0.3s ease;
}

.result-item:hover {
    background-color: #f8f9fa;
}

.result-item:last-child {
    border-bottom: none;
}

.result-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.result-detail {
    display: flex;
    gap: 15px;
    font-size: 14px;
    color: #7f8c8d;
}

.no-results {
    padding: 20px;
    text-align: center;
    color: #7f8c8d;
}

.loading-indicator {
    display: none;
    text-align: center;
    padding: 20px;
}

.loading-indicator.active {
    display: block;
}

.spinner {
    width: 40px;
    height: 40px;
    margin: 0 auto;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Modal Styling */
.modal-content {
    border-radius: 8px;
}

.modal-body .detail-item {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.modal-body .detail-item:last-child {
    border-bottom: none;
}

.modal-body .detail-label {
    font-weight: 600;
    color: #2c3e50;
}

.modal-body .detail-value {
    color: #7f8c8d;
}

/* Autocomplete Styling */
.autocomplete-container {
    position: relative;
    width: 100%;
}

.autocomplete-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 4px 4px;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: none;
}

.autocomplete-item {
    padding: 10px 15px;
    cursor: pointer;
    border-bottom: 1px solid #f1f1f1;
    transition: background-color 0.2s;
}

.autocomplete-item:hover,
.autocomplete-item.selected {
    background-color: #f8f9fa;
}

.autocomplete-item:last-child {
    border-bottom: none;
}

.autocomplete-name {
    font-weight: 600;
    color: #2c3e50;
}

.autocomplete-nik {
    font-size: 12px;
    color: #7f8c8d;
    margin-top: 2px;
}

.verification-info {
    background-color: #e7f3ff;
    border: 1px solid #b8daff;
    border-radius: 4px;
    padding: 10px;
    margin-top: 10px;
    font-size: 14px;
    color: #004085;
}

.error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
}
</style>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home - Laravel</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('enno/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('enno/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('enno/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('enno/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('enno/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('enno/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('enno/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#hero" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">eNno</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#agenda">Agenda</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#surat">Permohonan Surat</a></li>
                    <li><a href="#search">Data Penduduk</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @auth
                <a class="btn-getstarted" href="/dashboard">Dashboard</a>
            @else
                <a class="btn-getstarted" href="/login">Login</a>
            @endauth

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero" style="background-image: url('https://cdn.pixabay.com/photo/2013/10/10/18/18/landscape-193720_1280.jpg'); background-size: cover; background-position: center;height:500px; position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.203); z-index: 1;"></div>
            <div class="container" style="padding-top: 140px; position: relative; z-index: 2;">
                <div class="d-flex justify-content-center" data-aos="fade-up">
                    <h1 style="color: white">Elegant and creative solutions</h1>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container section-title" data-aos="fade-up">
                <span>About Us<br></span>
                <h2>About</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('enno/assets/img/about.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Agenda Section -->
        <section id="agenda" class="team section">
            <div class="container section-title" data-aos="fade-up">
                <span>Agenda</span>
                <h2>Agenda</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            <div class="container">
                <div class="row gy-5">
                    @foreach ($agendas as $agenda)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <a href="{{ route('portal.agenda', $agenda->id) }}" class="img-link">
                            <div class="member">
                                <div class="pic"><img src="{{ asset('storage/' . $agenda->foto_agenda) }}"
                                        class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <h4>{{ $agenda->judul }}</h4>
                                    <span>{{ $agenda->deskripsi }}</span>
                                    <div class="social">
                                        <span>{{ $agenda->tanggal }}</span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section id="berita" class="portfolio section light-background">
            <div class="container section-title" data-aos="fade-up">
                <span>Berita</span>
                <h2>Berita</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($beritas as $berita)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img src="{{ asset('storage/' . $berita->foto_berita) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <a href="{{ route('portal.berita', $berita->id) }}" class="img-link">
                                        <h4>{{ $berita->judul }}</h4>
                                        <p>{{ $berita->deskripsi }}</p>
                                        <a href="{{ asset('storage/' . $berita->foto_berita) }}"
                                            title="{{ $berita->judul }}" data-gallery=""
                                            class="glightbox preview-link"></a>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="portfolio section">
            <div class="container section-title" data-aos="fade-up">
                <span>Gallery</span>
                <h2>Gallery</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($gallerys as $gallery)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <a href="{{ asset('storage/' . $gallery->foto_gallery) }}"
                                    title="{{ $gallery->judul }}" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link">
                                <img src="{{ asset('storage/' . $gallery->foto_gallery) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->judul }}</h4>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="surat" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <span>Permohonan Surat</span>
                <h2>Permohonan Surat</h2>
                <p>Silakan isi formulir berikut untuk mengajukan permohonan surat</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    <div class="col-lg-12">
                        
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="error-message">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('permohonan') }}" class="php-email-form" method="POST" data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            
                            {{-- <div class="verification-info">
                                <i class="bi bi-info-circle"></i> 
                                <strong>Informasi Penting:</strong> Untuk keamanan, pastikan data yang Anda masukkan sesuai dengan database penduduk. 
                                Tanggal lahir akan digunakan sebagai verifikasi identitas.
                            </div> --}}

                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="nama-field" class="pb-2">Nama Lengkap</label>
                                    <div class="autocomplete-container">
                                        <input type="text" name="nama" id="inputNama" class="form-control" 
                                               placeholder="Ketik nama untuk mencari..." value="{{ old('nama') }}" required>
                                        <div class="autocomplete-suggestions" id="nama-suggestions"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Email</label>
                                    <input type="email" placeholder="Isi Email..." class="form-control" name="email" id="inputEmail" 
                                           value="{{ old('email') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="nik-field" class="pb-2">NIK</label>
                                    <input type="text" class="form-control" name="nik" id="inputNik" 
                                           maxlength="16" value="{{ old('nik') }}" required readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="tgl-lahir-field" class="pb-2">Tanggal Lahir <small class="text-muted">(untuk verifikasi)</small></label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="inputTglLahir" 
                                           value="{{ old('tgl_lahir') }}" required>
                                </div>

                                <div class="col-md-2">
                                    <label for="rt-field" class="pb-2">RT</label>
                                    <input type="text" class="form-control" name="rt" id="inputRt" 
                                           value="{{ old('rt') }}" required readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="rw-field" class="pb-2">RW</label>
                                    <input type="text" class="form-control" name="rw" id="inputRw" 
                                           value="{{ old('rw') }}" required readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="telepon-field" class="pb-2">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="no_hp" id="inputTelepon" 
                                           value="{{ old('no_hp') }}" required readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="jenis-surat-field" class="pb-2">Jenis Surat</label>
                                    <select class="form-control" name="jenis_surat" id="inputJenissurat" required>
                                        <option value="">Pilih Jenis Surat</option>
                                        <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>Surat Keterangan Domisili</option>
                                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>Surat Keterangan Tidak Mampu</option>
                                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat Keterangan Usaha</option>
                                        <option value="Surat Pengantar" {{ old('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                                        <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="keterangan-field" class="pb-2">Keterangan/Keperluan</label>
                                    <textarea class="form-control" name="keterangan" id="inputKeterangan" rows="4" 
                                              placeholder="Jelaskan keperluan surat yang dimohon..." required>{{ old('keterangan') }}</textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Memproses...</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Permohonan Anda berhasil dikirim!</div>
                                    <button type="submit">Kirim Permohonan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <section id="search" class="search section light-background">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Pencarian Data Penduduk</h2>
                    <p>Cari data penghuni berdasarkan NIK, Nama</p>
                </div>

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-8">
                        <div class="search-box">
                            <select id="search-by" class="form-select">
                                <option value="nik">NIK</option>
                                <option value="nama">Nama</option>
                            </select>
                            <input type="text" id="search-input" class="form-control" placeholder="Search...">
                            <button style="display: none" id="search-btn" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-12">
                        <div id="search-results" class="search-results">
                            <!-- Hasil pencarian akan muncul di sini -->
                        </div>
                        <!-- Modal untuk Detail Penduduk -->
                        <div class="modal fade" id="residentDetailModal" tabindex="-1" aria-labelledby="residentDetailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="residentDetailModalLabel">Detail Data Penduduk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="modal-content">
                                            <!-- Detail penduduk akan dimuat di sini -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">eNno</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">eNno</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('enno/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('enno/assets/vendor/php-email-form/validate.js') }}"></script> --}}
    <script src="{{ asset('enno/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('enno/assets/js/main.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Autocomplete functionality for letter form
            const namaInput = document.getElementById('inputNama');
            const nikInput = document.getElementById('inputNik');
            const teleponInput = document.getElementById('inputTelepon');
            const rtInput = document.getElementById('inputRt');
            const rwInput = document.getElementById('inputRw');
            const tglLahirInput = document.getElementById('inputTglLahir');
            const suggestions = document.getElementById('nama-suggestions');
            
            let autocompleteTimeout;
            let selectedResidentData = null;

            // Setup CSRF token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Autocomplete for nama field
            namaInput.addEventListener('input', function() {
                clearTimeout(autocompleteTimeout);
                const keyword = this.value.trim();

                if (keyword.length < 2) {
                    hideSuggestions();
                    return;
                }

                autocompleteTimeout = setTimeout(() => {
                    fetchAutocompleteData(keyword);
                }, 300);
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.autocomplete-container')) {
                    hideSuggestions();
                }
            });

            function fetchAutocompleteData(keyword) {
                fetch(`/api/autocomplete-resident?keyword=${encodeURIComponent(keyword)}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showSuggestions(data);
                })
                .catch(error => {
                    console.error('Autocomplete error:', error);
                    hideSuggestions();
                });
            }

            function showSuggestions(data) {
                if (data.length === 0) {
                    hideSuggestions();
                    return;
                }

                let html = '';
                data.forEach((item, index) => {
                    html += `
                        <div class="autocomplete-item" data-index="${index}">
                            <div class="autocomplete-name">${item.nama}</div>
                            <div class="autocomplete-nik">NIK: ${item.nik}</div>
                        </div>
                    `;
                });

                suggestions.innerHTML = html;
                suggestions.style.display = 'block';
                suggestions.dataset.results = JSON.stringify(data);

                // Add click event to each suggestion
                suggestions.querySelectorAll('.autocomplete-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const index = this.dataset.index;
                        const results = JSON.parse(suggestions.dataset.results);
                        selectResident(results[index]);
                    });
                });
            }

            function hideSuggestions() {
                suggestions.style.display = 'none';
                suggestions.innerHTML = '';
            }

            function selectResident(resident) {
                selectedResidentData = resident;
                namaInput.value = resident.nama;
                nikInput.value = resident.nik;
                
                teleponInput.value = resident.no_hp;
                rtInput.value = resident.rt;
                rwInput.value = resident.rw;
                
                // if (resident.tgl_lahir) {
                //     tglLahirInput.value = resident.tgl_lahir;
                // }
                hideSuggestions();
            }

            // Clear selected data when fields are manually changed
            nikInput.addEventListener('input', function() {
                if (selectedResidentData && this.value !== selectedResidentData.nik) {
                    selectedResidentData = null;
                }
            });

            tglLahirInput.addEventListener('change', function() {
                if (selectedResidentData && this.value !== selectedResidentData.tgl_lahir) {
                    selectedResidentData = null;
                }
            });

            // Search functionality (existing code)
            const searchInput = document.getElementById('search-input');
            const searchBySelect = document.getElementById('search-by');
            const searchBtn = document.getElementById('search-btn');
            const searchResults = document.getElementById('search-results');
            const residentDetailModal = new bootstrap.Modal(document.getElementById('residentDetailModal'));
            const modalContent = document.getElementById('modal-content');
        
            function performSearch() {
                const keyword = searchInput.value.trim();
                const searchBy = searchBySelect.value;
        
                if (keyword.length === 0) {
                    searchResults.innerHTML = '<div class="no-results">Masukkan kata kunci pencarian</div>';
                    return;
                }
        
                searchResults.innerHTML = `
                    <div class="loading-indicator active">
                        <div class="spinner"></div>
                        <p>Mencari data...</p>
                    </div>
                `;
        
                fetch(`/api/search?keyword=${encodeURIComponent(keyword)}&search_by=${searchBy}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            searchResults.innerHTML = '<div class="no-results">Tidak ditemukan data yang sesuai</div>';
                            return;
                        }
        
                        let html = '';
                        data.forEach((item, index) => {
                            if (item.type === 'penghuni') {
                                html += `
                                    <div class="result-item penghuni" data-index="${index}" style="cursor: pointer;">
                                        <div class="result-title">${item.nama}</div>
                                        <div class="result-detail">
                                            <span>NIK: <b>${item.nik}</b></span>
                                            <span>Status: <b>${item.status_penghuni}</b></span>
                                        </div>
                                    </div>
                                `;
                            } else {
                                html += `
                                    <div class="result-item anggota" data-index="${index}" style="cursor: pointer;">
                                        <div class="result-title">${item.nama}</div>
                                        <div class="result-detail">
                                            <span>NIK: <b>${item.nik}</b></span>
                                            <span>Status: <b>${item.status_keluarga}</b></span>
                                            <span>Kepala Keluarga: <b>${item.penghuni?.nama_kepala_keluarga || '-'}</b></span>
                                        </div>
                                    </div>
                                `;
                            }
                        });
        
                        searchResults.innerHTML = html;
                        searchResults.dataset.results = JSON.stringify(data);
        
                        document.querySelectorAll('.result-item').forEach(item => {
                            item.addEventListener('click', function() {
                                const index = this.dataset.index;
                                const results = JSON.parse(searchResults.dataset.results);
                                const selectedItem = results[index];
        
                                let modalHtml = '';
                                if (selectedItem.type === 'penghuni') {
                                    modalHtml = `
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <img src="{{ asset('storage/') }}/${selectedItem.foto}" 
                                            class="img-thumbnail" style="width: 250px;">
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Nama:</span>
                                        <span class="detail-value">${selectedItem.nama}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Status:</span>
                                        <span class="detail-value">${selectedItem.is_kepala_keluarga == 1 ? 'Kepala Keluarga' : 'Anggota Keluarga'}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">NIK:</span>
                                        <span class="detail-value">${selectedItem.nik}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Status Penghuni:</span>
                                        <span class="detail-value">${selectedItem.status_penghuni}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Alamat:</span>
                                        <span class="detail-value">${selectedItem.rumah.alamat_lengkap} No.${selectedItem.rumah.no_rumah} RT ${selectedItem.rumah.rt} RW ${selectedItem.rumah.rw} Kelurahan ${selectedItem.rumah.kelurahan}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Kodepos:</span>
                                        <span class="detail-value">${selectedItem.rumah.kode_pos}</span>
                                    </div>
                                    `;
                                } else {
                                    modalHtml = `
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <img src="{{ asset('storage/') }}/${selectedItem.foto}" 
                                                class="img-thumbnail" style="width: 250px;">
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Nama:</span>
                                            <span class="detail-value">${selectedItem.nama}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Status:</span>
                                            <span class="detail-value">Anggota Keluarga</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">NIK:</span>
                                            <span class="detail-value">${selectedItem.nik}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Status Keluarga:</span>
                                            <span class="detail-value">${selectedItem.status_keluarga}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Kepala Keluarga:</span>
                                            <span class="detail-value">${selectedItem.penghuni?.nama_kepala_keluarga || '-'}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Alamat:</span>
                                            <span class="detail-value">${selectedItem.penghuni.rumah.alamat_lengkap} No.${selectedItem.penghuni.rumah.no_rumah} RT ${selectedItem.penghuni.rumah.rt} RW ${selectedItem.penghuni.rumah.rw} Kelurahan ${selectedItem.penghuni.rumah.kelurahan}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Kodepos:</span>
                                            <span class="detail-value">${selectedItem.penghuni.rumah.kode_pos}</span>
                                        </div>
                                    `;
                                }
        
                                modalContent.innerHTML = modalHtml;
                                residentDetailModal.show();
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        searchResults.innerHTML = '<div class="no-results">Terjadi kesalahan saat melakukan pencarian</div>';
                    });
            }
        
            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 500);
            });
        });
        </script>

</body>

</html>