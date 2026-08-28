@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">

                <h1 class="mb-4 text-center">管理者ホーム</h1>

                <div class="row row-cols-md-3 row-cols-1 g-3">

                    <div class="col">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">会員管理</h5>

                                <a href="{{ route('admin.users.index') }}"
                                   class="btn btn-dark">
                                    会員一覧
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">店舗管理</h5>

                                <a href="{{ route('admin.shops.index') }}"
                                   class="btn btn-dark">
                                    店舗一覧
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 bg-light">
                            <div class="card-body text-center">
                                <h5 class="card-title">カテゴリ管理</h5>

                                <a href="{{ route('admin.categories.index') }}"
                                   class="btn btn-dark">
                                    カテゴリ一覧
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection