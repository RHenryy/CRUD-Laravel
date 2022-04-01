<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
            ->join('vehicles', 'orders.id_vehicle', '=', 'vehicles.id_vehicle')
            ->join('agencies', 'orders.id_agency', '=', 'agencies.id_agency')
            ->join('members', 'orders.id_member', '=', 'members.id_member')
            ->select('orders.*', 'agencies.title_agency as agency', 'members.nickname as name', 'members.email as email', 'vehicles.title as vehicle')
            ->get();
        return view('orders', compact('orders'));
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
        $orders = new Orders();

        $orders->title = request('name');
        $orders->id_agency = request('v_agency');
        $orders->brand = request('brand');
        $orders->model = request('model');
        $orders->description = request('description');
        $orders->photo = request('photo');
        $orders->daily_price = request('price');

        $orders->save();


        return redirect('/orders')->with('msg', 'Le véhicule a bien été ajouté!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $orders = Orders::findOrFail();
    //     $orders->

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
