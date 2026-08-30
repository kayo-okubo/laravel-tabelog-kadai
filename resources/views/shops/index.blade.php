@extends('layouts.app')

@section('content')

@if (session('flash_message'))
<div class="alert alert-success">
  {{ session('flash_message') }}
</div>
@endif

<div class="container mt-4">
  <div class="row">

  {{-- サイドバー --}}
  <div class="col-3">
    @component('components.sidebar', ['categories' => $categories])
    @endcomponent
  </div>

  {{-- 店舗一覧 --}}
  <div class="col-9">

    <div class="container">
      @if ($category !== null)
        <a href="{{ route('shops.index') }}">トップ</a> >
          {{ $category->name }}
          <h1>{{ $category->name }}の店舗一覧{{$total_count}}件</h1>
      @elseif ($keyword !== null)
        <a href="{{ route('shops.index') }}">トップ</a> > 店舗一覧
        <h1>"{{ $keyword }}"の検索結果{{ $total_count }}件</h1>
      @endif
    </div>

    <form method="GET" action="{{ route('shops.index') }}" class="mb-3">
      <div class="input-group">
        <input
          type="text"
          name="keyword"
          class="form-control"
          placeholder="店舗名で検索"
          value="{{ request('keyword') }}"
        >
        <button type="submit" class="btn btn-dark">
          検索
        </button>
      </div>
    </form>

    <div class="mb-3">
      並び替え
      @sortablelink('created_at', '登録日')
    </div>

    <div class="row">

  @foreach ($shops as $shop)

  <div class="col-4 mb-4">
    <div class="card h-100">

      <a href="{{ route('shops.show', $shop) }}">
        @if ($shop->image)
        <img src="{{ asset('storage/shops/' . $shop->image) }}"
          class="card-img-top"
          style="height: 220px; object-fit: cover;"
          alt="{{ $shop->name }}">
        @else
        <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-muted"
        style="height: 220px;">
          No Image
        </div>
        @endif
      </a>

      <div class="card-body">

        <h5 class="card-title">
          {{ $shop->name }}
        </h5>

        <p class="card-text">
          {{ $shop->category->name }}<br>
          @if ($shop->reviews()->exists())
          @php
            $averageScore = round($shop->reviews->avg('score'), 1);
          @endphp

          <div class="d-flex align-items-center gap-2 mb-3">
              <span class="tabelog-star-rating"
                    data-rate="{{ round($averageScore * 2) / 2 }}">
              </span>
              <span>{{ $averageScore }}</span>
          </div>
          @endif
          {{ $shop->price_range }}
        </p>

        <a href="{{ route('shops.show', $shop) }}"
          class="btn btn-primary">
          詳細を見る
        </a>
        
      </div>
    </div>
  </div>
  @endforeach
  </div>
</div>
</div>

  <div class="d-flex justify-content-center mt-4 mb-5">
    {{ $shops->appends(request()->query())->links() }}
  </div>
</div>

@endsection