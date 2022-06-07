<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data['item'] = Product::withCount(['orders' => function ($query) {
            $query->where('status', 4);
        }])->orderBy('orders_count', 'DESC')->get()->take(10);
        return view('data', $data);
    }
}
