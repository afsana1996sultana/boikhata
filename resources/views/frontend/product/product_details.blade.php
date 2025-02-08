@extends('layouts.frontend')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>

        .selectors {
            margin-top: 10px;
        }

        .selectors .mz-thumb img {
            max-width: 56px;
        }

        .product__item .dropdown-toggle::after {
            display: none;
        }

        @media screen and (max-width: 1023px) {
            .app-figure {
                width: 99% !important;
                margin: 20px auto;
                padding: 0;
            }
        }

        .selectors {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .rating i {
            color: #ffb301;
        }

        .single-review-item {
            border-top: 1px solid #ffb301;
        }

        .single-review-item {
            padding: 10px 0;
        }

        .review_list {
            margin-top: 20px;
        }

        a[data-zoom-id],
        .mz-thumb,
        .mz-thumb:focus {
            margin-top: 0 !important;
        }

        .dropdown-menu.dots__dropdown.show li a {
            color: #000 !important;
            font-size: 15px;
            padding: 5px 10px;
            line-height: 1;
        }

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
        a.product__thumbnail__image {
            position: relative;
        }
        .share__social {
            transition: all 0.3s ease;
        }

        img.readBook {
            position: absolute;
            width: 50%;
            left: 0;
            top: 0;
            z-index: 999;
            background: #fff;
            right: 0;
            margin: auto;
        }
        .detail-info h2.title-detail {
            font-size: 30px;
            margin-bottom: 20px;
        }
        .title-detail {
            font-weight: normal;
            font-size: 25px;
        }
        h4.title-detail strong {
            font-size: 25px;
        }
        h6.category_show {
            font-weight: 600;
            margin-top:20px
        }
        .buy_button {
            margin-top: 25px;
        }
        .social_share {
            position: relative;
        }

        .share__social {
            position: absolute;
            width: 100%;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            z-index: 999999;
            background: #fff;
        }

        .share__social i {
            transition: all .5s ease-in-out;
            color: #000 !important;
            padding: 0 5px;
        }

        .share__social i:hover {
            color: #f06a25 !important;
        }
    </style>
    <!-- Image zoom -->
    <link rel="stylesheet" href="{{ asset('frontend/magiczoomplus/magiczoomplus.css') }}" />
@endpush
@section('meta')
    <meta property="og:title" content="{{ $product->name_en }}">
    <meta property="og:image" content="{{ asset($product->product_thumbnail) }}">
@endsection
@section('content-frontend')
    @include('frontend.common.maintenance')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb d-flex align-items-center" style="justify-content: space-between;cursor: pointer;">
                    <a href="{{ route('home') }}" rel="nofollow"><i class="mr-5 fi-rs-home"></i>
                        @if (session()->get('language') == 'bangla')
                            {{ $product->category->name_bn ?? 'No Category' }}
                        @else
                            {{ $product->category->name_en ?? 'No Category' }}
                        @endif
                    </a>
                    <div class="product__item d-md-none d-sm-block">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dots__dropdown">
                                <li><a class="dropdown-item" href="{{ route('home') }}">Home</a></li>
                                <li><a class="dropdown-item" href="{{ route('category_list.index') }}">Categories</a></li>
                                <li><a class="dropdown-item" href="{{ route('product.show') }}">Shop</a></li>
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">My Account</a></li>
                                @endauth
                                @guest
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                @endguest
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product-detail accordion-detail">
                        <div class="row mt-30 mb-20">
                            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                                {{-- <div class="showpdf">
                                    <div data-bs-toggle="modal" data-bs-target="#showPdfBook">
                                        @foreach ($product->multi_imgs as $img)
                                            @php
                                                $pdf = $product->product_pdf;
                                                $pdfPath = public_path($pdf);
                                                $pdfbookName = $product->name_bn;
                                            @endphp
                                            @if ($pdf && file_exists($pdfPath))
                                                <a class="pdf-link" href="{{ asset($pdf) }}" data-pdf="{{ asset($pdf) }}">
                                                    <img src="{{asset('frontend/read.png')}}" alt="একটু পড়ে দেখুন" class="readBook">
                                                    <img src="{{ asset($img->photo_name) }}" alt="{{ $pdfbookName }}" class="thumbnail_book_image">
                                                </a>
                                            @else
                                                <a class="pdf-link" href="{{ asset($img->photo_name) }}" data-pdf="{{ asset($img->photo_name) }}">
                                                    <img src="{{asset('frontend/read.png')}}" alt="একটু পড়ে দেখুন" class="readBook">
                                                    <img src="{{ asset($img->photo_name) }}" alt="{{ $pdfbookName }}" class="thumbnail_book_image">
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="showPdfBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-6" id="staticBackdropLabel">একটু পড়ে দেখুন</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id="pdfIframe" src="" width="100%" height="500px"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="showpdf">
                                    <div data-bs-toggle="modal" data-bs-target="#showPdfBook">
                                        @foreach ($product->multi_imgs as $img)
                                            @php
                                                $pdf = $product->product_pdf;
                                                $pdfPath = public_path($pdf);
                                                $pdfbookName = $product->name_bn;
                                            @endphp
                                            @if ($pdf && file_exists($pdfPath))
                                                <a class="pdf-link" data-pdf="{{ asset($pdf) }}">
                                                    <img src="{{asset('frontend/read.png')}}" alt="একটু পড়ে দেখুন" class="readBook">
                                                    <img src="{{ asset($img->photo_name) }}" alt="{{ $pdfbookName }}" class="thumbnail_book_image">
                                                </a>
                                            @else
                                                <a class="pdf-link" data-pdf="{{ asset($img->photo_name) }}">
                                                    <img src="{{asset('frontend/read.png')}}" alt="একটু পড়ে দেখুন" class="readBook">
                                                    <img src="{{ asset($img->photo_name) }}" alt="{{ $pdfbookName }}" class="thumbnail_book_image">
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="showPdfBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-6" id="staticBackdropLabel">একটু পড়ে দেখুন</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe id="pdfIframe" src="" width="100%" height="500px"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="detail-info">
                                    @php
                                        $discount = 0;
                                        $amount = $product->regular_price;
                                        if ($product->discount_price > 0) {
                                            if ($product->discount_type == 1) {
                                                $discount = $product->discount_price;
                                                $amount = $product->regular_price - $discount;
                                            } elseif ($product->discount_type == 2) {
                                                $discount = ($product->regular_price * $product->discount_price) / 100;
                                                $amount = $product->regular_price - $discount;
                                            } else {
                                                $amount = $product->regular_price;
                                            }
                                        }
                                    @endphp

                                    <input type="hidden" id="discount_amount" value="{{ $discount }}">
                                    <h2 class="title-detail">
                                        {{ $product->name_bn }}
                                    </h2>
                                    <h4 class="title-detail">
                                       <strong class="text-black">লেখক : </strong>
                                        {{ $product->name_bn }}
                                    </h4>
                                    <h6 class="category_show">ক্যাটেগরি : {{ $product->category->name_bn }}</h6>
                                    <div class="d-inline-block">
                                        @if ($product->stock_qty > 0)
                                            <div class="mb-5 hot_stock">In Stock </div>
                                        @else
                                            <div class="mb-5 hot_stock">Stock Out</div>
                                        @endif
                                    </div>

                                     <div class="clearfix product-price-cover">
                                        <div class="float-left product-price primary-color" style="display: block">
                                            @if ($product->discount_price <= 0)
                                                <span class="current-price">৳{{ formatNumberInBengali($product->regular_price) }}</span>
                                            @else
                                                <span class="current-price">৳{{ formatNumberInBengali($amount) }}</span>
                                                @if ($product->discount_type == 1)
                                                    <span class="save-price font-md color3 ml-15">৳{{ formatNumberInBengali($discount) }} Off </span>
                                                @elseif ($product->discount_type == 2)
                                                    <span class="save-price font-md color3 ml-15">{{ formatNumberInBengali($product->discount_price) }}% Off</span>
                                                @endif
                                                    <span class="old-price font-md ml-15">৳{{ formatNumberInBengali($product->regular_price) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row" id="attribute_alert"></div>
                                </div>
                                <div class="row" id="stock_alert"></div>

                                @if ($product->short_description_en != null)
                                    <div class="product__info__text">
                                        <p>{!! $product->short_description_en ?? '' !!}</p>
                                    </div>
                                @endif

                                <div class="buy_button">
                                    <input type="hidden" id="product_id" value="{{ $product->id }}">
                                    <input type="hidden" id="pname" value="{{ $product->name_en }}">
                                    <input type="hidden" id="product_price" value="{{ $amount }}">
                                    <input type="hidden" id="minimum_buy_qty" value="{{ $product->minimum_buy_qty }}">
                                    <input type="hidden" id="qty" value="1">
                                    <input type="hidden" id="stock_qty" value="{{ $product->stock_qty }}">
                                    <input type="hidden" id="pvarient" value="">
                                    <input type="hidden" id="buyNowCheck" value="0">
                                    <button type="submit" onclick="buyNow()"><i class="fa-solid fa-bag-shopping"></i> এখুনি কিনুন</button>
                                    <button type="submit" onclick="addToCart()"><i class="fa-solid fa-cart-shopping"></i> কার্টে যুক্ত করুন</button>
                                </div>

                                <div class="share_button">
                                   <div class="social_share">
                                        <button id="shareButton"><i class="fa-solid fa-share-nodes"></i>Share this Book</button>
                                        <div class="share__social d-none">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="fab fa-facebook-f" title="facebook"></i></a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($product->name_en) }}" target="_blank"><i class="fab fa-linkedin-in" title="linkedin"></i></a>
                                            <a href="https://www.youtube.com/share?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fab fa-youtube" title="youtube"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                <table class="table no-border">
                                    <tbody id="">
                                        <h5>বেশি বিক্রিত বই</h5>
                                        @foreach($last_30_days_sales->take(3) as $today_product)
                                            @php
                                                $MostSellProduct = \App\Models\Product::find($today_product->product_id);
                                            @endphp
                                            @if($MostSellProduct !== null)
                                                <tr>
                                                    <td class="image product-thumbnail product__detail__page">
                                                        <a href="{{ route('product.details', $MostSellProduct->slug) }}">
                                                            <img src="{{ asset($MostSellProduct->product_thumbnail) }}" alt="{{ $MostSellProduct->name_bn }}">
                                                        </a>
                                                        <h6 class="mb-5">
                                                            <a href="{{ route('product.details', $MostSellProduct->slug) }}" class="text-heading">
                                                                {{ \Illuminate\Support\Str::words(strip_tags($MostSellProduct->name_bn ?? ''), 2, '....') }}
                                                            </a>
                                                            @if($MostSellProduct->writer)
                                                                <a href="{{ route('writer.product', $MostSellProduct->writer->slug) }}" class="mt-1 d-block">
                                                                    {{ \Illuminate\Support\Str::words(strip_tags($MostSellProduct->writer->writer_name ?? ''), 2, '....') }}
                                                                </a>
                                                            @endif
                                                            <div>
                                                                @php
                                                                    if ($MostSellProduct->discount_type == 1) {
                                                                        $price_after_discount = $MostSellProduct->regular_price - $MostSellProduct->discount_price;
                                                                    } elseif ($MostSellProduct->discount_type == 2) {
                                                                        $price_after_discount = $MostSellProduct->regular_price - ($MostSellProduct->regular_price * $MostSellProduct->discount_price) / 100;
                                                                    }
                                                                @endphp

                                                                @if ($MostSellProduct->discount_price > 0)
                                                                    <span style="margin-bottom: 0; font-weight: bold;">
                                                                        ৳{{ formatNumberInBengali($price_after_discount) }}
                                                                    </span>
                                                                    <span style="margin-bottom: 0; color: #EF7D20; font-weight: bold;">
                                                                        <del>৳{{ formatNumberInBengali($MostSellProduct->regular_price) }}</del>
                                                                    </span>
                                                                @else
                                                                    <span style="margin-bottom:0; font-weight: bold;">
                                                                        ৳{{ formatNumberInBengali($MostSellProduct->regular_price) }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <input type="hidden" id="product_id" value="{{ $MostSellProduct->id }}">
                                                            <input type="hidden" id="pname" value="{{ $MostSellProduct->name_en }}">
                                                            <input type="hidden" id="product_price" value="{{ $amount }}">
                                                            <input type="hidden" id="minimum_buy_qty" value="{{ $MostSellProduct->minimum_buy_qty }}">
                                                            <input type="hidden" id="qty" value="1">
                                                            <input type="hidden" id="stock_qty" value="{{ $MostSellProduct->stock_qty }}">
                                                            <input type="hidden" id="pvarient" value="">
                                                            <input type="hidden" id="buyNowCheck" value="0">
                                                            <button type="submit" onclick="addToCart()">
                                                                <i class="fa-solid fa-cart-shopping"></i> কার্টে যুক্ত করুন
                                                            </button>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">পণ্যের বিবরণ</a>
                                    </li>
                                    <li class="nav-item">
                                        @php
                                            $data = \App\Models\Review::where('product_id', $product->id)->where('status', 1)->get();
                                        @endphp
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                            href="#reviews">পর্যালোচনা ({{ $data->count() }})</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                            href="#Additional-info">লেখক</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>
                                                @if (session()->get('language') == 'bangla')
                                                    {!! $product->description_en ?? 'No Product Long Descrption' !!}
                                                @else
                                                    {!! $product->description_bn ?? 'No Product Logn Descrption' !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="img-fluid" src="{{ asset($product->writer->writer_image ?? '') }}" alt="{{ $product->writer->writer_name ?? ''}}">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="authors_details">
                                                    <p>লেখকের জীবনী</p>
                                                    <h6>{{ $product->writer->writer_name ?? 'No Authors'}}</h6>
                                                    <p>{{ $product->writer->description ?? 'No Discriptions'}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="product__review__system">
                                            <h6>ক্রেতার পর্যালোচনা:</h6>
                                            <h5>{{ $product->name_bn }}</h5>
                                            <form action="{{ route('review.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="user_id"
                                                    value="{{ Auth::user()->id ?? 'null' }}">
                                                <div class="product__rating">
                                                    <label for="rating">পর্যালোচনা <span
                                                            class="text-danger">*</span></label>
                                                    <div class="rating-checked">
                                                        <input type="radio" name="rating" value="5"
                                                            style="--r: #ffb301" />
                                                        <input type="radio" name="rating" value="4"
                                                            style="--r: #ffb301" />
                                                        <input type="radio" name="rating" value="3"
                                                            style="--r: #ffb301" />
                                                        <input type="radio" name="rating" value="2"
                                                            style="--r: #ffb301" />
                                                        <input type="radio" name="rating" value="1"
                                                            style="--r: #ffb301" />
                                                    </div>
                                                    @error('rating')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="review__form">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="name">নাম <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="name"
                                                                    value="{{ old('name') }}">
                                                                @error('name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="summary">সারসংক্ষেপ <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="summary" id="summary"
                                                                    value="{{ old('summary') }}">
                                                                @error('summary')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="review">পর্যালোচনা <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="review" id="review"
                                                                    value="{{ old('review') }}">
                                                                @error('review')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">পর্যালোচনা জমা দিন</button>
                                                </div>
                                            </form>
                                            <div class="review_list">
                                                @php
                                                    $data = \App\Models\Review::where('product_id', $product->id)
                                                        ->latest()
                                                        ->get();
                                                @endphp
                                                @foreach ($data as $value)
                                                    @if ($value->status == 1)
                                                        <div class="single-review-item">
                                                            <div class="rating">
                                                                @if ($value->rating == '1')
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($value->rating == '2')
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($value->rating == '3')
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($value->rating == '4')
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                @elseif($value->rating == '5')
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                @endif
                                                            </div>
                                                            <h5 class="review-title">{{ $value->summary }}</h5>
                                                            <h6 class="review-user">{{ $value->name }}</h6>
                                                            <span class="review-description">{!! $value->review !!}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="border">
                                <div class="p-1 row g-0 align-items-center" style="background: #f9f9f9">
                                    <div class="col-8">
                                        <div class="section__heading">
                                            <h3 class="py-3 fs-3">সংশ্লিষ্ট বই</h3>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="related__roduct_arrow text-end"></div>
                                    </div>
                                </div>
                                <div class="related__product__active">
                                    <div class="category__product__active">
                                    @foreach ($relatedProduct as $product)
                                            @include('frontend.common.product_grid_view')
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('footer-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <script>
        document.getElementById('shareButton').addEventListener('click', function() {
            var shareSocial = document.querySelector('.share__social');
            shareSocial.classList.toggle('d-none');
        });
    </script>

    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-angle-right"></i></button>',
            fade: true,
            asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            autoplay: true,
            margin: 10,
            arrows: false,
            centerMode: true,
            focusOnSelect: true,
            vertical: true,
            verticalSwiping: true,
            centerPadding: '0px', // Adjust centerPadding to zero
            infinite: true // Enable infinite looping
        });
    </script>
    <script>
        $(document).ready(function() {
            const minus = $('.quantity__minus');
            const plus = $('.quantity__plus');
            const input = $('.quantity__input');
            minus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                if (value > 1) {
                    value--;
                }
                input.val(value);
            });

            plus.click(function(e) {
                e.preventDefault();
                var value = input.val();
                value++;
                input.val(value);
            })
        });
    </script>
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     const modal = document.getElementById('showPdfBook');
        //     const iframe = document.getElementById('pdfIframe');
        //     const links = document.querySelectorAll('.pdf-link');

        //     links.forEach(link => {
        //         link.addEventListener('click', function (event) {
        //             event.preventDefault();
        //             const pdfUrl = this.getAttribute('data-pdf');
        //             iframe.src = pdfUrl + '#toolbar=0';
        //         });
        //     });

        //     modal.addEventListener('hidden.bs.modal', function () {
        //         iframe.src = ''; // Clear the iframe src when modal is closed
        //     });
        // });

        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('showPdfBook');
            const iframe = document.getElementById('pdfIframe');
            const links = document.querySelectorAll('.pdf-link');

            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const pdfUrl = this.getAttribute('data-pdf');
                    iframe.src = pdfUrl + '#toolbar=0';
                    $('#showPdfBook').modal('show');
                });
            });

            $('#showPdfBook').on('hidden.bs.modal', function () {
                iframe.src = ''; // Clear the iframe src when modal is closed
            });
        });
    </script>
@endpush
