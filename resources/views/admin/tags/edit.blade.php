@extends('admin_layout')

@section('title', 'Edit Tag')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-center gap-2">
            <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-icon-text">
              <i class="icon-arrow-left menu-icon"></i>
            </a>
            <h4 class=" m-0">Edit Tag</h4>
          </div>
        
          <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
              {{-- Kiri --}}
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="tag_name">Nama Tag</label>
                  <input type="text" class="form-control" id="tag_name" name="tag_name" placeholder="Masukkan nama" data-slug-target="#slug"
                    value="{{ old('tag_name', $tag->tag_name) }}" required>
                  @error('tag_name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Masukkan slug"
                    value="{{ old('slug', $tag->slug) }}" required>
                  @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                
              </div>
              
            </div>
            <button type="submit" class="btn btn-dark">Update Tag</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
@endpush
@endsection
