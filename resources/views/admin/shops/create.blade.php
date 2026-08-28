@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('/js/preview.js') }}"></script>
@endpush

@section('content')
<div class="col container pb-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9">

            <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.shops.index') }}">店舗一覧</a>
                    </li>
                    <li class="breadcrumb-item active">店舗登録</li>
                </ol>
            </nav>

            <h1 class="mb-4 text-center">店舗登録</h1>

            <hr class="mb-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.shops.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">店舗名</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">カテゴリ</label>

                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">選択してください</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">店舗画像</label>
                    <input type="file"
                           class="form-control"
                           id="image"
                           name="image">
                </div>

                <div class="row" id="imagePreview"></div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">説明</label>
                    <textarea class="form-control"
                              id="description"
                              name="description"
                              rows="5">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">住所</label>
                    <input type="text"
                           class="form-control"
                           id="address"
                           name="address"
                           value="{{ old('address') }}">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label fw-bold">電話番号</label>
                    <input type="text"
                           class="form-control"
                           id="phone_number"
                           name="phone_number"
                           value="{{ old('phone_number') }}">
                </div>

                <div class="mb-3">
                    <label for="regular_holiday" class="form-label fw-bold">定休日</label>
                    <input type="text"
                           class="form-control"
                           id="regular_holiday"
                           name="regular_holiday"
                           value="{{ old('regular_holiday') }}">
                </div>

                <div class="mb-3">
                    <label for="business_hours" class="form-label fw-bold">営業時間</label>
                    <input type="text"
                           class="form-control"
                           id="business_hours"
                           name="business_hours"
                           value="{{ old('business_hours') }}">
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
                                @selected(old('price_range') == $price)>
                                {{ $price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-center mb-5">
                    <button type="submit" class="btn btn-dark w-50">
                        登録
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection