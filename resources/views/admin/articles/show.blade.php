@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Article Detail</h2>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    @if($article->image)
        <img src="{{ asset('storage/' . $article->image) }}" 
             alt="{{ $article->title }}" 
             class="card-img-top"
             style="max-height: 400px; object-fit: cover;">
    @endif
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h3 class="card-title">{{ $article->title }}</h3>
                <p class="text-muted">
                    @if($article->is_published)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-secondary">Draft</span>
                    @endif
                    <span class="ms-2">
                        <i class="bi bi-calendar"></i> 
                        {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : 'Not published' }}
                    </span>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <hr>

        <div class="content">
            {!! nl2br(e($article->content)) !!}
        </div>

        <hr class="mt-4">

        <div class="text-muted small">
            <p class="mb-1"><strong>Slug:</strong> <code>{{ $article->slug }}</code></p>
            <p class="mb-1"><strong>Created:</strong> {{ $article->created_at->format('d M Y, H:i') }}</p>
            <p class="mb-0"><strong>Last Updated:</strong> {{ $article->updated_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>
@endsection
