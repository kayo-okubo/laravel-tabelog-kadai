@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-4 mb-5">
  <div style="width: 70%; max-width: 900px;">

    <h1 class="mb-4">マイページ</h1>
    <hr>

    {{-- 会員情報編集 --}}
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
      <div class="d-flex align-items-center">
        <div style="width: 70px;" class="text-center me-4">
          <i class="fas fa-user fa-3x"></i>
        </div>

        <div>
          <h5 class="fw-bold mb-1">会員情報の編集</h5>
          <p class="mb-0">アカウント情報を編集できます</p>
        </div>
      </div>

      <a href="{{ route('mypage.edit') }}">
        <i class="fas fa-chevron-right fa-2x"></i>
      </a>
    </div>

    <hr class="m-0">

    {{-- 予約一覧 --}}
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
      <div class="d-flex align-items-center">
        <div style="width: 70px;" class="text-center me-4">
          <i class="fas fa-calendar-days fa-3x"></i>
        </div>

        <div>
          <h5 class="fw-bold mb-1">予約一覧</h5>
          <p class="mb-0">予約内容を確認できます</p>
        </div>
      </div>

      <a href="{{ route('reservations.index') }}">
        <i class="fas fa-chevron-right fa-2x"></i>
      </a>
    </div>

    <hr class="m-0">

    {{-- お気に入り --}}
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
      <div class="d-flex align-items-center">
        <div style="width: 70px;" class="text-center me-4">
          <i class="far fa-heart fa-3x"></i>
        </div>

        <div>
          <h5 class="fw-bold mb-1">お気に入り</h5>
          <p class="mb-0">お気に入り店舗を確認できます</p>
        </div>
      </div>

      <a href="{{ route('mypage.favorite') }}">
        <i class="fas fa-chevron-right fa-2x"></i>
      </a>
    </div>

    <hr class="m-0">

    {{-- パスワード変更 --}}
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
      <div class="d-flex align-items-center">
        <div style="width: 70px;" class="text-center me-4">
          <i class="fas fa-lock fa-3x"></i>
        </div>

        <div>
          <h5 class="fw-bold mb-1">パスワード変更</h5>
          <p class="mb-0">パスワードを変更します</p>
        </div>
      </div>

      <a href="{{ route('mypage.edit_password') }}">
        <i class="fas fa-chevron-right fa-2x"></i>
      </a>
    </div>

    <hr class="m-0">

    {{-- ログアウト --}}
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
      <div class="d-flex align-items-center">
        <div style="width: 70px;" class="text-center me-4">
          <i class="fas fa-sign-out-alt fa-3x"></i>
        </div>

        <div>
          <h5 class="fw-bold mb-1">ログアウト</h5>
          <p class="mb-0">ログアウトします</p>
        </div>
      </div>

      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-chevron-right fa-2x"></i>
      </a>

      <form id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            class="d-none">
        @csrf
      </form>
    </div>

    <hr class="m-0">

  </div>
</div>

@endsection