<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="/"><img src="/images/logo.png" class="mr-2" alt="logo"></a>
    <a class="navbar-brand brand-logo-mini" href="/"><img src="/images/logokecil.png" alt="logo"></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
          data-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
          aria-labelledby="notificationDropdown">
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div>
              </div>
            </div>
            <div class="preview-item-content">
              </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
          <div class="preview-thumbnail">
          <div class="preview-icon bg-warning">
      <!-- Tambahkan ikon chat di sini -->
          <i class="fas fa-comment"></i>
          </div>
          </div>
        <div class="preview-item-content">
        <h6 class="preview-subject font-weight-normal">Chat</h6>
        <p class="font-weight-light small-text mb-0 text-muted">
        2 pesan belum terbaca
        </p>
      </div>
      </a>
      </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          @if (Auth::user()->photo)
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="profile" style="object-fit: cover">
          @else
            <img src="/images/user-placeholder.png" alt="profile" style="object-fit: cover"/>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <div class="dropdown-item">
            {{-- <i class="ti-user text-primary"></i> --}}
            <div>
              <p class="mb-0 fw-bold">{{ Auth::user()->name }}</p>
              <p class="mb-0">{{ Auth::user()->email }}</p>
            </div>
          </div>
          <a href="{{ route('admin.profile') }}" class="dropdown-item">
            <i class="ti-user text-primary"></i>
            Profil
          </a>
          
          <a href="/admin/logout" class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
