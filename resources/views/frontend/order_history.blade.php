@extends('frontend.frontend_layout')

@section('title', 'Riwayat Pembelian')

@section('content')

  <div class="container mt-5 py-4 mb-5 rounded-lg">

    <div class="p-4" style="border-radius: 18px;">
      <h4>Riwayat Pembelian</h4>
      <p class="text-muted">Daftar Riwayat Pembelian Anda</p>
      <div class="mt-4">
        <select name="filter_status" class="d-none form-control mb-2 ml-auto" style="max-width: 200px">
          <option value="semua">Semua</option>
          <option value="semua">Diproses</option>
          <option value="semua">Selesai</option>
          <option value="semua">Dibatalkan</option>
        </select>
        @foreach (range(0, 10) as $item)
          <div class="row py-3 mx-0 mb-3 bg-white border history-item">
            <div class="col-lg-5 d-flex">
              <img src="/frontend/images/contohgambar.jpg" class="rounded mr-3" style="width:90px; height:90px;">
              <div>
                <h5>Blackcore Ultimate</h5>
                <div>Harga: Rp 100.000</div>
                <div>Jumlah: 2</div>
              </div>
            </div>

            <div class="col-lg-6 order-details">
              <div class="row mx-0">
                <div class="col-md-4 mx-0 px-0">
                  <div>
                    <div class="text-muted text-sm">No. Invoice:</div>
                    <div class="mb-2">#127162725</div>
                  </div>
                  <div>
                    <div class="text-muted text-sm">Tanggal:</div>
                    <div>16 September 2024</div>
                  </div>
                </div>
                <div class="col-md-4 mx-0 px-0">
                  <div>
                    <div class="text-muted text-sm">Total</div>
                    <div class="mb-2">Rp 500.000</div>
                  </div>
                  <div>
                    <div class="text-muted text-sm">Kurir</div>
                    <div>J&amp;T Express</div>
                  </div>

                </div>
                <div class="col-md-4 mx-0 px-0">
                  <div>
                    <div class="text-muted text-sm">Status</div>
                    <div class="mb-2"><span class="badge badge-success">Selesai</span></div>
                  </div>
                  <div>
                    <div class="text-muted text-sm">Tanggal Diterima</div>
                    <div>18 September 2024</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1 lacak">
              <a href="{{ route('frontend.order_tracking') }}" class="btn btn-primary btn-sm btn-lacak w-100">Lacak</a>
            </div>
          </div>
        @endforeach

      </div>

    </div>
  </div>

@endsection
