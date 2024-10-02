@extends('admin_layout')

@section('title', 'Edit Produk')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Detail Informasi</h4>
          </div>
        
            <div class="row gx-5">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Nama Informasi</label>
                  <input type="text" class="form-control bg-disabled" disabled
                    value="{{ $product->name }}">
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control bg-disabled" disabled
                    value="{{ $product->slug }}">
                </div>
                <div class="form-group">
                  <label for="price">Harga</label>
                  <input type="text" class="form-control bg-disabled" disabled
                    value="{{ formatRupiah($product->price) }}">
                </div>
                <div class="form-group">
                  <label for="stock">Stok</label>
                  <input type="text" class="form-control bg-disabled"
                    value="{{ $product->stock }}" disabled>
                </div>
                <div class="form-group">
                  <label for="address">Deskripsi</label>
                  <textarea type="text" rows="15" class="form-control bg-disabled" disabled>{{ $product->description }}</textarea>
                </div>
              </div>
              {{-- Kanan --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="foto">Foto Produk</label>
                  <div class="mt-2 d-flex flex-column justify-content-center align-items-center">
                    @if($product->photo)
                    <img src="{{ asset('storage/'.$product->photo) }}" class="w-100 h-auto rounded border" alt="Product Image Preview"
                      style="object-fit:cover">
                    @else
                      <p class="mt-2">Tidak ada foto</p>
                    @endif
                  </div>
                </div>
                
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection
