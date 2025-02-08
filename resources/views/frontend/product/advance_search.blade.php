<style>
    .card {
        background-color: #fff;
        padding: 15px;
        border: none
    }
    .input-box {
        position: relative
    }
    .input-box i {
        position: absolute;
        right: 13px;
        top: 15px;
        color: #ced4da
    }
    .form-control {
        height: 50px;
        background-color: #eeeeee69
    }
    .form-control:focus {
        background-color: #eeeeee69;
        box-shadow: none;
        border-color: #eee
    }
    .list {
        padding-top: 20px;
        padding-bottom: 10px;
        display: flex;
        align-items: center
    }
    .border-bottom {
        border-bottom: 2px solid #eee;
    }
    .list i {
        font-size: 19px;
        color: red
    }
    .list small {
        color: #dedddd

    }
    .price{
        font-size: 18px;
        font-weight: bold;
        color: #000;
    }
    .old-price{
        font-size: 14px;
        color: #adadad;
        margin: 0 0 0 7px;
        text-decoration: line-through;
    }
</style>

@if($products -> isEmpty())
    <h5 class="p-4 text-center text-danger">Product Not Found </h5>
@else
    <div class="advance___search">
        @foreach($products as $product)
            <a href="{{ route('product.details',$product->slug) }}">
                @if($loop->index == (count($products) - 1))
                    <div class="list border-bottom">
                        <div style="display:flex; gap:5px">
                            <img src="{{ asset($product->product_thumbnail) }}" style="width: 50px; height: 50px;">
                            <div class="ml-3 d-flex flex-column" style="margin-left: 10px;">
                                <span style="color: black;font-weight:700;line-height:1">{{ $product->name_bn }} </span>
                                <span style="color: black;font-size:12px">{{ $product->writer->writer_name }} (<i style="color:#000;font-size:12px">{{ $product->publication->name }}</i>)</span>
                                @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                @endphp
                            </div>
                        </div>
                        <div>
                            @if ($product->discount_price > 0)
                            <div>
                                <small style="background: #F06A25;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                <div class="product-price">
                                    <span class="price"> ৳{{ formatNumberInBengali($price_after_discount) }} </span>
                                </div>
                            </div>
                            @else
                                <div>
                                    <small style="background: #F06A25;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                    <div class="product-price">
                                        <span class="price"> ৳{{ formatNumberInBengali($product->regular_price) }} </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="list border-bottom">
                        <div style="display:flex; gap:5px">
                            <img src="{{ asset($product->product_thumbnail) }}" style="width: 50px; height: 50px;">
                            <div class="ml-3 d-flex flex-column" style="margin-left: 10px;">
                                <span style="color: black;font-weight:700;line-height:1">{{ $product->name_bn }} </span>
                                <span style="color: black;font-size:12px">{{ $product->writer->writer_name }} (<i style="color:#000;font-size:12px">{{ $product->publication->name }}</i>)</span>
                                @php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                @endphp
                            </div>
                        </div>
                        <div>
                            @if ($product->discount_price > 0)
                            <div>
                                <small style="background: #F06A25;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                <div class="product-price">
                                    <span class="price"> ৳{{ formatNumberInBengali($price_after_discount) }} </span>
                                </div>
                            </div>
                            @else
                                <div>
                                    <small style="background: #F06A25;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                    <div class="product-price">
                                        <span class="price"> ৳{{ formatNumberInBengali($product->regular_price) }} </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </a>
        @endforeach
    </div>
@endif
