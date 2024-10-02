
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/css/loginregister.css') }}">
  <title>blackcore.id</title>
</head>

<body>
  {{session()->get('old_passwd')}}
  <div class="container {{ (request()->get('mode') == 'register' || Session::get('mode') == 'register') ? 'sign-up-mode' : '' }}">
    <div class="signin-signup">
      <form action="{{ route('frontend.login_action') }}" method="POST" class="sign-in-form">
        <h2 class="title">Sign in</h2>
        @csrf
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
          @error('email')
          <small class="input-error">{{ $message }}</small>
            @enderror
        </div>
        <div class="input-field">
          <i class="fas fa-key"></i>
          <input type="password" id="password-login" name="password" placeholder="Password" required value="{{ old('password') }}">
          @error('password')
          <small class="input-error">{{ $message }}</small>
        @enderror
        </div>
        <input type="submit" value="Login" class="btn">
        <p class="social-text">Or Sign in with social platform</p>
        <div class="social-media">
          {{-- <a href="#" class="social-icon">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="" class="social-icon">
            <i class="fab fa-twitter"></i>
          </a> --}}
          <a href="{{ route('oauth.google.redirect', $google_auth) }}" class="social-icon">
            <i class="fab fa-google"></i>
          </a>
          {{-- <a href="" class="social-icon">
            <i class="fab fa-linkedin-in"></i>
          </a> --}}
        </div>
        <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
      </form>
      <form action="{{ route('frontend.register_action') . '?mode=register' }}" method="POST" class="sign-up-form">
        @csrf
        <h2 class="title">Sign up</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" name="name" placeholder="Username" value="{{ old('name') }}" required>
        </div>
        @error('name')
          <small class="input-error">{{ $message }}</small>
        @enderror
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" value=" {{ old('email') }}" required>
        </div>
        @error('email')
          <small class="input-error">{{ $message }}</small>
        @enderror
        <div class="input-field">
          <i class="fas fa-phone"></i>
          <input type="text" name="phone" placeholder="Nomor Telepon" value="{{ old('phone')}}" required>
        </div>
        @error('phone')
          <small class="input-error">{{ $message }}</small>
        @enderror
        <div class="input-field">
          <i class="fas fa-home"></i>
          <input type="text" name="address" placeholder="Alamat" value="{{old('address')}}" required>
        </div>
        @error('address')
          <small class="input-error">{{ $message }}</small>
        @enderror
        <div class="input-field">
          <i class="fas fa-key"></i>
          <input type="password" id="password-register" name="password" placeholder="Password" required value="{{ old('password')}}">
        </div>
        @error('password')
          <small class="input-error">{{ $message }}</small>
        @enderror
        <input type="submit" value="Sign up" class="btn">
        <p class="social-text">Or Sign in with social platform</p>
        <div class="social-media">
          {{-- <a href="#" class="social-icon">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="" class="social-icon">
            <i class="fab fa-twitter"></i>
          </a> --}}
          <a href="{{ route('oauth.google.redirect', $google_auth) }}" class="social-icon">
            <i class="fab fa-google"></i>
          </a>
          {{-- <a href="" class="social-icon">
            <i class="fab fa-linkedin-in"></i>
          </a> --}}
        </div>
        <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
      </form>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Sudah Punya Akun?</h3>
          <p>Masukkan akunmu yang sudah kalian punya</p>
          <button class="btn" id="sign-in-btn">Sign in</button>
        </div>
        
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>User Baru?</h3>
          <p>Daftar akunmu sekarang juga untuk menjadi sebagai admin</p>
          <button class="btn" id="sign-up-btn">Sign up</button>
        </div>
        
      </div>
    </div>
  </div>
  <script src="{{ asset('frontend/js/loginregister.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

  <script>
    var notyf = new Notyf();
    @if (session('success'))
      notyf.success({
        message: '{{ session('success') }}',
        duration: 10000,
        dismissible: true,
        position: {
          x: 'center',
          y: 'top'
        }
      });
    @endif

    @if (session('error'))
      notyf.error({
        message: '{{ session('error') }}',
        duration: 10000,
        dismissible: true,
        position: {
          x: 'center',
          y: 'top'
        }
      });
    @endif
  </script>
</body>

</html>
