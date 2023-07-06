<?php

namespace App\Http\Controllers\Admin\CustomerQuestion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReplyCustomerQuestionRequest;
use App\Models\CustomerQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

/**
 * 管理者回應客戶的問題
 */
class Reply extends Controller
{
    public function __invoke(CustomerQuestion $question, ReplyCustomerQuestionRequest $request): RedirectResponse
    {
        $question->update([
            'reply' => $request->reply,
        ]);

        return Redirect::route('customerQuestion.adminView');
    }
}
