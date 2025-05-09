<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>List Pengumuman</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            max-width: 100%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-lg-6 {
            flex: 1 1 50%;
            max-width: 50%;
        }

        @media (max-width: 768px) {
            .col-lg-6 {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>

</head>

<body class="category-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('homepage') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">RuangPikiran</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('homepage') }}" class="active">Home</a></li>
                    <li><a href="{{ route('about_us') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('pembelajaran_user') }}">Pembelajaran</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Categories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ route('jadwal.user') }}">Jadwal</a></li>
                            <li><a href="{{ route('analisis.form') }}">Cek Kesehatan Mental</a></li>
                            <!-- <li><a href="category.html">Category 3</a></li> -->
                        </ul>
                    </li>
                    <li><a href="{{ route('feedback.user') }}">Feedback</a></li>

                    <!-- Dropdown untuk Auth Buttons saat Mobile -->
                    <li class="dropdown auth-dropdown d-xl-none">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <span>Akun</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @if(auth()->check())
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="p-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 text-start">Logout</button>
                                </form>
                            </li>
                            @else
                            <li><a href="{{ route('registrasi.tampil') }}" class="dropdown-item">Daftar</a></li>
                            <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
                            @endif
                        </ul>
                    </li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Tombol tetap muncul di layar besar -->
            <div class="header-auth-buttons d-none d-xl-flex">
                @if(auth()->check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
                @else
                <a href="{{ route('registrasi.tampil') }}" class="btn btn-primary">Daftar</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                @endif
            </div>
        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title position-relative">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Daftar Pengumuman</h1>
            </div>

        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Posts Section -->
                    <section id="blog-posts" class="blog-posts section">
                        <div class="container">
                            <div class="container mt-5">
                                <div class="row">
                                    @if ($announcements->isNotEmpty())
                                    @foreach ($announcements as $announcement)
                                    <div class="col-lg-6 mb-4">
                                        <article class="card shadow-sm border-0 rounded-3 p-4 position-relative">
                                            <h3 class="fw-bold mb-2">{{ $announcement->title }}</h3>
                                            <p class="text-muted mb-3">
                                                {{ Str::words($announcement->content, 15, '...') }}
                                            </p>
                                            <hr class="my-2">
                                            <a href="{{ route('announcement.show', $announcement->id) }}" class="text-primary fw-semibold d-flex align-items-center">
                                                Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                            <span class="badge bg-primary position-absolute bottom-0 end-0 m-3 px-3 py-2">
                                                {{ $announcement->created_at->format('d M Y') }}
                                            </span>
                                        </article>
                                    </div>
                                    @endforeach

                                    <!-- Tambahkan Pagination -->
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $announcements->links() }}
                                    </div>
                                    @else
                                    <p class="text-center">Tidak ada pengumuman tersedia.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </main>

    <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">RuangPikiran</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Institut Teknologi Del</p>
            <p> Jl. Sisingamangaraja, Sitoluama</p>
            <p>Laguboti, Toba Samosir
              Sumatera Utara, Indonesia</p>
            <p class="mt-3"><strong>Phone:</strong> <span> +62 632 331234</span></p>
            <p><strong>Email:</strong> <span>info@del.ac.id</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{ route('homepage') }}">Home</a></li>
            <li><a href="{{ route('about_us') }}">Tentang Kami</a></li>
            <li><a href="{{ route('pembelajaran_user') }}">Pembelajaran</a></li>
            <li><a href="{{ route('jadwal.user') }}">Jadwal</a></li>
            <li><a href="{{ route('feedback.user') }}">Feedback</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="https://web.facebook.com/Institut.Teknologi.Del/"><i class="bi bi-facebook"></i></a> </li>
            <li> <a href="https://www.instagram.com/it.del?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><i class="bi bi-instagram"></i></a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <div class="credits">
        Designed by Kelompok 17<br>
        &copy; 2023 RuangPikiran. All Rights Reserved.
      </div>
    </div>

  </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>