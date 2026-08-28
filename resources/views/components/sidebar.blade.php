<div class="container">
  <h4 class="fw-bold mb-3">
    カテゴリから探す
  </h4>

  <div class="list-group">
    @foreach($categories as $category)
      <a href="{{ route('shops.index', ['category' => $category->id]) }}"
         class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">

        <span>
          {{ $category->name }}
        </span>

        <i class="fas fa-chevron-right small"></i>
      </a>
    @endforeach
  </div>
</div>