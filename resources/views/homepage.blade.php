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
              <!-- <li><a href="{{ route('histori') }}">Histori</a></li> -->
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
    <!-- Slider Section -->
    <section id="slider" class="slider section dark-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              }
            }
          </script>

          <div class="swiper-wrapper">
            @foreach($carousels as $carousel)
            <div class="swiper-slide" style="background-image: url('{{ asset($carousel->image) }}');">
              <div class="content">
                <h2>{{ $carousel->title }}</h2>
                <p>{{ $carousel->description }}</p>
              </div>
            </div>
            @endforeach
          </div>

          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <!-- /Slider Section -->

    <!-- Pembelajaran + Pengumuman Section -->
    <section id="culture-category" class="culture-category section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-5">

          {{-- Kolom Pembelajaran (Kiri) --}}
          <div class="col-lg-8">
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
                  <h2 class="mb-2"><a href="{{ route('pembelajaran_user') }}">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($item->deskripsi, 120) }}</p>
                </div>
                @endforeach
              </div>

              {{-- Sub-kolom 2 --}}
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
                  <h2><a href="{{ route('pembelajaran_user') }}">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($item->deskripsi, 120) }}</p>
                </div>
                @endforeach
              </div>

              {{-- Sub-kolom 3 --}}
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
                  <h2><a href="{{ route('pembelajaran_user') }}">{{ $item->judul }}</a></h2>
                  <p>{{ Str::limit($item->deskripsi, 120) }}</p>
                </div>
                @endforeach
              </div>
            </div>
          </div>

          {{-- Kolom Pengumuman (Kanan) --}}
          <div class="col-lg-4">
            <div class="trending-category">
              <div class="trending">
                <h3>Pengumuman</h3>

                @if ($announcements->isNotEmpty())
                <ul class="trending-post">
                  @foreach ($announcements->take(5) as $key => $announcement)
                  <li>
                    @auth
                    <a href="{{ route('announcement.show', $announcement->id) }}">
                      <h3>{{ $announcement->title }}</h3>
                      <span class="author">{{ $announcement->created_at->format('d M Y') }}</span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" onclick="return confirm('Anda harus login terlebih dahulu untuk melihat detail pengumuman.')">
                      <span class="number">{{ $key + 1 }}</span>
                      <h3>{{ $announcement->title }}</h3>
                      <span class="author">{{ $announcement->created_at->format('d M Y') }}</span>
                    </a>
                    @endauth
                  </li>
                  @endforeach
                </ul>

                <div class="section-title mt-3" data-aos="fade-up">
                  <div class="section-title-container d-flex align-items-center justify-content-between">
                    <p>
                      @auth
                      <a href="{{ route('announcement.index') }}">Lihat Semua Pengumuman</a>
                      @else
                      <a href="{{ route('login') }}" onclick="return confirm('Anda harus login terlebih dahulu untuk melihat semua pengumuman.')">Lihat Semua Pengumuman</a>
                      @endauth
                    </p>
                  </div>
                </div>
                @else
                <p class="p-3">Tidak ada pengumuman terbaru.</p>
                @endif
              </div>
            </div>
          </div>

        </div> <!-- End .row -->
      </div> <!-- End .container -->
    </section><!-- /Pembelajaran Category Section -->



    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <div class="section-title-container d-flex align-items-center justify-content-between">
          <h2>Konselor Kami</h2>
          <p>Konselor berpengalaman dan terpercaya, siap mendampingi Anda dengan solusi terbaik.</p>
        </div>
      </div><!-- End Section Title -->

      <div class="container">
        {{-- Kartu untuk Team Members --}}
        <div class="row">
          @if ($teamMembers->isEmpty())
          <p class="text-muted">Belum ada anggota tim</p>
          @else
          @foreach ($teamMembers as $member)
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic text-center">
                <img src="{{ asset($member->image) }}"
                  class="img-fluid rounded-circle shadow-sm"
                  alt="{{ $member->name }}"
                  style="width: 150px; height: 150px; object-fit: cover;">
              </div>

              <div class="member-info ms-3">
                <h4>{{ $member->name }}</h4>
                <span>{{ $member->position }}</span>
                <p>{{ $member->description }}</p>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>

    </section><!-- /Team Section -->


    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Feedback Title -->

      <section class="container my-5">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Apa Kata Pelanggan?</h2>
          <hr>
        </div>

        <div class="swiper feedback-swiper">
          <div class="swiper-wrapper">
            @foreach ($feedbacks as $feedback)
            <div class="swiper-slide">
              <div class="card h-100 shadow-sm p-3 rounded-4">
                <div class="card-body">
                  <h5 class="card-title">{{ $feedback->user->name }}</h5>
                  <p class="card-text">{{ $feedback->message }}</p>
                  <small class="text-muted">{{ $feedback->created_at->format('d M Y, H:i') }}</small>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Navigasi jika diperlukan -->
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </section>



      </div><!-- End Section Title -->

    </section><!-- /Feedback Section -->
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

  <!-- Tambahkan di <head> -->
  <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">

  <!-- Tambahkan sebelum penutup </body> -->
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>


  <script>
    const swiper = new Swiper('.feedback-swiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      grid: {
        rows: 2, // tampilkan 2 baris
        fill: "row"
      },
      breakpoints: {
        768: {
          slidesPerView: 2, // 2 kolom di tablet
        },
        1024: {
          slidesPerView: 3, // 3 kolom di desktop
        },
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>


  <!-- Main JS File -->
  <script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>