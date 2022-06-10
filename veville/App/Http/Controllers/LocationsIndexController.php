<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locations');
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
        $filename1 = time() . '.' . $request->photo1->extension();

        $filename2 = time() . '.' . $request->photo2->extension();
        $filename3 = time() . '.' . $request->photo3->extension();

        $locations = new Location();

        $locations->photo_1 = request('photo1')->storeAs('vehicles', $filename1, 'public');
        $locations->photo_2 = request('photo2')->storeAs('vehicles', $filename2, 'public');;
        $locations->photo_3 = request('photo3')->storeAs('vehicles', $filename3, 'public');;
        $locations->updated_at = date('Y-m-d H:i:s');
        $locations->created_at = date('Y-m-d H:i:s');
        $locations->save();





        return redirect('/locations')->with('msg', 'Les photos ont bien été ajoutées!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
