@extends('frontend.frontend_layout')

@section('title', 'Checkout')

@push('styles')
  {{-- <link href="{{ asset('frontend/css/checkout.css') }}" rel="stylesheet"> --}}
@endpush
@section('content')

  <div class="container mt-5 py-4 mb-5  rounded-lg">
    {{-- Tambah class 'needs-validation' jika ingin validasi form --}}
    <form class="" novalidate action="{{ route('frontend.payment') }}">
      <div class="row">
        <div class="col-12 col-lg-8">
          <h4>Form Lengkap</h4>
          <div class="mb-2">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="" required>
            <div class="invalid-feedback">
              Nama tidak boleh kosong
            </div>
          </div>
          <div class="mb-2">
            <label for="address">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" value="" required>
            <div class="invalid-feedback">
              Alamat tidak boleh kosong
            </div>
          </div>
          <div class="mb-2">
            <label for="phone">Nomor Telepon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="" required>
            <div class="invalid-feedback">
              Nomor Telepon tidak boleh kosong
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-2">
              <label for="city">Kota</label>
              <input type="text" class="form-control" id="city" name="city" value="" required>
              <div class="invalid-feedback">
                Kota tidak boleh kosong
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <label for="province">Provinsi</label>
              <input type="text" class="form-control" id="province" name="province" value="" required>
              <div class="invalid-feedback">
                Provinsi tidak boleh kosong
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-2">
              <label for="postcode">Kode Pos</label>
              <input type="text" class="form-control" id="postcode" name="postcode" value="" required>
              <div class="invalid-feedback">
                Kode pos tidak boleh kosong
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
                    <h6>{{ $cart->product->name }}</h6>
                    <div class="text-muted">{{ formatRupiah($cart->product->price) }} x {{ $cart->qty }}</div>
                  </div>
                  <div class="text-muted">{{ formatRupiah($cart->total) }}</div>
                </li>
              @endforeach
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
        <button class="btn btn-primary mx-auto w-100 mt-4" type="submit" style="max-width: 500px">Lanjutkan Ke
          Checkout</button>
      </div>
      
    </form>


  </div>
@endsection

@push('scripts')
  <script src="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.js"></script>
  <script>
    // form validation
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
@endpush
