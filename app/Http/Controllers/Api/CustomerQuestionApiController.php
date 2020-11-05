<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerQuestion;
use Yajra\DataTables\DataTables;

class CustomerQuestionApiController extends Controller
{
  public function all()
  {
    $questions = CustomerQuestion::latest()->get();
    return DataTables::of($questions)
      ->addColumn('select', function ($row) {
        $item = '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">
        ';
        return $item;
      })
      ->addColumn('created_at', function ($row) {
        return date('d/m/Y h:i A', strtotime($row->created_at));
      })
      ->addColumn('reply', function ($row) {
        $class = $row->reply ? 'text-danger' : 'text-danger';
        $val = $row->reply ?? '<p class="' . $class . '">pending</p>';
        return $val;
      })
      ->addColumn('action', function ($row) {
        $item = '<a href="/admin/customer-question/' . $row->id . '/reply" class="btn btn-sm btn-success">Reply</a>
        ';
        return $item;
      })

      ->rawColumns(['select', 'action', 'reply'])
      ->make(true);
  }
}
