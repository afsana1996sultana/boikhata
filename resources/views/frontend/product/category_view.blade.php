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
<main class="main">
    <div class="page-header">
        <div class="container mt-30 mb-30">
            <div class="row">
                <div class="col-lg-4-5">
                    <div class="row product-grid g-2">
                        <div class="category__main__image">
                            @if ($category->banner_image)
                                <img src="{{ asset($category->banner_image) }}" alt="">
                            @else
                                <img src="{{ asset($category->image) }}" alt="" style="height: 250px; width: 1264px;">
                            @endif

                            <div class="breadcrumb breadcrumb__title">
                                <h4 class="mb-15">
                                    @if(session()->get('language') == 'bangla')
                                    {{ $category->name_bn }}
                                    @else
                                    {{ $category->name_en }}
                                    @endif
                                </h4>
                                <a href="{{ route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>হোম</a>
                                <span></span>
                                @if(session()->get('language') == 'bangla')
                                {{ $category->name_bn }}
                                @else
                                {{ $category->name_en }}
                                @endif
                            </div>
                        </div>

                        @if ($subcategories->count() > 0)
                        <div class="subcategory__show toggle_nav" id="toggle_nav">
                            <h6>Subcategory List</h6>
                        </div>
                        @endif
                        <div class="mobile_nav" id="mobile_nav">
                            <div class="mobile_navWrapper" id="mobile_navWrapper">
                                <div class="mobile_nav_content">
                                    <ul class="subcategory__item__show">
                                        <h5 class="pb-2 mb-2 border-bottom">Subcategory List</h5>
                                        @foreach ($subcategories as $key => $subcategory)
                                        <li><a href="{{ route('product.category', $subcategory->slug) }}">{{
                                                $subcategory->name_en }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>আমরা আপনার জন্য {{ formatNumberInBengali(count($products)) }} টি আইটেম খুঁজে পেয়েছি!</p>
                            </div>
                        </div>
                        <div class="row g-2">
                            @forelse($products as $product)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-md-1-5">
                                @include('frontend.common.product_grid_view')
                            </div>
                            @empty
                            <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
                            @endforelse
                        </div>
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
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <!-- SideCategory -->
                    @include('frontend.common.sidecategory')
                </div>
            </div>
        </div>
</main>
@endsection
@push('footer-script')
<script type="text/javascript">
</script>

<script type="text/javascript">
    function filter() {
        $('#search-form').submit();
    }

</script>

<script>
    const mobileNav = document.getElementById("mobile_nav");
    const toggleNav = document.getElementById("toggle_nav");
    const navWrapper = document.getElementsByClassName("mobile_navWrapper")[0];

    // Function to remove classes from elements
    function removeClasses() {
        toggleNav.classList.remove("activeToggle");
        mobileNav.classList.remove("showMobileNav");
    }

    // Add event listener to window
    window.addEventListener("click", function(event) {
        // Check if click occurred outside of navWrapper and toggleNav
        if (!navWrapper.contains(event.target) && !toggleNav.contains(event.target)) {
            removeClasses();
        }
    });

    // Add event listener to toggleNav
    toggleNav.addEventListener("click", function(event) {
        // Prevent event from bubbling up to window
        event.stopPropagation();
        // Toggle classes on elements
        toggleNav.classList.toggle("activeToggle");
        mobileNav.classList.toggle("showMobileNav");
    });

</script>
@endpush
