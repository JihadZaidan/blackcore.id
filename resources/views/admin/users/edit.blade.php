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
            <h4 class=" m-0">Edit User</h4>
          </div>
        
          <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                    value="{{ old('name', $user->name) }}" required>
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email"
                    value="{{ old('email', $user->email) }}" required>
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan phone"
                    value="{{ old('phone', $user->phone) }}" required>
                  @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea type="text" rows="5" class="form-control" id="address" name="address" placeholder="Masukkan alamat" required>{{ old('address', $user->address) }}</textarea>
                  @error('address')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              {{-- Kanan --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="foto">Foto</label>
                  <div class="input-group">
                    <input type="text" class="form-control bg-white" id="fotoPath" placeholder="Image path" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-dark btn-upload-file" type="button" id="chooseFotoProfilBtn">
                        <i class="ti-image"></i> Choose Image
                      </button>
                    </div>
                  </div>
                  <input type="file" name="photo" id="fotoFile" style="display: none;" accept="image/*">
                  <div class="mt-3">
                    <img id="fotoPreview" src="{{ $user->photo ? asset('storage/'.$user->photo) : '' }}" alt="Product Image Preview"
                      style="max-width: 100%; max-height: 200px; {{ $user->photo ? '' : 'display: none;' }}">
                  </div>
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
