@extends('admin_layout')

@section('title', 'Edit User')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Detail User</h4>
          </div>
        
            <div class="row gx-5">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control bg-disabled" disabled
                    value="{{ $user->name }}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control bg-disabled" disabled
                    value="{{ $user->email }}">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="text" class="form-control bg-disabled"
                    value="{{ $user->phone }}" disabled>
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea type="text" rows="5" class="form-control bg-disabled"disabled>{{ $user->address }}</textarea>
                </div>
                <div class="form-group">
                  <label for="phone">Role</label>
                  <input type="text" class="form-control bg-disabled" disabled
                  value="{{ ucfirst($user->role ) }}">
                </div>
              </div>
              {{-- Kanan --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <div class="mt-3 d-flex flex-column justify-content-center align-items-center">
                    @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}" class="w-100 h-100 rounded-pill" alt="Product Image Preview"
                      style="max-width: 210px; max-height: 210px;object-fit:cover">
                    @else
                      <img src="{{ asset('images/user-placeholder.png') }}" class="rounded-pill" alt="Product Image Preview"
                      style="max-width: 210px; max-height: 210px;">
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
