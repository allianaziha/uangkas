<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profil Saya</title>

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

<body>

  <!-- HEADER -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <h1 class="sitename"><span>e</span>kaskelas</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="dropdown">
            <a href="#">
              <span>{{ Auth::user()->name }}</span>
              <i class="bi bi-chevron-down toggle-dropdown"></i>
            </a>
            <ul>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
  <!-- /HEADER -->

 <main class="main">
  <section class="section kas-background py-5">
    <div class="container">
      <div class="row justify-content-center align-items-center g-4">
        <!-- Kolom Biodata -->
        <div class="col-lg-6">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
              <div class="mb-4">
                <p class="mb-1 text-muted">Nama</p>
                <h5 class="mb-0">{{ $user->name }}</h5>
              </div>
              <div class="mb-4">
                <p class="mb-1 text-muted">Email</p>
                <h5 class="mb-0">{{ $user->email }}</h5>
              </div>
              <hr>
              <div class="mt-4 text-center">
                <h6 class="mb-2">Saldo Uang Masuk</h6>
                <p class="fs-4 fw-semibold text-success">
                  Rp {{ number_format($totalBayar, 0, ',', '.') }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom Gambar -->
        <div class="col-lg-6 text-center">
          <img src="{{ asset('assets/frontend/img/hero.png') }}" class="img-fluid rounded" alt="Gambar Profil">
        </div>
      </div>
    </div>
  </section>
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

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    
</body>
</html>
