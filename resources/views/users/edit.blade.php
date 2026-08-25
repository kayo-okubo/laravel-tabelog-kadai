@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <span>
        <a href="{{ route('mypage') }}">マイページ</a> > 会員情報の編集
      </span>

      <h1 class="mt-3 mb-3">会員情報の編集</h1>

      <hr>

      <form method="POST" action="{{ route('mypage.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
          <div class="d-flex justify-content-between">
            <label for="name" class="text-md-left tabelog-edit-user-info-label">
              氏名
            </label>
          </div>

          <input
            id="name"
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name"
            value="{{ $user->name }}"
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

        <br>

        <div class="form-group">
          <div class="d-flex justify-content-between">
            <label for="email" class="text-md-left tabelog-edit-user-info-label">
              メールアドレス
            </label>
          </div>

          <input
            id="email"
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            name="email"
            value="{{ $user->email }}"
            required
            autocomplete="email"
          >

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <br>

        <div class="form-group">
          <div class="d-flex justify-content-between">
            <label for="address" class="text-md-left tabelog-edit-user-info-label">
              住所
            </label>
          </div>

          <input
            id="address"
            type="text"
            class="form-control @error('address') is-invalid @enderror"
            name="address"
            value="{{ $user->address }}"
            required
            autocomplete="street-address"
          >

          @error('address')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <br>

        <div class="form-group">
          <div class="d-flex justify-content-between">
            <label for="phone_number" class="text-md-left tabelog-edit-user-info-label">
              電話番号
            </label>
          </div>

          <input
            id="phone_number"
            type="tel"
            class="form-control @error('phone_number') is-invalid @enderror"
            name="phone_number"
            value="{{ $user->phone_number }}"
            required
            autocomplete="tel"
          >

          @error('phone_number')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <hr>

        <button type="submit" class="btn tabelog-submit-button mt-3 w-25">
          保存
        </button>

      </form>
    </div>
  </div>
</div>

@endsection