@extends('site.layout.master')

@section('content')
   <!-- ##### Breadcumb Area Start ##### -->
   <div class="breadcumb_area bg-img" style="background-image: url(site/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2 id="category-header">{{$currCategory->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Shop Grid Area Start ##### -->
<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            @include('site.partials.left_category', ['parentCategory' => $parentCategory, 'currCategory' => $currCategory])
            <div id="content-filter" class="col-12 col-md-8 col-lg-9">
                @include('site.product.product_filter', ['productFilters' => $productFilters, 'ajax' => 1])
            </div>
        </div>
    </div>
</section>
<!-- ##### Shop Grid Area End ##### -->

@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.filter-category').click(function(){
                let url = $(this).attr('href');
                $('.filter-category').removeClass('text-dark font-weight-bold');
                $(this).addClass('text-dark font-weight-bold');
                ajaxFilter('POST', url, getDataOfSlider('.slider-range-price'));
                return false;
            });

            $(document).on('click', '.pagination_ a', function(e){
                let url = $(this).attr('href');
                ajaxFilter('POST', url, getDataOfSlider('.slider-range-price'));
                return false
            });

            $(document).on('change', 'select[name=sort]', function(){
                let url = $(this).val();
                ajaxFilter('POST', url, getDataOfSlider('.slider-range-price'));
                return false;
            });
            

            $('.slider-range-price').slider({
                change: function(e, ui){
                    let data = ui.values;
                    let url = window.location.href;
                    ajaxFilter('POST', url, {min: data[0], max: data[1]})
                }
            });

            function ajaxFilter(type, url, data){
                $.ajax({
                        type : type,
                        url : url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data : data,
                        success : function(res){
                            history.pushState({}, null, url);
                            //console.log(res);
                            $('#content-filter').html(res);
                            $('html, body').animate({scrollTop: '0px'}, 0);
                        }
                });
            }

            function getDataOfSlider(selector){
                return {
                    min : $(selector).slider('option', 'values')[0],
                    max : $(selector).slider('option', 'values')[1],
                }
            }
        });
    </script>
@endpush