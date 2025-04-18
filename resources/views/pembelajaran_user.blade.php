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
              <li><a href="category.html">Category 1</a></li>
              <li><a href="category.html">Category 2</a></li>
              <li><a href="category.html">Category 3</a></li>
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
        <div class="row g-5">
          {{-- Kolom Kiri --}}
          <div class="col-lg-4">
            @if($pembelajaran->isNotEmpty())
            @php $first = $pembelajaran->first(); @endphp
            <div class="post-list lg mb-4">
              @if($first->tipe === 'gambar')
              <img src="{{ asset($first->konten) }}" alt="{{ $first->judul }}" class="img-fluid rounded mb-2">
              @elseif($first->tipe === 'video')
              <video controls class="img-fluid rounded mb-2">
                <source src="{{ asset($first->konten) }}" type="video/mp4">
              </video>
              @else
              <img src="{{ asset('assets/img/default-thumbnail.jpg') }}" class="img-fluid rounded mb-2">
              @endif
              <div class="post-meta">
                <span>{{ $first->created_at->format('M jS, Y') }}</span>
              </div>
              <h2>{{ $first->judul }}</h2>
              <p>{{ Str::limit($first->deskripsi, 120) }}</p>
            </div>
            @endif

            @foreach($pembelajaran->slice(1, 2) as $item)
            <div class="post-list border-bottom mb-3">
              <div class="post-meta">
                <span>{{ $item->created_at->format('M jS, Y') }}</span>
              </div>
              <h2 class="mb-2"><a href="#">{{ $item->judul }}</a></h2>
              <p>{{ Str::limit($first->deskripsi, 120) }}</p>
            </div>
            @endforeach
          </div>

          {{-- Kolom Kanan --}}
          <div class="col-lg-8">
            <div class="row g-5">
              {{-- Sub-kolom 1 --}}
              <div class="col-lg-4 border-start custom-border">
                @foreach($pembelajaran->slice(3, 3) as $item)
                <div class="post-list mb-4">
                  @if($item->tipe === 'gambar')
                  <img src="{{ asset($item->konten) }}" class="img-fluid mb-2">
                  @elseif($item->tipe === 'video')
                  <video controls class="img-fluid mb-2">
                    <source src="{{ asset($item->konten) }}" type="video/mp4">
                  </video>
                  @else
                  <img src="{{ asset('assets/img/default-thumbnail.jpg') }}" class="img-fluid mb-2">
                  @endif
                  <div class="post-meta">
                    <span>{{ $item->created_at->format('M jS, Y') }}</span>
                  </div>
                  <h2><a href="#">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($first->deskripsi, 120) }}</p>

                </div>
                @endforeach
              </div>

              {{-- Sub-kolom 2 --}}
              <div class="col-lg-4 border-start custom-border">
                @foreach($pembelajaran->slice(6, 3) as $item)
                <div class="post-list mb-4">
                  @if($item->tipe === 'gambar')
                  <img src="{{ asset($item->konten) }}" class="img-fluid mb-2">
                  @elseif($item->tipe === 'video')
                  <video controls class="img-fluid mb-2">
                    <source src="{{ asset($item->konten) }}" type="video/mp4">
                  </video>
                  @else
                  <img src="{{ asset('assets/img/default-thumbnail.jpg') }}" class="img-fluid mb-2">
                  @endif
                  <div class="post-meta">
                    <span>{{ $item->created_at->format('M jS, Y') }}</span>
                  </div>
                  <h2><a href="#">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($first->deskripsi, 120) }}</p>
                </div>
                @endforeach
              </div>

              {{-- Sub-kolom 3 --}}
              <div class="col-lg-4">
                @foreach($pembelajaran->slice(9, 6) as $item)
                <div class="post-list border-bottom mb-3">
                  <div class="post-meta">
                    <span class="date">{{ ucfirst($item->tipe) }}</span>
                    <span class="mx-1">•</span>
                    <span>{{ $item->created_at->format('M jS, Y') }}</span>
                  </div>
                  <h2 class="mb-2"><a href="#">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($first->deskripsi, 120) }}</p>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    </section><!-- /Culture Category Section -->



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
    {{ $studies->links() }}
  </div>
</section>

    <!-- /Study Category Section -->
  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">ZenBlog</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">ZenBlog</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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