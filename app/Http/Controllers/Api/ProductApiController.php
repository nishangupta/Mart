<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProductApiController extends Controller
{
  public function all()
  {
    $products = Product::latest();
    return DataTables::of($products)

      ->addColumn('select', function ($row) {
        $item = '<input type="checkbox" name="ids[]" class="selectbox" value="' . $row->id . '">
        ';
        return $item;
      })
      ->addColumn('onSale', function ($row) {
        $val = $row->onSale ? 'onSale' : 'Toggle sale';
        $class = $row->onSale ? 'btn-danger' : 'btn-outline-danger';
        $item = '<a href="/api/product/onsale/invert/' . $row->id . '" class="btn btn-sm ' . $class . '">' . $val . '</a>
        ';
        return $item;
      })
      ->addColumn('live', function ($row) {
        $val = $row->live ? 'live now' : 'Toggle Live';
        $class = $row->live ? 'btn-success' : 'btn-outline-success';
        $item = '<a href="/api/product/live/invert/' . $row->id . '" class="btn btn-sm ' . $class . '">' . $val . '</a>';
        return $item;
      })
      ->addColumn('actions', function ($row) {
        $btns = '<a target="_blank" class="btn btn-info float-left btn-sm w-50 " href="/product/' . $row->id . '/image" ><i class="fas fa-eye"></i> Images</a>
                <a class="btn btn-primary btn-sm float-left w-50 " href="/product/' . $row->id . '/edit"><i class="fas fa-pen-square"></i> Edit</a>';
        return $btns;
      })
      ->rawColumns(['select', 'actions', 'live', 'onSale'])
      ->make(true);
  }

  public function onSaleInvert(Product $id)
  {
    //here id become the product
    $id->update([
      'onSale' => !$id->onSale
    ]);

    return redirect()->route('product.index');
  }

  public function liveInvert(Product $id)
  {
    //here id become the product
    $id->update([
      'live' => !$id->live
    ]);

    return redirect()->route('product.index');
  }
}
