@extends('admin_layout')

@section('title', 'Produk')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">Produk</h4>
              <p class="card-description mb-0">
                Data produk yang telah ditambahkan
              </p>
            </div>
            <button class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#addProductModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah Produk
            </button>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search products" aria-label="Search products">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit" style="padding: 0.8rem 1.5rem">
                  <i class="ti-search"></i>
                </button>
              </div>
            </form>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th>Foto</th>
                  <th>Stok</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $row)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ formatRupiah($row->price) }}</td>
                    <td>
                      <img src="{{ asset('storage/'. $row->photo) }}" alt="{{ $row->name }}" class="rounded" style="width: 50px; height: 50px; object-fit:cover" >
                    </td>
                    <td>{{ $row->stock }}</td>
                    <td>{{ truncateString($row->description, 50)  }}</td>
                    <td>
                      <a href="{{ route('admin.products.show', $row->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                      <a href="{{ route('admin.products.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $row->id }}', '{{ $row->name }}')">Hapus</button>
                      <form id="delete-form-{{ $row->id }}" action="{{ route('admin.products.destroy', $row->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                @endforeach

                @if ($products->total() == 0)
                  <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $products->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Tambah Produk Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama Produk</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama produk"
                value="{{ old('name') }}" required>
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="Ketik nama produk untuk otomatis generate slug"
                value="{{ old('slug') }}" required>
              @error('slug')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="price">Harga</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga"
                value="{{ old('price') }}" required>
              @error('price')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="stock">Stok</label>
              <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan stock"
                value="{{ old('stock') }}" required>
              @error('stock')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea rows="8" class="form-control" id="description" name="description" placeholder="Masukkan alamat" required>{{ old('description') }}</textarea>
              @error('description')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="foto">Foto Produk</label>
              <div class="input-group">
                <input type="text" class="form-control bg-white" id="fotoPath" placeholder="Image path" readonly>
                <div class="input-group-append">
                  <button class="btn btn-dark" type="button" id="chooseImageBtn">
                    <i class="ti-image"></i> Choose Image
                  </button>
                </div>
              </div>
              <input type="file" name="photo" id="fotoFile" style="display: none;" accept="image/*">
              <div class="mt-3">
                <img id="fotoPreview" src="" alt="Product Image Preview"
                  style="max-width: 100%; display: none;">
              </div>
              @error('photo')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan Produk</button>
          </div>
        </div>
      </div>
    </form>
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

      // show modal when errors occur
      @if(count($errors) > 0) 
      $(document).ready(function() {
        $('#addProductModal').modal('show');
      });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus Produk',
          text: "Apakah Anda yakin ingin menghapus produk '" + name + "' ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({title: 'Menghapus...'});
            Swal.showLoading();
            $('#delete-form-'+id).submit();
          }
        })
      }

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
