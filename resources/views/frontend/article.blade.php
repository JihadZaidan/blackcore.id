@extends('frontend.frontend_layout')

@section('title', $article->title ?? 'Article')

@section('content')
  <div class="row">
    <div class="col-12 col-lg-8 mx-auto">
      <div class="container mt-5 pt-3">
        <article class="my-4">
          <!-- Post content-->
          <article>
            <!-- Post header-->
            <header class="mb-4">
              <!-- Post title-->
              <h1 class="fw-bold mb-1" style="font-size: 50px; font-weight: 500">{{ $article->title }}</h1>
              <!-- Post meta content-->
              <div class="text-muted fst-italic mb-2">Posted on {{ $article->created_at->format('d F Y') }} by Admin </div>
              <!-- Post tags-->
              <a class="badge bg-primary text-light text-decoration-none" href="#!">{{ $article->category->category_name }}</a>
            </header>
            <!-- Preview image figure-->
            <figure class="mb-4"><img class="img-fluid rounded mb-4" src="{{ asset('storage/' . $article->cover_image) }}"
                alt="{{ $article->title }}" /></figure>
            <!-- Post content-->
            <section class="mb-5 prose">
              {!! $article->content !!}
            </section>
          </article>
          <div>Tags : </div>
          @foreach ($article->tags as $tag)
              <a class="badge bg-secondary text-light text-decoration-none" href="#!">#{{ $tag->tag_name }}</a>
          @endforeach
    
      </div>
    </div>
  </div>

@endsection
