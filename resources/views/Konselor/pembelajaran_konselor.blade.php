<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Konselor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/konselor/dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">RuangPikiran</span>
      </a>

      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->name }}</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.konselor') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </button>
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/konselor/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/konselor/pengumuman') }}">
          <i class="bi bi-card-list"></i>
          <span>Pengumuman</span>
        </a>
      </li><!-- End Pengumuman Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('jadwal.konselor') }}">
          <i class="ri-calendar-2-fill"></i>
          <span>Jadwal</span>
        </a>
      </li><!-- End Schedule Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('konselor.carousel') }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Carousel</span>
        </a>
      </li><!-- End Carousel Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ request()->is('konselor/pembelajaran') ? 'active' : '' }}" href="{{ route('konselor.pembelajaran') }}">
          <i class=" ri-folder-open-fill"></i>
          <span>Pembelajaran</span>
        </a>
      </li><!-- End Pembelajaran Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('konselor.feedback') }}">
          <i class="bi bi-menu-button-wide"></i>
          <span>Feedback</span>
        </a>
      </li><!-- End Feedback Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list-check"></i><span>Task</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('konselor.cemas') }}">
              <i class="bi bi-circle"></i><span>Task Cemas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('konselor.depresi') }}">
              <i class="bi bi-circle"></i><span>Task Depresi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('konselor.task_berat') }}">
              <i class="bi bi-circle"></i><span>Task Berat</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Pembelajaran</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/konselor/dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Pembelajaran</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Konten Pembelajaran</h5>
          <p>Berikut adalah daftar konten pembelajaran untuk konselor.</p>

          <div class="mt-3 mb-3">
            <a href="{{ route('konselor.pembelajaran.create') }}" class="btn btn-primary">Tambah Konten Pembelajaran</a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <thead class="table-light">
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Tipe</th>
                  <th>Konten</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pembelajaran as $index => $item)
                <tr>
                  <td>{{ $pembelajaran->firstItem() + $index }}</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ \Illuminate\Support\Str::words($item->deskripsi, 50, '...') }}</td>
                  <td><span class="badge bg-info text-dark text-capitalize">{{ $item->tipe }}</span></td>
                  <td>
                    @if($item->tipe === 'gambar')
                    <img src="{{ asset($item->konten) }}" alt="Gambar" style="max-height: 100px;">
                    @elseif($item->tipe === 'video')
                    <video controls style="max-height: 100px; width: 150px;">
                      <source src="{{ asset($item->konten) }}" type="video/mp4">
                    </video>
                    @elseif($item->tipe === 'artikel')
                    <div style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      {{ $item->konten }}
                    </div>
                    @elseif($item->tipe === 'link')
                    <a href="{{ $item->konten }}" target="_blank">{{ $item->konten }}</a>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('konselor.pembelajaran.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                    <a href="{{ route('konselor.pembelajaran.detail', $item->id) }}" class="btn btn-sm btn-info mb-1">Detail</a>

                    <form action="{{ route('konselor.pembelajaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?')" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-muted">Belum ada konten pembelajaran.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="d-flex justify-content-center mt-4">
            {{ $pembelajaran->withQueryString()->links() }}
          </div>
        </div>
      </div>

    </section>

    <section class="section">
      <div class="container">
        <h1>Pembelajaran Video</h1>
        <a href="{{ route('konselor.study_create') }}" class="btn btn-primary mb-3">Tambah Pembelajaran</a>

        @if(isset($studies) && $studies->count() > 0)
        <table class="table table-bordered align-middle text-center">
          <thead class="table-light">
            <tr>
              <th>Judul</th>
              <th>Deskripsi</th>
              <th>Link</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($studies as $study)
            <tr>
              <td>{{ $study->judul }}</td>
              <td>{{ $study->deskripsi }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#videoModal{{ $study->id }}">
                  Tonton
                </button>

                <!-- Modal -->
                <div class="modal fade" id="videoModal{{ $study->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $study->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel{{ $study->id }}">{{ $study->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                      </div>
                      <div class="modal-body">
                        <div class="ratio ratio-16x9">
                          <iframe
                            src="https://www.youtube.com/embed/{{ \Str::after($study->link, 'v=') }}?enablejsapi=1"
                            title="{{ $study->judul }}"
                            allowfullscreen
                            class="youtube-iframe"></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <a href="{{ route('konselor.study.edit', $study->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                <form action="{{ route('konselor.study.destroy', $study->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <p class="text-muted">Belum ada data pembelajaran video.</p>
        @endif
      </div>
      <div class="d-flex justify-content-center mt-4">
        {{ $studies->withQueryString()->links() }}
      </div>
    </section>


  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>