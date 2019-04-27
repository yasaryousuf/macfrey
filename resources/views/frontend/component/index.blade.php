@extends('frontend.layouts.master') @section('content')
<div id="breadcrumb" class="lightgrey">
    <div class="ym-wrapper">
        <div id="breadcrumbcontent">
            <!--BREADCRUMB_begin-->
            <ul>
                <li><a href="/"><i class="papicon_homefull"></i></a></li>
                <li>Components</li>

                <li>Motor</li>
            </ul>
            <!--BREADCRUMB_end-->
        </div>
    </div>
</div>
<!--TOPSLIDER_begin-->
{{-- @foreach ($components as $componentcategory => $component)
    <h1>{{$componentcategory}}</h1>
    @foreach ($component as $item)
    {!! '<pre>' !!}
        {{print_r($item)}}
    @endforeach
@endforeach --}}
<!--TOPSLIDER_end-->
<!--TYPO3SEARCH_begin-->
<main>
    <div class="ym-wrapper">
        <!--CONTENT_begin-->
        <div class="loading">Loading&#8230;</div>

        <div class="tx-bafangdb">

            <div class="component-wrapper orange-context">

                <div id="filter">

                    <form enctype="multipart/form-data" method="post" name="filter" class="filter" action="https://www.bafang-e.com/en/components/motor.html">
                        <div>
                            <input type="hidden" name="tx_bafangdb_component[__referrer][@extension]" value="Bafangdb" />
                            <input type="hidden" name="tx_bafangdb_component[__referrer][@vendor]" value="BAF" />
                            <input type="hidden" name="tx_bafangdb_component[__referrer][@controller]" value="Product" />
                            <input type="hidden" name="tx_bafangdb_component[__referrer][@action]" value="list" />
                            <input type="hidden" name="tx_bafangdb_component[__referrer][arguments]" value="YToyOntzOjg6ImNhdGVnb3J5IjtzOjE6IjEiO3M6NzoicHJvZHVjdCI7czowOiIiO30=23d401c1244a5d221d11434ac860ec5823dbb41d" />
                            <input type="hidden" name="tx_bafangdb_component[__referrer][@request]" value="a:4:{s:10:&quot;@extension&quot;;s:8:&quot;Bafangdb&quot;;s:11:&quot;@controller&quot;;s:7:&quot;Product&quot;;s:7:&quot;@action&quot;;s:4:&quot;list&quot;;s:7:&quot;@vendor&quot;;s:3:&quot;BAF&quot;;}995c4d354f8279f1770893a056bddb8596b1a1c1" />
                            <input type="hidden" name="tx_bafangdb_component[__trustedProperties]" value="a:2:{s:11:&quot;resetfilter&quot;;i:1;s:7:&quot;filters&quot;;a:1:{s:8:&quot;property&quot;;a:4:{i:1;i:1;i:16;i:1;i:15;i:1;i:13;i:1;}}}d3ff9a144f5faa6b4e8d86398170e9d5c83f3004" />
                        </div>

                        <div class="ym-grid">
                            <div class="ym-g50 ym-gl">
                                <h2>Filter</h2>
                            </div>
                            <div class="ym-g50 ym-gr">
                                <input id="resetfilter" type="submit" name="tx_bafangdb_component[resetfilter]" value="clear filter" />
                            </div>
                        </div>
                        <div class="ym-grid">

                            <div class="ym-g25 ym-gl">
                                <label for="filters-property-1">Position</label>
                                <div class="field_select">

                                    <select id="filters-property-1" name="tx_bafangdb_component[filters][property][1]">
                                        <option value="-1">all</option>
                                        <option value="Front / Rear Motor">Front / Rear Motor</option>
                                        <option value="Front Motor">Front Motor</option>
                                        <option value="Mid Motor">Mid Motor</option>
                                        <option value="Rear Motor">Rear Motor</option>
                                    </select>

                                </div>
                            </div>

                            <div class="ym-g25 ym-gl">
                                <label for="filters-property-16">Rated Power (W)</label>
                                <div class="field_select">

                                    <select id="filters-property-16" name="tx_bafangdb_component[filters][property][16]">
                                        <option value="-1">all</option>
                                        <option value="200">200</option>
                                        <option value="220">220</option>
                                        <option value="250">250</option>
                                        <option value="250/350">250/350</option>
                                        <option value="250;350;500">250;350;500</option>
                                        <option value="350">350</option>
                                        <option value="350/500">350/500</option>
                                        <option value="350;500">350;500</option>
                                        <option value="500">500</option>
                                        <option value="750">750</option>
                                        <option value="1000">1000</option>
                                        <option value="750/1000">750/1000</option>
                                    </select>

                                </div>
                            </div>

                            <div class="ym-g25 ym-gl">
                                <label for="filters-property-15">Rated Voltage (DCV)</label>
                                <div class="field_select">

                                    <select id="filters-property-15" name="tx_bafangdb_component[filters][property][15]">
                                        <option value="-1">all</option>
                                        <option value="24/36/43">24/36/43</option>
                                        <option value="36/43">36/43</option>
                                        <option value="36/43/48">36/43/48</option>
                                        <option value="36/48">36/48</option>
                                        <option value="43/48">43/48</option>
                                        <option value="48">48</option>
                                        <option value="48/52">48/52</option>
                                    </select>

                                </div>
                            </div>

                            <div class="ym-g25 ym-gl">
                                <label for="filters-property-13">Brake</label>
                                <div class="field_select">

                                    <select id="filters-property-13" name="tx_bafangdb_component[filters][property][13]">
                                        <option value="-1">all</option>
                                        <option value="Disc Brake">Disc Brake</option>
                                        <option value="Disc-Brake">Disc-Brake</option>
                                        <option value="Roller Brake">Roller Brake</option>
                                        <option value="Roller-Brake">Roller-Brake</option>
                                        <option value="V Brake">V Brake</option>
                                        <option value="V Brake /Disc Brake">V Brake /Disc Brake</option>
                                        <option value="V-Brake">V-Brake</option>
                                        <option value="V-Brake/Disc-Brake">V-Brake/Disc-Brake</option>
                                    </select>

                                </div>
                            </div>

                        </div>

                    </form>
                    <br>
                    <br>
                </div>

                <span id="langlabel-seeall">see all</span>
                <span id="langlabel-collapse">collapse</span>

<!--TOPSLIDER_begin-->
            @foreach ($components as $componentcategory => $component)
    {{-- {!! '<pre>' !!}
        {{print_r($components)}} --}}
                <div class="list listprod">
                    <div class="header">

                        <img class="svg" src="../../fileadmin/templates/img/icons/icon-frontmotor.svg" width="0" height="0" alt="" />

                        <h2>{{$componentcategory}}</h2>

                    </div>
                    <div class="content">

                    @foreach ($component as $item)
                        <div class="product equalheights">

                            <a href="{{$parentCategory}}/{{$item->slug}}">

                                <div class="productimage">
                                    @if (!empty($item->is_top))
                                    <div class="istopproduct"><strong>Top</strong>
                                        <br><span> Product</span></div>
                                        
                                    @endif
                                    <?php

                                    if ($item->images->first()) : 
                                        $imageUrl = '/images/component_image/'.$item->images[0]->image;
                                    else :
                                        $imageUrl = '/images/No_Image.svg';
                                    endif;
                                    ?>
                                    <img class="Sliver" src="{{asset($imageUrl)}}" width="401" height="300" alt="" />

                                </div>

                                <div class="productcontent">
                                <h4>{{$item->name}}</h4>

                                    <table>
                                        <tbody>

                                            <tr>
                                                <td class="propertytitle">Construction</td>
                                                <td class="propertydescription"><strong>{{$item->core_data->construction}}</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="propertytitle">Rated Power (W)</td>
                                                <td class="propertydescription"><strong>{{$item->core_data->rated_power}}</strong></td>
                                            </tr>

                                            <tr>
                                                <td class="propertytitle">Installation Widths (mm / OLD)</td>
                                                <td class="propertydescription"><strong>{{$item->mounting_parameter->installation_widths}}</strong></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </a>

                        </div>

                    @endforeach
                    </div>
                </div>
            @endforeach


            </div>

            <script type="text/javascript">
                jQuery(document).ready(function() {

                    jQuery('#breadcrumb').attr('class', 'breadcrumb-orange-context');
                    jQuery('#topproducts-slider').attr('class', 'orange');
                });
            </script>

        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection