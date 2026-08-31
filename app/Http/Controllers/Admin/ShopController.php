<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Category; 

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $shops = Shop::where('name', 'like', "%{$keyword}%")
                ->paginate(15);
        } else {
            $shops = $query->orderBy('id')->paginate(15);
        }

        $total = $shops->total();

        return view('admin.shops.index', compact('shops', 'keyword', 'total'));
    }

    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();

        return view('admin.shops.show', compact('shop', 'reviews'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.shops.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            'regular_holiday' => 'nullable',
            'business_hours' => 'nullable',
            'price_range' => 'required',
                    ], [], [
            'category_id' => 'カテゴリ',
            'name' => '店舗名',
            'address' => '住所',
            'phone_number' => '電話番号',
            'description' => '説明',
            'image' => '店舗画像',
            'regular_holiday' => '定休日',
            'business_hours' => '営業時間',
            'price_range' => '価格帯',
        ]);

        $shop = new Shop();

        $shop->category_id = $request->input('category_id');
        $shop->name = $request->input('name');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->description = $request->input('description');
        $shop->regular_holiday = $request->input('regular_holiday');
        $shop->business_hours = $request->input('business_hours');
        $shop->price_range = $request->input('price_range');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('shops', 'public');
            $shop->image = basename($image);
        } else {
            $shop->image = '';
        }

        $shop->save();

        return to_route('admin.shops.index')
            ->with('flash_message', '店舗を登録しました。');
    }

    public function edit(Shop $shop)
    {
        $categories = Category::all();

        return view('admin.shops.edit', compact('shop', 'categories'));
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',
            'regular_holiday' => 'nullable',
            'business_hours' => 'nullable',
            'price_range' => 'required',
        ]);


        $shop->category_id = $request->input('category_id');
        $shop->name = $request->input('name');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->description = $request->input('description');
        $shop->regular_holiday = $request->input('regular_holiday');
        $shop->business_hours = $request->input('business_hours');
        $shop->price_range = $request->input('price_range');

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('shops', 'public');
            $shop->image = basename($image);
        } 

        $shop->update();

        return to_route('admin.shops.index')
            ->with('flash_message', '店舗情報を更新しました。');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();

        return to_route('admin.shops.index')
            ->with('flash_message', '店舗を削除しました。');
    }

}
