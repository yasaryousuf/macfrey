<?php

namespace App\Http\Controllers;

use App\ComponentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComponentCategoryController extends Controller
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
        $componentCategories = ComponentCategory::all();
        return view('admin.component_category.index', compact('componentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $componentCategories = ComponentCategory::whereNull('parent_id')->get();
        return view('admin.component_category.create', compact('componentCategories'));
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


        $ComponentCategory = new ComponentCategory();
        $ComponentCategory->name = $request->name;
        $ComponentCategory->slug = Str::slug($request->name);
        // if (!empty($request->parent_id)) {
            $ComponentCategory->parent_id = $request->parent_id;
        // }

        $ComponentCategory->save();

        return back()->with('message', 'Successfully saved.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComponentCategory  $componentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ComponentCategory $componentCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ComponentCategory  $componentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $componentCategories = ComponentCategory::whereNull('parent_id')->get();
        $componentCategory = ComponentCategory::find($id); 
        return view('admin.component_category.edit', compact('componentCategory', 'componentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComponentCategory  $componentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'name' => 'required',
        ]);


        $ComponentCategory = ComponentCategory::find($id);
        $ComponentCategory->name = $request->name;
        $ComponentCategory->slug = Str::slug($request->name);
        // if (!empty($request->parent_id)) {
            $ComponentCategory->parent_id = $request->parent_id;
        // }

        $ComponentCategory->save();

        return back()->with('message', 'Successfully saved.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComponentCategory  $componentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $componentCategory =  ComponentCategory::find($id);
        $componentCategory->delete();
  
        return back()->with('success','Product deleted successfully');
    }
}
