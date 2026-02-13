@extends('admin.layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 style="font-size: 22px; font-weight: 700; color: #1a1d29; margin-bottom: 4px;">Dashboard</h2>
        <p class="text-muted mb-0" style="font-size: 13px;">Welcome back, {{ Auth::user()->name ?? 'Admin' }}! Here's an overview of your content.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #eb0a1e 0%, #eb0a1e 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Products</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Product::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                            <i class="bi bi-check-circle me-1"></i>{{ \App\Models\Product::where('is_active', true)->count() }} active
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-box-seam" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.1); padding: 10px 20px;">
                <a href="{{ route('admin.products.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View all products <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #eb0a1e 0%, #eb0a1e 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Categories</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Category::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                            <i class="bi bi-folder me-1"></i>Product categories
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-tags" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.1); padding: 10px 20px;">
                <a href="{{ route('admin.categories.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View all categories <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0" style="background: linear-gradient(135deg, #1a1d29 0%, #252a3a 100%); color: white;">
            <div class="card-body" style="padding: 20px;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-uppercase mb-1" style="font-size: 11px; font-weight: 600; opacity: 0.85; letter-spacing: 0.5px;">Total Articles</p>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">{{ \App\Models\Article::count() }}</h3>
                        <small style="opacity: 0.75; font-size: 12px;">
                            <i class="bi bi-check-circle me-1"></i>{{ \App\Models\Article::where('is_published', true)->count() }} published
                        </small>
                    </div>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 12px; padding: 12px;">
                        <i class="bi bi-newspaper" style="font-size: 24px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0" style="background: rgba(0,0,0,0.15); padding: 10px 20px;">
                <a href="{{ route('admin.articles.index') }}" class="text-white text-decoration-none" style="font-size: 12px; font-weight: 500;">
                    View all articles <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card border-0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0" style="font-size: 15px; font-weight: 600;">
                    <i class="bi bi-box-seam me-2" style="color: #eb0a1e;"></i>Recent Products
                </h5>
                <a href="{{ route('admin.products.index') }}" style="font-size: 12px; color: #eb0a1e; text-decoration: none;">View all</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse(\App\Models\Product::latest()->take(5)->get() as $product)
                        <a href="{{ route('admin.products.show', $product) }}" 
                           class="list-group-item list-group-item-action border-0" style="padding: 12px 18px; font-size: 13px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded" 
                                             style="width: 36px; height: 36px; object-fit: cover; margin-right: 10px;">
                                    @else
                                        <div class="rounded d-flex align-items-center justify-content-center" 
                                             style="width: 36px; height: 36px; margin-right: 10px; background: #f5f5f5;">
                                            <i class="bi bi-image text-muted" style="font-size: 14px;"></i>
                                        </div>
                                    @endif
                                    <span style="font-weight: 500;">{{ $product->name }}</span>
                                </div>
                                <small class="text-muted" style="font-size: 11px;">{{ $product->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item text-muted text-center border-0" style="padding: 30px; font-size: 13px;">
                            <i class="bi bi-inbox" style="font-size: 24px; display: block; margin-bottom: 6px;"></i>
                            No products yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0" style="font-size: 15px; font-weight: 600;">
                    <i class="bi bi-newspaper me-2" style="color: #eb0a1e;"></i>Recent Articles
                </h5>
                <a href="{{ route('admin.articles.index') }}" style="font-size: 12px; color: #eb0a1e; text-decoration: none;">View all</a>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse(\App\Models\Article::latest()->take(5)->get() as $article)
                        <a href="{{ route('admin.articles.show', $article) }}" 
                           class="list-group-item list-group-item-action border-0" style="padding: 12px 18px; font-size: 13px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="font-weight: 500;">{{ $article->title }}</span>
                                <div class="d-flex align-items-center gap-2">
                                    @if($article->is_published)
                                        <span class="badge" style="background: #E8F5E9; color: #2E7D32; font-size: 10px;">Published</span>
                                    @else
                                        <span class="badge bg-secondary" style="font-size: 10px;">Draft</span>
                                    @endif
                                    <small class="text-muted" style="font-size: 11px;">{{ $article->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="list-group-item text-muted text-center border-0" style="padding: 30px; font-size: 13px;">
                            <i class="bi bi-inbox" style="font-size: 24px; display: block; margin-bottom: 6px;"></i>
                            No articles yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
