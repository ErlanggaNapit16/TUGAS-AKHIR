<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detail Pengumuman</title>
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

</head>

<body class="index-page">

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
    <div class="container mt-4">
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h2 class="card-title text-primary font-weight-bold">
            📢 <span class="text-danger">[INFO]</span> {{ $announcement->title }}
          </h2>
          <p class="text-muted">📅 Dibuat pada: {{ $announcement->created_at->format('d M Y, H:i') }} WIB</p>
          <hr>

          <p class="card-text">
            📌 <strong>Dear Mahasiswa,</strong><br>
            Berikut kami sampaikan informasi terkait:
          </p>

          <p class="font-weight-bold text-dark">
            {!! nl2br(e($announcement->content)) !!}
          </p>

          @if (!empty($announcement->link))
          <p><strong>🔗 Tautan Pengumuman:</strong>
            <a href="{{ $announcement->link }}" target="_blank" class="text-primary">
              {{ $announcement->link }}
            </a>
          </p>
          @endif

          @if (!empty($announcement->file))
          <div class="mt-3 p-3 bg-light border rounded">
            <strong>📄 Nama File:</strong> <br>
            <a href="{{ asset('storage/' . $announcement->file) }}" target="_blank" class="text-info">
              {{ basename($announcement->file) }}
            </a>
            <p class="mb-0 text-muted">📏 Size: {{ number_format(Storage::size($announcement->file) / 1024, 2) }} KB</p>
          </div>
          @endif

          <p class="mt-4">Demikian informasi ini kami sampaikan. Terima kasih atas perhatian dan kerja samanya.</p>

          <div class="mt-3">
            <p class="font-weight-bold mb-0">{{ $announcement->author_name }}</p>
            <p class="text-muted">{{ $announcement->author_position }}</p>
          </div>

          <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">⬅️ Kembali</a>
        </div>
      </div>
    </div>
  </main>

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