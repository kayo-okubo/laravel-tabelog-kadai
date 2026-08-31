@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h3 class="mt-3 mb-3">新規会員登録</h3>

            <hr>

            <form method="POST" action="{{ route('register') }}">
                @csrf
            
                <div class="form-group row">
                    <label for="name" class="col-md-5 col-form-label text-md-left">
                        氏名
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                        >

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">
                        メールアドレス
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        >

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-5 col-form-label text-md-left">
                        住所
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="address"
                            type="text"
                            class="form-control @error('address') is-invalid @enderror"
                            name="address"
                            value="{{ old('address') }}"
                            required
                            autocomplete="address"
                        >

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone_number" class="col-md-5 col-form-label text-md-left">
                        電話番号
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="phone_number"
                            type="tel"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            required
                            autocomplete="phone_number"
                        >

                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">
                        パスワード
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="new-password"
                        >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-5 col-form-label text-md-left">
                        パスワード（確認）
                        <span class="ml-1 tabelog-require-input-label">
                            <span class="tabelog-require-input-label-text">
                                必須
                            </span>
                        </span>
                    </label>

                    <div class="col-md-7">
                        <input
                            id="password_confirmation"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        >

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="mt-3 btn tabelog-submit-button w-100">
                        アカウント作成
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
