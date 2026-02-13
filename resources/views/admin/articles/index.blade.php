@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2>Articles</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add Article
        </a>
    </div>
</div>

<!-- Search & Filter -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.articles.index') }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search articles..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>{{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}</td>
                        <td>{{ $article->title }}</td>
                        <td>
                            @if($article->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No articles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
