@extends('layouts.app')

@section('content')

<div class="container">
  <h1>店舗の情報を編集</h1>

  <form action="{{ route('shops.update', $shop->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="shop-name">店舗名</label>
      <input type="text" name="name" id="shop-name" class="form-control" value="{{ $shop->name }}">
    </div>

    <div class="form-group">
      <label for="shop-category">カテゴリ</label>
      <select name="category_id" id="shop-category" class="form-control">
        @foreach ($categories as $category)
        @if ($category->id == $shop->category_id)
        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
        <option value="{{ $category->id }}">{{ $category->name }}</option>          
        @endif
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="shop-description">店舗紹介</label>
      <textarea name="description" id="shop-description" class="form-control">{{ $shop->description }}</textarea>
    </div>

    <div class="form-group">
      <label for="shop-address">住所</label>
      <input type="text" name="address" id="shop-address" class="form-control" value="{{ $shop->address }}">
    </div>

    <div class="form-group">
      <label for="shop-phone-number">電話番号</label>
      <input type="text" name="phone_number" id="shop-phone-number" class="form-control" value="{{ $shop->phone_number }}">
    </div>

    <div class="form-group">
      <label for="shop-regular-holiday">定休日</label>
      <input type="text" name="regular_holiday" id="shop-regular-holiday" class="form-control" value="{{ $shop->regular_holiday }}">
    </div>

    <div class="form-group">
      <label for="shop-business-hours">営業時間</label>
      <input type="text" name="business_hours" id="shop-business-hours" class="form-control" value="{{ $shop->business_hours }}">
    </div>

    <div class="form-group">
      <label for="shop-price-range">価格帯</label>
      <select name="price_range" id="shop-price-range" class="form-control">
        <option value="">選択してください</option>

        @if ($shop->price_range == '〜3,000円')
        <option value="〜3,000円" selected>〜3,000円</option>
        @else
        <option value="〜3,000円">〜3,000円</option>
        @endif

        @if ($shop->price_range == '3,000円〜5,000円')
        <option value="3,000円〜5,000円" selected>3,000円〜5,000円</option>
        @else
        <option value="3,000円〜5,000円">3,000円〜5,000円</option>
        @endif

        @if ($shop->price_range == '5,000円〜10,000円')
        <option value="5,000円〜10,000円" selected>5,000円〜10,000円</option>
        @else
        <option value="5,000円〜10,000円">5,000円〜10,000円</option>
        @endif

        @if ($shop->price_range == '10,000円〜20,000円')
        <option value="10,000円〜20,000円" selected>10,000円〜20,000円</option>
        @else
        <option value="10,000円〜20,000円">10,000円〜20,000円</option>
        @endif

        @if ($shop->price_range == '20,000円〜')
        <option value="20,000円〜" selected>20,000円〜</option>
        @else
        <option value="20,000円〜">20,000円〜</option>
        @endif
        
      </select>
    </div>
  

    <button type="submit" class="btn btn-danger">
      編集内容を更新
    </button>
  </form>

  <a href="{{ route('shops.index') }}">店舗一覧に戻る</a>

</div>

@endsection
