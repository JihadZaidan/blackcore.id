@extends('admin_layout')

@section('title', 'Edit Kategori')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Edit Kategori</h4>
          </div>
        
          <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="category_name">Nama Kategori</label>
                  <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan nama" data-slug-target="#slug"
                    value="{{ old('category_name', $category->category_name) }}" required>
                  @error('category_name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Masukkan slug"
                    value="{{ old('slug', $category->slug) }}" required>
                  @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                
              </div>
              
            </div>
            <button type="submit" class="btn btn-dark">Update Kategori</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
@endpush
@endsection
