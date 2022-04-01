<?php

namespace App\Http\Controllers;

use App\Models\Agencies;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class VehiclesController extends Controller
{

    public function index()
    {

        $agencies = Agencies::all();
        $vehicles = DB::table('vehicles')
            ->join('agencies', 'vehicles.id_agency', '=', 'agencies.id_agency')
            ->select('vehicles.*', 'agencies.city as city', 'agencies.title_agency as agence')
            ->get();







        return view('vehicles', compact('vehicles', 'agencies'));
    }

    public function create()
    {
    }



    public function store(Request $request)
    {

        $filename0 = time() . '.' . $request->photo->extension();

        Vehicles::create([

            'id_agency' => $request->v_agency,
            'title' => $request->title,
            'brand' => $request->brand,
            'model' => $request->model,
            'description' => $request->description,
            'photo' => $request->photo->storeAs('vehicles', $filename0, 'public'),

            'daily_price' => $request->price

        ]);






        return redirect('/vehicles')->with('msg', 'Le véhicule a bien été ajouté!');
    }

    public function show($id)
    {
        $vehicles = DB::table('vehicles')
            ->join('agencies', 'vehicles.id_agency', '=', 'agencies.id_agency')
            ->select('vehicles.*', 'agencies.city as city', 'agencies.title_agency as agence')->where('vehicles.id_agency', 'LIKE', $id)
            ->get();
        $agencies = Agencies::all();
        return view('vehicles', compact('vehicles', 'agencies'));
    }

    public function showProduct($id)

    {


        $vehicles = DB::table('vehicles')
            ->select('vehicles.*')->where('id_vehicle', 'LIKE', $id)
            ->get();



        return view('vehiclesProducts', compact('vehicles'));
    }

    public function destroy($id)
    {

        $imgVehicle = DB::table('vehicles')
            ->select('vehicles.photo')
            ->where('id_vehicle', 'LIKE', $id)
            ->get();
        Storage::disk('public')->delete($imgVehicle[0]->photo);

        DB::table('vehicles')
            ->where('id_vehicle', 'LIKE', $id)
            ->delete();

        return redirect('vehicles');
    }

    public function edit($id)
    {
        $vehicles = DB::table('vehicles')
            ->select('vehicles.*')
            ->where('id_vehicle', 'LIKE', $id)
            ->get();

        $agencies = Agencies::all();

        return view('vehiclesEdit', compact('vehicles', 'agencies'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = DB::table('vehicles')
            ->select('vehicles.*')
            ->where('id_vehicle', 'LIKE', $id)
            ->get();

        if ($request->photo == null) {
            $photo = $vehicle[0]->photo;
        } else {
            $filename = time() . '.' . $request->photo->extension();
            $photo = request('photo')->storeAs('vehicles', $filename, 'public');
            $imgVehicle = DB::table('vehicles')
                ->select('vehicles.photo')
                ->where('id_vehicle', 'LIKE', $id)
                ->get();
            Storage::disk('public')->delete($imgVehicle[0]->photo);
        }


        DB::table('vehicles')
            ->where('id_vehicle', 'LIKE', $id)
            ->update([

                'title' => $request->title,
                'brand' => $request->brand,
                'model' => $request->model,
                'description' => $request->description,
                'photo' => $photo,
                'daily_price' => $request->daily_price,
                'updated_at' => date('Y-m-d H:i:s')




            ]);

        return redirect('/vehicles')->with('msg', 'Entry successfully updated!');;
    }
}
