<?php

namespace App\Http\Controllers;

use App\DriveSystemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DriveSystemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function adminIndex()
    {
        $DriveSystemCategories = DriveSystemCategory::all();
        return view('admin.drive_system_category.index', compact('DriveSystemCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drive_system_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


        $DriveSystemCategory = new DriveSystemCategory();
        $DriveSystemCategory->name = $request->name;
        $DriveSystemCategory->slug = Str::slug($request->name);


        $DriveSystemCategory->save();

        return back()->with('message', 'Successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DriveSystemCategory  $driveSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DriveSystemCategory $driveSystemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DriveSystemCategory  $driveSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DriveSystemCategory = DriveSystemCategory::find($id); 
        return view('admin.drive_system_category.edit', compact('DriveSystemCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DriveSystemCategory  $driveSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'name' => 'required',
        ]);


        $DriveSystemCategory = DriveSystemCategory::find($id);
        $DriveSystemCategory->name = $request->name;
        $DriveSystemCategory->slug = Str::slug($request->name);

        $DriveSystemCategory->save();

        return back()->with('message', 'Successfully saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DriveSystemCategory  $driveSystemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DriveSystemCategory =  DriveSystemCategory::find($id);
        $DriveSystemCategory->delete();
  
        return back()->with('success','Deleted successfully');
    }
}
