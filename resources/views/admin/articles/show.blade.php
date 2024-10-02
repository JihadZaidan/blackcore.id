@extends('admin_layout')

@section('title', 'Tambah Artikel')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-icon d-flex align-items-center justify-content-center">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Detail Artikel</h4>
          </div>

          <div class="row px-3">
            <div class="col-12 col-md-8">
              <div class="form-group">
                <h5 class="text-muted">Cover Gambar</h5>
                <div>
                  @if ($article->cover_image)
                    <img src="{{ asset('storage/' . $article->cover_image) }}" class="w-100 h-auto rounded"
                      alt="Cover Image Preview" style="object-fit:cover">
                  @else
                    <p class="mt-2">Tidak ada gambar</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="row px-3">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <h5 class="text-muted">Judul</h5>
                <div>{{ $article->title }}</div>
              </div>
              <div class="form-group">
                <h5 class="text-muted">Slug</h5>
                <div>{{ $article->slug }}</div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="form-group">
                <h5 class="text-muted">Kategori</h5>
                <div>{{ $article->category->category_name }}</div>
              </div>
              <div class="form-group">
                <h5 class="text-muted">Tags</h5>
                <div class="d-flex flex-wrap-1" style="gap: 2px">
                  @foreach ($article->tags as $tag)
                    <span class="badge badge-info">#{{ $tag->tag_name }}</span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="row px-3">
            <div class="col-12">
              <h5 class="text-muted">Isi</h5>
              <div class="rounded-lg border p-4">
                {!! $article->content !!}
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
