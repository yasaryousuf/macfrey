@extends('frontend.layouts.master')
@section('content')
@include('frontend.includes.slider')
<main>
    <div class="ym-wrapper">
        <!--CONTENT_begin-->
        <div class="ym-grid">
            <div class="ym-g33 ym-gl">
                <div class="ym-gbox">
                    <div class="teaser">
                        <span class="bigicon"><span class="papicon_ballon"></span></span>
                        <h2>News</h2>
                        <p>
                            <p class="bodytext">Here you find all news about our products, events and current developments.</p>
                        </p>

                        <a class="linkcontent" href="../news.html"><i class="papicon_rightsmal"></i>read more</a>

                    </div>
                </div>
            </div>
            <div class="ym-g33 ym-gl">
                <div class="ym-gbox">
                    <div class="teaser">
                        <span class="bigicon"><span class="papicon_home"></span></span>
                        <h2>About Bafang</h2>
                        <p>
                            <p class="bodytext">BAFANG is a manufacturer of e-mobility components and complete systems and sells its products internationally.</p>
                        </p>

                        <a class="linkcontent" href="../company/about-bafang.html"><i class="papicon_rightsmal"></i>read more</a>

                    </div>
                </div>
            </div>
            <div class="ym-g33 ym-gr">
                <div class="ym-gbox">
                    <div class="teaser">
                        <span class="bigicon"><span class="papicon_user"></span></span>
                        <h2>Bafang philosophy</h2>
                        <p>
                            <p class="bodytext">BAFANG faces up to the global trends of the future: an increased demand for mobility, individualised infrastructure solutions, changing demands for vehicle usage as well as an increased demand for service and support.</p>
                        </p>

                        <a class="linkcontent" href="../company/philosophy.html"><i class="papicon_rightsmal"></i>read more</a>

                    </div>
                </div>
            </div>
        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection