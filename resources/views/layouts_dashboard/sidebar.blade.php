<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <img src="{{ asset('user/assets/img/logo.svg') }}" height="40" alt="logo" />
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div>Dashboards</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Master</span>
    </li>
    <li class="menu-item {{ request()->is('admin/operator*') ? 'active open' : '' }}">
      <a href="{{ route('admin.operator.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-user-check"></i>
        <div>Operator</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/instansi*') ? 'active open' : '' }}">
      <a href="{{ route('admin.instansi.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-building-bank"></i>
        <div>Instansi</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/sekolah*') ? 'active open' : '' }}">
      <a href="{{ route('admin.sekolah.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-school"></i>
        <div>Sekolah</div>
      </a>
    </li>
    {{-- <li class="menu-item {{ request()->is('admin/siswa*') ? 'active open' : '' }}">
      <a href="{{ route('admin.siswa.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div>Siswa</div>
      </a>
    </li> --}}
    <li class="menu-item {{ request()->is('admin/soal-awalan*') ? 'active open' : '' }}">
      <a href="/admin/soal-awalan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-sidebar-right"></i>
        <div>Soal Tes Awalan</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('admin/soal-lanjutan*') ? 'active open' : '' }}">
      <a href="/admin/soal-lanjutan" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
        <div>Soal Tes Lanjutan</div>
      </a>
    </li>
    {{-- <li class="menu-item {{ request()->is('m-wilayah*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti ti-world"></i>
        <div>Instansi</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('m-wilayah/provinsi*') ? 'active' : '' }}">
          <a href="/m-wilayah/provinsi" class="menu-link">
            <div>Instansi</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('m-wilayah/kabupaten*') ? 'active' : '' }}">
          <a href="/m-wilayah/kabupaten" class="menu-link">
            <div>Pendidikan</div>
          </a>
        </li>
      </ul>
    </li> --}}
  </ul>
</aside>
