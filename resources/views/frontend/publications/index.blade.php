@extends('layouts.frontend')
@section('content-frontend')
	<div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
                <span> Publications </span>
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-product-fillter-header">
                    <div class="row g-3">
                    	@foreach($publications as $publication)
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 col-6">
                                <a href="{{ route('publication.product', $publication->id) }}" class="d-flex align-items-center card-publication justify-content-center" title="{{ $publication->name }}" style="background: {{ $publication->background_color}};">
                                    <h4 class="category-title fs-6 mb-0">
                                        {{ $publication->name }}
                                    </h4>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 mb-20 pagination-area">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $publications->links() }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
