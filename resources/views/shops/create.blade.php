@extends('layouts.app')

@section('content')

<div class="container">
  <h1>新しい店舗を追加</h1>

  <form action="{{ route('shops.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <label for="shop-name">店舗名</label>
      <input type="text" name="name" id="shop-name" class="form-control">
    </div>

    <div class="form-group">
      <label for="shop-category">カテゴリ</label>
      <select name="category_id" id="shop-category" class="form-control">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">
          {{ $category->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="shop-description">店舗紹介</label>
      <textarea name="description" id="shop-description" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label for="shop-address">住所</label>
      <input type="text" name="address" id="shop-address" class="form-control">
    </div>

    <div class="form-group">
      <label for="shop-phone-number">電話番号</label>
      <input type="text" name="phone_number" id="shop-phone-number" class="form-control">
    </div>

    <div class="form-group">
      <label for="shop-regular-holiday">定休日</label>
      <input type="text" name="regular_holiday" id="shop-regular-holiday" class="form-control">
    </div>

    <div class="form-group">
      <label for="shop-business-hours">営業時間</label>
      <input type="text" name="business_hours" id="shop-business-hours" class="form-control">
    </div>

    <div class="form-group">
      <label for="shop-price-range">価格帯</label>
      <select name="price_range" id="shop-price-range" class="form-control">
        <option value="">選択してください</option>
        <option value="〜3,000円">〜3,000円</option>
        <option value="3,000円〜5,000円">3,000円〜5,000円</option>
        <option value="5,000円〜10,000円">5,000円〜10,000円</option>
        <option value="10,000円〜20,000円">10,000円〜20,000円</option>
        <option value="20,000円〜">20,000円〜</option>
      </select>
    </div>
  

    <button type="submit" class="btn btn-success mt-3">
      店舗を登録
    </button>
  </form>

  <a href="{{ route('shops.index') }}">店舗一覧に戻る</a>

</div>

@endsection
