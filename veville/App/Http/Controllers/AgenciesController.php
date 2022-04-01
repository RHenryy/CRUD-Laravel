<?php

namespace App\Http\Controllers;

use App\Models\Agencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AgenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agencies::all();



        $city = DB::table('agencies')
            ->select('agencies.city')
            ->groupBy('agencies.city')
            ->get();

        $autofill = "";
        return view('agencies', compact('agencies', 'city', 'autofill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agency = Agencies::all();

        return view('agencies', compact('agency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filename0 = time() . '.' . $request->photo->extension();




        Agencies::create([

            'title_agency' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'pc' => $request->pc,
            'map' => $request->map,
            'photo' => $request->photo->storeAs('agencies', $filename0, 'public'),
            'description' => $request->description
        ]);


        return redirect('/agencies')->with('msg', 'Votre agence a bien été ajoutée!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */

    public function show($city)

    {


        $agencies = DB::table('agencies')
            ->select('agencies.*')
            ->where('city', 'LIKE', $city)
            ->get();

        $city = DB::table('agencies')
            ->select('agencies.city')
            ->groupBy('agencies.city')
            ->get();



        $autofill = $agencies[0]->city;



        return view('agencies', compact('agencies', 'city', 'autofill'));
    }

    public function showAgency($id)

    {

        $agencies = DB::table('agencies')
            ->select('agencies.*')
            ->where('agencies.id_agency', 'LIKE', $id)
            ->get();
        return view('agenciesList', compact('agencies'));
    }



    // public function getCity()
    // {   
    //     $city = request('v_agency');
    //     dump($city);
    //     die();
    //     $agencies = DB::table('agencies')->where('city','LIKE','%'.$city.'%')
    //     ->get();


    //     return view('agencies', ['agencies' => $agencies]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agencies = DB::table('agencies')
            ->select('agencies.*')
            ->where('id_agency', 'LIKE', $id)
            ->get();

        return view('agenciesEdit', compact('agencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $agency = DB::table('agencies')
            ->select('agencies.*')
            ->where('id_agency', 'LIKE', $id)
            ->get();

        if ($request->photo == null) {
            $photo = $agency[0]->photo;
        } else {
            $filename = time() . '.' . $request->photo->extension();
            $photo = request('photo')->storeAs('agencies', $filename, 'public');
            $imgAgency = DB::table('agencies')
                ->select('agencies.photo')
                ->where('id_agency', 'LIKE', $id)
                ->get();
            Storage::disk('public')->delete($imgAgency[0]->photo);
        }

        DB::table('agencies')
            ->where('id_agency', 'LIKE', $id)
            ->update([

                'title_agency' => $request->title_agency,
                'address' => $request->address,
                'city' => $request->city,
                'pc' => $request->pc,
                'description' => $request->description,
                'photo' => $photo,
                'updated_at' => date('Y-m-d H:i:s')




            ]);

        return redirect('/agencies')->with('msg', 'Entry successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agencies  $agencies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imgAgency = DB::table('agencies')
            ->select('agencies.photo')
            ->where('id_agency', 'LIKE', $id)
            ->get();
        Storage::disk('public')->delete($imgAgency[0]->photo);

        DB::table('agencies')
            ->where('id_agency', 'LIKE', $id)
            ->delete();

        return redirect('agencies');
    }
}
