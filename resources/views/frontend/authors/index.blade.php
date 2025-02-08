@extends('layouts.frontend')
@section('content-frontend')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}" rel="nofollow"><i class="mr-5 fi-rs-home"></i>Home</a>
            <span> Authors </span>
        </div>
    </div>
</div>
<div class="container mb-30 mt-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="shop-product-fillter-header">
                <div class="row g-3">
                    @foreach($authors as $author)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="category_header" title="{{ $author->writer_name }}">
                                <a href="{{ route('writer.product', $author->slug) }}"
                                    class="align-items-center">
                                    <img src="{{ asset($author->writer_image) }}" class="img-fluid category_image"
                                        alt="Writer Image">
                                    <h4 class="category-title fs-6">
                                        {{ $author->writer_name }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="mt-20 mb-20 pagination-area">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{ $authors->links() }}
            </ul>
        </nav>
    </div>
</div>
@endsection
