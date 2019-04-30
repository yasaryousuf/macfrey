
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<!-- 
	Concept and Implementation by Papenfuss | Atelier für Gestaltung, www.atelierpapenfuss.de

	This website is powered by TYPO3 - inspiring people to share!
	TYPO3 is a free open source Content Management Framework initially created by Kasper Skaarhoj and licensed under GNU/GPL.
	TYPO3 is copyright 1998-2019 of Kasper Skaarhoj. Extensions are copyright of their respective owners.
	Information and contribution at https://typo3.org/
-->

{{-- <base href="https://www.bafang-e.com/"> --}}


<meta name="generator" content="TYPO3 CMS">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="robots" content="index,follow">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="description" content="Bafang description">
<meta name="author" content="Bafang">
<meta name="keywords" content="Bafang, Motor, hmi">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta property="og:title" content="OEM Area">


<link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/frontend/css/style.css" media="all">



<script src="{{asset('/frontend/home/js/script-bf4.js')}}" type="text/javascript"></script>

<script src="{{asset('/frontend/home/js/script-f3d.js')}}" type="text/javascript"></script>



<link rel="stylesheet" href="{{asset('/frontend/home/css/paprallaxslider.css')}}" type="text/css">
<script type="text/javascript" src="{{asset('/frontend/home/js/jquery.fractionslider.js')}}" charset="utf-8"></script>
<script type="text/javascript">
						$(window).load(function(){
							$('.slider').fractionSlider({
								'fullWidth': 			true,
								'controls': 			true, 
								'pager': 				true,
								'responsive': 		true,
								'dimensions': 		'980,620',
								'timeout' : 4000,
								'speedIn' : 1000,
								'speedOut' : 1500,
								'slideTransitionSpeed' : 800,
								'slideEndAnimation' : false
							});
						
						});
						</script>
  <!--[if IE 8 ]> <html class="ie8" lang="DE-de"> <![endif]-->
  <!--[if IE 7 ]> <html class="ie7" lang="DE-de"> <![endif]-->
  <!--[if lte IE 7]>
  <link href="../../yaml/core/iehacks.css" rel="stylesheet" type="text/css" />
  <![endif]-->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <link href="/fileadmin/templates/css/patches/ie.css" rel="stylesheet" type="text/css" />
  <![endif]-->
  <!-- [if (gte IE 9) & (!IEMobile)]
  <script src="../../js/lib/selectivizr.js"></script>
  <![endif]--><link type="image/png" href="/fileadmin/templates/img/favicon/favicon_32x32.png" rel="shortcut icon"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-72x72-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-76x76-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-114x114-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-120x120-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-144x144-precomposed.png"><link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-152x152-precomposed.png"><meta name="google-site-verification" content="p40D-Sv60UHgC8tetpKXa6u3Cq_zmwckYlZ3N80MK2U" /><title>BAFANG &#x007C;&nbsp;OEM Area&nbsp;&#x007C;</title><!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136125592-1"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-136125592-1');
</script>

</head>
<body>

<ul class="ym-skiplinks">
    <li><a class="ym-skip" href="#nav">Skip to navigation (Press Enter)</a></li>
    <li><a class="ym-skip" href="#main">Skip to main content (Press Enter)</a></li>
</ul>
@include('frontend.includes.header')

{{-- SLIDER --}}
<div id="fullslider">
    <div class="ym-wrapper">

        <div class="slider">
            @foreach ($sliders as $slider)
                <div class="slide" style="display:none;" data-in="scrollLeft" id="2" data-color="#FF9822">
                <img src="{{asset('/images/slider/')}}/{{$slider->image}}" data-fixed="" alt="" title="" />

                    <div class="claim" data-position="0,20" data-in="right" data-step="0" data-out="left">

                        <h1>{{$slider->title}}</h1>
                        <span>{{$slider->subtitle}}</span>

                        <a href="{{$slider->url}}" class="linkcontent">
                            <i class="papicon_rightsmal"></i> read more
                        </a>

                    </div>

                </div>
            @endforeach

            <div class="fs_loader"></div>
        </div>
        <!--SLIDER_end-->
    </div>
</div>
{{-- SLIDER ENDS --}}

        <div id="quicklinks">
            <div class="ym-wrapper">
                <div class="ym-qlist">
                    <!--QUICKLINKS_begin-->
                    <ul>
<li class="">
	<a class="preventdefault " style="cursor: pointer;">Components</a>
	<ul>
		
			<li class="">
			<a href="/en/oem-area/components/motor/">
			<i class="orange icon">
				<span class="papicon_motor"></span>
			</i>
			<span class="category-title">
			Motor
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/hmi/">
			<i class="yellow icon">
				<span class="papicon_hmi"></span>
			</i>
			<span class="category-title">
			HMI
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/battery/">
			<i class="green icon">
				<span class="papicon_battery"></span>
			</i>
			<span class="category-title">
			Battery
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/sensor/">
			<i class="turquoise icon">
				<span class="papicon_sensor"></span>
			</i>
			<span class="category-title">
			Sensor
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/controller/">
			<i class="lightblue icon">
				<span class="papicon_controller"></span>
			</i>
			<span class="category-title">
			Controller
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/connector/">
			<i class="blue icon">
				<span class="papicon_connector"></span>
			</i>
			<span class="category-title">
			Connector
			</span>
			</a>
			</li>
		
			<li class="">
			<a href="/en/oem-area/components/accessories/">
			<i class="lightgrey icon">
				<span class="papicon_accessories"></span>
			</i>
			<span class="category-title">
			Accessories
			</span>
			</a>
			</li>
		
	</ul>
</li>

<li class="">
	<a href="/en/oem-area/drive-systems/">Drive systems</a>
	
</li>
<li><a href="/en/oem-area/company/about-bafang/">Company</a><ul><li><a href="/en/oem-area/company/about-bafang/">About Bafang</a></li><li><a href="/en/oem-area/company/philosophy/">Philosophy</a></li><li><a href="/en/oem-area/company/quality/">Quality</a></li></ul></li><li><a href="/en/oem-area/service/contact/">Service</a><ul><li><a href="/en/oem-area/service/besst/">BESST</a></li><li><a href="/en/oem-area/service/faqs/">FAQs</a></li><li><a href="/en/oem-area/service/glossary/">Glossary</a></li><li><a href="/en/oem-area/service/press/">Press</a></li><li><a href="/en/oem-area/service/contact/">Contact</a></li><li><a href="/en/oem-area/service/after-sales-support/">After sales support</a></li><li><a href="/en/oem-area/service/enquiry/">Enquiry</a></li><li><a href="/en/oem-area/service/warranty-policy/">Warranty Policy</a></li></ul></li><li><a href="/en/oem-area/news/">News</a></li><li><a href="/en/oem-area/downloads/">Downloads</a></li></ul>
                    <!--QUICKLINKS_end-->
                </div>
            </div>
        </div>
        <!--TYPO3SEARCH_begin-->
        <main>
            <div class="ym-wrapper">
                <!--CONTENT_begin-->
                <div class="ym-grid"><div class="ym-g33 ym-gl"><div class="ym-gbox"><div class="teaser">
	<span class="bigicon"><span class="papicon_ballon"></span></span>
	<h2>News</h2>
	<p><p class="bodytext">Here you find all news about our products, events and current developments.</p></p>
	
		<a class="linkcontent" href="/en/oem-area/news/"><i class="papicon_rightsmal"></i>read more</a>
	
</div></div></div><div class="ym-g33 ym-gl"><div class="ym-gbox"><div class="teaser">
	<span class="bigicon"><span class="papicon_home"></span></span>
	<h2>About Bafang</h2>
	<p><p class="bodytext">BAFANG is a manufacturer of e-mobility components and complete systems and sells its products internationally.</p></p>
	
		<a class="linkcontent" href="/en/oem-area/company/about-bafang/"><i class="papicon_rightsmal"></i>read more</a>
	
</div></div></div><div class="ym-g33 ym-gr"><div class="ym-gbox"><div class="teaser">
	<span class="bigicon"><span class="papicon_user"></span></span>
	<h2>Bafang philosophy</h2>
	<p><p class="bodytext">BAFANG faces up to the global trends of the future: an increased demand for mobility, individualised infrastructure solutions, changing demands for vehicle usage as well as an increased demand for service and support.</p></p>
	
		<a class="linkcontent" href="/en/oem-area/company/philosophy/"><i class="papicon_rightsmal"></i>read more</a>
	
</div></div></div></div>
                <!--CONTENT_end-->
            </div>
        </main>
    

<!--TYPO3SEARCH_end-->
@include('frontend.includes.footer')
<script src="{{asset('/frontend/home/js/script-de5.js')}}" type="text/javascript"></script>

	<script src="{{asset('/frontend/home/js/script-0e7.js')}}" type="text/javascript"></script>

<script type="text/javascript">
/*<![CDATA[*/
/*TS_inlineFooter*/
jQuery(document).ready(function() { jQuery('a[class*=lightbox],a[rel*=lightbox]').fancybox({		'speed' : 330,
		'loop' : true,
		'opacity' : 'auto',
		'margin' : [44, 0],
		'gutter' : 30,
		'infobar' : true,
		'buttons' : true,
		'slideShow' : true,
		'fullScreen' : true,
		'thumbs' : true,
		'closeBtn' : true,
		'smallBtn' : 'auto',

		'baseClass' : '',
		'slideClass' : '',
		'parentEl' : 'body',
		'touch' : true,
		'keyboard' : true,
		'focus' : true,
		'closeClickOutside' : true,

		'beforeShow' : function(opts) {
			this.title = (jQuery(this.group[this.index]).attr('title') != undefined ? jQuery(this.group[this.index]).attr('title') : jQuery(this.group[this.index]).find('img').attr('title'));
		}});  });

/*]]>*/
</script>


</body>
</html>