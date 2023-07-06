<?php

namespace App\Http\Controllers\User\CustomerQuestion;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as ViewFactory;

class Index extends Controller
{
    public function __invoke(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $questions = $user->questions()
            ->with('product')
            ->paginate(20);

        return ViewFactory::make('customer-question.index')->with([
            'questions' => $questions,
        ]);
    }
}
