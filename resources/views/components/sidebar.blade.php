<div class="container">
  <h2>カテゴリ</h2>
  @foreach($categories as $category)
      <label class="tabelog-sidebar-category-label">
        <a href="{{ route('shops.index', ['category' => $category->id]) }}">
          {{ $category->name }}
        </a>
      </label>
  @endforeach
</div>