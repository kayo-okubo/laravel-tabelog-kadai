@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3">
  <div class="w-75">

  <h1>予約一覧</h1>

  <hr>

  <div class="row">
    @foreach($reservations as $reservation)

    <div class="col-md-2 mt-2">
      <a href="{{ route('shops.show', $reservation->shop->id) }}">
        <img
          src="{{ asset('img/dummy.png') }}"
          class="img-fuild w-100"
        >
      </a>
    </div>

    <div class="col-md-4 mt-4">
      <h3>{{ $reservation->shop->name }}</h3>
    </div>

    <div class="col-md-4 mt-4">
      <p>予約日時：{{ $reservation->reservation_datetime }}</p>
      <p>予約人数：{{ $reservation->number_of_people }}名</p>
    </div>

    @endforeach
  </div>

  <hr>

  </div>
</div>

@endsection