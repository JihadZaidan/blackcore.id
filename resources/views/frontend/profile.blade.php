@extends('frontend.frontend_layout')

@section('title', 'Profile')

@section('content')
  <div class="container-fluid main" style=";">
    <div class="d-block d-md-none menu">
      <div class="bar"></div>
    </div>
<form action="{{ route('frontend.update_profile') }}" method="post" enctype="multipart/form-data">
  @csrf 
  @method('PUT')
    <div class="container rounded bg-white mt-5 mb-5">
      <div class="row">
        <div class="col-md-4 border-right">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            @if ($user->photo != null)
              <img id="profile-preview" class="rounded-circle mt-5 img-fluid mb-2 object-cover" style="height: 150px; width: 150px;object-fit:cover"
                src="{{ asset('storage/' . $user->photo) }}">
            @else
              <img id="profile-preview" class="rounded-circle mt-5 img-fluid mb-2 object-cover" style="height: 150px; width: 150px;object-fit:cover"
                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
            @endif
            {{-- <input type="file" id="imageUpload" accept="image/*" style="display: none;" onchange="previewImage(event)"> --}}
            {{-- <label for="imageUpload" class="btn btn-primary mt-3">Ubah Foto Profil</label> --}}
            <div class="custom-file mt-2 mb-3">
              <input type="file" name="photo" class="custom-file-input" id="image-upload" accept="image/*"  onchange="previewImage(event)">
              <label class="btn btn-primary" for="image-upload" style="position: absolute;left: 0;top: 0;width: 100%;">UBAH
                FOTO PROFIL</label>
            </div>
            <span class="font-weight-bold">{{ $user->name }}</span>
            <span class="text-black-50">{{ $user->email }}</span>
          </div>
        </div>
        <div class="col-md-8">
          <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="text-right">Profile Settings</h4>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <label class="labels">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ $user->name }}">
              </div>
              <div class="col-md-12">
                <label class="labels">Nomor Telefon</label>
                <input type="text" name="phone" class="form-control" placeholder="Masukkan Nomor Telefon"
                  value="{{ $user->phone }}">
              </div>
              <div class="col-md-12">
                <label class="labels">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Alamat Email"
                  value="{{ $user->email }}">
              </div>
              <div class="col-md-12">
                <label class="labels">Alamat</label>
                <textarea class="form-control" name="address" id="address" rows="4" placeholder="Masukkan Alamat">{{ $user->address }}</textarea>
              </div>
              <div class="col-md-12">
                <label class="labels">Password (isi password jika ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" value="">
              </div>
              {{-- <div class="col-md-6">
              <label class="labels">Country</label>
              <input type="text" class="form-control" placeholder="country" value="">
            </div> --}}
              {{-- <div class="col-md-6">
              <label class="labels">State/Region</label>
              <input type="text" class="form-control" value="" placeholder="state">
            </div> --}}
            </div>
            <div class="mt-5 text-center">
              <button class="btn btn-primary profile-button" type="submit">Simpan Profil</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
  <script src="{{ asset('frontend/js/profile.js')}}"></script>
@endsection
