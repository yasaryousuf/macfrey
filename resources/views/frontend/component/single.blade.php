@extends('frontend.layouts.master')

@section('content')
<div id="breadcrumb" class="breadcrumb-orange-context">
    <div class="ym-wrapper">
        <div id="breadcrumbcontent">
            <!--BREADCRUMB_begin-->
            <ul><li><a href="/"><i class="papicon_homefull"></i></a></li><li>Components</li>


                <li><a href="/components/{{$ComponentCategory->slug}}/">{{$ComponentCategory->name}}</a></li>
                
                <li>{{$component->name}}</li>
            </ul>
            <!--BREADCRUMB_end-->
        </div>
    </div>
</div>
<main>
    <div class="ym-wrapper">
        <!--CONTENT_begin-->
        <div class="loading">Loading…</div>

        <div class="tx-bafangdb">
            <div class="component-wrapper orange-context">

                <div class="productdetail">

                    <div class="detailheader">
                        <div class="productheader">
                            <div class="left">
                                <h1>
                                <span class="producttitle-bold">FM</span> {{$component->name}}
                            </h1>
                            </div>

                            <div class="right">

                                <span id="colorSelect">

                                                    <img class="active" id="colorButSliver" src="/fileadmin/Media/Colors/chrome.png" width="20" height="20" alt="">

                                                    <img id="colorButBlack" src="/fileadmin/templates/img/icons/material-schwarz.png" width="20" height="20" alt="">

                                </span>

                            </div>
                        </div>

                        <div class="bx-wrapper" style="max-width: 100%;">
                            <div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 500px;">
                                <div class="productslider" style="width: 415%; position: relative; transition-duration: 0s; transform: translate3d(-980px, 0px, 0px);">
                                    <div class="slide bx-clone" style="float: left; list-style: none; position: relative; width: 980px;">
                                        <img class="Sliver" src="/fileadmin/Media/Components/Motor/FM_G310.250.R-2.png" width="667" height="500" alt="">
                                    </div>

                                    <div class="slide" style="float: left; list-style: none; position: relative; width: 980px;">
                                        <img class="Sliver" src="/fileadmin/Media/Components/Motor/FM_G320.250.R.png" width="667" height="500" alt="">
                                    </div>
                                    <div class="slide" style="float: left; list-style: none; position: relative; width: 980px;">
                                        <img class="Sliver" src="/fileadmin/Media/Components/Motor/FM_G310.250.R-2.png" width="667" height="500" alt="">
                                    </div>
                                    <div class="slide bx-clone" style="float: left; list-style: none; position: relative; width: 980px;">
                                        <img class="Sliver" src="/fileadmin/Media/Components/Motor/FM_G320.250.R.png" width="667" height="500" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="bx-controls bx-has-controls-direction">
                                <div class="bx-controls-direction">
                                    <a class="bx-prev" href=""></a>
                                    <a class="bx-next" href=""></a>
                                </div>
                            </div>
                        </div>

                        <div class="productslider_content">

                            <div class="left">

                                <div id="bx-pager" class="thumbnails">

                                    <a href="#" data-slide-index="0" class="active">
                                        <img class="Sliver" src="/fileadmin/_processed_/b/6/csm_FM_G320.250.R_4f40ccb00c.png" width="267" height="200" alt="">
                                    </a>
                                    <a href="#" data-slide-index="1">
                                        <img class="Sliver" src="/fileadmin/_processed_/f/0/csm_FM_G310.250.R-2_b95ed9d89d.png" width="267" height="200" alt="">
                                    </a>
                                </div>

                            </div>

                            <div class="right">

                                <a class="lightbox" title="" data-fancybox-group="componentimages" href="/fileadmin/Media/Components/Motor/FM_G320.250.R.png">

                                    <span class="papicon_lensplus"></span>

                                </a>

                                <a class="lightbox" title="" data-fancybox-group="componentimages" href="/fileadmin/Media/Components/Motor/FM_G310.250.R-2.png">

                                </a>

                                <a class="lightbox" title="" data-fancybox-group="componentimages" href="/fileadmin/Media/Components/Motor/FM_G310.250-3.png">

                                </a>

                                <a class="lightbox" title="" data-fancybox-group="componentimages" href="/fileadmin/Media/Components/Motor/FM_G310.250-4.png">

                                </a>

                            </div>

                            <div style="clear:both;"></div>

                        </div>

                    </div>

                    <div class="detailcontent">
                        <br>

                        <p class="bodytext">
                            {{$component->description}}
                        </p>

                        <div class="productdetailspecs">
                            <div class="specs">

                                <h3>
                                Specifications
                            </h3>
                                <div>
                                    @if ($component->core_data)
                                        <div class="specslist">

                                            <h4>Core Data</h4>
                                            <table>
                                                <tbody>
                                                    @if ($component->core_data->position)
                                                    <tr>
                                                        <td>Position</td>
                                                        <td>{{$component->core_data->position}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->wheel_diameter)
                                                    <tr>
                                                        <td>Wheel Diameter (Inch)</td>
                                                        <td>{{$component->core_data->wheel_diameter}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->construction)
                                                    <tr>
                                                        <td>Construction</td>
                                                        <td>{{$component->core_data->construction}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->rated_voltage)
                                                    <tr>
                                                        <td>Rated Voltage (DCV)</td>
                                                        <td>{{$component->core_data->rated_voltage}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->n0)
                                                    <tr>
                                                        <td>n0 (Rpm)</td>
                                                        <td>{{$component->core_data->n0}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->rated_power)
                                                    <tr>
                                                        <td>Rated Power (W)</td>
                                                        <td>{{$component->core_data->rated_power}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->nT)
                                                    <tr>
                                                        <td>nT(Rpm)</td>
                                                        <td>{{$component->core_data->nT}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->max_torque)
                                                    <tr>
                                                        <td>Max Torque</td>
                                                        <td>{{$component->core_data->max_torque}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->efficiency)
                                                    <tr>
                                                        <td>Efficiency (%)</td>
                                                        <td>{{$component->core_data->efficiency}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->color)
                                                    <tr>
                                                        <td>Color</td>
                                                        <td>{{$component->core_data->color}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->weight)
                                                    <tr>
                                                        <td>Weight (kg)</td>
                                                        <td>{{$component->core_data->weight}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->noise_grade)
                                                    <tr>
                                                        <td>Noise Grade (dB)</td>
                                                        <td>{{$component->core_data->noise_grade}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->operating_temperature)
                                                    <tr>
                                                        <td>Operating Temperature</td>
                                                        <td>{{$component->core_data->operating_temperature}}</td>
                                                    </tr>
                                                    @endif
                                                    @if ($component->core_data->suitability)
                                                    <tr>
                                                        <td>Suitability</td>
                                                        <td>{{$component->core_data->suitability}}</td>
                                                    </tr>
                                                    @endif

                                                </tbody>
                                            </table>

                                        </div>
                                    @endif


                                    @if ($component->mounting_parameter)
                                        <div class="specslist">

                                            <h4>Mounting Parameters</h4>
                                            <table>
                                                <tbody>

                                                    @if ($component->mounting_parameter->brake)
                                                    <tr>
                                                        <td>Brake</td>
                                                        <td>{{$component->mounting_parameter->brake}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->mounting_parameter->installation_widths)
                                                    <tr>
                                                        <td>Installation Widths (mm / OLD)</td>
                                                        <td>{{$component->mounting_parameter->installation_widths}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->mounting_parameter->max_housing_diameter)
                                                    <tr>
                                                        <td>Max. Housing Diameter (mm)</td>
                                                        <td>{{$component->mounting_parameter->max_housing_diameter}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->mounting_parameter->cabling_route)
                                                    <tr>
                                                        <td>Cabling Route</td>
                                                        <td>{{$component->mounting_parameter->cabling_route}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->mounting_parameter->cable_length)
                                                    <tr>
                                                        <td>Cable Length(mm), Connection Type</td>
                                                        <td>{{$component->mounting_parameter->cable_length}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->mounting_parameter->spoke_specification)
                                                    <tr>
                                                        <td>Spoke Specification</td>
                                                        <td>{{$component->mounting_parameter->spoke_specification}}</td>
                                                    </tr>
                                                    @endif


                                                </tbody>
                                            </table>

                                        </div>
                                    @endif

                                    @if ($component->further_specification)
                                        <div class="specslist">
                                            <h4>Further Specifications</h4>
                                            <table>
                                                <tbody>


                                                    @if ($component->further_specification->speed_detection_signal)
                                                    <tr>
                                                        <td>Speed Detection Signal (Pulses/Cycle)</td>
                                                        <td>{{$component->further_specification->speed_detection_signal}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->further_specification->reduction_ratio)
                                                    <tr>
                                                        <td>Reduction Ratio</td>
                                                        <td>{{$component->further_specification->reduction_ratio}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->further_specification->magnet_poles)
                                                    <tr>
                                                        <td>Magnet Poles (2P)</td>
                                                        <td>{{$component->further_specification->magnet_poles}}</td>
                                                    </tr>
                                                    @endif

                                                </tbody>
                                            </table>

                                        </div>
                                    @endif

                                    @if ($component->certification)
                                        <div class="specslist">

                                            <h4>Tests &amp; Certifications</h4>
                                            <table>
                                                <tbody>

                                                    @if ($component->certification->ip)
                                                    <tr>
                                                        <td>IP</td>
                                                        <td>{{$component->certification->ip}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->certification->certifications)
                                                    <tr>
                                                        <td>Certifications</td>
                                                        <td>{{$component->certification->certifications}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->certification->salt_spray_test_standard)
                                                    <tr>
                                                        <td>Salt Spray Test Standard(h)</td>
                                                        <td>{{$component->certification->salt_spray_test_standard}}</td>
                                                    </tr>
                                                    @endif


                                                </tbody>
                                            </table>

                                        </div>
                                    @endif
                                </div>

                            </div>

                            @if ($component->dimention)
                                <div class="measur">

                                        <?php
                                        // echo '<pre>';
                                        //     print_r($component->dimention->toArray());
                                        // echo '</pre>';
                                        ?> 

                                    <h3>
                                                Dimensions
                                            </h3>

                                    <div>

                                        <img src="{{$component->dimention->image ? asset('/images/dimension/'.$component->dimention->image) : asset('/images/No_Image.svg')}}" width="500" height="500" alt="">

                                        <div>
                                            <table>
                                                <tbody>


                                                    @if ($component->dimention->A)
                                                    <tr>
                                                        <td>Dimension A</td>
                                                        <td>{{$component->dimention->A}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->B)
                                                    <tr>
                                                        <td>Dimension B</td>
                                                        <td>{{$component->dimention->B}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->C)
                                                    <tr>
                                                        <td>Dimension C</td>
                                                        <td>{{$component->dimention->C}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->D)
                                                    <tr>
                                                        <td>Dimension D</td>
                                                        <td>{{$component->dimention->D}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->E)
                                                    <tr>
                                                        <td>Dimension E</td>
                                                        <td>{{$component->dimention->E}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->F)
                                                    <tr>
                                                        <td>Dimension F</td>
                                                        <td>{{$component->dimention->F}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->G)
                                                    <tr>
                                                        <td>Dimension G</td>
                                                        <td>{{$component->dimention->G}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->H)
                                                    <tr>
                                                        <td>Dimension H</td>
                                                        <td>{{$component->dimention->H}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->I)
                                                    <tr>
                                                        <td>Dimension I</td>
                                                        <td>{{$component->dimention->I}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->J)
                                                    <tr>
                                                        <td>Dimension J</td>
                                                        <td>{{$component->dimention->J}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->K)
                                                    <tr>
                                                        <td>Dimension K</td>
                                                        <td>{{$component->dimention->K}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->wl)
                                                    <tr>
                                                        <td>Dimension WL</td>
                                                        <td>{{$component->dimention->wl}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->wr)
                                                    <tr>
                                                        <td>Dimension WR</td>
                                                        <td>{{$component->dimention->wr}}</td>
                                                    </tr>
                                                    @endif

                                                    @if ($component->dimention->old)
                                                    <tr>
                                                        <td>Dimension OLD</td>
                                                        <td>{{$component->dimention->old}}</td>
                                                    </tr>
                                                    @endif



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                        </div>


                        <div class="ym-clearfix"></div>
                        <br>
                        <a class="button back"  href="/components/{{$ComponentCategory->slug}}/">
                        Back to
                        {{$ComponentCategory->name}}
                    </a>

                    </div>


                </div>



            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#breadcrumb').attr('class', 'breadcrumb-orange-context');
                    $('#topproducts-slider').attr('class', 'orange');
                });
            </script>

        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection