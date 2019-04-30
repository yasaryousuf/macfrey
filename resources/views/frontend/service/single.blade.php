@extends('frontend.layouts.master')

@section('content')
<div id="breadcrumb" class="lightgrey">
	<div class="ym-wrapper">
		<div id="breadcrumbcontent">
			<!--BREADCRUMB_begin-->
        <ul><li><a href="/"><i class="papicon_homefull"></i></a></li><li><a href="service/contact">Service</a></li><li><a href="/service/{{$service->slug}}">{{$service->name}}</a></li></ul>
		    <!--BREADCRUMB_end-->
		</div>
	</div>
</div>
<!--TYPO3SEARCH_begin-->
<main>
	<div class="ym-wrapper">
		<!--CONTENT_begin-->
            <div class="csc-header csc-header-n1"><h2 class="csc-firstHeader">{{$service->name}}</h2></div>
            {!! $service->content !!}
		<!--CONTENT_end-->
        @if (Request::is('service/contact') || Request::is('service/after-sales-support') || Request::is('service/enquiry'))
            @include('frontend.contact.form')
        @endif
	</div>
</main>
@endsection