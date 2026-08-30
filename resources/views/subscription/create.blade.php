@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endpush

@section('content')
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">有料プラン登録</li>
                    </ol>
                </nav>

                <h1 class="mb-3 text-center">有料プラン登録</h1>

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header text-center">
                        有料プランの内容
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">・店舗を予約できます</li>
                        <li class="list-group-item">・店舗をお気に入りに追加できます</li>
                        <li class="list-group-item">・レビューを投稿・編集・削除できます</li>
                        <li class="list-group-item">・月額300円</li>
                    </ul>
                </div>

                <hr class="mb-4">

                <div class="alert alert-danger d-none" id="card-error" role="alert">
                    <ul class="mb-0" id="error-list"></ul>
                </div>

                <form id="card-form" action="{{ route('subscription.store') }}" method="post">
                    @csrf
                    <input class="form-control mb-3"
                        id="card-holder-name"
                        type="text"
                        placeholder="カード名義人"
                        required>
                    <div class="form-control mb-4 py-3" id="card-element"></div>

                </form>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-dark shadow-sm w-50"
                        id="card-button" 
                        data-secret="{{ $intent->client_secret }}">
                        登録
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection