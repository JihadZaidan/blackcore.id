@extends('frontend.frontend_layout')

@section('title', $product->name ?? 'Product')

@section('content')
  <div class="container mt-5 pt-5 pb-5 mb-5">
    <div class="row">
      <div class="col-md-6">
        <div class="product-image" style="height: 100%">
          @if ($product->photo)
          <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Image" class="img-fluid"
          style="width: 100%; height: 100%; object-fit: cover">
          @endif
        </div>
      </div>
      <div class="col-md-6">
        <div class="product">
          <div class="product-title">
            <h2>{{ $product->name }}</h2>
          </div>

          <div class="product-price">
            <span class="offer-price">{{ formatRupiah($product->price) }}</span>
            {{-- <span class="sale-price">Rp4.000.0000</span> --}}
          </div>

          <div class="product-details mb-3">
            <h3>Description</h3>
            <p id="product-description">{!! nl2br(e($product->description)) !!}</p>
          </div>
          <div class="product-size">
            <div class="row" style="gap:0px;">
              <div class="col-12 col-lg-6 p-1">
                <a href="{{ route('frontend.livechat') }}" class="button-outline" style="flex: 1 1 0%;">
                  <i class="fas fa-comment"></i> Chat Sekarang
                </a>
              </div>
              <div class="col-12 col-lg-6 p-1">
                <form action="{{ route('frontend.cart.add')}}" method="post">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="qty" value="1" >
                  <button type="submit" class="button-outline" style="flex: 1 1 0%;">
                    <i class="fas fa-shopping-cart"></i>
                    Tambahkan Keranjang
                  </button>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-12 p-1">
                <button class="button-outline"><i class="fas fa-dollar-sign"></i> Beli Langsung</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    {{-- <script src="/frontend/js/navbar.js"></script> --}}
    {{-- <script src="/frontend/js/product.js"></script> --}}

    <script>
      // Function untuk set cookie
      function setCookie(name, value, days) {
        let expires = "";
        if (days) {
          let date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
      }

      // Function untuk ambil cookie
      function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
      }

      function addToCart(productId) {
        // simpan cart ke cookie
        // Ambil data cart dari cookie
        let cart = JSON.parse(getCookie('cart') || '[]');
        // Cek apakah produk sudah ada di dalam cart
        const existingProduct = cart.find(item => item.productId === productId);
        // Jika produk sudah ada, tambahkan jumlahnya
        if (existingProduct) {
          existingProduct.quantity += 1;
        } else {
          // Jika produk belum ada, tambahkan produk baru ke dalam cart
          cart.push({
            productId: productId,
            quantity: 1
          });
        }
        // Simpan data cart kembali ke cookie
        let date = new Date();
        let expires =
          setCookie('cart', JSON.stringify(cart), 30);
        // Tampilkan notifikasi atau lakukan tindakan lainnya
        alert('Produk berhasil ditambahkan ke keranjang!');
      }
    </script>

  </div>

@endsection

@push('scripts')
  <script>
    $('#product-description').readmore({
      speed: 75,
      collapsedHeight: 100
    });
  </script>
@endpush
