<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        return view('home');
    }
    public function showInfo()

    {
        $users = DB::table('users')
            ->select('users.*')
            ->where('id', '=', Auth::user()->id)
            ->get();
            return view('home', compact('users'));
    }

    public function edit($id)
    {   
        $id = Auth::user()->id;
        $users = DB::table('users')
        ->select('users.*')
        ->where('id', '=', $id)
        ->get();
        return view('homeEdit', compact('users'));
    }

    public function update(request $request, $id)
    {   
        DB::table('users')
        ->where('id', '=', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect('/home')->with('editSuccess', 'Informations bien mises à jour');
    }
}
