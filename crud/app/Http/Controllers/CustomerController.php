<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id == null) {
            $data = new User();

            $customer = new Customer();

        } else {
            $data = User::find($request->id);
            $item = Customer::find($request->id);
        }

        $nama = explode(' ', $request->nama);
        $last_name = array_slice($nama, 1, -1);

        $data->first_name = $nama[0];
        $data->last_name = $last_name;
        $data->last_name = $request->alamat;
        $data->phone = $request->phone;
        $data->created_at = $request->date;

        $data->save();

        $customer->id = $data->id;
        $customer->address = $request->alamat;
        $customer->save();

        $item = User::with('customer')->latest()->orderBy('first_name', 'ASC')->paginate(10);
        return response()->json($item);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::with('customer')->find($id);
        return view('customer.detail',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('customer')->first();
        return response()->json($user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getData(Request $request)
    {
        if ($request->start != null) {

            $from =  Carbon::parse($request->start);
            $to =  Carbon::parse($request->end);
            $data = User::whereBetween('created_at', [$from, $to])->orderBy('first_name', 'ASC')->with('customer')->latest()->paginate(10);

        } else {
            $data = User::orderBy('first_name', 'ASC')->with('customer')->latest()->paginate(10);
        }
        return response()->json($data);
    }
}
