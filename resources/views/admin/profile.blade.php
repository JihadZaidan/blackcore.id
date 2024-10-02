@extends('admin_layout')

@section('title', 'Profil Anda')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Profil Anda</h4>
          </div>
        
          <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="d-flex justify-center mb-4 align-items-center flex-column mx-auto" style="width:100%;max-width: 250px;aspect-ratio:1/1">
              @if ($profile->photo != null)
              
              <img id="fotoPreview" src="{{asset('storage/'.$profile->photo)}}" alt="Foto" class="w-100 h-100 object-fit-cover rounded-pill" style="object-fit: cover">
              @else 
              <img id="fotoPreview" src="/images/user-placeholder.png" alt="Foto" class="w-100 h-100 object-fit-cover rounded-pill" style="object-fit: cover">
              @endif
              <div>
                <input type="text" class="form-control bg-white" id="fotoPath" placeholder="Image path" readonly style="display:none">
                  <div class="input-group-appends">
                    <button class="btn btn-dark btn-upload-file mt-4" type="button" id="chooseFotoProfilBtn" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">
                      <i class="ti-image"></i> Ganti Foto Profil
                    </button>
                  </div>
                  <input type="file" name="photo" id="fotoFile" style="display: none;" accept="image/*">
              </div>
            </div>
            
            
            <div class="row">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                    value="{{ old('name', $profile->name) }}" required>
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email"
                    value="{{ old('email', $profile->email) }}" required>
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan phone"
                    value="{{ old('phone', $profile->phone) }}" required>
                  @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                
              </div>
              {{-- Kanan --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea type="text" rows="5" class="form-control" id="address" name="address" placeholder="Masukkan alamat" required>{{ old('address', $profile->address) }}</textarea>
                  @error('address')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password (isi jika ingin mengubah password)</label>
                  <input type="text" class="form-control" id="password" name="password"
                    placeholder="Masukkan password" value="{{ old('password') }}">
                  @error('password')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
            </div>
            

            <button type="submit" class="btn btn-dark">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const chooseImageBtn = document.getElementById('chooseFotoProfilBtn');
      const fotoFile = document.getElementById('fotoFile');
      const fotoPath = document.getElementById('fotoPath');
      const imagePreview = document.getElementById('fotoPreview');

      chooseImageBtn.addEventListener('click', function() {
        fotoFile.click();
      });

      fotoFile.addEventListener('change', function(event) {
        handleImageUpload(event.target);
      });

      function handleImageUpload(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            fotoPath.value = input.files[0].name;
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
          }

          reader.readAsDataURL(input.files[0]);
        }
      }
    });

  </script>
@endpush
@endsection
