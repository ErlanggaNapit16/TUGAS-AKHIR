<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>RuangPikiran</title>
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
    .study-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      /* Center all cards */
      max-width: 1280px;
      /* Limit container width */
      margin: 0 auto;
      /* Center container */
      padding: 20px;
    }

    .study-card {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: calc(25% - 20px);
      /* 4 cards per row with 20px gap */
      min-width: 250px;
      transition: transform 0.3s;
    }

    .study-card:hover {
      transform: translateY(-5px);
    }

    .study-card img {
      width: 100%;
      height: auto;
      display: block;
    }

    .study-card-content {
      padding: 15px;
    }

    .study-card-content h3 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }

    .study-card-content p {
      margin: 8px 0;
      font-size: 14px;
      color: #666;
    }

    .study-card-content a {
      display: inline-block;
      margin-top: 10px;
      color: #007BFF;
      text-decoration: none;
      font-weight: 500;
    }

    .study-card-content a:hover {
      text-decoration: underline;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1024px) {
      .study-card {
        width: calc(33.333% - 20px);
        /* 3 per row */
      }
    }

    @media (max-width: 768px) {
      .study-card {
        width: calc(50% - 20px);
        /* 2 per row */
      }
    }

    @media (max-width: 480px) {
      .study-card {
        width: 100%;
        /* 1 per row */
      }
    }
  </style>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="{{ route('homepage') }}">
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

    <!-- Pembelajaran Category Section -->
    <section id="culture-category" class="culture-category section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Pencarian Pembelajaran -->
        <div class="mb-4">
          <div class="input-group">
            <input type="text" id="searchPembelajaran" class="form-control" placeholder="Cari pembelajaran..." onkeyup="searchPembelajaran()">
            <button class="btn btn-primary" type="button" onclick="searchPembelajaran()">Cari</button>
          </div>
        </div>

        <div class="row g-4" id="pembelajaranList">
          @foreach($pembelajaran as $item)
          <div class="col-md-4 pembelajaran-card" data-title="{{ $item->judul }} {{ $item->deskripsi }}">
            <div class="card h-100">
              @if($item->tipe === 'gambar')
              <img src="{{ asset($item->konten) }}" alt="{{ $item->judul }}" class="card-img-top">
              @elseif($item->tipe === 'video')
              <video controls class="card-img-top">
                <source src="{{ asset($item->konten) }}" type="video/mp4">
              </video>
              @else
              <img src="{{ asset('assets/img/default-thumbnail.jpg') }}" class="card-img-top">
              @endif

              <div class="card-body">
                <div class="post-meta mb-1">
                  <span class="date">{{ ucfirst($item->tipe) }}</span>
                  <span class="mx-1">•</span>
                  <span>{{ $item->created_at->format('M jS, Y') }}</span>
                </div>
                <h5 class="card-title mb-2">
                  <a href="{{ route('pembelajaran_detail', $item->id) }}">{{ $item->judul }}</a>
                </h5>
                <p class="card-text">{{ Str::limit($item->deskripsi, 120) }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $pembelajaran->withQueryString()->links() }}
      </div>
    </section>

    <!-- Studi Category Section -->
    <section class="study-section">
      <div>
        <div class="container section-title" data-aos="fade-up">
          <div class="section-title-container d-flex align-items-center justify-content-between">
            <h2>Pembejalaran Lebih Luas</h2>
          </div>
        </div>

        @if($studies->isEmpty())
        <p class="text-gray-600">Belum ada konten pembelajaran tersedia.</p>
        @else
        <div class="study-container">
          @foreach($studies as $study)
          <div class="study-card">
            <div class="relative">
              @if($study->link)
              @php
              preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $study->link, $matches);
              $youtubeId = $matches[1] ?? null;
              @endphp

              @if($youtubeId)
              <div class="study-video">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              @else
              <a href="{{ $study->link }}" target="_blank">
                <div class="study-image" style="background-color: #eee; display: flex; align-items: center; justify-content: center;">
                  <span style="color: #666;">Link Pembelajaran</span>
                </div>
              </a>
              @endif
              @endif
            </div>

            <div class="study-content">
              <h3 class="study-title">{{ $study->judul }}</h3>
              <p class="study-desc">{{ $study->deskripsi }}</p>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $studies->withQueryString()->links() }}
      </div>
    </section>

    <!-- /Study Category Section -->
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
  <script>
    function searchPembelajaran() {
      const query = document.getElementById('searchPembelajaran').value.toLowerCase();
      const pembelajaranCards = document.querySelectorAll('.pembelajaran-card');

      pembelajaranCards.forEach(card => {
        const title = card.getAttribute('data-title').toLowerCase();
        if (title.includes(query)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }
  </script>




</body>


</html>