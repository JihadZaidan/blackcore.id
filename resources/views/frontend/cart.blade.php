@extends('frontend.frontend_layout')

@section('title', 'Cart')

@section('content')
  <div class="container mt-5 py-4">
    <div class="row">
      <div class="col-md-8">
        <h3 class="mb-4">Your shopping cart</h3>
        <div class="cart-items">
          <!-- Repeat this block for each item -->
          @foreach ($carts as $item)
          <div class="cart-item d-flex align-items-center mb-4">
            <img src="{{ asset('storage/'.$item->product->photo) }}" alt="Product" class="mr-3" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="flex-grow-1">
              <h5 class="mb-1" style="font-weight: 600">{{ $item->product->name }}</h5>
              <h5 class="mb-0 mr-3">{{ formatRupiah($item->product->price) }}</h5>
            </div>
            <div class="d-flex align-items-center">
              <span class="mr-3">x</span>
              <form action="{{ route('frontend.cart.update', $item->id)}}" method="post" class="d-flex">
                @csrf
                <input type="number" class="form-control rounded-left" name="qty" min="1" max="99" value="{{ $item->qty }}" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px">
                <button type="submit" class="btn btn-primary rounded-right" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px">
                  <i class="fas fa-check" style="font-size: 14px"></i>
                </button>
              </form>
              <form action="{{ route('frontend.cart.remove', $item->id)}}" method="post" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger ml-3">
                  <i class="fas fa-trash" style="font-size: 14px"></i> Remove
                </button>
              </form>
              
            </div>
          </div>
          <hr>
          @endforeach

          @if ($carts->count() == 0)
            <h5>Keranjang Anda Masih Kosong!</h5>
          @endif
          {{-- <div class="cart-item d-flex align-items-center mb-4">
            <img src="path_to_image" alt="Product" class="mr-3" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="flex-grow-1">
              <h5 class="mb-1">Winter jacket for men and lady</h5>
              <p class="text-muted mb-0">Yellow, Jeans</p>
            </div>
            <div class="d-flex align-items-center">
              <select class="form-control mr-3" style="width: 70px;">
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
              <h5 class="mb-0 mr-3">$1156.00</h5>
              <button class="btn btn-link text-danger">REMOVE</button>
            </div>
          </div> --}}
          <!-- End of item block -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-4">Order Summary</h5>
            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Coupon code">
              <button class="btn btn-outline-secondary mt-2">APPLY</button>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Total price:</span>
              <span>{{ $totalPrice ? formatRupiah($totalPrice) : 'Rp. 0'}}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Discount:</span>
              <span class="text-success">-Rp. 0</span>
            </div>
            <a href="{{ route('frontend.checkout') }}" class="btn btn-primary btn-block mb-2">CHECKOUT</a>
            <button class="btn btn-outline-secondary btn-block">BACK TO SHOP</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
