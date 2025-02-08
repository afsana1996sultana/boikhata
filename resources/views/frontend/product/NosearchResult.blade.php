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
    <div class="container">
        <div class="py-2 d-md-flex justify-content-between align-items-center">
            <nav class="woocommerce-breadcrumb font-size-2">
                <a href="{{ route('home')}}" class="h-primary">হোম</a>
                <span class="mx-1 breadcrumb-separator"><i class="fas fa-angle-right"></i></span>
                <span class="h-primary">সার্চ</span>
            </nav>
        </div>
        <hr>
    </div>
	<div class="container mb-30">
	    <div class="row">
			<div class="row g-2">
				<h5 class="text-danger">আপনি পণ্য খুজে পাওয়ার জন্য কোন তথ্য প্রদান করেননি !
                <br>
                দয়া করে সঠিক তথ্য প্রদান করুন।</h5>
			</div>
	        <!--product grid-->
            <div class="justify-content-center"></div>
            <!-- Side Filter Start -->
	        <div class="col-lg-1-5 primary-sidebar sticky-sidebar"></div>
            <!-- Side Filter End -->
	    </div>
	</div>
</main>
@endsection
