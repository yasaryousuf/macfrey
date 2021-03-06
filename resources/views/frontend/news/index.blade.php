@extends('frontend.layouts.master')
@section('content')
<div id="breadcrumb" class="lightgrey">
    <div class="ym-wrapper">
        <div id="breadcrumbcontent">
            <!--BREADCRUMB_begin-->
            <ul>
                <li><a href="/"><i class="papicon_homefull"></i></a></li>
                <li><a href="/news">News</a></li>
            </ul>
            <!--BREADCRUMB_end-->
        </div>
    </div>
</div>
<main>
    <div class="ym-wrapper">
        <!--CONTENT_begin-->
        <div class="ym-grid">
            <div class="ym-g66 ym-gl">
                <div class="ym-gbox">
                    <div class="csc-header csc-header-n1">
                        <h2 class="csc-firstHeader">NEWS</h2></div>
                    <p class="bodytext">Here you find all news about our products, events and current developments.
                        <br />
                        <br />
                    </p>

                    <div class="news">

                        <div class="news-list-view">
                            <div class="page-navigation">
                            {{ $news->links('pagination.default') }}
                            </div>


                            <div class="news-clear"></div>

                            {{-- SINGLE NEWS --}}

                            @foreach ($news as $singleNews)
                                <div class="article articletype-0">

                                    <div class="ym-g25 ym-gl">

                                        <div class="news-img-wrap">

                                            <a href="{{url("/news/{$singleNews->slug}")}}">

                                                <img src="{{$singleNews->thumbnail ? asset('/images/news/thumbnails/'. $singleNews->thumbnail ) : asset('/images/No_Image.svg')}}" width="214" height="136" alt="">

                                            </a>

                                        </div>

                                    </div>
                                    <div class="ym-g75 ym-gr">
                                        <!-- date -->
                                        <span class="news-list-date">
                                        {{date('d/m/Y', strtotime($singleNews->created_at))}}
                                    </span>

                                        <!-- header -->
                                        <h3>
                                        <a href="{{url("/news/{$singleNews->slug}")}}">
                                            {{$singleNews->title}}
                                        </a>
                                    </h3>

                                        <!-- teas=ser text -->
                                        <div class="teaser-text">
                                            <?= substr($singleNews->content,0,260) ?>...

                                            <br>
                                            <br>

                                            <a class="more button cicolor" href="{{url("/news/{$singleNews->slug}")}}">
                                            Read more
                                        </a>
                                        </div>

                                    </div>
                                </div>
                                    
                            @endforeach

                            {{-- SINGLE NEWS ENDS --}}

  
                            <div class="page-navigation">
                            {{ $news->links('pagination.default') }}
                            </div>

                            <div class="news-clear"></div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="ym-g33 ym-gr">
                <div class="ym-gbox"></div>
            </div>
        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection