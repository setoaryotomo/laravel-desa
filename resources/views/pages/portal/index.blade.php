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
</style>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home - Laravel</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

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

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="{{ asset('enno/assets/img/logo.png') }}" alt=""> -->
                <h1 class="sitename">eNno</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    {{-- <li><a href="#about">About</a></li> --}}
                    <li><a href="#team">Agenda</a></li>
                    <li><a href="#portfolio">Berita</a></li>
                    <li><a href="#portfolio1">Gallery</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                        class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="/login">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="fade-up">
                        <h1>Elegant and creative solutions</h1>
                        <p>We are team of talented designers making websites with Bootstrap</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started">Get Started</a>
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="glightbox btn-watch-video d-flex align-items-center"><i
                                    class="bi bi-play-circle"></i><span>Watch Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="{{ asset('enno/assets/img/hero-img.png') }}" class="img-fluid animated"
                            alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->


        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>About Us<br></span>
                <h2>About</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('enno/assets/img/about.png') }}" class="img-fluid" alt="">
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                    </div>
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in
                                    voluptate velit.</span></li>
                            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                    storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->


        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Agenda</span>
                <h2>Agenda</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    @foreach ($agendas as $agenda)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
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
                        </div><!-- End Team Member -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Berita</span>
                <h2>Berita</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($beritas as $berita)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img src="{{ asset('storage/' . $berita->foto_berita) }}" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $berita->judul }}</h4>
                                    <p>{{ $berita->deskripsi }}</p>
                                    <a href="{{ asset('storage/' . $berita->foto_berita) }}"
                                        title="{{ $berita->judul }}" data-gallery="portfolio-gallery-app"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div><!-- End Portfolio Item -->
                        @endforeach
                    </div><!-- End Portfolio Container -->
                </div>
            </div>
        </section><!-- /Portfolio Section -->


        <!-- Portfolio Section -->
        <section id="portfolio1" class="portfolio section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Gallery</span>
                <h2>Gallery</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->
            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($gallerys as $gallery)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img src="{{ asset('storage/' . $gallery->foto_gallery) }}" class="img-fluid"
                                    alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $gallery->judul }}</h4>
                                    <p>{{ $gallery->deskripsi }}</p>
                                    <a href="{{ asset('storage/' . $gallery->foto_gallery) }}"
                                        title="{{ $gallery->judul }}" data-gallery="portfolio-gallery-app"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div><!-- End Portfolio Item -->
                        @endforeach
                    </div><!-- End Portfolio Container -->
                </div>
            </div>
        </section><!-- /Portfolio Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Section Title</span>
                <h2>Contact</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p>A108 Adam Street, New York, NY 535022</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>+1 5589 55488 55</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                                frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-7">

                        <form action="{{ route('permohonan') }}" class="php-email-form" method="POST"
                            data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            @method('POST')
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="name-field" class="pb-2">Nama</label>
                                    <input type="text" name="nama" id="inputNama" class="form-control"
                                        required="">
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail"
                                        required="">
                                </div>

                                <div class="col-md-6">
                                    <label for="subject-field" class="pb-2">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" id="inputTelepon"
                                        required="">
                                </div>

                                <div class="col-md-6">
                                    <label for="subject-field" class="pb-2">NIK</label>
                                    <input type="text" class="form-control" name="nik" id="inputNik"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Jenis Surat</label>
                                    <input type="text" class="form-control" name="jenis_surat"
                                        id="inputJenissurat" required="">
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan"
                                        id="inputKeterangan" required="">
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Lampiran</label>
                                    <input type="text" class="form-control" name="lampiran" id="inputLampiran"
                                        required="">
                                </div>

                                {{-- <input type="hidden" name="_method" value="POST"> --}}

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send</button>
                                </div>

                                {{-- <button type="submit">Send</button> --}}

                            </div>

                    </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

    <!-- Pencarian Real-time Section -->
    <section id="search" class="search section light-background">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Pencarian Data Penghuni</h2>
                <p>Cari data penghuni berdasarkan NIK, Nama</p>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-8">
                    <div class="search-box">
                        <input type="text" id="search-input" class="form-control" placeholder="Masukkan NIK/Nama.">
                        <select id="search-by" class="form-select">
                            <option value="nik">NIK</option>
                            <option value="nama">Nama</option>
                            {{-- <option value="no_kk">No KK</option> --}}
                        </select>
                        <button style="display: none" id="search-btn" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>

            <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="col-12">
                    <div id="search-results" class="search-results">
                        <!-- Hasil pencarian akan muncul di sini -->
                    </div>
                </div>
            </div>
        </div>
    </section>

        {{-- <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
                    </div>
                </div>
            </div>
        </div> --}}

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
            <p>© <span>Copyright</span> <strong class="px-1 sitename">eNno</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                    href=“https://themewagon.com>ThemeWagon
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('enno/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('enno/assets/vendor/php-email-form/validate.js') }}"></script>
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
            const searchInput = document.getElementById('search-input');
            const searchBySelect = document.getElementById('search-by');
            const searchBtn = document.getElementById('search-btn');
            const searchResults = document.getElementById('search-results');
        
            // Fungsi untuk melakukan pencarian
            function performSearch() {
    const keyword = searchInput.value.trim();
    const searchBy = searchBySelect.value;

    if (keyword.length === 0) {
        searchResults.innerHTML = '<div class="no-results">Masukkan kata kunci pencarian</div>';
        return;
    }

    // Tampilkan loading
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
            data.forEach(item => {
                if (item.type === 'penghuni') {
                    html += `
                        <div class="result-item penghuni">
                            <div class="result-title">
                                ${item.nama} 
                                <span class="badge bg-primary">Kepala Keluarga</span>
                            </div>
                            <div class="result-detail">
                                <span>NIK: <b>${item.nik}</b></span>
                                <span>Status: <b>${item.status_penghuni}</b></span>
                                <span>Alamat: <b>${item.rumah.alamat_lengkap} RT ${item.rumah.rt} RW ${item.rumah.rw} Kelurahan ${item.rumah.kelurahan}</b></span>
                                <span>Kodepos: <b>${item.rumah.kode_pos}</b></span>
                            </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="result-item anggota">
                            <div class="result-title">
                                ${item.nama} 
                                <span class="badge bg-success">Anggota Keluarga</span>
                            </div>
                            <div class="result-detail">
                                <span>NIK: <b>${item.nik}</b></span>
                                <span>Status: <b>${item.status_keluarga}</b></span>
                                <span>Kepala Keluarga: <b>${item.penghuni?.nama_kepala_keluarga || '-'}</b></span>
                                <span>Alamat: <b>${item.penghuni.rumah.alamat_lengkap} RT ${item.penghuni.rumah.rt} RW ${item.penghuni.rumah.rw} Kelurahan ${item.penghuni.rumah.kelurahan}</b></span>
                                <span>Kodepos: <b>${item.penghuni.rumah.kode_pos}</b></span>
                            </div>
                        </div>
                    `;
                }
            });

            searchResults.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            searchResults.innerHTML = '<div class="no-results">Terjadi kesalahan saat melakukan pencarian</div>';
        });
}
        
            // Event listener untuk tombol cari
            searchBtn.addEventListener('click', performSearch);
        
            // Event listener untuk enter di input
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });
        
            // Event listener untuk perubahan input (pencarian langsung saat mengetik)
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(performSearch, 500);
            });
        });
        </script>

</body>

</html>

