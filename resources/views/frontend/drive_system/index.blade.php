@extends('frontend.layouts.master')

@section('script')


@endsection

@section('content')
<div id="breadcrumb" class="breadcrumb-lightorange-context">
    <div class="ym-wrapper">
        <div id="breadcrumbcontent">
            <!--BREADCRUMB_begin-->
            <ul><li><a href="/"><i class="papicon_homefull"></i></a></li><li>Drive systems</li>



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
                @foreach ($DriveSystemCategories as $DriveSystemCategory)
                    <div class="list listsys">
                        <div class="header">
                            <i class="lightorange icon groupedicon">
                                        <span class="papicon_config2"></span>
                                    </i>
                            <h2>{{$DriveSystemCategory->name}}</h2>
                            <a href="#" class="toggle-products preventdefault" 
                                {{-- onclick="$(this).parent().parent().find('.collapsed').toggle('fast'); $(this).find('span').toggle(); return false;" --}}
                            >
                                <span class='block_expand' style="display: block;" onclick="$(this).parent().parent().parent().find('.collapsed').toggle('fast');$(this).toggle(); $(this).siblings().toggle();"><i class="papicon_plus"></i>see all</span>
                                <span class='block_collapse' style="display: none;" onclick="$(this).parent().parent().parent().find('.collapsed').toggle('fast');$(this).toggle(); $(this).siblings().toggle();"><i class="papicon_minus"></i>collapse</span>
                            </a>
                        </div>
                        <div class="content">
                            @foreach ($DriveSystemCategory->drive_systems as $drive_system)
                                <div class="product">

                                    <a href="/drive_system/{{$DriveSystemCategory->slug}}/{{$drive_system->slug}}/">

                                        <div class="productimage">

                                            {{-- <img src="/fileadmin/_processed_/a/2/csm_M800_ROAD_66cf0dc808.png" width="400" height="300" alt=""> --}}
                                            <img src="{{$drive_system->thumbnail_image ? asset('/images/drive_system/'.$drive_system->thumbnail_image) : asset('/images/No_Image.svg')}}"  width="400" height="300" alt=""/>
                                        </div>

                                        <div class="productcontent">
                                            <h4>{!!\App\Component::boldName($drive_system->name)!!}</h4>
                                            <table>
                                                <tbody>
                                                    <?php
                                                    foreach ($drive_system->components as $component) :
                                                    // $subcategory = /App/ComponentCategory::where('id', $component->category->id)->first();
                                                        // echo '<pre>';
                                                        //     print_r($component->toArray());
                                                        // echo '</pre>';
                                                        ?>

                                                    <tr>
                                                        <td>{{$component->category->parent->name}}:</td>
                                                        <td>{!!\App\Component::boldName($component->name)!!}</td>
                                                    </tr>

                                                    <?php
                                                        endforeach;
                                                    ?>


                                                </tbody>
                                            </table>

                                        </div>

                                    </a>

                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach


                <script>
                    // $(function() {
                    //     if ($(window).width() > 840) {
                    //         $('.tx-bafangdb .listsys').each(function() {

                    //             var seeAllElement = '<span style="display: block;"><i class="papicon_plus"></i>see all</span>',
                    //                 collapseElement = '<span style="display: none;"><i class="papicon_minus"></i>collapse</span>',
                    //                 products = $(this).find('.product');

                    //             if (products.length > 2) {
                    //                 var header = $(this).find('.header');

                    //                 $(header).append('<a href="#" class="toggle-products preventdefault" onclick="$(this).parent().parent().find(\'.collapsed\').toggle(\'fast\'); $(this).find(\'span\').toggle(); return false;">' + seeAllElement + collapseElement + '</a>');
                    //                 products.splice(0, 2);

                    //                 $(products).wrapAll('<div class="collapsed" style="display:none"/>');
                    //             }
                    //         });
                    //     }
                    // })
                </script>

            </div>

            <script type="text/javascript">
                jQuery(document).ready(function() {

                    jQuery('#breadcrumb').attr('class', 'breadcrumb-lightorange-context');
                    jQuery('#topproducts-slider').attr('class', 'lightorange');
                });
            </script>
        </div>
        <!--CONTENT_end-->
    </div>
</main>
@endsection