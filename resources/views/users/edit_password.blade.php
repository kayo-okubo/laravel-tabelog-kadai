@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-4 mb-5">
  <div style="width: 70%; max-width: 800px;">

    <a href="{{ route('mypage') }}" class="text-decoration-none">
      ← マイページに戻る
    </a>

    <h1 class="mt-3 mb-4">パスワード変更</h1>

    <hr class="mb-4">

    <form method="POST" action="{{ route('mypage.update_password') }}">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="password" class="form-label fw-bold">
          新しいパスワード
        </label>

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

      <div class="mb-4">
        <label for="password-confirm" class="form-label fw-bold">
          確認用
        </label>

        <input
          id="password-confirm"
          type="password"
          class="form-control"
          name="password_confirmation"
          required
          autocomplete="new-password"
        >
      </div>

      <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-danger px-5">
          パスワード更新
        </button>
      </div>

    </form>

  </div>
</div>

@endsection