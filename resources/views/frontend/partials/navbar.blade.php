<nav class="navbar main-nav fixed-top navbar-expand-lg large">
  <div class="container">
    <a class="navbar-brand" href="{{ route('frontend.index') }}"><img src="/images/logo-white.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="ti-menu text-white"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto d-flex align-items-center">
        <li class="nav-item">
          <a class="nav-link scrollTo" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link scrollTo" href="/#product">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link scrollTo" href="/#berita">Informasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link scrollTo" href="/#testimoni">Testimoni</a>
        </li>
        <li class="nav-item">
          <a class="nav-link scrollTo" href="{{ route('frontend.about_us') }}">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link scrollTo" href="{{ route('frontend.cart') }}"><i class="fas fa-shopping-cart"></i></a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link scrollTo" href="{{ route('frontend.login_register') }}"><i class="fas fa-user"></i></a>
        </li> --}}
        <li class="nav-item dropdown">
          {{-- <div class=""> --}}
            <a href="#" class="nav-link dropdown-toggle" id="accountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
              @if (Auth::check())
              @if (Auth::user()->photo)
              <img class="rounded-circle object-fit-cover" style="height: 35px; width: 35px;object-fit:cover"
              src="{{ asset('storage/' . auth()->user()->photo) }}">
              @else
              <i class="fas fa-user"></i>
              @endif
                
              @else
              <i class="fas fa-user"></i>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
              @if(Auth::check())
              <div class="dropdown-item" href="#">{{ Auth::user()->name }}</div>
              @else 
              <a class="dropdown-item" href="{{ route('frontend.login_register') }}">Login User</a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/admin">Dashboard Admin</a>
              
              @auth
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('frontend.profile') }}">Profil</a>
              <a class="dropdown-item" href="{{ route('frontend.order_history') }}">Riwayat Pembelian</a>
              <a class="dropdown-item" href="/logout">Logout</a>
              @endauth
            </div>
          {{-- </div> --}}
          </li>
      </ul>
      
    </div>
  </div>
</nav>