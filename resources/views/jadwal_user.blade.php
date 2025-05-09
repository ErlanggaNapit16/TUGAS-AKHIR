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

  <main class="main mt-5">
    <div class="container">
      <div class="card shadow-sm border-0 rounded-lg p-4">
        <h2 class="fs-4 fw-bold mb-4 text-dark">Ajukan Jadwal Konseling</h2>

        <form action="{{ route('jadwal.store') }}" method="POST">
          @csrf
          <div class="row g-3">
            <div class="col-md-4">
              <label for="konselor_id" class="form-label">Konselor</label>
              <select name="konselor_id" id="konselor_id" class="form-select" required>
                @foreach($konselors as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label for="date" class="form-label">Tanggal</label>
              <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label for="time" class="form-label">Waktu</label>
              <input type="time" name="time" id="time" class="form-control" required>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100">Ajukan</button>
          </div>
        </form>

        <h3 class="fs-5 fw-semibold mt-5 mb-3 text-dark">Riwayat Jadwal</h3>

        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Konselor</th>
                <th>Status</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($schedules as $schedule)
              <tr>
                <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</td>
                <td>{{ $schedule->konselor->name }}</td>
                <td>
                  <span class="badge 
                {{ $schedule->status === 'approved' ? 'bg-success' : 
                   ($schedule->status === 'requested' ? 'bg-warning text-dark' : 
                   ($schedule->status === 'rejected' ? 'bg-danger' : 'bg-info')) }}">
                    {{
                    $schedule->status === 'rejected' 
                        ? 'Ditolak' 
                        : ucfirst($schedule->status)
                }}
                  </span>
                </td>
                <td>
                  @if($schedule->status === 'reschedule')
                  <a href="{{ route('jadwal.selectRescheduleOptions', $schedule->id) }}" class="btn btn-info btn-sm">Pilih Opsi Waktu</a>
                  @elseif($schedule->status === 'requested')
                  <span class="badge bg-secondary">Menunggu Konfirmasi</span>
                  @elseif($schedule->status === 'rejected')
                  <!-- Tombol untuk menampilkan alasan penolakan -->
                  <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#rejectionReasonModal{{ $schedule->id }}">
                    Lihat Alasan
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="rejectionReasonModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="rejectionReasonModalLabel{{ $schedule->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header bg-light text-dark">
                          <h5 class="modal-title" id="rejectionReasonModalLabel{{ $schedule->id }}">
                            <i class="bi bi-x-circle-fill text-danger"></i> Alasan Penolakan
                          </h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <!-- Modal Body -->
                        <div class="modal-body">
                          <div class="alert alert-info p-3">
                            <p>Mohon maaf atas penolakannya.</p>
                            <p>Saya <strong>{{ $schedule->konselor->name }}</strong> melakukan penolakan dikarenakan:</p>
                            <p><strong class="text-muted">{{ $schedule->rejection_reason ?? 'Tidak ada alasan yang diberikan.' }}</strong></p>
                            <p>Mohon dapat memakluminya.</p>
                            <p class="fw-bold text-primary">Jika ingin melakukan konseling secara langsung, Anda dapat memilih konselor lain yang tersedia.</p>
                          </div>
                          <p>Terima kasih atas pengertiannya.</p>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Tutup
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center text-muted">Belum ada jadwal konseling.</td>
              </tr>
              @endforelse
            </tbody>

          </table>
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

  <!-- Tambahkan di <head> -->
  <link rel="stylesheet" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">

  <!-- Tambahkan sebelum penutup </body> -->
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>


  <!-- Main JS File -->
  <script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>