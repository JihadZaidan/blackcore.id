@extends('admin_layout')

@section('title', 'Users')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">User</h4>
              <p class="card-description mb-0">
                Data user yang telah terdaftar
              </p>
            </div>
            <button class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#addUserModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah User
            </button>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search user" aria-label="Search user">
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
                  <th>Nama</th>
                  <th>Email</th>
                  <th>No. Telepon</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $row)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->phone }}</td>
                    <td class="wrap-text">{{ $row->address }}</td>
                    <td>
                      <a href="{{ route('admin.users.show', $row->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                      <a href="{{ route('admin.users.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $row->id }}', '{{ $row->name }}')">Hapus</button>
                      <form id="delete-form-{{ $row->id }}" action="{{ route('admin.users.destroy', $row->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                @endforeach

                @if ($users->total() == 0)
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $users->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                value="{{ old('name') }}" required>
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email"
                value="{{ old('email') }}" required>
              @error('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="phone">Nomor Telepon</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon"
                value="{{ old('phone') }}" required>
              @error('phone')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea type="text" rows="5" class="form-control" id="address" name="address" placeholder="Masukkan alamat" required>{{ old('address') }}</textarea>
              @error('address')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
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
                <img id="fotoPreview" src="" alt="Product Image Preview"
                  style="max-width: 100%; max-height: 200px; display: none;">
              </div>
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" class="form-control" id="password" name="password"
                placeholder="Masukkan password" value="{{ old('password') }}" required>
              @error('password')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan User</button>
          </div>
        </div>
      </div>
    </form>
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

      // show modal when errors occur
      @if(count($errors) > 0) 
      $(document).ready(function() {
        $('#addUserModal').modal('show');
      });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus User',
          text: "Apakah Anda yakin ingin menghapus user '" + name + "' ini?",
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
    </script>
  @endpush
@endsection
