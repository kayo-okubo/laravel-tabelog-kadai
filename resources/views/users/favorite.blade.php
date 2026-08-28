@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
  <div class="w-75">
    <h1>お気に入り</h1>

    <hr>

    <div class="row">
      @foreach ($favorite_shops as $favorite_shop)

      <div class="col-md-9 mt-3 mb-3">
        <div class="d-flex align-items-center">

        <a href="{{ route('shops.show', $favorite_shop->id) }}" style="width: 180px;">
          @if ($favorite_shop->image)
          <img
            src="{{ asset('storage/shops/' . $favorite_shop->image) }}"
            class="img-fluid rounded"
            style="width: 180px; height: 120px; object-fit: cover;"
            alt="{{ $favorite_shop->name }}"
            >
          @else
          <div
            class="bg-light d-flex align-items-center justify-content-center text-muted rounded"
            style="width: 180px; heigth: 120px;"
          >
          No Image
        </div>
        @endif
        </a>

        <div class="ms-4">
          <h4 class="mb-2">
            {{ $favorite_shop->name }}
          </h4>

          <p class="mb-1">
            {{ $favorite_shop->category->name }}
          </p>

          <p class="mb-0">
            {{ $favorite_shop->price_range }}
          </p>

        </div>

        </div>
      </div>

      <div class="col-md-3 d-flex align-items-center justify-content-end">
        <a
          href="{{ route('favorites.destroy', $favorite_shop->id) }}"
          class="btn btn-outline-danger"
          onclick="event.preventDefault(); document.getElementById('favorites-destroy-form{{ $favorite_shop->id }}').submit();"
        >
        削除
      </a>

      <form
        id="favorites-destroy-form{{ $favorite_shop->id }}"
        action="{{ route('favorites.destroy', $favorite_shop->id) }}"
        method="POST"
        class="d-none"
      >

      @csrf
      @method('DELETE')
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