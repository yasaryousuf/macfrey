@extends('frontend.layouts.master')

@section('content');
<div id="breadcrumb" class="breadcrumb-lightorange-context">
    <div class="ym-wrapper">
        <div id="breadcrumbcontent">
            <!--BREADCRUMB_begin-->
            <ul>
                <li><a href="/"><i class="papicon_homefull"></i></a></li>
                <li>Drive systems</li>

                <li><a href="/drive_system/{{$DriveSystemCategory->slug}}">{{$DriveSystemCategory->name}}</a></li>

                <li>{{$DriveSystem->name}}</li>
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

            <div class="set-wrapper lightorange-context">

                <div class="productdetail">
                    <div class="detailheader">
                        <div class="productheader">
                            <div class="left">
                                <h1>
                                {!!\App\Component::boldName($DriveSystem->name)!!}
                            </h1>
                            </div>
                            <div class="right"></div>
                        </div>

                        <div class="productslider centerinner">

                            <div class="slide centeredslide">
                                <img style="margin:0 auto;" src="{{$DriveSystem->image ? asset('/images/drive_system/'.$DriveSystem->image) : asset('/images/No_Image.svg')}}" width="667" height="500" alt="">
                            </div>

                        </div>

                        <div class="productslider_content">
                            <div class="left">
                                <div id="bx-pager" class="thumbnails">

                                </div>
                            </div>

                            <div class="right">

                                <a class="lightbox" title="" data-fancybox-group="componentimages" href="{{$DriveSystem->image ? asset('/images/drive_system/'.$DriveSystem->image) : asset('/images/No_Image.svg')}}">

                                    <span class="papicon_lensplus"></span>

                                </a>

                            </div>

                            <div style="clear:both;"></div>
                        </div>

                    </div>

                    <div class="detailcontent">
                        <br>

                        <div class="productdetailcomponents">

                            <div class="components">
                                <h3>
                                Components
                            </h3>
                                <div>
                                    <?php
                                        foreach ($DriveSystem->components as $component) : ?>
                                    <div class="product equalheights orange-context" style="height: 233px;">

                                        <a href="/component/{{$component->category->parent->slug}}/{{$component->slug}}/">

                                            <div class="productcategory">

                                                <i class="{{ \App\ComponentCategory::getCategorycontext($component->category->parent->slug) }} icon">
                                                    <span class="{{ \App\ComponentCategory::getCategoryImage($component->category->parent->slug) }}"></span>
                                                </i>
                                                <span class="title">{{$component->category->parent->name}}</span>

                                                <div class="ym-clearfix"></div>
                                            </div>

                                            <div class="productimage">
                                                <?php

                                                if ($component->images->first()) : 
                                                    $imageUrl = '/images/component_image/'.$component->images[0]->image;
                                                else :
                                                    $imageUrl = '/images/No_Image.svg';
                                                endif;
                                                ?>

                                                <img class="Black" src="{{asset($imageUrl)}}" width="401" height="300" alt="">

                                            </div>

                                            <div class="productcontent">
                                                <h4><span class="producttitle-bold">MM</span> G530.200</h4>

                                                <table>
                                                    <tbody>

                                                        @if ($component->category->parent->slug == 'motor')
                                                        
                                                            @if ($component->core_data)
                                                                <tr>
                                                                    <td>Construction</td>
                                                                    <td><strong>{{$component->core_data->construction}}</strong></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Rated Power (W)</td>
                                                                    <td><strong>{{$component->core_data->rated_power}}</strong></td>
                                                                </tr>                                                                                                            
                                                            @endif
                                                        @elseif($component->category->parent->slug == 'hmi')
                                                            @if ($component->mounting_parameter)
                                                                <tr>
                                                                    <td>Com. Protocol</td>
                                                                    <td><strong>{{$component->mounting_parameter->com_protocol}}</strong></td>
                                                                </tr>
                                                            @endif

                                                            @if ($component->core_data)
                                                                <tr>
                                                                    <td>Display Type</td>
                                                                    <td><strong>{{$component->core_data->display_type}}</strong></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Rated Voltage(DCV)</td>
                                                                    <td><strong>{{$component->core_data->rated_voltage  }}</strong></td>
                                                                </tr>
                                                            @endif
                                                        @elseif($component->category->parent->slug == 'sensor')
                                                            @if ($component->core_data)
                                                                <tr>
                                                                    <td>Type</td>
                                                                    <td><strong>{{$component->core_data->type}}</strong></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Input Voltage(DCV)</td>
                                                                    <td><strong>{{$component->core_data->input_voltage}}</strong></td>
                                                                </tr>  
                                                            @endif
                                                        @elseif($component->category->parent->slug == 'sensor')
                                                            @if ($component->certification)
                                                                <tr>
                                                                    <td>IP-Code</td>
                                                                    <td><strong>{{$component->certification->ip}}</strong></td>
                                                                </tr>
                                                            @endif                                                                                                              
                                                        @endif

                                                    </tbody>
                                                </table>

                                                <!-- <a href="" class="button" style="background-color: #9b9fab !important;">view component</a> -->
                                            </div>

                                        </a>

                                    </div>
                                    <?php endforeach; ?>
                                    <div class="ym-clearfix"></div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="productdetailbuttons">
                            <div class="right">

                                <a id="addtoinquiry" href="#" class="button">
                                Add to Enquiry
                            </a>

                            </div>
                        </div> --}}

                        <div class="ym-clearfix"></div>
                        <br>

                        <a class="button back" onclick="history.go(-1); return false;" href="/drive_system/">
                        Back to
                        MID
                    </a>

                    </div>

                    {{-- <div class="success-notification notification">
                        <p>
                            Set added to enquiry
                        </p>
                    </div>

                    <div class="double-notification notification">
                        <p>
                            Set already added to enquiry
                        </p>
                    </div>

                    <div class="error-notification notification">
                        <p>
                            Error: Set could not be added to enquiry
                        </p>
                    </div> --}}

                    <input id="ajaxRequestUri" type="hidden" value="/en/oem-area/drive-systems/drive-system/?type=896571&amp;cHash=548906272b6373e852a69bb6fad7dec0">
                    <input id="setUid" type="hidden" value="155">
                </div>

                {{-- <script type="text/javascript">
                    $(function() {
                        $('#addtoinquiry').bind('click', function() {
                            var addtoinquiryBtn = $(this),
                                ajaxUrl = $('#ajaxRequestUri').val();

                            //check inquiry
                            $.ajax({
                                url: ajaxUrl,
                                type: "POST",
                                dataType: "json",
                                cache: false,
                                data: {
                                    tx_bafangdb_inquiry: {
                                        action: "ajax",
                                        controller: "Inquiry",
                                        task: "addinquiry",
                                        id: $('#setUid').val(),
                                        type: "systems"
                                    },
                                },
                                success: function(response) {
                                    if (parseFloat(response) == 2) {
                                        $('.double-notification').css('backgroundColor', $(addtoinquiryBtn).css('backgroundColor')).appendTo('body').miniNotification();
                                    } else if (parseFloat(response) == 1) {
                                        $('.success-notification').css('backgroundColor', $(addtoinquiryBtn).css('backgroundColor')).appendTo('body').miniNotification();
                                    } else {
                                        $('.error-notification').css('backgroundColor', $(addtoinquiryBtn).css('backgroundColor')).appendTo('body').miniNotification();
                                    }
                                },
                                complete: function() {
                                    $.ajax({
                                        url: ajaxUrl,
                                        type: "POST",
                                        dataType: "json",
                                        cache: false,
                                        data: {
                                            tx_bafangdb_inquiry: {
                                                action: "ajax",
                                                controller: "Inquiry",
                                                task: "countinquiries"
                                            },
                                        },
                                        success: function(response) {
                                            $('#inquiries').html(response);
                                        },
                                        complete: function() {

                                        },
                                        error: function(response) {
                                            jQuery('#inquiries').html(0);
                                        }
                                    });
                                },
                                error: function(response) {

                                }
                            });

                            return false;
                        });

                        $('a[class*=lightbox],a[rel*=lightbox]').fancybox({
                            'padding': 15,
                            'margin': 20,
                            'width': 800,
                            'height': 600,
                            'minWidth': 100,
                            'minHeight': 100,
                            'maxWidth': 9999,
                            'maxHeight': 9999,
                            'autoSize': true,
                            'fitToView': true,
                            'aspectRatio': false,
                            'topRatio': 0.5,
                            'fixed': false,
                            'scrolling': 'auto',
                            'wrapCSS': '',
                            'arrows': true,
                            'closeBtn': true,
                            'closeClick': false,
                            'nextClick': false,
                            'mouseWheel': true,
                            'loop': true,
                            'modal': false,
                            'autoPlay': false,
                            'playSpeed': 3000,
                            'index': 0,
                            'type': null,
                            'href': null,
                            'content': null,
                            'overlayShow': true,
                            'openEffect': 'fade',
                            'closeEffect': 'fade',
                            'nextEffect': 'fade',
                            'prevEffect': 'fade',
                            'openSpeed': 300,
                            'closeSpeed': 300,
                            'nextSpeed': 300,
                            'prevSpeed': 300,
                            'openEasing': 'swing',
                            'closeEasing': 'swing',
                            'nextEasing': 'swing',
                            'prevEasing': 'swing',
                            'openOpacity': true,
                            'closeOpacity': true,
                            'openMethod': 'zoomIn',
                            'closeMethod': 'zoomOut',
                            'nextMethod': 'changeIn',
                            'prevMethod': 'changeOut',
                            'groupAttr': 'data-fancybox-group',
                            'beforeShow': function(opts) {
                                this.title = (jQuery(this.group[this.index]).attr('title') != undefined ? jQuery(this.group[this.index]).attr('title') : jQuery(this.group[this.index]).find('img').attr('title'));
                            }
                        });
                    });

                    $(window).load(function() {
                        if ($('.productdetail .slide').length > 1) {
                            $('.productslider').bxSlider({
                                pagerCustom: '#bx-pager',
                                nextText: '',
                                prevText: ''
                            });
                        }
                    });
                </script>

                <script type="text/javascript">
                </script> --}}

            </div>

            {{-- <script type="text/javascript">
                jQuery(document).ready(function() {

                    jQuery('#breadcrumb').attr('class', 'breadcrumb-lightorange-context');
                    jQuery('#topproducts-slider').attr('class', 'lightorange');
                }); --}}
            </script>
        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection