 @extends('layouts.frontend')
 @section('content-frontend')
 @push('css')
<style>
    .archive-header {
        height: 400px;
    }

    .single-book h6 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        height: 50px;
        -webkit-box-orient: vertical;
    }

    .single-book button {
        background: #f06a256b;
        color: #F06A25;
        border: 0;
        border-radius: 4px;
        padding: 5px 10px;
        transition: all .5s ease-in-out;
    }

    .single-book:hover button {
        background: #F06A25;
        color: #fff;
    }

    .single-book {
        transition: all .5s ease-in-out;
    }

    .single-book:hover {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
    }
</style>
@endpush
    <main class="main product-shop">
         <div class="container mt-40 mb-30">
             <div class="row">
                 <!-- Side Filter Start -->
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    @include('frontend.common.sidebar__filter__category')
                </div>
                <!-- Side Filter End -->
                <div class="col-lg-4-5 primary-sidebar sticky-sidebar ">
                    <form class="" id="search-form" action="" method="GET">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                            </div>
                        </div>

                        <div class="row g-2">
                            @forelse($products as $product)
                               <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-md-1-5">
                                @include('frontend.common.product_grid_view')
                                </div>
                            @empty
                                @if(session()->get('language') == 'bangla')
                                    <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                                @else
                                    <h5 class="text-danger">No products were found here!</h5>
                                @endif
                            @endforelse
                        </div>

                        <!-- product grid -->
                        <div class="pagination-area mt-20 mb-20">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    {{ $products->links('vendor.pagination.custom') }}
                                </ul>
                            </nav>
                        </div>
                     </form>
                     <!--End Deals-->
                 </div>
             </div>
         </div>
    </main>
 @endsection
 @push('footer-script')
     <script type="text/javascript">
         function filter() {
             $('#search-form').submit();
         }
     </script>

     <script type="text/javascript">
         function sort_price_filter() {
             var start = $('#slider-range-value1').html();
             var end = $('#slider-range-value2').html();
             $('#filter_price_start').val(start);
             $('#filter_price_end').val(end);
             $('#search-form').submit();
         }
     </script>

     <script type="text/javascript">
         (function($) {
             ("use strict");
             // Slider Range JS
             if ($("#slider-range").length) {
                 $(".noUi-handle").on("click", function() {
                     $(this).width(50);
                 });
                 var rangeSlider = document.getElementById("slider-range");
                 var moneyFormat = wNumb({
                     decimals: 0,
                     // thousand: ",",
                     // prefix: "$"
                 });
                 var start_price = document.getElementById("filter_price_start").value;
                 var end_price = document.getElementById("filter_price_end").value;
                 noUiSlider.create(rangeSlider, {
                     start: [start_price, end_price],
                     step: 1,
                     range: {
                         min: [1],
                         max: [10000]
                     },
                     format: moneyFormat,
                     connect: true
                 });

                 // Set visual min and max values and also update value hidden form inputs
                 rangeSlider.noUiSlider.on("update", function(values, handle) {
                     document.getElementById("slider-range-value1").innerHTML = values[0];
                     document.getElementById("slider-range-value2").innerHTML = values[1];
                     document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
                     document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
                 });
             }
         })(jQuery);
     </script>
 @endpush
