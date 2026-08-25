@extends('layouts.app')

@section('content')
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

    <div class="mb-3">
      並び替え
      @sortablelink('created_at', '登録日')
    </div>

    <div class="row">

  @foreach ($shops as $shop)

  <div class="col-4 mb-4">
    <div class="card h-100">

      <a href="{{ route('shops.show', $shop) }}">
        <img src="{{ asset('img/dummy.png') }}"
          class="card-img-top"
          alt="{{ $shop->name }}">
      </a>

      <div class="card-body">

        <h5 class="card-title">
          {{ $shop->name }}
        </h5>

        <p class="card-text">
          {{ $shop->category->name }}<br>

          @if ($shop->reviews()->exists())
            <span
              class="tabelog-star-rating"
              data-rate="{{ round($shop->reviews->avg('score') * 2) / 2 }}">
            </span>

            {{ round($shop->reviews->avg('score'), 1) }}<br>
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

  <div class="d-flex justify-content-center">
    {{ $shops->appends(request()->query())->links() }}
  </div>

</div>

@endsection