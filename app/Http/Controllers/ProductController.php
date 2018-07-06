<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilters;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(ProductFilters $filters)
    {
        $products = Product::filter($filters)->with('vendor')->paginate(25);

        $products->appends($filters->getQueryFilterParams());

        return view('products.index', [
            'pageTitle' => 'Список товаров',
            'products' => $products,
        ]);
    }

    public function updatePrice(Request $request)
    {
        $data = $this->validate($request, [
            'id' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findOrFail($data['id']);

        $product->update(['price' => $data['price']]);

        return [
            'res' => true,
            'message' => 'Цена обновлена'
        ];
    }
}
