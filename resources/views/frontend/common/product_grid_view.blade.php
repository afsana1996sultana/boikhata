
    <div class="single-book card">
        @if($product->discount_price > 0)
            <span class="ribbon1">
                @if($product->discount_type == 1)
                    <span class="discount">৳ {{ formatNumberInBengali($product->discount_price) }} ছাড়</span>
                @elseif($product->discount_type == 2)
                    <span class="discount">{{ formatNumberInBengali($product->discount_price) }}% ছাড়</span>
                @endif
            </span>
        @endif

        <a href="{{ route('product.details', $product->slug) }}">
            <img src="{{ asset($product->product_thumbnail) }}" alt="{{ $product->name_bn  }}">
            <h6 class="px-2 py-2 mb-0 text-center lh-base fs-6 fw-normal">{{ \Illuminate\Support\Str::words(strip_tags($product->name_bn), 4,'....')  }}</h6>
        </a>
        <small class="text-center" style="color: #000;">{{ \Illuminate\Support\Str::words(strip_tags($product->writer->writer_name ?? ''), 5,'....')  }}</small>
        <div class="p-2 d-flex justify-content-between align-items-center single__book__item">
            <div>
                @php
                if ($product->discount_type == 1) {
                    $price_after_discount = $product->regular_price - $product->discount_price;
                } elseif ($product->discount_type == 2) {
                    $price_after_discount =
                    $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                }
                @endphp

                @if ($product->discount_price > 0)
                    <span style="margin-bottom: 0; font-weight: bold;">৳{{ formatNumberInBengali($price_after_discount) }}</span>
                    <span style="margin-bottom: 0; color: #EF7D20; font-weight: bold;"><del>৳{{ formatNumberInBengali($product->regular_price) }}</del></span>
                @else
                    <span style="margin-bottom:0; font-weight: bold;">৳{{ formatNumberInBengali($product->regular_price) }}</span>
                @endif
            </div>

            <div>
                <input type="hidden" id="pfrom" value="direct">
                <input type="hidden" id="product_product_id" value="{{ $product->id }}" min="1">
                <input type="hidden" id="{{ $product->id }}-product_pname" value="{{ $product->name_en }}">
                <input type="hidden" id="buyNowCheck" value="0">
                <button onclick="addToCartDirect({{ $product->id }})">কার্টে যুক্ত করুন</button>
            </div>
        </div>
    </div>
