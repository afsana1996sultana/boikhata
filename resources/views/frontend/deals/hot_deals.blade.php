@extends('layouts.frontend')
@section('content-frontend')
@include('frontend.common.add_to_cart_modal')
<main class="main">
    <div class="container mt-20 mb-30">
        <div class="row"></div>
        <div class="row">
            <div class="col-lg-4-5">
                <div class="mb-4 hot_deals_image">
                    <img src="{{ asset('upload/category/hot_deals.jpeg') }}" width="100%" alt=""></div>
                <div class="shop-product-fillter">

                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{ count($products)}}</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="gap-2 mb-2 sort-by-cover d-flex">
                                    <div class="custom_select">
                                        <select class="form-control select-active" onchange="filter()" name="brand">
                                            <option value="">All Brands</option>
                                            @foreach (\App\Models\Brand::all() as $brand)
                                            <option value="{{ $brand->slug }}" @if ($brand_id==$brand->id) selected @endif >{{ $brand->name_en ?? 'Null' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="sort_by" onchange="filter()">
                                            <option value="newest" @if ($sort_by=='newest' ) selected @endif>Newest</option>
                                            <option value="oldest" @if ($sort_by=='oldest' ) selected @endif>Oldest</option>
                                            <option value="price-asc" @if ($sort_by=='price-asc' ) selected @endif>Price Low to High</option>
                                            <option value="price-desc" @if ($sort_by=='price-desc' ) selected @endif>Price High to Low</option>
                                        </select>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid gutters-5">
                    @forelse($products as $product)
                    @include('frontend.common.product_grid_view',['product' => $product])
                    @empty
                    @if(session()->get('language') == 'bangla')
                    <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                    @else
                    <h5 class="text-danger">No products were found here!</h5>
                    @endif
                    @endforelse
                    <!--end product card-->
                </div>
                <!-- product grid -->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $products->links('vendor.pagination.custom') }}
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Side Filter Start -->
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <form action="{{ URL::current() }}" method="GET">
                    <div class="card">
                        <div class="border-0 sidebar-widget price_range range">
                            <h5 class="mb-20">By Price</h5>
                            <div class="mb-20 price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range" class="mb-20"></div>
                                    <div class="d-flex justify-content-between">
                                        <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                        <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-20">Category</h5>
                            <div class="custome-checkbox">
                                @foreach(get_categories() as $category)
                                <div class="mb-2">
                                    @php
                                    $checked = [];
                                    if(isset($_GET['filtercategory'])){
                                    $checked = $_GET['filtercategory'];
                                    }
                                    @endphp
                                    <input class="form-check-input" type="checkbox" name="filtercategory[]" id="category_{{$category->id}}" value="{{$category->name_en}}" @if(in_array($category->name_en, $checked)) checked @endif
                                    />
                                    <label class="form-check-label" for="category_{{$category->id}}">
                                        <span>
                                            @if(session()->get('language') == 'bangla')
                                            {{ $category->name_bn }}
                                            @else
                                            {{ $category->name_en }}
                                            @endif
                                        </span>
                                    </label>
                                    <span class="float-end">{{ count($category->products) }}</span>
                                    <br>
                                </div>
                                @endforeach
                            </div>
                            <button type="submin" class="mt-20 mb-10 btn btn-sm btn-default"><i class="mr-5 fi-rs-filter"></i> Fillter</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Side Filter End -->
        </div>
    </div>
</main>
@endsection
