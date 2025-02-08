@extends('layouts.frontend')
@section('content-frontend')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>হোম</a>
                <span></span> শপ
                <span></span> কার্ট
            </div>
        </div>
    </div>
    <div class="container mb-50 mt-20">
        <div class="row">
            <div class="col-lg-8 mb-20">
                <h1 class="heading-2 mb-10" style="font-size: 30px !important">আপনার কার্ট</h1>

                <div class="d-flex justify-content-between flex-wrap">
                    <h6 class="text-body">আপনার কার্টে <span class="text-brand" id="total_cart_qty"></span> টি পণ্য রয়েছে৷</h6>
                    @if ($cartCount > 0)
                        <h6 class="text-body"><a href="{{ route('cart.remove.all') }}" id="delete" class=""><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" width="10px" class="text-center">ইমেজ</th>
                                <th scope="col" width="300px" class="text-center">পণ্য</th>
                                <th scope="col" width="50px" class="text-center">মূল্য</th>
                                <th scope="col" width="10px" class="text-center">পরিমাণ</th>
                                <th scope="col" width="10px" class="text-center">সাবটোটাল</th>
                                <th scope="col" width="10px" class="end">রিমুভ</th>
                            </tr>
                        </thead>
                        <tbody id="cartPage"></tbody>
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a href="{{route('home')}}" class="btn continue__shopping"><i class="fi-rs-arrow-left mr-10"></i>কন্টিনিউ শপিং</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="border p-md-4 cart-totals">
                    <div class="table-responsive">
                        <table class="table no-border">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 id="cartSubTotal">সাবটোটাল</h6>

                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-brand text-end">৳<span id="cartSubTotal"></span></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6>টোটাল</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-brand text-end">৳<span id="cartSubTotal"></span></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('checkout')}}" class="btn w-100 proceedCheckout {{ Cart::count() == 0 ? 'disabled' : '' }}" {{ Cart::count() == 0 ? 'disabled' : '' }}>
                        চেকআউট করতে এগিয়ে যান<i class="fi-rs-sign-out ml-15"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
