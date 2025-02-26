<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        $review = Review::create($request->all());
        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = Review::find($id);
        return $review ? response()->json($review, 200) : response()->json(['message' => 'Review not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Review not found'], 404);
        $review->update($request->all());
        return response()->json($review, 200);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Review not found'], 404);
        $review->delete();
        return response()->json(['message' => 'Review deleted'], 200);
    }
}
