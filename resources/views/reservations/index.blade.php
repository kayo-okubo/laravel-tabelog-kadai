@extends('layouts.app')

@section('content')

@if (session('flash_message'))
  <div class="container mt-3">
    <div class="alert alert-success">
      {{ session('flash_message') }}
    </div>
  </div>
  @endif
  

<div class="container d-flex justify-content-center mt-3">
  <div class="w-75">

  <h1>予約一覧</h1>

  <hr>

  <div class="row">
    @foreach($reservations as $reservation)

    <div class="col-md-3 mt-3 mb-3">
      <a href="{{ route('shops.show', $reservation->shop->id) }}">
        @if ($reservation->shop->image)
          <img
            src="{{ asset('storage/shops/' . $reservation->shop->image) }}"
            class="img-fluid rounded"
            style="width: 100%; height: 140px; object-fit: cover;"
            alt="{{ $reservation->shop->name }}"
          >
        @else
          <div
            class="bg-light d-flex align-items-center justify-content-center text-muted rounded"
            style="width: 100%; height: 140px;"
          >
            No Image
          </div>
        @endif
      </a>
    </div>

    <div class="col-md-3 mt-4">
      <h4>{{ $reservation->shop->name }}</h4>
    </div>

    <div class="col-md-4 mt-4">
      <p>予約日時：{{ $reservation->reservation_datetime }}</p>
      <p>予約人数：{{ $reservation->number_of_people }}名</p>
    </div>

    <div class="col-md-2 mt-4 d-flex align-items-center justify-content-end">
      <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-outline-danger">
          キャンセル
        </button>
      </form>
    </div>

    <div class="col-12">
      <hr>
    </div>

    @endforeach
  </div>

  <hr>

  </div>
</div>

@endsection