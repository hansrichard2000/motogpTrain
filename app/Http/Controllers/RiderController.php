<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Team;
use App\Models\Constructor;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riders = Rider::all();
        $teams = Team::all();
        return view('rider.index', compact('riders', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        $constructors = Constructor::all();
        return view('rider.addRider', compact('teams', 'constructors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'flag'=> 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'number' => 'required|unique:riders',
        ]);

        $imgRider = $request->picture->getClientOriginalName().'-'.time().'.'.$request->picture->extension();
        $request->picture->move(public_path('images/rider'), $imgRider);

        $imgFlag = $request->flag->getClientOriginalName().'-'.time().'.'.$request->flag->extension();
        $request->flag->move(public_path('images/flag'), $imgFlag);

        Rider::create([
            'name'=> $request->name,
            'number'=> $request->number,
            'team'=> $request->team,
            'engine'=> $request->engine,
            'nation'=> $request->nation,
            'date'=> $request->date,
            'place'=> $request->place,
            'height'=> $request->height,
            'weight'=> $request->weight,
            'podiums'=> $request->podiums,
            'wins'=> $request->wins,
            'title'=> $request->title,
            'description'=> $request->description,
            'picture'=> $imgRider,
            'flag'=> $imgFlag,
            'created_by' => $request->created_by,
        ]);
        return redirect()->route('rider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ridershow = Rider::where('id', $id)->first();
        $teams = Team::all();
        $constructors = Constructor::all();
        if($ridershow == null){
            abort(404);
        }

        return view('rider.detail', compact('ridershow', 'teams', 'constructors'));
    }

    public function showUpdateImg(Rider $rider, Team $teams, Constructor $constructors)
    {
        $teams = Team::all();
        $constructors = Constructor::all();

        return view('rider.updateImgRider', compact('rider', 'teams', 'constructors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit(Rider $rider, Team $teams, Constructor $constructors)
    {
        $teams = Team::all();
        $constructors = Constructor::all();
        return view('rider.editRider', compact('rider','teams', 'constructors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Rider $rider)
    // {
        // $rider->update($request->all());
        // return redirect()->route('rider.index');
    // }

    public function update(Request $request, Rider $rider)
    {
        $request->validate([
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'flag'=> 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->picture != null && $request->flag !=null){
            $imgRider = $request->picture->getClientOriginalName().'-'.time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images/rider'), $imgRider);

            $imgFlag = $request->flag->getClientOriginalName().'-'.time().'.'.$request->flag->extension();
            $request->flag->move(public_path('images/flag'), $imgFlag);

            $rider->update([
                'name'=> $request->name,
                'number'=> $request->number,
                'team'=> $request->team,
                'engine'=> $request->engine,
                'nation'=> $request->nation,
                'date'=> $request->date,
                'place'=> $request->place,
                'height'=> $request->height,
                'weight'=> $request->weight,
                'podiums'=> $request->podiums,
                'wins'=> $request->wins,
                'title'=> $request->title,
                'description'=> $request->description,
                'picture'=> $imgRider,
                'flag'=> $imgFlag,
                'updated_by' => $request->updated_by,
            ]);
        }
        else if ($request->picture != null){
            $imgRider = $request->picture->getClientOriginalName().'-'.time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images/rider'), $imgRider);

            $rider->update([
                'name'=> $request->name,
                'number'=> $request->number,
                'team'=> $request->team,
                'engine'=> $request->engine,
                'nation'=> $request->nation,
                'date'=> $request->date,
                'place'=> $request->place,
                'height'=> $request->height,
                'weight'=> $request->weight,
                'podiums'=> $request->podiums,
                'wins'=> $request->wins,
                'title'=> $request->title,
                'description'=> $request->description,
                'picture'=> $imgRider,
                'updated_by' => $request->updated_by,
            ]);
        }
        else if($request->flag !=null){
            $imgFlag = $request->flag->getClientOriginalName().'-'.time().'.'.$request->flag->extension();
            $request->flag->move(public_path('images/flag'), $imgFlag);

            $rider->update([
                'name'=> $request->name,
                'number'=> $request->number,
                'team'=> $request->team,
                'engine'=> $request->engine,
                'nation'=> $request->nation,
                'date'=> $request->date,
                'place'=> $request->place,
                'height'=> $request->height,
                'weight'=> $request->weight,
                'podiums'=> $request->podiums,
                'wins'=> $request->wins,
                'title'=> $request->title,
                'description'=> $request->description,
                'flag'=> $imgFlag,
                'updated_by' => $request->updated_by,
            ]);
        }
        else{
            $rider->update([
                'name'=> $request->name,
                'number'=> $request->number,
                'team'=> $request->team,
                'engine'=> $request->engine,
                'nation'=> $request->nation,
                'date'=> $request->date,
                'place'=> $request->place,
                'height'=> $request->height,
                'weight'=> $request->weight,
                'podiums'=> $request->podiums,
                'wins'=> $request->wins,
                'title'=> $request->title,
                'description'=> $request->description,
                'updated_by' => $request->updated_by,
            ]);
        }

        return redirect()->route('rider.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        $rider->delete();
        return redirect()->back();
    }
}
