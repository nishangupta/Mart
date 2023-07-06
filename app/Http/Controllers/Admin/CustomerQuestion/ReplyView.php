<?php

namespace App\Http\Controllers\Admin\CustomerQuestion;

use App\Models\CustomerQuestion;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFactory;

class ReplyView
{
    public function __invoke($id): View
    {
        $question = CustomerQuestion::where('id', $id)
            ->with('user', 'product.productImage')
            ->first();

        return ViewFactory::make('admin.customer.reply', compact('question'));
    }
}
