<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>uang kas</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets/frontend/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('assets/frontend/css/main.css')}}" rel="stylesheet">
</head>

<body class="index-page">

  <!-- HEADER -->
 <header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <h1 class="sitename"><span>e</span>kaskelas</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        @guest
          <li>
            <a href="{{ route('login') }}">Login</a>
          </li>
        @else
          <li class="dropdown">
            <a href="#">
              <span>{{ Auth::user()->name }}</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li>
                <a href="{{ route('profil') }}">
                  <i class="bx bx-user me-2"></i> Profil Saya
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bx bx-power-off me-2"></i> Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>

  <!-- /HEADER -->

  <main class="main">

    <!-- HERO SECTION -->
    <!-- Hero Section -->
<section id="hero" class="hero section kas-background">
  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-5">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <!-- Judul dan deskripsi dari codingan atas -->
        <p>Website ini membantu kamu mengelola semua pemasukan dan pengeluaran kas kelas secara online. Semua data bisa dilihat kapan saja, jadi pengelolaan uang kas jadi lebih mudah, cepat, dan transparan.</p>
      </div>
      <div class="col-lg-6 order-1 order-lg-2">
        <img src="{{ asset('assets/frontend/img/hero.png') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>

  <!-- Icon Box ngambang dari codingan atas -->
  <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
    <div class="container position-relative">
      <div class="row gy-4 mt-5">
        <div class="col-xl-6 col-md-3 mx-auto">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-cash-stack"></i></div>
            <h4 class="title">Saldo Kas</h4>
            <h5>Rp {{ number_format($saldoKas, 0, ',', '.') }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- /HERO SECTION -->

    <!-- CONTACT SECTION (Pengeluaran Kas) -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Pengeluaran Kas</h2>
      </div>

      <div class="container">
        @if($transaksi->count())
        <div class="table-responsive">
          <table class="table table-bordered" >
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah (Rp)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transaksi as $i => $item)
              <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
          <p class="text-muted">Belum ada data pengeluaran.</p>
        @endif
      </div>
    </section>
    <!-- /CONTACT SECTION -->

  </main>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <div class="copyright text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">ekaskelas</strong> <span>SMK Assalaam</span></p>
      </div>
      <div class="credits">
        Designed by <a href="/">ekaskelas</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/frontend/js/main.js')}}"></script>

</body>
</html>
