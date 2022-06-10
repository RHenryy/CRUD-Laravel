<?php

namespace App\Http\Controllers;

use App\Models\Agencies;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $agencies = DB::table('agencies')
                    ->select('agencies.*')
                    ->get();

        $locations = DB::table('locations')
            ->join('agencies', 'locations.id_agency', '=', 'agencies.id_agency')
            ->select('agencies.city as city', 'locations.*')
            ->get();

        

        return view('index', compact('locations', 'agencies'));
    }

    public function show($city)

    {

        $agencies = DB::table('agencies')
        ->select('agencies.*')
        ->get();
        $locations = DB::table('agencies')
        ->join('locations', 'locations.id_agency', '=', 'agencies.id_agency')
            ->select('agencies.*', 'locations.*')
            ->where('city', 'LIKE', $city)
            ->get();
        


        return view('indexList', compact('agencies', 'locations'));
    }
}
