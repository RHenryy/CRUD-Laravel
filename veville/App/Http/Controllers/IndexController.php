<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        $vehicles = Vehicles::all();

        return view('index', compact('vehicles'));
    }
}
