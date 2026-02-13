@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Edit Article</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $article->title) }}"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" 
                          name="content" 
                          rows="15" 
                          required>{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Featured Image</label>
                        @if($article->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->image) }}" 
                                     alt="{{ $article->title }}" 
                                     class="img-thumbnail"
                                     style="max-width: 200px;">
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image"
                               accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB (JPEG, PNG, JPG, GIF)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Visibility</label>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_published" 
                                   name="is_published" 
                                   value="1"
                                   {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                Publish
                            </label>
                        </div>
                        @if($article->published_at)
                            <small class="text-muted">Published on: {{ $article->published_at->format('d M Y, H:i') }}</small>
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-check-circle"></i> Update Article
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
