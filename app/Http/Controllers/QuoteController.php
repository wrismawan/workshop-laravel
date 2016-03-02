<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Quote;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{

    public function timeline()
    {
        $quotes = Quote::orderBy('created_at','desc')->get();

        $data = [
            "quotes" => $quotes
        ];
        return view('timeline')->with($data);
    }

    public function store(Request $request)
    {
    	$newQuote = new Quote();

    	$newQuote->user_id = Auth::user()->id;
    	$newQuote->content = $request->content;
    	$newQuote->author = $request->author;
    	$newQuote->save();

    	return back();
    }

    public function edit($id)
    {
        $quote = Quote::find($id);

        $data = [
            "quote" => $quote
        ];

        return view('edit_quote')->with($data);
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $quote->content = $request->content;
        $quote->author = $request->author;
        $quote->save();

        return redirect('/quote/timeline');
    }

    public function remove($id)
    {
        $quote = Quote::find($id);
        $quote->delete();

        return back();
    }


}
