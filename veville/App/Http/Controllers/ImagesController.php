<?php

namespace App\Http\Controllers;


use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
       if (Auth::check() && Auth::user()->role === 1)
       {

   
        $locations = DB::table('locations')
        ->join('agencies', 'locations.id_agency', 'agencies.id_agency')
        ->select('locations.*', 'agencies.city as city')
        ->where('id_location', '=', $id)
        ->get();
        
        $images = DB::table('images')
        ->join('locations', 'locations.id_location', 'images.id_location')
        ->select('images.*')
        ->where('locations.id_location', '=', $id)
        ->get();
        return view('admin.pictures', compact('locations', 'images'));    
        }

        elseif (Auth::check() && Auth::user()->role === 2)
        {
            $locations = DB::table('locations')
        ->join('agencies', 'locations.id_agency', 'agencies.id_agency')
        ->select('locations.*', 'agencies.city as city')
        ->where('id_location', '=', $id)
        ->get();
        
        $images = DB::table('images')
        ->join('locations', 'locations.id_location', 'images.id_location')
        ->select('images.*')
        ->where('locations.id_location', '=', $id)
        ->get();
        return view('agent.pictures', compact('locations', 'images'));    
        }
        else abort(403);
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
    public function store(Request $request, $id)
    {   
        
        if (Auth::check() && Auth::user()->role === 1)
        {
               $filename = time() . '.' . $request->photo->extension();
        Image::create([
            'id_location' => $id,
            'src' => $request->photo->storeAs('pictures_location', $filename, 'public'),
            
        ]);
        return redirect('/admin/pictures/'. $id)->with('msg', "L'image a bien été ajoutée !");
        }
        elseif (Auth::check() && Auth::user()->role === 2 )
        {
            $filename = time() . '.' . $request->photo->extension();
        Image::create([
            'id_location' => $id,
            'src' => $request->photo->storeAs('agent_pictures_location', $filename, 'public'),
            
        ]);
        return redirect('/agent/pictures/'. $id)->with('msg', "L'image a bien été ajoutée !");

        }
        else abort(403);
     
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $picture)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy($loc, $id)
    {   
        if(Auth::check() && Auth::user()->role === 1)
        {
            $image = DB::table('images')
            ->select('images.src')
            ->where('id', '=', $id)
            ->get();
            Storage::disk('public')->delete($image[0]->src);

        DB::table('images')
        ->select('images.*')
        ->where('id', '=', $id)
        ->delete();


        return redirect('/admin/pictures/'.$loc.'/'.$id)->with('msg', 'Photo supprimée !');
        }

        elseif(Auth::check() && Auth::user()->role === 2)
        {
            $image = DB::table('images')
            ->select('images.src')
            ->where('id', '=', $id)
            ->get();
            Storage::disk('public')->delete($image[0]->src);

            DB::table('images')
            ->select('images.*')
            ->where('id', '=', $id)
            ->delete();


        return redirect('/agent/pictures/'.$loc.'/'.$id)->with('msg', 'Photo supprimée !');
        }
        else abort(403);
        
    }
}
