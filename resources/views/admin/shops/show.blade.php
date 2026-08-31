@extends('layouts.app')

@section('content')
    <!-- 店舗の削除用モーダル -->
    <div class="modal fade" id="deleteShopModal" tabindex="-1" aria-labelledby="deleteShopModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteShopModalLabel">
                        「{{ $shop->name }}」を削除してもよろしいですか？
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('admin.shops.destroy', $shop) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            削除
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col container pb-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9">

                <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.shops.index') }}">店舗一覧</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            店舗詳細
                        </li>
                    </ol>
                </nav>

                <h1 class="mb-4 text-center">{{ $shop->name }}</h1>

                <div class="d-flex justify-content-end align-items-end mb-3">
                    <div>
                        <a href="{{ route('admin.shops.edit', $shop) }}" class="me-2">
                            編集
                        </a>

                        <a href="#"
                           class="link-secondary"
                           data-bs-toggle="modal"
                           data-bs-target="#deleteShopModal">
                            削除
                        </a>
                    </div>
                </div>

                @if (session('flash_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('flash_message') }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    @if ($shop->image)
                        <img src="{{ asset('storage/shops/' . $shop->image) }}"
                             class="w-100 img-fluid">
                    @else
                        <div class="text-muted">画像なし</div>
                    @endif
                </div>

                <div class="container mb-4">

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">ID</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->id }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">店舗名</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->name }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">カテゴリ</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->category->name }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">説明</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->description }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">価格帯</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->price_range }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">住所</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->address }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">電話番号</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->phone_number }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">定休日</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->regular_holiday }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">営業時間</span>
                        </div>
                        <div class="col">
                            <span>{{ $shop->business_hours }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection