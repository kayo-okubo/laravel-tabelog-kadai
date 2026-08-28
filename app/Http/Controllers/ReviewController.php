<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'score' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->shop_id = $request->input('shop_id');
        $review->user_id = Auth::user()->id;
        $review->score = $request->input('score');
        $review->save();

        return redirect()->route('shops.show', $request->input('shop_id'));
    }

}
