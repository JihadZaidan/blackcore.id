@extends('admin_layout')

@section('title', 'categories')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">Kategori</h4>
              <p class="card-description mb-0">
                Data kategori yang telah ditambahkan
              </p>
            </div>
            <button class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#addKategoriModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah Kategori
            </button>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search kategori" aria-label="Search kategori">
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
                  <th>Slug</th>
                  <th>Created at</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $row)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->category_name }}</td>
                    <td>{{ $row->slug }}</td>
                    <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>                      
                      <a href="{{ route('admin.categories.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ $row->id }}', '{{ $row->category_name }}')">Hapus</button>
                      <form id="delete-form-{{ $row->id }}"
                        action="{{ route('admin.categories.destroy', $row->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                @endforeach

                @if ($categories->total() == 0)
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $categories->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addKategoriModalLabel">Tambah Kategori Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="category_name">Nama Kategori</label>
              <input type="text" class="form-control" id="category_name" name="category_name" data-slug-target="#slug"
                placeholder="Masukkan nama kategory" value="{{ old('category_name') }}" required>
              @error('category_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug"
                placeholder="Ketik nama kategori untuk generate slug otomatis" value="{{ old('slug') }}" required>
              @error('slug')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan Kategori</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // auto generate slug

      });

      // show modal when errors occur
      @if (count($errors) > 0)
        $(document).ready(function() {
          $('#addKategoriModal').modal('show');
        });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus Kategori',
          text: "Apakah Anda yakin ingin menghapus kategori '" + name + "' ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Menghapus...'
            });
            Swal.showLoading();
            $('#delete-form-' + id).submit();
          }
        })
      }

    </script>
  @endpush
@endsection
