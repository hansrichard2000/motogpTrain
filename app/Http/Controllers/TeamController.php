<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Constructor;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructors = Constructor::all();
        $teams = Team::all();
        return view('team.index', compact('teams', 'constructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructors = Constructor::all();
        return view('team.addTeam', compact('constructors'));
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'bg_image'=> 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $logoName = $request->logo->getClientOriginalName().'-'.time().'.'.$request->logo->extension();
        $request->logo->move(public_path('images/team-logo'), $logoName);

        $imgName = $request->bg_image->getClientOriginalName().'-'.time().'.'.$request->bg_image->extension();
        $request->bg_image->move(public_path('images/team-back'), $imgName);

        Team::create([
            'name'=> $request->name,
            'principal' => $request->principal,
            'engine'=> $request->engine,
            'entry'=> $request->entry,
            'logo'=> $logoName,
            'bg_image'=> $imgName,
            'created_by' => $request->created_by,
        ]);
        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team, Constructor $constructors)
    {
        $constructors = Constructor::all();
        return view('team.updateImageTeam', compact('team', 'constructors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Constructor $constructors)
    {
        $constructors = Constructor::all();
        return view('team.editTeam', compact('team', 'constructors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'bg_image'=> 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->logo!=null && $request->bg_image!=null){

            $logoName = $request->logo->getClientOriginalName().'-'.time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images/team-logo'), $logoName);

            $imgName = $request->bg_image->getClientOriginalName().'-'.time().'.'.$request->bg_image->extension();
            $request->bg_image->move(public_path('images/team-back'), $imgName);

            $team->update([
                'name'=> $request->name,
                'principal' => $request->principal,
                'engine'=> $request->engine,
                'entry'=> $request->entry,
                'logo'=> $logoName,
                'bg_image'=> $imgName,
                'updated_by' => $request->updated_by,
            ]);
        }
        else if($request->logo!=null){
            $logoName = $request->logo->getClientOriginalName().'-'.time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images/team-logo'), $logoName);

            $team->update([
                'name'=> $request->name,
                'principal' => $request->principal,
                'engine'=> $request->engine,
                'entry'=> $request->entry,
                'logo'=> $logoName,
                'updated_by' => $request->updated_by,
            ]);
        }
        else if ($request->bg_image!=null){
            $imgName = $request->bg_image->getClientOriginalName().'-'.time().'.'.$request->bg_image->extension();
            $request->bg_image->move(public_path('images/team-back'), $imgName);

            $team->update([
                'name'=> $request->name,
                'principal' => $request->principal,
                'engine'=> $request->engine,
                'entry'=> $request->entry,
                'bg_image'=> $imgName,
                'updated_by' => $request->updated_by,
            ]);
        }
        else{
            $team->update([
                'name'=> $request->name,
                'principal' => $request->principal,
                'engine'=> $request->engine,
                'entry'=> $request->entry,
                'updated_by' => $request->updated_by,
            ]);
        }
        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
        } catch (\Throwable $th) {
            return view('team.error');
        }

        return redirect()->back();
    }
}
