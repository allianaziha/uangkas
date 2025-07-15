<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
              <span style="color: #4CAF50;">e-</span><span style="color: #696CFF;">KasKelas</span>
            </span>

            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
              <a href="{{ url('admin') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
              </a>
            </li>

            <!-- Siswa -->
            <li class="menu-item {{ request()->routeIs('backend.siswa.*') ? 'active' : '' }}">
              <a href="{{ route('backend.siswa.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Siswa</div>
              </a>
            </li>

            <!-- Transaksi Kas -->
            <li class="menu-item {{ request()->routeIs('backend.transaksikas.*') ? 'active' : '' }}">
              <a href="{{ route('backend.transaksikas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-transfer"></i>
                <div>Transaksi Kas</div>
              </a>
            </li>

            <!-- Pembayaran -->
            <li class="menu-item {{ request()->routeIs('backend.pembayaran.*') ? 'active' : '' }}">
              <a href="{{ route('backend.pembayaran.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div>Pembayaran</div>
              </a>
            </li>

            <!-- Kas Mingguan -->
            <li class="menu-item {{ request()->routeIs('backend.kas_mingguan.*') ? 'active' : '' }}">
              <a href="{{ route('backend.kas_mingguan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-week"></i>
                <div>Kas Mingguan</div>
              </a>
            </li>

            <!-- Laporan -->
            <li class="menu-item {{ request()->routeIs('backend.export.index') ? 'active' : '' }}">
                <a href="{{ route('backend.export.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-file"></i>
                    <div>Laporan</div>
                </a>
            </li>
          </ul>
        </aside>