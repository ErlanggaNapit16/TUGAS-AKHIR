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
          <li><a href="{{ route('about_us') }}">About</a></li>
          <li><a href="single-post.html">Single Post</a></li>
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

    <!-- Trending Category Section -->
    <section id="trending-category" class="trending-category section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="container" data-aos="fade-up">
          <div class="row g-5">
            <div class="col-lg-4">

              <div class="post-entry lg">
                <a href="blog-details.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                <h2><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">Cameron Williamson</h3>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-8">
              <div class="row g-5">
                <div class="col-lg-4 border-start custom-border">
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">Let’s Get Back to Work, New York</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Food</span> <span class="mx-1">•</span> <span>Jul 17th '22</span></div>
                    <h2><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Design</span> <span class="mx-1">•</span> <span>Mar 15th '22</span></div>
                    <h2><a href="blog-details.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                  </div>
                </div>
                <div class="col-lg-4 border-start custom-border">
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Tech</span> <span class="mx-1">•</span> <span>Mar 1st '22</span></div>
                    <h2><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Travel</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                  </div>
                </div>

                <!-- Pengumuman Section -->
                <div class="col-lg-4">
                  <div class="trending">
                    <h3>Pengumuman</h3>
                    @if ($announcements->isNotEmpty())
                    <ul class="trending-post">
                      @foreach ($announcements->take(5) as $announcement) {{-- Ambil hanya 5 --}}
                      <li>
                        @auth
                        <a href="{{ route('announcement.show', $announcement->id) }}">
                          <h3>{{ $announcement->title }}</h3>
                          <p>{{ $announcement->created_at->format('d M Y') }}</p>
                        </a>
                        @else
                        <a href="{{ route('login') }}" onclick="return confirm('Anda harus login terlebih dahulu untuk melihat detail pengumuman.')">
                          <h3>{{ $announcement->title }}</h3>
                          <p>{{ $announcement->created_at->format('d M Y') }}</p>
                        </a>
                        @endauth
                      </li>
                      @endforeach
                    </ul>

                    <div class="container section-title" data-aos="fade-up">
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
                    <p>Tidak ada pengumuman terbaru.</p>
                    @endif
                  </div>
                </div>
              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>

      </div>

    </section><!-- /Trending Category Section -->



    <!-- Business Category Section -->
    <section id="business-category" class="business-category section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <div class="section-title-container d-flex align-items-center justify-content-between">
          <h2>Business</h2>
          <p><a href="categories.html">See All Business</a></p>
        </div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-md-9 order-md-2">

            <div class="d-lg-flex post-entry">
              <a href="blog-details.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
                <img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid">
              </a>
              <div>
                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                <h3><a href="blog-details.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                <div class="d-flex align-items-center author">
                  <div class="photo"><img src="assets/img/person-4.jpg" alt="" class="img-fluid"></div>
                  <div class="name">
                    <h3 class="m-0 p-0">Wade Warren</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="post-list border-bottom">
                  <a href="blog-details.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                  <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                </div>

                <div class="post-list">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="post-list">
                  <a href="blog-details.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                  <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>

            <div class="post-list border-bottom">
              <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
              <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
              <span class="author mb-3 d-block">Jenny Wilson</span>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Business Category Section -->

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