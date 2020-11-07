<?php

namespace App\Http\Controllers;

use App\Models\CustomerQuestion;
use Illuminate\Http\Request;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerQuestionController extends Controller
{
    //admin 
    public function adminView()
    {
        return view('customer.customer-question');
    }

    public function adminReply($id)
    {
        $question = CustomerQuestion::where('id', $id)->with('user', 'product.productImage')->first();
        return view('customer.reply', compact('question'));
    }

    public function reply(CustomerQuestion $id, Request $request)
    {
        $request->validate([
            'reply' => 'required|max:255'
        ]);
        $id->update([
            'reply' => $request->reply
        ]);
        return redirect(route('customerQuestion.adminView'));
    }

    public function massDelete(Request $request)
    {
        $ids = $request->get('ids');
        $questions = CustomerQuestion::whereIn('id', $ids)->get(['id']);
        foreach ($questions as $order) {
            $order->delete();
        }
        Alert::toast('Removed', 'success');
        return redirect(route('customerQuestion.adminView'));
    }

    //for users
    public function index()
    {
        $questions = auth()->user()->questions()->with('product')->paginate(20);
        return view('customer-question.index')->with([
            'questions' => $questions
        ]);
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

    public function destroy($id)
    {
        auth()->user()->questions()->where('id', $id)->delete();
        Alert::toast('Deleted!', 'success');
        return redirect(route('customerQuestion.index'));
    }
}
