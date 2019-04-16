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
<!--TYPO3SEARCH_begin-->
<main>
    <div class="ym-wrapper">
        <!--CONTENT_begin-->
        <div class="ym-grid">
            <div class="ym-g66 ym-gl">
                <div class="ym-gbox">

                    <div class="news news-single">
                        <div class="article">

                            <!-- date -->
                            <span class="news-list-date">
				{{date('d/m/Y', strtotime($news->created_at))}}
			</span>
                            <h2>{{$news->title}}</h2>


                            <!-- main text -->
                            <div class="news-text-wrap">
                                {!! $news->content !!}
                            </div>


                            <!-- Link Back -->
                            <div class="news-backlink-wrap">
                                <a href="/news">
						Back
					</a>
                            </div>

                            <!-- related things -->
                            <div class="news-related-wrap">

                            </div>

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