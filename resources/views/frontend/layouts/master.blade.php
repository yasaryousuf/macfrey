<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Bafang description">
    <meta name="keywords" content="Bafang, Motor, hmi">
    <meta name="author" content="Bafang">

    <link rel="stylesheet" href="{{asset('frontend/css/custom-style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <script src="{{asset('frontend/js/script-0b.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://www.bafang-e.com/typo3conf/ext/cl_jquery_fancybox/Resources/Public/CSS/jquery.fancybox.css?1445435578" media="screen">

    <link rel="stylesheet" href="https://www.bafang-e.com/typo3conf/ext/paprallaxslider/Resources/Public/Css/paprallaxslider.css" type="text/css">
    <script type="text/javascript" src="https://www.bafang-e.com/typo3conf/ext/paprallaxslider/Resources/Public/Js/jquery.fractionslider.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('.slider').fractionSlider({
                'fullWidth': true,
                'controls': true,
                'pager': true,
                'responsive': true,
                'dimensions': '980,620',
                'timeout': 4000,
                'speedIn': 1000,
                'speedOut': 1500,
                'slideTransitionSpeed': 800,
                'slideEndAnimation': false
            });

        });
    </script>
    <link type="image/png" href="/fileadmin/templates/img/favicon/favicon_32x32.png" rel="shortcut icon">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-72x72-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-76x76-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-114x114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-120x120-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-144x144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="/fileadmin/templates/img/favicon/apple-touch-icon-152x152-precomposed.html">
    <meta name="google-site-verification" content="p40D-Sv60UHgC8tetpKXa6u3Cq_zmwckYlZ3N80MK2U" />
    <title>BAFANG &#x007C;&nbsp;Start&nbsp;&#x007C;</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    {{--
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136125592-1"></script> --}}

    <script>
        //   window.dataLayer = window.dataLayer || [];
        //   function gtag(){dataLayer.push(arguments);}
        //   gtag('js', new Date());
        //   gtag('config', 'UA-136125592-1');
    </script>
    <script type="text/javascript">
        /* <![CDATA[ */
        //    function getInquiries() {
        //    	    //check inquiry
        // 		jQuery.ajax({
        // 		    url: "index.php?type=896571",               
        // 		    type: "POST", 
        // 		    dataType: "json",
        // 		    cache: false,             
        // 		    data: {
        // 		    	tx_bafangdb_inquiry: {
        // 				      action : "ajax",
        // 				      controller : "Inquiry",
        // 				      task : "countinquiries"
        // 		    	},
        // 		    },
        // 		    success: function(response) {
        // 		   	    jQuery('#inquiries').html(response);   	
        // 			},
        // 			complete: function(){

        // 			},
        // 			error: function(response) {
        // 				jQuery('#inquiries').html(0);   	
        // 			}
        // 		});
        //    };
        /* ]]> */
    </script>
</head>

<body>
    <ul class="ym-skiplinks">
        <li><a class="ym-skip" href="3.html#nav">Skip to navigation (Press Enter)</a></li>
        <li><a class="ym-skip" href="3.html#main">Skip to main content (Press Enter)</a></li>
    </ul>

    @include('frontend.includes.header') 
    @yield('content')

    @include('frontend.includes.footer')
    <script src="{{asset('frontend/js/script-a3.js')}}"></script>
    <script src="{{asset('frontend/js/script-ed.js')}}"></script>
    {{-- <script src="{{asset('frontend/js/slider.js')}}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script> --}}
    @yield('script')

</body>

</html>