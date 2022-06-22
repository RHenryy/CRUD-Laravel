<?php

namespace App\Http\Controllers;

use App\Models\Agencies;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LocationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', "showAppartment");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::check() && Auth::user()->role === 1) {
            $agencies = Agencies::all();
            $locations = DB::table('locations')
                ->join('agencies', 'locations.id_agency', '=', 'agencies.id_agency')
                ->select('locations.*', 'agencies.city as city', 'agencies.title_agency as agency')
                ->get();
            return view('admin.locations', compact('agencies', 'locations'));
        } elseif (Auth::check() && Auth::user()->role === 2) {

            $agents = DB::table('locations')
                ->join('agents', 'agents.id_location', '=', 'locations.id_location')
                ->join('users', 'users.id', '=', 'agents.id_user')
                ->join('agencies', 'agencies.id_agency', '=', 'agents.id_agency')
                ->select('agents.*', 'locations.*', 'agencies.title_agency', 'agencies.id_agency', 'agencies.city')
                ->where('agents.id_user', '=', Auth::user()->id)
                ->get();
            return view('agent.locations', compact('agents'));
        } elseif (Auth::check() && Auth::user()->role === 3) {
            $manager = DB::table('managers')
                ->select('managers.id_agency')
                ->where('managers.id_user', '=', Auth::user()->id)
                ->get();
            $manager = json_decode(json_encode($manager), true);


            $locations = DB::table('locations')
                ->join('agencies', 'locations.id_agency', '=', 'agencies.id_agency')
                ->join('agents', 'agents.id_location', '=', 'locations.id_location')
                ->select('locations.*', 'agencies.city as city', 'agencies.title_agency as agency', 'agents.id_location as id_loc')
                ->where('agencies.id_agency', '=', $manager)
                ->groupBy('locations.id_location')
                ->get();






            return view('manager.locations', compact('locations'));
        } else {

            $agencies = Agencies::all();
            $locations = DB::table('locations')
                ->join('agencies', 'locations.id_agency', '=', 'agencies.id_agency')
                ->select('locations.*', 'agencies.city as city', 'agencies.title_agency as agency')
                ->get();


            return view('locations', compact('agencies', 'locations'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filename = time() . '.' . $request->photo->extension();
        Location::create([
            'id_agency' => $request->v_agency,
            'title_location' => $request->title,
            'description' => $request->description,
            'rent_price' => $request->rent_price,
            'photo' => $request->photo->storeAs('locations', $filename, 'public')
        ]);
        if (Auth::check() && Auth::user()->role === 1) {
            return redirect('/admin/locations')->with('msg', "L'appartement a bien été ajouté!");
        } elseif (Auth::check() && Auth::user()->role === 2) {
            return redirect('/agent/locations')->with('msg', "L'appartement a bien été ajouté!");
        }
    }

    public function show($id)
    {
        $locations = DB::table('locations')
            ->join('agencies', 'locations.id_agency', '=', 'agencies.id_agency')
            ->select('locations.*', 'agencies.city as city', 'agencies.title_agency as agency')
            ->where('locations.id_agency', '=', $id)
            ->get();
        $agencies = Agencies::all();

        return view('locations', compact('locations', 'agencies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAppartment($id)
    {

        $locations = DB::table('locations')
            ->select('locations.*')
            ->where('id_location', '=', $id)
            ->get();

        $images = DB::table('images')
            ->join('locations', 'images.id_location', '=', 'locations.id_location')
            ->select('images.*', 'locations.title_location')
            ->where('images.id_location', '=', $id)
            ->get();

        $contacts = DB::table('agents')
            ->join('locations', 'locations.id_location', '=', 'agents.id_location')
            ->join('users', 'users.id', '=', 'agents.id_user')
            ->join('agencies', 'agencies.id_agency', '=', 'agents.id_agency')
            ->select('locations.*', 'agents.*', 'users.*', 'agencies.*')
            ->where('agents.id_location', '=', $id)
            ->get();

        if (Auth::check() && Auth::user()->role === 3) {
            return view('manager.locationsShow', compact('locations', 'images', 'contacts'));
        }

        return view('locationsShow', compact('locations', 'images', 'contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locations = DB::table('locations')
            ->select('locations.*')
            ->where('id_location', '=', $id)
            ->get();
        $agencies = Agencies::all();

        $agency = DB::table('locations')
            ->join('agencies', 'agencies.id_agency', '=', 'locations.id_agency')
            ->select('agencies.*')
            ->where('locations.id_location', '=', $id)
            ->get();

        if (Auth::check() && Auth::user()->role === 1) {
            return view('admin.locationsEdit', compact('locations', 'agencies', 'agency'));
        } elseif (Auth::check() && Auth::user()->role === 2) {
            return view('agent.locationsEdit', compact('locations', 'agencies', 'agency'));
        }
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
        $locations = DB::table('locations')
            ->select('locations.*')
            ->where('id_location', '=', $id)
            ->get();

        if ($request->photo === null) {
            $photo = $locations[0]->photo;
        } else {

            $filename = time() . '.' . $request->photo->extension();
            $photo = request('photo')->storeAs('locations', $filename, 'public');

            $imgLocation = DB::table('locations')
                ->select('locations.photo')
                ->where('id_location', "=", $id)
                ->get();
            Storage::disk('public')->delete($imgLocation[0]->photo);
        }

        DB::table('locations')
            ->where('id_location', '=', $id)
            ->update([
                'id_agency' => $request->id_agency,
                'title_location' => $request->title_location,
                'description' => $request->description,
                'rent_price' => $request->rent_price,
                'photo' => $photo,
                'updated_at' => date('Y-m-d H:i:s')

            ]);

        if (Auth::check() && Auth::user()->role === 1) {
            return redirect('/admin/locations')->with('msg', "L'annonce a bien été modifiée");
        } elseif (Auth::check() && Auth::user()->role === 2) {
            return redirect('/agent/locations')->with('msg', "L'annonce a bien été modifiée");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imgLocation = DB::table('locations')
            ->select('locations.photo')
            ->where('id_location', '=', $id)
            ->get();
        Storage::disk('public')->delete($imgLocation[0]->photo);

        DB::table('locations')
            ->where('id_location', '=', $id)
            ->delete();

        if (Auth::check() && Auth::user()->role === 1) {
            return redirect('/admin/locations')->with('msg', "L'annonce a bien été supprimée!");
        } elseif (Auth::check() && Auth::user()->role === 2) {
            return redirect('/agent/locations')->with('msg', "L'annonce a bien été supprimée!");
        }
    }
}
