@extends('admin_layout')

@section('title', 'Tambah Artikel')

@push('styles')
  <style>
    .ms-options-wrap button {
      display: block;
      padding: .4375rem .75rem !important;
      border: 0 !important;
      outline: 1px solid #CED4DA !important;
      width: 100%;
      height: 2.875rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      outline-offset: 0px !important;
    }

    .ms-options-wrap button:focus {
      position: relative;
      display: block;
      width: 100%;
      height: 2.875rem;
      padding: .4375rem .75rem !important;
      border: 0;
      outline: 1px solid #CED4DA;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      outline-offset: 0px !important;
    }

    .btn-inside {
      border: 1px solid #CED4DA;
      border-radius: 4px !important;
      margin-left: 2px;
      flex-shrink: 0;
    }

    .ms-options-wrap {
      flex-grow: 1;
    }
  </style>
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Tambah Artikel</h4>
          </div>

          <form method="POST" id="tambahArtikelForm" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="title">Judul Artikel</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul"
                    data-slug-target="#slug-article" value="{{ old('title') }}" required>
                  @error('title')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug-article" name="slug"
                    placeholder="Ketik judul artikel untuk generate slug otomatis" value="{{ old('slug') }}" required>
                  @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="category_id">Kategori</label>
                  <div class="d-flex">
                    <select type="text" class="form-control" id="category_id" name="category_id"
                      placeholder="Pilih kategori" value="{{ old('category_id') }}" required>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-light btn-sm btn-inside" data-toggle="modal"
                      data-target="#addKategoriModal">
                      <i class="icon-plus"></i>
                    </button>
                    <button type="button" class="btn btn-light btn-sm btn-inside" onclick="refreshKategori()">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" style="height: 16px;width:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                      </svg>
                    </button>
                  </div>
                  @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="tags">Tags</label>
                  <div class="d-flex">
                    <select type="text" class="form-control" id="tags" name="tags[]" multiple
                      placeholder="Pilih kategori" value="{{ old('tags') }}" required>
                      @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                      @endforeach
                    </select>
                    <button type="button" class="btn btn-light btn-sm btn-inside" data-toggle="modal"
                      data-target="#addTagModal">
                      <i class="icon-plus"></i>
                    </button>
                    <button type="button" class="btn btn-light btn-sm btn-inside" onclick="refreshTag()">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" style="height: 16px;width:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                      </svg>

                    </button>
                  </div>
                  @error('tags')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
            </div>
            <label for="content">Isi Konten</label>
            <textarea id="tinyeditor" name="content" class="mb-4" class="min-height: 500px">{{ old('content') }}</textarea>
            @error('content')
              <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group mt-4">
              <label for="foto">Cover Image</label>
              <div class="input-group">
                <input type="file" class="form-control bg-white" id="uploadCover" name="cover_image"
                  placeholder="Image path" accept="image/*">
              </div>

              <div class="mt-3">
                <img id="uploadCoverPreview" src="" alt="Product Image Preview"
                  style="max-width: 70%; display: none;margin: 0 auto;">
              </div>
              @error('cover_image')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <button type="button" onclick="tinymce_submit()" class="btn btn-dark">Simpan Artikel</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- tambah kategori modal -->
  <div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog" aria-labelledby="addKategoriModalLabel"
    aria-hidden="true">
    <form id="addKategoriForm" enctype="multipart/form-data">
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
              <input type="text" class="form-control" id="category_name" name="category_name"
                data-slug-target="#slug-kategori" placeholder="Masukkan nama kategory"
                value="{{ old('category_name') }}" required>
              @error('category_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug-kategori" name="slug"
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

  <!-- Modal add tag -->
  <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
    aria-hidden="true">
    <form id="addTagForm" method="POST" enctype="multipart/form-data">
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
              <input type="text" class="form-control" id="tag_name" name="tag_name" data-slug-target="#slug-tag"
                placeholder="Masukkan nama kategory" value="{{ old('tag_name') }}" required>
              @error('tag_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug-tag" name="slug"
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
      $('select[multiple]').multiselect({
        search: true,
        texts: {
          placeholder: 'Select States',
          search: 'Search States'
        }
      });

      const config = {
        onUploadProgress: function(progressEvent) {
          var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)

        }
      }

      tinymce.init({
        selector: '#tinyeditor',
        min_height: 300,
        menubar: false,
        content_style: 'img {max-width: 100%;}',
        plugins: 'code table lists image autoresize codesample',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright | indent outdent | bullist numlist | blockquote codesample image | table | code',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        images_upload_url: "{{ route('upload_image') }}",
        images_upload_handler: (blobInfo, progress) => {
          return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            axios.post('/upload-image', formData, {
                onUploadProgress: (e) => {
                  progress(e.loaded / e.total * 100); 
                }
              })
              .then((response) => {
                if (response.status !== 200) {
                  reject('HTTP Error: ' + response.status);
                  return;
                }
                const json = response.data;
                if (!json || typeof json.location !== 'string') {
                  reject('Invalid JSON: ' + JSON.stringify(response.data));
                  return;
                }
                resolve(json.location); 
              })
              .catch((error) => {
                reject('Image upload failed. Error: ' + error.message);
              });
          });
        },
        file_picker_types: 'image',
        relative_urls: false,
      });

      // add kategori
      document.getElementById('addKategoriForm').addEventListener('submit', function(e) {
        e.preventDefault(); 

        const form = e.target;
        const formData = new FormData(form);

        Swal.fire({
          title: 'Menambah kategori...',
        });
        Swal.showLoading();
        axios.post('{{ route('admin.categories.store') }}', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .then(function(response) {
            // Sukses
            refreshKategori();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Berhasil menambah kategori',
            });
            $('#addKategoriModal').modal('hide');
          })
          .catch(function(error) {
            // Gagal
            console.error(error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Gagal menambah kategori',
            })
          });
      });

      // get kategori
      function refreshKategori() {
        const url = '{{ route('admin.categories.index') }}';
        const select_kategori = document.getElementById('category_id');
        const axiosconfig = {
          headers: {
            'Accept': 'application/json',
            'X-Request-With': 'XMLHttpRequest'
          }
        }

        axios.get(url, axiosconfig)
          .then(function(response) {
            // handle success
            const categories = response.data;
            select_kategori.innerHTML = '';
            categories.forEach(category => {
              const option = document.createElement('option');
              option.value = category.id;
              option.text = category.category_name;
              select_kategori.appendChild(option);
            });
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })
      }

      document.getElementById('addTagForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        Swal.fire({
          title: 'Menambah kategori...',
        });
        Swal.showLoading();
        axios.post('{{ route('admin.tags.store') }}', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .then(function(response) {
            refreshTag();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Berhasil menambah tag',
            });
            $('#addTagModal').modal('hide');
          })
          .catch(function(error) {
            console.error(error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Gagal menambah tag',
            })
          });
      });

      function refreshTag() {
        const url = '{{ route('admin.tags.index') }}';
        const select_tag = document.getElementById('tags');
   
        const axiosconfig = {
          headers: {
            'Accept': 'application/json',
            'X-Request-With': 'XMLHttpRequest'
          }
        }

        axios.get(url, axiosconfig)
          .then(function(response) {
            const categories = response.data;
            const selectedValues = Array.from(select_tag.selectedOptions).filter(option => option.selected)
              .map(option => option.value);
            
            select_tag.innerHTML = '';
            categories.forEach(category => {
              const option = document.createElement('option');
              option.value = category.id;
              option.text = category.tag_name;
              if (selectedValues.includes(option.value)) {
                option.selected = true;
              }
              select_tag.appendChild(option);
            });

            select_tag.classList.remove('jqmsLoaded');

            $('select[multiple]').multiselect('reload');
          })
          .catch(function(error) {
            console.log(error);
          })
      }

      document.getElementById('uploadCover').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('uploadCoverPreview');

        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
        } else {
          preview.src = '';
          preview.style.display = 'none';
        }
      });

      function tinymce_submit() {
        let form = document.getElementById('tambahArtikelForm');
        tinymce.activeEditor.uploadImages().then(() => {
          form.submit();
        });
      }
    </script>
  @endpush
@endsection
