<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($request->category !== null)
            {
                $shops = Shop::where('category_id', $request->category)->sortable()->paginate(12);
                $total_count = Shop::where('category_id', $request->category)->count();
                $category = Category::find($request->category);
            } elseif ($keyword !== null) {
                $shops = Shop::where('name', 'like', "%{$keyword}%")->sortable()->paginate(12);
                $total_count = $shops->total();
                $category = null;
            } else {
                $shops = Shop::sortable()->paginate(12);
                $total_count = "";
                $category = null;
            }

        $categories = Category::all();

        return view('shops.index', compact('shops', 'category', 'categories', 'total_count', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->category_id = $request->input('category_id');
        $shop->description = $request->input('description');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->regular_holiday = $request->input('regular_holiday');
        $shop->business_hours = $request->input('business_hours');
        $shop->price_range = $request->input('price_range');

        $shop->save();

        return redirect()->route('shops.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();

        return view('shops.show', compact('shop', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        $categories = Category::all();

        return view('shops.edit', compact('shop', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        $shop->name = $request->input('name');
        $shop->category_id = $request->input('category_id');
        $shop->description = $request->input('description');
        $shop->address = $request->input('address');
        $shop->phone_number = $request->input('phone_number');
        $shop->regular_holiday = $request->input('regular_holiday');
        $shop->business_hours = $request->input('business_hours');
        $shop->price_range = $request->input('price_range');
        
        $shop->update();

        return to_route('shops.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return to_route('shops.index');
    }
}
