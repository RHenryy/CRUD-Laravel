<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Agencies;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 1) {
            $agents = DB::table('agents')
                ->join('users', 'users.id', '=', 'agents.id_user')
                ->select('agents.id_user', 'agents.id_location', 'agents.id_agency', 'users.id', 'users.name', 'users.email')
                ->groupBy('agents.id_user')
                ->get();
            $locations = Location::all();
            $agencies = DB::table('agencies')
                ->select('agencies.city', 'agencies.title_agency', 'agencies.id_agency')
                ->groupBy('agencies.city')
                ->get();

            return view('admin.agents', compact('agents', 'locations', 'agencies'));
        } elseif (Auth::check() && Auth::user()->role === 3) {
            $manager = DB::table('managers')
                ->select('managers.id_agency')
                ->where('managers.id_user', '=', Auth::user()->id)
                ->get();
            $manager = json_decode(json_encode($manager), true);
            $agents = DB::table('agents')
                ->join('agencies', 'agents.id_agency', '=', 'agencies.id_agency')
                ->join('locations', 'agents.id_location', '=', 'locations.id_location')
                ->join('users', 'users.id', '=', 'agents.id_user')
                ->select('agents.id_location', 'agents.id_agent', 'agents.id_agency', 'users.*', 'agencies.city as city', 'agencies.title_agency as agency', 'locations.photo as photo', 'locations.title_location', 'locations.rent_price')
                ->where('agents.id_agency', '=', $manager)
                ->groupBy('users.name')
                ->get();
            $agencies = DB::table('agencies')
                ->select('agencies.*')
                ->where('agencies.id_agency', '=', $manager)
                ->groupBy('agencies.title_agency')
                ->get();
            $locations = DB::table('locations')
                ->join('agencies', 'locations.id_agency', 'agencies.id_agency')
                ->select('locations.*', 'agencies.city as city')
                ->where('locations.id_agency', '=', $manager)
                ->get();
            return view('manager.agents', compact('agents', 'agencies', 'locations'));
        } else return abort(403);
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
        if (Auth::check() && Auth::user()->role === 1) {
            Agent::create([
                'id_user' => $request->user_id,
                'id_agency' => $request->id_agency,
                'id_location' => $request->id_location

            ]);
            return redirect('/admin/agents')->with('msg', "L'agent a bien été assigné !");
        } elseif (Auth::check() && Auth::user()->role === 3) {

            DB::table('users')
                ->insert(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make('12345678'),
                        'role' => 2,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')

                    ]
                );

            $users = DB::table('users')
                ->select('id')
                ->where('email', '=', $request->email)
                ->get();

            $users = json_decode(json_encode($users), true);
            $idAgent = $users[0]['id'];

            DB::table('agents')
                ->insert([
                    'id_user' => $idAgent,
                    'id_agency' => $request->idAgency,
                    'id_location' => $request->idLocation,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);


            return redirect('/manager/agents')->with('msg', "L'agent a bien été ajouté !");
        } else return abort(403);
    }

    public function assignAgent()
    {
        if (Auth::check() && Auth::user()->role === 3) {
            $managerId = DB::table('managers')
                ->select('id_agency')
                ->where('id_user', Auth::user()->id)
                ->get();
            $managerId = json_decode(json_encode($managerId), true);
            $id = $managerId[0]['id_agency'];

            $agents = DB::table('agents')
                ->join('users', 'users.id', 'agents.id_user')
                ->select('agents.*', 'users.name', 'users.email')
                ->where('agents.id_agency', $id)
                ->orderBy('users.name')
                ->get();
            $locations = DB::table('locations')
                ->select('locations.*')
                ->where('id_agency', $id)
                ->get();
            return view('manager.assignAgent', compact('agents', 'locations'));
        } else abort(403);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->role === 3) {
            DB::table('agents')
                ->join('users', 'users.id', '=', 'agents.id_user')
                ->select('users.*', 'agents.*')
                ->where('agents.id_agent', '=', $id)
                ->delete();
            return redirect('/manager/agents')->with('msg', "L'agent a bien été supprimé !");
        } else abort(403);
    }
}
