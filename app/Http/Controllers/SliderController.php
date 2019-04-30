<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name = '';
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('image'))
        {
            $image  = $request->file('image');
            $image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/slider/', $image_name);  
        }

        $Slider = new Slider();
        $Slider->title = $request->title;
        $Slider->subtitle = $request->subtitle;
        $Slider->url = $request->link;
        if ($image_name) {
            $Slider->image = $image_name;
        }
        $Slider->save();

        return back()->with('message', 'Successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id); 
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $image_name = '';
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('image'))
        {
            $image  = $request->file('image');
            $image_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/slider/', $image_name);  
        }

        $Slider = Slider::find($id);
        $Slider->title = $request->title;
        $Slider->subtitle = $request->subtitle;
        $Slider->url = $request->link;
        if ($image_name) {
            $Slider->image = $image_name;
        }
        $Slider->save();

        return back()->with('message', 'Successfully saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
  
        return back()->with('success','Slider deleted successfully');
    }
}
