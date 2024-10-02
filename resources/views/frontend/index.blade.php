@extends('frontend.frontend_layout')

@section('content')
  <section class="banner bg-1" id="home">
    <div class="container">
      <div class="row">
        <div class="col-md-8 align-self-center">
          <!-- Contents -->
          <div class="content-block">
            <h1>Blackcore </h1>
            <h5>Solusi Hemat Bahan Bakar</h5>
            <!-- App Badge -->
            <div class="app-badge">
              <ul class="list-inline">
                <li class="list-inline-item">
                  </a>
                </li>
                <li class="list-inline-item">

                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <!-- App Image -->
          <div class="image-block">

          </div>
        </div>
      </div>
    </div>
  </section>

  <!--====  End of Homepage Banner  ====-->

  <section class="products" id="product">
    <div class="container">
      <div class="row product-container">
        <div class="col-12">
          <div class="section-title text-center my-2">
            <h2 class="my-2">Produk</h2>
            <p class="section-subtitle">Produk yang dijual Oleh Blackcore</p>
          </div>
        </div>
      </div>
      <div class="product-container">
        <div class="product-wrapper">
          <!-- Product Item 1 -->
          @foreach ($products as $item)
            <a href="{{ route('frontend.product', $item->slug) }}" class="product-item">
              <div class="product-image">
                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}">
              </div>
              <div class="product-content">
                <h3 style="font-size:16px; font-weight: 600">{{ $item->name }}</h3>
                <p class="price">{{ formatRupiah($item->price) }}</p>
              </div>
            </a>
          @endforeach

          <!-- Product Item 5 (moved here) -->

          <!-- Add more product items as needed -->

        </div>
      </div>
    </div>
  </section>

  <section class="berita section" id="berita">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h2>Informasi</h2>
            <p class="section-subtitle">Informasi Terbaru tentang Blackcore</p>
          </div>
        </div>
      </div>
      <div class="berita-container">
        <div class="berita-wrapper">

          @foreach ($articles as $info)
          <div class="berita-item">
            <div class="berita-image">
              @if ($info->cover_image)
                <img src="{{ asset('storage/' . $info->cover_image)}}" alt="{{ $info->title }}" class="h-100 w-100" style="object-fit: cover">
              @endif
            </div>
            <div class="berita-content">
              <a href="{{ route('frontend.article', $info->slug) }}">
                <h3>{{ $info->title }}</h3>
              </a>
              <p class="date">{{ $info->created_at->format('d F Y') }}</p>
              <p class="excerpt">{{ Str::words(strip_tags($info->content), 15) }}</p>
              <span class="btn btn-sm btn-danger">{{ $info->category->category_name }}</span>
            </div>
          </div>
          @endforeach
          
        </div>
      </div>
    </div>
  </section>

  <!--============================
         =            Testimonials            =
         =============================-->

  <section class="testimoni section" id="testimoni">
    <div class="container">
      <h2 class="section-title">Testimoni</h2>
      <p class="section-subtitle">Pelanggan yang Menggnakan Blackcore</p>
      <div class="testimoni-wrapper">
        <div class="testimoni-item">
          <img src="path/to/luisa-image.jpg" alt="Luisa" class="author-image">
          <div class="rating">
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star empty">★</span>
          </div>
          <p class="quote">"Tarikannya Langsung Ngacir!"</p>
          <p class="author">Luisa</p>
        </div>
        <div class="testimoni-item">
          <img src="path/to/edoardo-image.jpg" alt="Edoardo" class="author-image">
          <div class="rating">
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
          </div>
          <p class="quote">"Biasanya Sering ke pom bensin, dengan berkat ini langsung hemat "</p>
          <p class="author">Edoardo</p>
        </div>
        <div class="testimoni-item">
          <img src="path/to/mart-image.jpg" alt="Mart" class="author-image">
          <div class="rating">
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star empty">★</span>
          </div>
          <p class="quote">"Akhirnya ada Alat yang Bisa Menghemat Bahan Bakar"</p>
          <p class="author">Mart</p>
        </div>
      </div>
    </div>
  </section>

  <!--====  End of Testimoni  ====-->

  <section class="youtube-section">
    <div class="container">
      <h2 class="section-title">Youtube</h2>
      <p class="section-subtitle">Update Video Youtube Terbaru</p>

      <div class="video-grid">
        <!-- Video 1 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/HV_oM67Lqjc" frameborder="0"
            allowfullscreen></iframe>

        </div>

        <!-- Video 2 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/b-2xHSmomak" frameborder="0"
            allowfullscreen></iframe>
        </div>

        <!-- Video 3 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/jNWuEpU1aMM" frameborder="0"
            allowfullscreen></iframe>

        </div>

        <!-- Video 4 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/H1AKC1-fzcc" frameborder="0"
            allowfullscreen></iframe>

        </div>

        <!-- Video 5 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/KBf9Ryu33SQ" frameborder="0"
            allowfullscreen></iframe>

        </div>

        <!-- Video 6 -->
        <div class="video-item">
          <iframe width="100%" height="200" src="https://www.youtube.com/embed/k3EoQKXhE-4" frameborder="0"
            allowfullscreen></iframe>

        </div>
      </div>
    </div>
  </section>

  <section class="tanya-jawab-section">
    <div class="container">
      <div class="section-title text-center">
        <h2>Tanya Jawab</h2>
        <p class="section-subtitle">Pertanyaan yang sering diajukan</p>
      </div>
      <div class="accordion">
        <div class="accordion-item">
          <div class="accordion-item-header">
            Apa Beda Blackcore Ultimate dan Blackcore Diesel?
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            Perbedaannya ada dari kapasitas power yang di hasilkan dan ukurannya

            <br>Blackcore Special :  Untuk mobil kurang dari 1500cc
            <br>Blackcore Ultimate : Untuk mobil 1500cc - 2000cc</br>

<br>Pasang Blackcore Special = setara tambah 300 cc ruang bakar
<br>Pasang Blackcore Ultimate = setara tambah 400 cc ruang bakar
<br>Berisi gas olahan blow-by gas oleh katalis blackcore setara Elpiji atau mirip Nos.</br>

<br>Ukuran Blackcore Special : 3,5 x 3,5 x 31 cm
<br>Ukuran Blackcore Ultimate : 4 x 4 x 31 cm</br>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Berapa Harga Blackcore dan Dapatnya Apa Saja?
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            Ada 2 Paket Utama Blackcore, Harga di bawah sudah komplit dengan Blackcore Tunning dan Blackcore Additive (diluar ongkir)
<br>1. Blackcore Special : Rp, 2.500.00</br>
    2. Blackcore Ultimate : Rp, 3.500.000</br>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Apa Aja Keuntungan Memasang Blackcore?
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
              <ul style="padding-left: 1rem;">
              KEUNTUNGAN YG DIDAPATKAN
<br>1. Tenaga & Torsi mobil akan meningkat tajam, hampir seperti ganti mesin yang lebih besar CC nya
<br>2. Bisa lebih irit BBM antara 10 sd 30% jika dibandingkan tanpa pasang katalis, (tergantung penggunaan) karena dengan injak gas separoh nya dari biasanya akan didapatkan kinerja yang sama , artinya rpm lebih rendah = irit bensin, tapi torsi dan horsepower sudah didapatkan lebih tinggi
<br>3. Lebih ramah lingkungan , setua apapun mobil nya akan lolos uji emisi gas buang
<br>4. Mobil jadi lebih "FUN TO DRIVE" apapun mobil nya.</br>

<br>Bukti nyata lapangan ,sudah ribuan mobil dari semua merk mobil yang beredar di Indonesia sudah terpasang ,
Cek di channel YouTube.</br>
YouTube BLACKCORE INDONESIA 
Cek bagian playlist nya , sudah saya pilah2 sesuai merk pabrik mobil .
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Cara Pemasangan Blackcore Pada Mesin Mobil Bensin
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            <br>1. Temukan "PCV" atau kalo mobil jadul "breather", biasanya diatas mesin ada slang menuju ke filter udara atau ke intake (mobil modern)
            <br>2. Temukan saluran uap bensin yang berasal dari kanister yang disalurkan ke selenoid in, lalu sebelum masuk selenoid in dikasih T lalu saluran ke dua dikasih PCV yang dihubungkan menuju ke saluran input blackcore, ,lalu yang satu saluran ke input naple selenoid .
            <br>3. lepas selang PCV atau breather yg menuju intake atau filter udara lalu pasang slang bawaan blackcore ke napel PCV /breather, di klem lalu disambung pakai sambungan T ke slang yang terhubung dengan sumber keluaran uap bensin ( kanister )= no 2 utk menjadi input blackcore
            <br>4. Sambungkan gabungan dua napel tadi ke input Blackcore (napel bagian bawah saat blackcore diberdirikan dan terbaca huruf F)
            <br>5. Blackcore diikatkan di atas header knalpot pakai klem 4 inch usahakan nempel langsung di header.
            <br>6. Kasih slang dari napel output blackcore lalu disambung pakai slang ke arah napel lepasan x PCV yang menuju intake, lalu diklem kencang semua
            <br>7. Pemasangan selesai, cek klem 2 harus kencang semua.
            <br>8. Rapikan pemasangan pakai kabel tis.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Cara Pemasangan Blackcore Pada Mesin Mobil Diesel
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            <br>1. Siapkan dudukan OCC ( oil catch can ) agar bisa dipasang dimobil posisi beda2 tiap merk mobil, harus diakali pakai plat lobang-lobang agar mudah ditekuk dan dipasang baut untuk mengikatkan ke body mobil Agar aman terjangkau dan mudah dirawat ,fungsi utama jadi penampung uap oli dari breather saat akan masuk blackcore dilewatkan OCC dulu .
            <br>2. Temukan selang breather yang menuju turbo atau intake kalo mobil belum ber turbo.slang dilepas , Lalu dari naple breather kasih slang dan diklem untuk disambung kan ke input OCC, lalu dari output OCC masuk ke bagian input Blackcore lalu di. Klem . (Sebelumnya diukur dulu kebutuhan panjang slang agar rapi terpasang) .
            <br>3. Blackcore diikatkan pakai 2 Klem 4 inch ke body header atau downpipe , agar mendapatkan panas yang maksimal ( boleh sampai 400 Drajad celsius ,makin panas makin hebat kinerja nya reactor )
            <br>4. Hubungkan output blackcore pakai slang 5/8 ke mulut intake atau ke mulut saluran turbo ( dimana sebelum nya ada slang asli dari breather ke intake atau ke turbo ).
            <br>5. Klem semua slang pada napel blackcore maupun pada napel turbo atau naple intake usahakan kencang semua agar tidak ada kebocoran.
            <br>6. Cek semua klem terpasang kencang dan tidak ada slang tertekuk.
            <br>7. Selesai.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Bagaimana Blackcore Bekerja?
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            <li>Pada intinya blackcore katalis (tabung reaktor) kinerja utama nya adalah mengolah blow-by gas menjadi gas setara Elpiji (mirip Nos) sehingga mampu mengefisiensikan kinerja mesin</li>
            <li>Blow-by gas adalah gas yang dikeluarkan mobil yang beracun dan tidak bermanfaat.</li>
            <li>Gas ini setelah direaksikan di tabung reaktor blackcore dan dipanaskan di header knalpot dapat menjadi power dan torsi tambahan/terutama di rpm bawah sudah sangat terasa tenaga dan torsi nya , sedangkan untuk penghematan BBM itu merupakan bonus , saat cara mengendara lebih " bijaksana " dengan power dan torsi tambahan baru bagaimana memanfaatkannya.</li>
            <li>Untuk mobil matic akan mempercepat perpindahan gear dengan meningkatnya torsi sehingga torque converter nya lebih cepat memproses oli untuk perpindahan gear lebih cepat , lebih smooth dan terjaga selain rendah rpm nya,</li>
            <li>namun speed dan akselerasi lebih menyenangkan namun jauh lebih irit.</li>
          </ul>
          <p>Blackcore Special = ++400 cc (virtual)<br>
            Blackcore Ultimate = ++700cc (virtual)<br>
            Ruang bakar baru berisi gas hasil olahan blackcore dari blow- by gas , setara elpiji</p>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <div class="accordion-item-header">
            Apakah Ada Efek Negatif dari Blackcore Ini di Jangka Panjang?
          </div>
          <div class="accordion-item-body">
            <div class="accordion-item-body-content">
            Tidak ada dan aman, karena blackcore tidak mempengaruhi kelistrikan mobil melainkan fokus mengolah blow-by menjadi tambahan tenaga saja,bukti nyata sudah 1000an lebih testimoni di youtube channel Blackcore Indonesia, sudah 6 tahun pemasaran tanpa komplain.
            </div>
          </div>
        </div>
      </div>
  </section>


@endsection
