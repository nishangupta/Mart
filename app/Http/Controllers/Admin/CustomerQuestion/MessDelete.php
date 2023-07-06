<?php

namespace App\Http\Controllers\Admin\CustomerQuestion;

use App\Models\CustomerQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class MessDelete
{
    public function __invoke(Request $request): RedirectResponse
    {
        $ids = $request->get('ids');

        $questions = CustomerQuestion::whereIn('id', $ids)->get(['id']);

        foreach ($questions as $order) {
            $order->delete();
        }

        Alert::toast('Removed', 'success');

        return Redirect::route('customerQuestion.adminView');
    }
}
