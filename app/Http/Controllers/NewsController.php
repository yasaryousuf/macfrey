<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(1);
        return view('frontend.news.index', compact('news'));
    }
    public function adminIndex()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thumbnail_name = '';
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('thumbnail'))
        {
            $image  = $request->file('thumbnail');
            $thumbnail_name   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/news/thumbnails/', $thumbnail_name);  
        }

        $News = new News();
        $News->title = $request->title;
        $News->slug = Str::slug($request->title);
        $News->content = $request->content;
        if ($thumbnail_name) {
            $News->thumbnail = $thumbnail_name;
        }
        $News->save();

        return back()->with('message', 'Successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('frontend.news.single', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id); 
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $thumbnail_name = '';
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('thumbnail'))
        {
            $image  = $request->file('thumbnail');
            $thumbnail_name   = $image->getClientOriginalName();
            $image->move(public_path().'/images/news/thumbnails/', $thumbnail_name);  
        }

        $News = News::find($id);
        $News->title = $request->title;
        $News->slug = Str::slug($request->title);
        $News->content = $request->content;
        if ($thumbnail_name) {
            $News->thumbnail = $thumbnail_name;
        }
        $News->save();

        return back()->with('message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
  
        return back()->with('success','Product deleted successfully');
    }
}
