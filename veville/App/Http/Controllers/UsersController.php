<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index', 'create', 'show', 'store');
    // }

    public function index()
    {

        $users = User::all();

        return view('admin.members', compact('users'));
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
        User::create([

            'name' => $request->name,
            'email' => $request->address,
            'password' => $request->city,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all();
        return view('admin.members', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = DB::table('users')
            ->select('users.*')
            ->where('id', '=', $id)
            ->get();

        return view('admin.membersEdit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $members = DB::table('users')
            ->select('users.*')
            ->where('id', '=', $id)
            ->get();

        if ($request->password == null) {
            $request->password = $members[0]->password;
        } else $request->password = Hash::make($request->password);

        // if ($request->status == null) {
        //     $request->status = $members[0]->status;
        // }

        // if ($request->civility == null) {
        //     $request->civility = $members[0]->civility;
        // }

        $request->created_at = $members[0]->created_at;



        $member = DB::table('users')
            ->select('users.*')
            ->where('id', '=', $id)
            ->get();



        DB::table('users')
            ->where('id', '=', $id)
            ->update([

                'name' => $request->name,
                // 'password' => $request->password,
                // 'lastname' => $request->lastname,
                // 'firstname' => $request->firstname,
                'email' => $request->email,
                'role' => $request->status,
                // 'civility' => $request->civility,
                // 'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s')




            ]);

        return redirect('/admin/members')->with('msg', "L'utilisateur a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')
            ->where('id', '=', $id)
            ->delete();

        return redirect('admin/members')->with('msg', 'Utilisateur bien supprimé');
    }
}
