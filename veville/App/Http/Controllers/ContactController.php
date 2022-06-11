<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $contacts = DB::table('agents')
            ->join('locations', 'locations.id_location', '=', 'agents.id_location')
            ->join('users', 'users.id', '=', 'agents.id_user')
            ->join('agencies', 'agencies.id_agency', '=', 'agents.id_agency')
            ->select('locations.*', 'agents.*', 'users.*', 'agencies.*')
            ->where('agents.id_location', '=', $id)
            ->get();
        return view('contact', compact('contacts'));
    }

    public function showArchives($id)
    {
        if (Auth::check() && Auth::user()->role === 2) {
            $messages = DB::table('archive_bookings')
                ->join('locations', 'locations.id_location', '=', 'archive_bookings.id_location')
                ->select('archive_bookings.*', 'locations.id_location', 'locations.title_location', 'locations.description', 'locations.photo')
                ->where('user_id', '=', $id)
                ->get();
            return view('agent.archivedMessages', compact('messages'));
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
        DB::table('bookings')
            ->insert([
                'id_agency' => $request->idAgency,
                'id_location' => $request->idLocation,
                'user_id' => $request->agent_id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'created_at' => date('Y-m-d H:i:s')

            ]);


        return redirect('/locations')->with('msg', 'Message bien envoyé !');
    }

    public function restore(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role === 2) {
            DB::table('bookings')
                ->insert([
                    'id_agency' => $request->idAgency,
                    'id_location' => $request->idLocation,
                    'user_id' => $request->agent_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => $request->message,
                    'created_at' => $request->createdAt,
                ]);

            DB::table('archive_bookings')
                ->where('id_booking', '=', $id)
                ->delete();

            return redirect('/agent/messages/')->with('msg', 'Le message a bien été restauré !');
        }
    }

    public function getHistory()
    {
        $messages = DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('locations', 'locations.id_location', '=', 'bookings.id_location')
            ->select('bookings.message', 'bookings.created_at', 'users.email', 'locations.photo', 'locations.title_location', 'locations.description', 'locations.id_location')
            ->where('bookings.email', '=', Auth::user()->email)
            ->get();
        return view('history', compact('messages'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::check() && Auth::user()->role === 2) {
            $messages = DB::table('bookings')
                ->join('locations', 'locations.id_location', '=', 'bookings.id_location')
                ->select('bookings.*', 'locations.title_location', 'locations.id_location', 'locations.description', 'locations.photo')
                ->where('user_id', '=', Auth::user()->id)
                ->get();
            return view('agent.messages', compact('messages'));
        } else abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function archiveMessage(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role === 2) {
            DB::table('bookings')
                ->where('id_booking', '=', $id)
                ->delete();

            DB::table('archive_bookings')
                ->insert([
                    'id_agency' => $request->idAgency,
                    'id_location' => $request->idLocation,
                    'user_id' => $request->agent_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => $request->message,
                    'created_at' => $request->createdAt,
                ]);



            return redirect('/agent/messages')->with('msg', 'Le message a bien été archivé !');
        } else return abort(403);
    }
}
