<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $constructors = Constructor::all();
        return view('constructor.index', compact('constructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('constructor.addConstructor');
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
        ]);

        $imgName = $request->logo->getClientOriginalName().'-'.time().'.'.$request->logo->extension();
        $request->logo->move(public_path('images/constructor'), $imgName);

        Constructor::create([
            'name' => $request->name,
            'description'=> $request->description,
            'nation'=> $request->nation,
            'engine'=> $request->engine,
            'logo'=> $imgName,
            'created_by' => $request->created_by,
        ]);
        return redirect()->route('constructor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function show(Constructor $constructor)
    {
        return view('constructor.updateImage', compact('constructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Constructor $constructor)
    {
        $request->nation;
        $request->engine;
        return view('constructor.editConstructor', compact('constructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Constructor $constructor)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->logo){
            $imgName = $request->logo->getClientOriginalName().'-'.time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images/constructor'), $imgName);

            $constructor->update([
                'name' => $request->name,
                'description'=> $request->description,
                'nation'=> $request->nation,
                'engine'=> $request->engine,
                'logo' => $imgName,
                'updated_by' => $request->updated_by,
            ]);
        }
        else{
            $constructor->update([
                'name' => $request->name,
                'description'=> $request->description,
                'nation'=> $request->nation,
                'engine'=> $request->engine,
                'updated_by' => $request->updated_by,
            ]);
        }
        return redirect()->route('constructor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor  $constructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Constructor $constructor)
    {
        try {
            $constructor->delete();
        } catch (\Throwable $th) {
            return view('constructor.error');
        }

        return redirect()->back();
    }
}
