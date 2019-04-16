@extends('frontend.layouts.master')

@section('content')
<div id="breadcrumb" class="lightgrey">
	<div class="ym-wrapper">
		<div id="breadcrumbcontent">
			<!--BREADCRUMB_begin-->
        <ul><li><a href="/"><i class="papicon_homefull"></i></a></li><li><a href="company/contact">Company</a></li><li><a href="/company/{{$company->slug}}">{{$company->name}}</a></li></ul>
		    <!--BREADCRUMB_end-->
		</div>
	</div>
</div>
<!--TYPO3SEARCH_begin-->
<main>
	<div class="ym-wrapper">
		<div class="ym-grid"><div class="ym-g66 ym-gl"><div class="ym-gbox">
		<!--CONTENT_begin-->
            <div class="csc-header csc-header-n1"><h2 class="csc-firstHeader">{{$company->name}}</h2></div>
            {!! $company->content !!}
        </div></div></div>
		<!--CONTENT_end-->
        @if (Request::is('company/contact') || Request::is('company/after-sales-support'))
            @include('frontend.contact.form')
        @endif
	</div>
</main>
@endsection