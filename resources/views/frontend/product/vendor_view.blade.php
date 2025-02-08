@extends('layouts.frontend')
@section('content-frontend')
@push('css')
<style>
    .archive-header {
        height: 400px;
    }
    .text-black{
        color: #000 !important;
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
    <div class="py-3 author_info">
        <div class="container">
            <div class="py-2 d-md-flex justify-content-between align-items-center">
                <h6 class="m-0 page-title font-size-3 font-weight-medium text-lh-lg">{{ $vendor->writer_name }} এর বই সমূহ</h6>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="{{ route('home')}}" class="h-primary">হোম</a>
                    <span class="mx-1 breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                        <a href="{{ route('authors') }}" class="h-primary">লেখক</a>
                    <span class="mx-1 breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                    <span>{{ $vendor->writer_name }}</span>
                </nav>
            </div>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-fluid" src="{{ asset($vendor->writer_image) }}" alt="{{ $vendor->writer_name }}">
                </div>
                <div class="col-md-9">
                <span class="text-gray-400 font-size-2">লেখকের জীবনী</span>
                <h4 class="pb-1 mt-2 mb-3 font-size-7 ont-weight-medium">{{ $vendor->writer_name }}</h4>
                <p class="mb-0">{{ $vendor->description }}</p>
            </div>
            </div>
        </div>
    </div>

    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>আমরা আপনার জন্য {{ formatNumberInBengali(count($products)) }} টি আইটেম খুঁজে পেয়েছি!</p>
                    </div>
                </div>
                <div class="mt-3 row g-2">
                    @forelse($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 col-md-1-5">
                        @include('frontend.common.product_grid_view')
                        </div>
                    @empty
                        <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5>
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
                <!--End Deals-->
            </div>

            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            	<!-- SideCategory -->
                @include('frontend.common.sidecategory')
            </div>
        </div>
    </div>
</main>
@endsection
