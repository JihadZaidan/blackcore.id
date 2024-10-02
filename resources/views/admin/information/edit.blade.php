@extends('admin_layout')

@section('title', 'Edit Informasi')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Edit Informasi</h4>
          </div>
        
          <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Nama Produk</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                    value="{{ old('name', $product->name) }}" required>
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Ketik nama produk untuk otomatis generate slug"
                    value="{{ old('slug', $product->slug) }}" required>
                  @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="price">Harga</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan price"
                    value="{{ old('price', $product->price) }}" required>
                  @error('price')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="stock">Stok</label>
                  <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan stock"
                    value="{{ old('stock', $product->stock) }}" required>
                  @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Deskripsi</label>
                  <textarea type="text" rows="15" class="form-control" id="description" name="description" placeholder="Masukkan alamat" required>{{ old('description', $product->description) }}</textarea>
                  @error('description')
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
                      <button class="btn btn-dark btn-upload-file" type="button" id="chooseImageBtn">
                        <i class="ti-image"></i> Choose Image
                      </button>
                    </div>
                  </div>
                  <input type="file" name="photo" id="fotoFile" style="display: none;" accept="image/*">
                  <div class="mt-3">
                    <img id="fotoPreview" src="{{ $product->photo ? asset('storage/'.$product->photo) : '' }}" alt="Product Image Preview"
                      style="max-width: 100%; max-height: 200px; {{ $product->photo ? '' : 'display: none;' }}">
                  </div>
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
      const chooseImageBtn = document.getElementById('chooseImageBtn');
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

    // auto generate slug
    function stringToSlug(text) {
        return text.toLowerCase()
          .trim()
          .replace(/[^\a-z0-9\s-]/g, '')
          .replace(/\s+/g, '-')
          .replace(/-+/g, '-');
      }

      $('#name').on('keyup', function() {
        var title = $(this).val();
        var slug = stringToSlug(title);
        $('#slug').val(slug);
      })

  </script>
@endpush
@endsection
