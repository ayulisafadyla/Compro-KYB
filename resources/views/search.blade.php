@extends('layouts.app')

@section('content')

<style>
    .list-group-item {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .list-group-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        background-color: #fff;
        z-index: 1;
    }
</style>

<div class="container py-5" style="min-height: 60vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 fw-bold">Hasil Pencarian</h1>

            <form action="/search" method="GET" class="mb-5">
                <div class="input-group">
                    <input type="text" name="q" class="form-control form-control-lg" placeholder="Cari lagi..." value="{{ $query ?? '' }}">
                    <button class="btn btn-danger" type="submit">Cari</button>
                </div>
            </form>

            @if(isset($query) && $query != '')
                <p class="mb-4">Menampilkan hasil untuk: <strong>"{{ $query }}"</strong></p>

                @if(count($results) > 0)
                    <div class="list-group">
                        @foreach($results as $result)
                            <a href="{{ $result['url'] }}" class="list-group-item list-group-item-action p-4 border-0 shadow-sm mb-3 rounded">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 fw-bold text-danger">{{ $result['title'] }}</h5>
                                </div>
                                <p class="mb-1">{{ $result['content'] }}</p>
                                <small class="text-muted">{{ url($result['url']) }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light text-center py-5 border" role="alert">
                        <i class="bi bi-search display-1 text-muted mb-3 d-block"></i>
                        <h4 class="alert-heading">Tidak ada hasil ditemukan</h4>
                        <p>Maaf, kami tidak dapat menemukan apa yang Anda cari dengan kata kunci "<strong>{{ $query }}</strong>".</p>
                        <hr>
                        <p class="mb-0">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
                    </div>
                @endif
            @else
                <div class="alert alert-info" role="alert">
                    Silakan masukkan kata kunci untuk mencari.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
