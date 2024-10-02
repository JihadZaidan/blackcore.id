@extends('frontend.frontend_layout')

@section('title', 'About Us')

@section('content')
  <section class="hero-section">
    <div class="container">
      <div class="hero-content">
        <h1>Apa Itu Blackcore?</h1>
        <p>Blackcore dapat mengubah energi yang terbuang menjadi bisa digunakan kembali yang membuat mobil jadi lebih bertenaga dan irit bensin.</p>
        <a href="index.html" class="btn btn-light">Kembali ke Halaman Utama</a>
      </div>
    </div>
  </section>

  <section class="about-section">
    <div class="container">
      <h2 class="text-center">Tentang Kami</h2>
      <hr class="divider">
      <div class="row">
        <div class="col-md-6 order-md-2 order-1 mb-3 mb-md-0">
          <h3>Bermula dari keresahan.</h3>
          <p><br>Perkenalkan nama saya, Ratmoko saya adalah head marketing dari produk blackcore.</br>
          <br>Blackcore adalah alat yang muncul dari keresahan akan kurangnya tenaga pada mobil saya. Blackcore dapat mengubah energi yang terbuang menjadi bisa digunakan kembali yang membuat mobil jadi lebih bertenaga dan irit bensin.</p>
        </div>
        <div class="col-md-6">
          <img src="/images/profilefoto.jpg" alt="Image 1" class="img-fluid">
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-6 order-md-2">
          <h3>Sejarah</h3>
          <p><br>Penulis bertemu dengan pencipta blackcore tahun 2017 , setelah meng-install dimobil sendiri di Avanza. Setelah merasakan sendiri kekuaatan blackcore, penulis menjadi tertarik untuk ikut memasarkan blackcore di bagian marketing nya.</br>
              <br>Setelah ditraining selama 3 bulan penulis memberanikan diri untuk memasarkan ke pasar yang lebih luas dengan menggunakan Facebook, WhatsApp, dan YouTube.</br>
              <br>Sampai saat ini sudah ribuan unit terpasang tanpa ada kendala teknis apapun. Mobil tetap aman , power bertambah ,torsi bertambah dan ajaibnya pemakaian BBM semakin irit.</br></p>
        </div>
        <div class="col-md-6 order-md-1">
          <img src="/images/fotopertama.png" alt="Image 2" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
@endsection
