<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Agencies;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::check() && Auth::user()->role === 1)
        {
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
        }
        
        else return abort(403);
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
        if(Auth::check() && Auth::user()->role === 1)
        {
            Agent::create([
            'id_user' => $request->user_id,
            'id_agency' => $request->id_agency,
            'id_location' => $request->id_location

        ]);
        return redirect('/admin/agents')->with('msg',"L'agent a bien été assigné !");
        }

        else return abort(403);
        
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
    public function destroy(Agent $agent)
    {
        //
    }
}
