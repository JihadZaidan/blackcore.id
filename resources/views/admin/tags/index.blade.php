@extends('admin_layout')

@section('title', 'tags')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">Tag</h4>
              <p class="card-description mb-0">
                Data tag yang telah ditambahkan
              </p>
            </div>
            <button class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#addTagModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah Tag
            </button>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search tag" aria-label="Search tag">
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
                  <th>Nama Tag</th>
                  <th>Slug</th>
                  <th>Created at</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tags as $row)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->tag_name }}</td>
                    <td>{{ $row->slug }}</td>
                    <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>                      
                      <a href="{{ route('admin.tags.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ $row->id }}', '{{ $row->tag_name }}')">Hapus</button>
                      <form id="delete-form-{{ $row->id }}"
                        action="{{ route('admin.tags.destroy', $row->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                    </td>
                  </tr>
                @endforeach

                @if ($tags->total() == 0)
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $tags->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.tags.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addTagModalLabel">Tambah Tag Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="tag_name">Nama Tag</label>
              <input type="text" class="form-control" id="tag_name" name="tag_name" data-slug-target="#slug"
                placeholder="Masukkan nama kategory" value="{{ old('tag_name') }}" required>
              @error('tag_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug"
                placeholder="Ketik nama tag untuk generate slug otomatis" value="{{ old('slug') }}" required>
              @error('slug')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan Tag</button>
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
          $('#addTagModal').modal('show');
        });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus Tag',
          text: "Apakah Anda yakin ingin menghapus tag '" + name + "' ini?",
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
