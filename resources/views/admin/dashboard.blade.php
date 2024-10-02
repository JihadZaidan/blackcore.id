@extends('admin_layout')

@section('title', "Dashboard")

@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Selamat Datang {{ auth()->user()->name }}</h3>
          <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread
              alerts!</span></h6>
        </div>
        <div class="col-12 col-xl-4">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="row">
        <div class="col-12 col-md-4 mb-4 stretch-card">
          <div class="card bg-danger text-white">
            <div class="card-body">
              <p class="mb-4">Jumlah Pengguna</p>
              <p class="fs-30 mb-2">{{ $total_user }}</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 mb-4 stretch-card">
          <div class="card bg-dark text-white">
            <div class="card-body">
              <p class="mb-4">Jumlah Barang</p>
              <p class="fs-30 mb-2">{{ $total_product }}</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 mb-4 stretch-card">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <p class="mb-4">Jumlah Pemesanan</p>
              <p class="fs-30 mb-2">34040</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    @media (max-width: 767px) {
      .grid-margin>.row {
        margin-left: 15px;
        margin-right: 15px;
      }

      .stretch-card {
        padding-left: 0;
        padding-right: 0;
      }

      .card {
        width: 100%;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
      }

      .fs-30 {
        font-size: 24px !important;
      }
    }
  </style>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Top Barang Terlaris</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Nama Produk</th>
                  <th>Jumlah Terjual</th>
                  <th>Total Pendapatan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Produk A</td>
                  <td>1500</td>
                  <td>Rp 150.000.000</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Produk B</td>
                  <td>1200</td>
                  <td>Rp 120.000.000</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Produk C</td>
                  <td>1000</td>
                  <td>Rp 100.000.000</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Produk D</td>
                  <td>800</td>
                  <td>Rp 80.000.000</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Produk E</td>
                  <td>600</td>
                  <td>Rp 60.000.000</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
