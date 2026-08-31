@extends('layouts.app')

@section('content')
<div class="col container pb-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9">

            <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.shops.index') }}">店舗一覧</a>
                    </li>
                    <li class="breadcrumb-item active">店舗編集</li>
                </ol>
            </nav>

            <h1 class="mb-4 text-center">店舗編集</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.shops.update', $shop) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">店舗名</label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control"
                           value="{{ old('name', $shop->name) }}">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">カテゴリ</label>
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id', $shop->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">店舗画像</label>

                    @if ($shop->image)
                    <div class="mb-2">
                        <p class="mb-1">現在の画像</p>
                        <img src="{{ asset('storage/shops/' . $shop->image) }}"
                            class="img-fluid"
                            style="max-width: 300px;">
                    </div>
                    @endif
                    <input type="file"
                           name="image"
                           id="image"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">説明</label>
                    <textarea name="description"
                              id="description"
                              class="form-control"
                              rows="5">{{ old('description', $shop->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">住所</label>
                    <input type="text"
                           name="address"
                           id="address"
                           class="form-control"
                           value="{{ old('address', $shop->address) }}">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label fw-bold">電話番号</label>
                    <input type="text"
                           name="phone_number"
                           id="phone_number"
                           class="form-control"
                           value="{{ old('phone_number', $shop->phone_number) }}">
                </div>

                <div class="mb-3">
                    <label for="regular_holiday" class="form-label fw-bold">定休日</label>
                    <input type="text"
                           name="regular_holiday"
                           id="regular_holiday"
                           class="form-control"
                           value="{{ old('regular_holiday', $shop->regular_holiday) }}">
                </div>

                <div class="mb-3">
                    <label for="business_hours" class="form-label fw-bold">営業時間</label>
                    <input type="text"
                           name="business_hours"
                           id="business_hours"
                           class="form-control"
                           value="{{ old('business_hours', $shop->business_hours) }}">
                </div>

                <div class="mb-3">
                    <label for="price_range" class="form-label fw-bold">価格帯</label>
                    <select name="price_range" id="price_range" class="form-select">
                        <option value="">選択してください</option>

                        @foreach ([
                            '〜3,000円',
                            '3,000円〜5,000円',
                            '5,000円〜10,000円',
                            '10,000円〜20,000円',
                            '20,000円〜'
                        ] as $price)
                            <option value="{{ $price }}"
                                @selected(old('price_range', $shop->price_range) == $price)>
                                {{ $price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-center mb-5">
                    <button type="submit" class="btn btn-dark w-50">
                        更新
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection