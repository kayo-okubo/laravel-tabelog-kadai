@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">レビュー編集</h2>

    <form method="POST" action="{{ route('reviews.update', $review) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="score" class="form-label">評価</label>

            <select name="score" id="score" class="form-select">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('score', $review->score) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">レビュー内容</label>

            <textarea
                name="content"
                id="content"
                class="form-control"
                rows="5"
            >{{ old('content', $review->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-dark">
            更新する
        </button>
    </form>

</div>

@endsection