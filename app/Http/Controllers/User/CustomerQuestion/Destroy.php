<?php

namespace App\Http\Controllers\User\CustomerQuestion;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * DELETE /customer-question/{id}
 */
class Destroy
{
    public function __invoke($id): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->questions()
            ->where('id', $id)
            ->delete();

        Alert::toast('Deleted!', 'success');

        return Redirect::route('customerQuestion.index');
    }
}
