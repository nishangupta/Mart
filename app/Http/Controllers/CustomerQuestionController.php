<?php

namespace App\Http\Controllers;

use App\Models\CustomerQuestion;
use Illuminate\Http\Request;
use App\Models\Product;

class CustomerQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
        ]);
        //product imported to redirect to its path
        $product = Product::findOrFail($request->product_id);

        $question = new CustomerQuestion;
        $question->user_id = auth()->user()->id;
        $question->product_id = $request->product_id;
        $question->question = $request->question;
        $question->save();

        return redirect($product->path());
    }
}
