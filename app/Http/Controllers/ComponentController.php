<?php

namespace App\Http\Controllers;

use App\Component;
use Illuminate\Http\Request;
use App\ComponentCategory;
use App\ComponentImage;

use Illuminate\Support\Str;

class ComponentController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $componentCategories = ComponentCategory::whereNotNull('parent_id')->get();
        return view('admin.component.create', compact('componentCategories'));
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
            'description' => 'required',
            'dimension_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'white_image_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'white_image_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'black_image_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'black_image_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $Component = new Component();
        $Component->name = $request->name;
        $Component->slug = Str::slug($request->name);
        $Component->description = $request->description;
        $Component->save();

        $CoreDataArr = $request->core_data;
        $CoreDataArr['component_id'] = $Component->id;


        $CoreData = \App\CoreData::create($CoreDataArr);

        $MountingParameterArr = $request->mounting_parameters;
        $MountingParameterArr['component_id'] = $Component->id;

        $MountingParameter = \App\MountingParameter::create($MountingParameterArr);
        

        $FurtherSpecificationArr = $request->further_specifications;
        $FurtherSpecificationArr['component_id'] = $Component->id;

        $FurtherSpecification = \App\FurtherSpecification::create($FurtherSpecificationArr);


        $CertificationArr = $request->certification;
        $CertificationArr['component_id'] = $Component->id;

        $Certification = \App\Certification::create($CertificationArr);

        $DimensionArr = $request->dimension;
        $DimensionArr['component_id'] = $Component->id;
        $dimension_image_name = '';

        if($request->hasfile('dimension_image'))
        {
            $image  = $request->file('dimension_image');
            $dimension_image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/dimension/', $dimension_image_name);  
        }

        if ($dimension_image_name) {
            $DimensionArr['image'] = $dimension_image_name;
        }

        $Dimension = \App\Dimention::create($DimensionArr);

        if($request->hasfile('white_image_1'))
        {
            $image  = $request->file('white_image_1');
            $white_image_1_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/component_image/', $white_image_1_name); 
            $ComponentImage = new ComponentImage();
            $ComponentImage->image = $white_image_1_name;
            $ComponentImage->component_id = $Component->id;
            $ComponentImage->color = 'white';
            $ComponentImage->save();
        }

        if($request->hasfile('white_image_2'))
        {
            $image  = $request->file('white_image_2');
            $white_image_1_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/component_image/', $white_image_1_name); 
            $ComponentImage = new ComponentImage();
            $ComponentImage->image = $white_image_1_name;
            $ComponentImage->component_id = $Component->id;
            $ComponentImage->color = 'white';
            $ComponentImage->save();
        }

        if($request->hasfile('black_image_1'))
        {
            $image  = $request->file('black_image_1');
            $white_image_1_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/component_image/', $white_image_1_name); 
            $ComponentImage = new ComponentImage();
            $ComponentImage->image = $white_image_1_name;
            $ComponentImage->component_id = $Component->id;
            $ComponentImage->color = 'black';
            $ComponentImage->save();
        }

        if($request->hasfile('black_image_2'))
        {
            $image  = $request->file('black_image_2');
            $white_image_1_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/component_image/', $white_image_1_name);
            $ComponentImage = new ComponentImage();
            $ComponentImage->image = $white_image_1_name;
            $ComponentImage->component_id = $Component->id;
            $ComponentImage->color = 'black';
            $ComponentImage->save();
        }

        return back()->with('message', 'Saved successfully.');
    }

    public function componentImageUpload($request)
    {
        $image  = $request->file('white_image_1');
        $white_image_1_name   = time().'_'.$image->getClientOriginalName();
        $image->move(public_path().'/images/component_image/', $white_image_1_name); 
        return $white_image_1_name;        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Component  $component
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        //
    }
}
