@extends('layouts.app')

@section('content')

@if (session('flash_message'))
<div class="alert alert-success">
  {{ session('flash_message') }}
</div>
@endif

<div class="d-flex justify-content-center">
  <div class="row w-75">

    <div class="col-5 offset-1">
      @if ($shop->image)
          <img src="{{ asset('storage/shops/' . $shop->image) }}"
              class="img-fluid"
              alt="{{ $shop->name }}">
      @else
          <div class="bg-light d-flex align-items-center justify-content-center text-muted"
              style="height: 300px; width: 100%;">
              No Image
          </div>
      @endif
    </div>

    <div class="col">
      <div class="d-flex flex-column">

      <h1>
        {{ $shop->name }}
      </h1>

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

      <p>
        {{ $shop->description }}
      </p>

      <hr>

      <p>
        カテゴリ：{{ $shop->category->name }}
      </p>

      <p>
        住所：{{ $shop->address }}
      </p>

      <p>
        電話番号：{{ $shop->phone_number }}
      </p>

      <p>
        営業時間：{{ $shop->business_hours }}
      </p>

      <p>
        定休日：{{ $shop->regular_holiday }}
      </p>

      <p>
        価格帯：{{ $shop->price_range }}
      </p>

      <hr>
      

    @auth
    @if (Auth::user()->subscribed('premium_plan'))
    <form method="POST" action="{{ route('reservations.store') }}" class="m-3">
      @csrf

      <input type="hidden" name="shop_id" value="{{ $shop->id }}">

      <div class="mb-3">
        <label for="reservation_datetime" class="form-label">
          予約日時
        </label>

          <input
            type="datetime-local"
            id="reservation_datetime"
            name="reservation_datetime"
            class="form-control"
          >
      </div>

      <div class="mb-3">
        <label for="number_of_people" class="form-label">
          予約人数
        </label>

          <input
            type="number"
            id="number_of_people"
            name="number_of_people"
            min="1"
            value="1"
            class="form-control w-25"
          >
      </div>

      <div class="row">
        <div class="col-7">
          <button type="submit" class="btn tabelog-submit-button w-100">
            <i class="fa-solid fa-calendar-days"></i>
            予約する
          </button>
        </div>

        <div class="col-5">
          @if(Auth::user()->favorite_shops()->where('shops.id', $shop->id)->exists())
            <a href="{{ route('favorites.destroy', $shop->id) }}" class="btn tabelog-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
              <i class="fa fa-heart"></i>
            お気に入り解除
            </a>        
          @else
            <a href="{{ route('favorites.store', $shop->id) }}" class="btn tabelog-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
              <i class="fa fa-heart"></i>
            お気に入り
            </a>    
          @endif
        </div>
      </div>

    </form>

    <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $shop->id) }}" method="POST" class="d-none">
      @csrf
      @method('DELETE')
    </form>

    <form id="favorites-store-form" action="{{ route('favorites.store', $shop->id) }}" method="POST" class="d-none">
      @csrf
    </form>

    @else
    <div class="m-3 text-center">
      <p>予約・お気に入り機能は有料会員限定です。</p>
      <a href="{{ route('subscription.create') }}" class="btn btn-dark">
        有料プランに登録する
      </a>
    </div>
    @endif
    @endauth
  </div>
</div>

    <div class="offset-1 col-11">
      <hr class="w-100">
      <h3>レビュー</h3>

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
      
    </div>

    <div class="offset-1 col-10">
      <div class="row">
        @foreach($reviews as $review)
        <div class="col-12 mb-4">

          <h3 class="review-score-color mb-2">
            {{ str_repeat('★', $review->score) }}
          </h3>

          <p class="h4 mb-2">
            {{$review->content}}
          </p>

          <small>
            {{ $review->created_at }} {{ $review->user->name }}
          </small>

          @if (Auth::id() === $review->user_id)
          <div class="mt-2 d-flex gap-2">
            <a href="{{ route('reviews.edit', $review) }}" class="btn btn-sm btn-outline-dark">
              編集
            </a>
            
            <form method="POST" action="{{ route('reviews.destroy', $review) }}">
              @csrf
              @method('DELETE')

              <button type="submit"
                      class="btn btn-sm btn-outline-danger"
                      onclick="return confirm('このレビューを削除しますか？')">
                削除
              </button>
            </form>
          </div>
          @endif
          
          <hr class="mt-3">
        </div>
        @endforeach
      </div><br />

      @auth
      @if (Auth::user()->subscribed('premium_plan'))

      <div class="row">
        <div class="offset-md-5 col-md-5">
          <form method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <h4>評価</h4>
            <select name="score" class="form-control m-2 review-score-color">
              <option value="5" class="review-score-color">★★★★★</option>
              <option value="4" class="review-score-color">★★★★</option>
              <option value="3" class="review-score-color">★★★</option>
              <option value="2" class="review-score-color">★★</option>
              <option value="1" class="review-score-color">★</option>
            </select>
            <h4>レビュー内容</h4>
            @error('content')
              <strong>{{ $message }}</strong>
            @enderror
            <textarea name="content" class="form-control m-2"></textarea>
            <input type="hidden" name="shop_id" value="{{$shop->id}}">
            <button type="submit" class="btn tabelog-submit-button ml-2">レビューを追加</button>
          </form>
        </div>
      </div>

      @else
      <div class="text-center mb-4">
        <p>レビュー投稿は有料会員限定です。</p>
        <a href="{{ route('subscription.create') }}" class="btn btn-dark">
          有料プランに登録する
        </a>
      </div>
      @endif
      @endauth
    </div>

  </div>
</div>

@endsection

