@extends('frontend.frontend_layout')

@section('title', 'Metode Pengiriman & Pembayaran')

@section('content')

  <div class="container mt-5 py-4 mb-5 rounded-lg">
    <form class="needs-validation" novalidate action="{{ route('frontend.order_history') }}">
    <div class="row">
      <div class="col-12 col-lg-8">
        <h4>Metode Pengiriman &amp; Pembayaran</h4>
          <div class="mb-3">
            <label for="kurir">Kurir Pengirim</label>
            <div class="dropdown">
              <button type="button" class="form-control dropdown-toggle input-dropdown" type="button"
                data-toggle="dropdown" aria-expanded="false">
                <div id="selected_kurir"></div>
              </button>
              <div class="dropdown-menu px-3 py-2 w-100 shadow">
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="kurir" id="kurir_jnt"
                    value="jnt" checked>
                  <label class="form-check-label flex-grow-1" for="kurir_jnt">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMrc49fKY1WmezUtaOm1M61hd2_CXhAMylcQ&s"
                      class="logo-dropdown">
                    <span>J&T Express</span>
                  </label>
                </div>
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="kurir" id="kurir_jne"
                    value="jne">
                  <label class="form-check-label flex-grow-1" for="kurir_jne">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/92/New_Logo_JNE.png" class="logo-dropdown">
                    <span>JNE Express</span>
                  </label>
                </div>
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="kurir" id="kurir_sicepat"
                    value="sicepat">
                  <label class="form-check-label flex-grow-1" for="kurir_sicepat">
                    <img
                      src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhPB6EIAp80B1c71Op0G9mq7SI89fKDKFa4-x1xhug-nbhuxfLYzD_TkLXSz26ePyRk4FmuU3annjxtR677Xt1d9ftVfQXQvRCOK-ASSm3d01V6LYyAXI6LjZIeIMSubm9fgSrCQsgpeqvs7v4gzc7HsN5tnnTeBANDjrH9WJFb3uIYwfgahhi-QFJ1lw/s851/Logo%20SiCepat%20Express@0.5x.png"
                      class="logo-dropdown">
                    <span>Sicepat</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="jenis_pengirim">Jenis Pengirim</label>
            <select class="custom-select" name="jenis_pengirim">
              <option value="1">Regular</option>
              <option value="2">Kilat</option>
              <option value="3">Satu Hari</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="kurir">Metode Pembayaran</label>
            <div class="dropdown">
              <button type="button" class="form-control dropdown-toggle input-dropdown" type="button"
                data-toggle="dropdown" aria-expanded="false">
                <div id="selected_metode_bayar"></div>
              </button>
              <div class="dropdown-menu px-3 py-2 w-100 shadow">
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="metode_pembayaran" id="gopay"
                    value="jnt" checked>
                  <label class="form-check-label flex-grow-1" for="gopay">
                    <img
                      src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdU_MFufUm2AAB1oSqraSBBRgCl-teIaIW6w&s"
                      class="logo-dropdown">
                    <span>Gopay</span>
                  </label>
                </div>
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="metode_pembayaran" id="dana"
                    value="jne">
                  <label class="form-check-label flex-grow-1" for="dana">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/320px-Logo_dana_blue.svg.png" class="logo-dropdown">
                    <span>DANA</span>
                  </label>
                </div>
                <div class="form-check d-flex align-items mb-2">
                  <input class="form-check-input position-static" type="radio" name="metode_pembayaran" id="qris"
                    value="sicepat">
                  <label class="form-check-label flex-grow-1" for="qris">
                    <img
                      src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjhvTtjN1Bj37W3jTiire9jlqgP046Je6-JPvIVEMjW6avji3kH1eC5HyUDIY8q1l6z89kidy_XZz4cX7-d_rdSentSrY94naUFcRo-NhiEvMUWmevEbQz-xRdMLUFSr61dHVvbVDq58GmxM0UAIgwnfCak8KWr0wTa0UmmjdUQTTcm2pEd3YjuHtPj9Q/s2161/Logo%20QRIS.png"
                      class="logo-dropdown">
                    <span>QRIS</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

        
      </div>

      <div class="col-12 col-lg-4">
        <h4>Keranjang Anda</h4>
        <label>&nbsp;</label>
        <div class="mb-4">

          <ul class="list-group w-100">
            @foreach ($carts as $cart)
              <li class="list-group-item item-cart d-flex justify-content-between align-items-center">
                <div>
                  <div class="text-dark mb-1">{{ $cart->product->name }}</div>
                  <div class="text-muted">{{ formatRupiah($cart->product->price) }} x {{ $cart->qty }}</div>
                </div>
                <div class="text-muted">{{ formatRupiah($cart->total) }}</div>
              </li>
            @endforeach
          </ul>
        </div>

        <h5>Ongkir &amp; Biaya Admin</h5>
        <div class="mb-4">
          <ul class="list-group w-100 mb-1">
            <li class="list-group-item item-cart d-flex justify-content-between align-items-center">
              <div class="text-dark">J&T Reguler</div>
              <div class="text-muted">Rp 18.000</div>
            </li>
          </ul>
          <ul class="list-group w-100 mb-1">
            <li class="list-group-item item-cart d-flex justify-content-between align-items-center">
              <div class="text-dark">Biaya Admin Gopay</div>
              <div class="text-muted">Rp 1.000</div>
            </li>
          </ul>
          <hr class="my-1">
          <ul class="list-group w-100 mb-1">
            <li class="list-group-item item-cart d-flex justify-content-between align-items-center">
              <div class="text-dark">Total</div>
              <h5 class="text-muted m-0 p-0">Rp 700.000</h5>
            </li>
          </ul>
        </div>

        <h5>Kode Promo</h5>
        <div class="input-group mb-3 shadow-0">
          <input type="text" class="form-control" placeholder="Masukkan kode promo">
          <div class="input-group-append">
            <button class="btn btn-secondary" type="button" id="button-addon2">Redeem</button>
          </div>
        </div>


      </div>

      <button class="btn btn-primary mx-auto w-100 mt-4" type="submit" style="max-width: 500px">Lanjutkan Ke Pembayaran</button>

    </div>
    </form>
  </div>

@endsection

@push('scripts')
  <script>
    // kurir
    function updateSelectedKurir() {
      var selectedRadio = $('input[name="kurir"]:checked');
      var associatedLabel = selectedRadio.siblings('label');

      $('#selected_kurir').html(associatedLabel.html());
    }

    $('input[name="kurir"]').on('change', function() {
      updateSelectedKurir();
    });

    updateSelectedKurir();

    // metode bayar
    function updateSelectedMetodeBayar() {
      var selectedRadio = $('input[name="metode_pembayaran"]:checked');
      var associatedLabel = selectedRadio.siblings('label');

      $('#selected_metode_bayar').html(associatedLabel.html());
    }

    $('input[name="metode_pembayaran"]').on('change', function() {
      updateSelectedMetodeBayar();
    });

    updateSelectedMetodeBayar();
  </script>
@endpush
