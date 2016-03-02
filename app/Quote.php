<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Quote extends Model
{
    protected $table = "quotes";

    // Relation to user (User has many quotes)
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Relation Quote to like (Quote has many likes)
    public function likes()
    {
        return $this->hasMany('App\Like', 'quote_id', 'id');
    }

    public static function isUserLike($quoteId) {
        $userId = Auth::user()->id;

        $userLike = Like::where('quote_id', $quoteId)
            ->where('user_id', $userId)
            ->first();

        if (is_null($userLike)) {
            return false;
        } else {
            return true;
        }
    }
}
