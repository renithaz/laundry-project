<?php

namespace App\Http\Controllers;

use App\Models\Level;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Level";
        $levels = Level::get(); //select * from users
        return view('level.index', compact('title', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Level";
        return view('level.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:levels,name',
        ]);

        //insert into users() values()
        Level::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Level created successfully');
        return redirect()->route('level.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit Level";
        $level = Level::find($id); 
        return view('level.edit', compact('title', 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:levels,name,' . $id,
            
        ]);

        $level = Level::find($id);
        $level->name = $request->name;
        $level->save();

        Alert::success('Success', 'Level updated successfully');
        return redirect()->route('level.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Level::find($id); 
        $level->delete();
        Alert::success('Success', 'User deleted successfully');
        return redirect()->route('level.index');
    }
}
