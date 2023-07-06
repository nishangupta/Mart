<?php

namespace App\Http\Controllers\User\CustomerQuestion;

use App\Models\CustomerQuestion;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * POST /customer-question
 */
class Store
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => 'required|max:255',
        ]);
        //product imported to redirect to its path
        $product = Product::findOrFail($request->product_id);

        $question = new CustomerQuestion();
        $question->user_id = auth()->user()->id;
        $question->product_id = $request->product_id;
        $question->question = $request->question;
        $question->save();

        return Redirect::to($product->path());
    }
}
