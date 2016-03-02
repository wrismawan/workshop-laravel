<?php

namespace App\Http\Controllers;

use App\Like;
use App\Quote;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($quoteId)
    {
        if (! Quote::isUserLike($quoteId)) {
            $newLike = new Like();
            $newLike->user_id = Auth::user()->id;
            $newLike->quote_id = $quoteId;
            $newLike->save();
        }

        return back();
    }

    public function unlike($quoteId)
    {
        $userId = Auth::user()->id;

        $userLike = Like::where('quote_id', $quoteId)
            ->where('user_id', $userId)
            ->first();

        if (! is_null($userLike)) {
            $userLike->delete();
        }

        return back();
    }
}
