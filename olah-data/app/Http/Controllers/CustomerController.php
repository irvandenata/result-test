<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
     public function index()
    {
        $data['item'] = Customer::withCount('orders')->with('user')->orderBy('orders_count','desc')->get()->take(10);

        return view('customer', $data);
    }
}
