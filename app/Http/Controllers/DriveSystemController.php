<?php

namespace App\Http\Controllers;

use App\ComponentCategory;
use App\DriveSystem;
use App\DriveSystemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DriveSystemController extends Controller
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
        $DriveSystems = DriveSystem::all();
        return view('admin.drive_system.index', compact('DriveSystems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $componentParentCategories = ComponentCategory::whereNull('parent_id')->get();
        foreach ($componentParentCategories as $componentParentCategory) {
            foreach ($componentParentCategory->children as $category ) {
                echo '<pre>';
                print_r($category->components);
            }
        }
        return;
        $DriveSystemCategories = DriveSystemCategory::all();
        return view('admin.drive_system.create', compact('DriveSystemCategories'));
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
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $DriveSystem = new DriveSystem();
        $DriveSystem->name = $request->name;
        $DriveSystem->slug = Str::slug($request->name);
        $DriveSystem->drive_system_category_id = $request->drive_system_category_id;

        $image_name = '';
        if($request->hasfile('image'))
        {
            $image  = $request->file('image');
            $image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/drive_system/', $image_name);  
        }

        if ($image_name) {
            $DriveSystem->image = $image_name;
        }

        $thumbnail_image_name = '';
        if($request->hasfile('thumbnail'))
        {
            $image  = $request->file('thumbnail');
            $thumbnail_image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/drive_system/', $thumbnail_image_name);  
        }

        if ($thumbnail_image_name) {
            $DriveSystem->thumbnail_image = $thumbnail_image_name;
        }


        $DriveSystem->save();

        return back()->with('message', 'Saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DriveSystem  $driveSystem
     * @return \Illuminate\Http\Response
     */
    public function show(DriveSystem $driveSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DriveSystem  $driveSystem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DriveSystemCategories = DriveSystemCategory::all();
        $DriveSystem = DriveSystem::find($id); 
        return view('admin.drive_system.edit', compact('DriveSystem', 'DriveSystemCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DriveSystem  $driveSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $DriveSystem = DriveSystem::find($id);
        $DriveSystem->name = $request->name;
        $DriveSystem->slug = Str::slug($request->name);
        $DriveSystem->drive_system_category_id = $request->drive_system_category_id;

        $image_name = '';
        if($request->hasfile('image'))
        {
            $image  = $request->file('image');
            $image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/drive_system/', $image_name);  
        }

        if ($image_name) {
            $DriveSystem->image = $image_name;
        }

        $thumbnail_image_name = '';
        if($request->hasfile('thumbnail'))
        {
            $image  = $request->file('thumbnail');
            $thumbnail_image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/drive_system/', $thumbnail_image_name);  
        }

        if ($thumbnail_image_name) {
            $DriveSystem->thumbnail_image = $thumbnail_image_name;
        }


        $DriveSystem->save();

        return back()->with('message', 'Saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DriveSystem  $driveSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DriveSystem = DriveSystem::find($id);
        $DriveSystem->delete();
  
        return back()->with('success','Product deleted successfully');
    }
}
