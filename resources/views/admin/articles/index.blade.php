@extends('admin_layout')

@section('title', 'articles')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">Informasi</h4>
              <p class="card-description mb-0">
                Data informasi yang telah ditambahkan
              </p>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-dark btn-icon-text">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah Informasi
            </a>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search artikel" aria-label="Search artikel">
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
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>Tags</th>
                  <th>Publikasi</th>
                  <th>Created at</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $row)
                  <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $row->title }}</td>
                    <td>{{ $row->category->category_name }}</td>
                    <td>
                      <div class="d-flex hide-scrollbar scroll-shadow" style="gap: 2px">
                        @foreach ($row->tags as $tag)
                          <span class="badge badge-info">#{{ $tag->tag_name }}</span>
                        @endforeach
                      </div>
                    </td>
                    <td>
                      @if ($row->is_published)
                        <div class="d-flex  align-items-center" style="gap: 4px">
                          <div class="d-flex text-success gap-1 align-items-center">
                            <i class="ti-check  mr-1"></i>
                            Ya
                          </div>
                        </div>
                      @else
                      <div class="d-flex  align-items-center gap-2" style="gap: 4px">
                        <div class="d-flex text-danger gap-1 align-items-center">
                          <i class="ti-close mr-1"></i>
                          Tidak
                        </div>
                      </div>
                      @endif

                    </td>
                    <td>{{ $row->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>
                      <a href="{{ route('admin.articles.show', $row->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                      <a href="{{ route('admin.articles.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <button class="btn btn-sm btn-danger"
                        onclick="confirmDelete('{{ $row->id }}', '{{ $row->title }}')">Hapus</button>
                      <form id="delete-form-{{ $row->id }}"
                        action="{{ route('admin.articles.destroy', $row->id) }}" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>
                      @if ($row->is_published)
                          <button class="btn btn-sm btn-warning"
                            onclick="confirmUnpublish('{{ $row->id }}', '{{ $row->title }}')">Batal Publikasi</button>
                          <form id="unpublish-form-{{ $row->id }}"
                            action="{{ route('admin.articles.unpublish', $row->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                          </form>
                      @else
                        <button class="btn btn-sm btn-success" 
                          onclick="confirmPublish('{{ $row->id }}', '{{ $row->title }}')">Publikasikan</button>
                        <form id="publish-form-{{ $row->id }}"
                          action="{{ route('admin.articles.publish', $row->id) }}" method="POST"
                          style="display: none;">
                          @csrf
                        </form>
                      @endif
                    </td>
                  </tr>
                @endforeach

                @if ($articles->total() == 0)
                  <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                  </tr>
                @endif

              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{ $articles->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addArtikelModal" tabindex="-1" role="dialog" aria-labelledby="addArtikelModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addArtikelModalLabel">Tambah Artikel Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="title">Judul Artikel</label>
              <input type="text" class="form-control" id="title" name="title" data-slug-target="#slug"
                placeholder="Masukkan judul" value="{{ old('title') }}" required>
              @error('title')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug"
                placeholder="Ketik judul untuk generate slug otomatis" value="{{ old('slug') }}" required>
              @error('slug')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan Artikel</button>
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
          $('#addArtikelModal').modal('show');
        });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus Artikel',
          text: "Apakah Anda yakin ingin menghapus artikel '" + name + "' ini?",
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

      function confirmPublish(id, name) {
        Swal.fire({
          title: 'Publikasikan?',
          text: "Apakah Anda yakin ingin mempublikasikan artikel '" + name + "' ini? Artikel akan ditampilkan di halaman depan",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, publikasikan!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Mempublikasikan...'
            });
            Swal.showLoading();
            $('#publish-form-' + id).submit();
          }
        })
      }

      function confirmUnpublish(id, name) {
        Swal.fire({
          title: 'Batalkan Publikasi?',
          text: "Apakah Anda yakin ingin membatalkan publikasi '" + name + "' ini? Artikel tidak akan ditampilkan di halaman depan",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, batalkan publikasi!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Mambatalkan publikasi...'
            });
            Swal.showLoading();
            $('#unpublish-form-' + id).submit();
          }
        })
      }
    </script>
  @endpush
@endsection
