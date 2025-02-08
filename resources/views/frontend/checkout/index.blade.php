@extends('layouts.frontend')
@push('css')
<style>
    .shipping_calculator .custom_select .select2-container {
        background: #fff;
        border-radius: 10px;
    }

    .shipping_calculator .custom_select .select2-container--default .select2-selection--single {
        border-radius: 0px !important;
        height: 48px !important;
        line-height: 1 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: -3px !important;
    }

    .shipping_calculator .custom_select .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: inherit !important;
    }

    .checkout_slide ul.slick-dots {
        position: absolute;
        bottom: 20px;
        display: flex;
        left: 50%;
        transform: translateX(-50%);
        margin: 0;
    }

    .checkout_slide ul.slick-dots li {
        text-indent: -9999px;
        width: 10px;
        height: 10px;
        background: #f06a25;
        margin: 0 3px;
        border-radius: 5px;
        transition: all .5s ease-in-out;
    }

    .checkout_slide ul.slick-dots li.slick-active {
        width: 30px;
        background: #fff;
    }

    .custom_select .select2-container {
        max-width: 200px;
    }

    .billing__info .select2-container {
        max-width: 100%;
        background: #fff;
    }
    .select2-container--default .select2-selection--single{
        border:0 !important
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: inherit !important;
    padding-left: 20px;
}
</style>

@endpush
@section('content-frontend')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="mr-5 fi-rs-home"></i>হোম</a>
                <span></span> শপ
                <span></span> চেকআউট
            </div>
        </div>
    </div>
    <div class="container mt-20 mb-20">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="heading-2 fw-normal">চেক আউট</h3>
                <div class="gap-4 d-flex align-items-center">
                    <h6 class="fw-normal">আপনি <span id="total_cart_qty"></span> বই কার্টে যুক্ত করেছেন!</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 ">
                <hr>
                <div class="row">
                    <div class="col-lg-6 mb-sm-15 mb-lg-3 mb-md-3">
                        <div class="panel-collapse collapse login_form" id="loginform">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details
                                    below. If you are a new customer, please proceed to the Billing &amp; Shipping
                                    section.</p>
                                <form method="post" style="">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Username Or Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember
                                                        me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" name="login">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('checkout.payment') }}" method="post">
                    @csrf
                    <div class="row billing__info">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name" class="text-black fw-bold"><span class="text-danger">*</span> নাম </label>
                                <input type="text" id="name" name="name" placeholder="আপনার সম্পূর্ণ নাম লিখুন" value="{{ Auth::user()->name ?? old('name') }}" oninput="validateNameInput()" required>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="phone" class="text-black fw-bold"><span class="required text-danger">*</span> মোবাইল </label>
                                <input type="number" id="numberInput" oninput="validateNumberInput(this)"name="phone" placeholder="আপনার মোবইল নম্বার দিন" value="{{ Auth::user()->phone ?? old('phone') }}" required>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6 address_select_custom">
                                <div class="custom_select custom_address_modal">
                                    <label for="district_id" class="text-black fw-bold"><span
                                            class="text-danger">*</span> জেলা</label>
                                    <select class="form-control select-active selectedistrict" name="district_id" id="district_id"
                                        required>
                                        <option value="">আপনার জেলা সিলেক্ট করুন</option>
                                        @foreach (get_districts() as $district)
                                        <option value="{{ $district->id }}">
                                            {{ ucwords($district->district_name_bn) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 address_select_custom">
                                <div class="custom_select custom_address_modal">
                                    <label for="upazilla_id" class="text-black fw-bold"><span
                                            class="text-danger">*</span>উপজেলা</label>
                                    <select class="form-control select-active" name="upazilla_id" id="upazilla_id"
                                        required>
                                        <option selected="" value="">আপনার উপজেলা সিলেক্ট করুন</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="address" class="fw-bold text-black"><span class="text-danger">*</span>
                                    বাড়ি/রাস্তা/এলাকা</label>
                                <textarea name="address" id="address" class="form-control" placeholder="ঠিকানা"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="shipping_id" class="fw-bold text-black col-12"><span
                                    class="text-danger">*</span> শিপিং</label>
                            <select class="form-control select-active" name="shipping_id" id="shipping_id"
                                required>
                                <option value="">--সিলেক্ট শিপিং--</option>
                                @foreach ($shippings as $key => $shipping)
                                <option value="{{ $shipping->id }}">
                                    @if ($shipping->type == 1)
                                    ঢাকার ভিতরে
                                    @elseif($shipping->type == 2)
                                    ঢাকার বাইরে
                                    @endif
                                </option>
                                @endforeach
                            </select>
                            @error('shipping_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-5">
                <hr class="mb-0">
                <div class="mb-20 border cart-totals">
                    <div class="d-flex align-items-end justify-content-between fw-normal">
                        <h5>আপনার অর্ডার</h5>
                    </div>
                    <div class="order_table checkout">
                        <table class="table no-border">
                            <tbody id="">
                                @foreach ($carts as $cart)
                                <tr>
                                    <td class="image product-thumbnail">
                                        <img src="/{{ $cart->options->image }}" alt="#">

                                        <div>
                                            <h6 class="mb-5">
                                                <a href="{{ route('product.details', $cart->options->slug) }}"
                                                    class="text-heading">{{ $cart->name }} <br>
                                                    <small>{{ $cart->name }}</small>
                                                </a>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <h6 class="pl-20 pr-20 text-muted">x {{ $cart->qty }}</h6>
                                        <h4 class="text-brand">৳{{ $cart->subtotal }}</h4>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="payment_charge">
                            <h6 class="mb-2 d-flex justify-content-between">সাব টোটাল : <span
                                    class="text-brand text-end">৳<span id="cartSubTotal">{{ $cartTotal }}</span></span>
                            </h6>

                            <h6 class="mb-2 d-flex justify-content-between">ডেলিভারি চার্জ : <span
                                    class="text-brand text-end">৳<span id="ship_amount">0.00</span></span>
                                <h6>
                                    <input type="hidden" value="" name="shipping_charge" class="ship_amount" />
                                    <input type="hidden" value="" name="shipping_type" class="shipping_type" />
                                    <input type="hidden" value="" name="shipping_name" class="shipping_name" />
                                    <input type="hidden" value="{{ $cartTotal }}" name="sub_total"
                                        id="cartSubTotalShi" />
                                    <input type="hidden" value="{{ $cartTotal }}" name="grand_total" id="grand_total" />
                                    <hr>

                                    <h6 class="mb-2 d-flex justify-content-between">মোট টাকা :
                                        <span class="text-brand text-end">৳<span id="grand_total_set">{{ $cartTotal }}</span></span>
                                    <h6>
                        </div>
                    </div>
                </div>
                <div class="p-3 payment card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <h4 class="mb-0">পেমেন্ট অপশন সিলেক্ট করুন</h4>
                    <div class="row gutters-5">
                        <h6 class="payment__info"></h6>
                        <div class="col-4 col-sm-3">
                            <lavel class="mb-3 cit-megabox d-block">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="bkash" checked="" value="bkash">
                                <span class="p-2 d-block cit-megabox-elem">
                                    <img src="{{ asset('frontend') }}/assets/imgs/theme/bkash.png" alt=""
                                        class="mb-2 img-fluid">
                                    <span class="text-center d-block">
                                        <span class="d-block fw-500 fs-15">bKash</span>
                                    </span>
                                </span>
                            </lavel>
                        </div>

                        <div class="col-4 col-sm-3">
                            <lavel class="mb-3 cit-megabox d-block">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="sslcommerz" value="sslcommerz">
                                <span class="p-2 d-block cit-megabox-elem">
                                    <img src="{{ asset('frontend') }}/assets/imgs/theme/sslcommerz.png" alt=""
                                        class="mb-2 img-fluid">
                                    <span class="text-center d-block">
                                        <span class="d-block fw-500 fs-15">sslcommerz</span>
                                    </span>
                                </span>
                            </lavel>
                        </div>

                        <div class="col-4 col-sm-3">
                            <lavel class="mb-3 cit-megabox d-block cash_on_delivery">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="cash_on_delivery" value="cod">
                                <span class="p-2 d-block cit-megabox-elem">
                                    <img src="{{ asset('frontend') }}/assets/imgs/theme/cod.png" alt=""
                                        class="mb-2 img-fluid">
                                    <span class="text-center d-block">
                                        <span class="d-block fw-500 fs-15">Cash On Delivery</span>
                                    </span>
                                </span>
                            </lavel>
                        </div>
                    </div>
                    <!-- </div> -->
                    <button type="submit" class="btn btn-fill-out btn-block">অর্ডার করুন <i
                            class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div>
    {{-- <div class="checkout_slide">
        <div class="container">
            @php
            $sliders=\App\Models\Slider::latest()->get();
            @endphp
            <div class="slider_active">
                @foreach ($sliders as $slider)
                <img src="{{ asset($slider->slider_img) }}" alt="">
                @endforeach
            </div>
        </div>
    </div> --}}
</main>
@endsection

@push('footer-script')
<script>
    $(document).ready(function() {
            $('select[name="shipping_id"]').on('change', function() {
                var shipping_cost = $(this).val();
                if (shipping_cost) {
                    $.ajax({
                        url: "{{ url('/checkout/shipping/ajax') }}/" + shipping_cost,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            //console.log(data);
                            // Calculate subtotal and shipping cost
                            var subtotal = parseInt('{{ $cartTotal }}');
                            var shipping_charge = parseInt(data.shipping_charge);

                            // Update shipping charge and other fields
                            $('#ship_amount').text(shipping_charge);
                            $('.ship_amount').val(shipping_charge);
                            $('.shipping_name').val(data.name);
                            $('.shipping_type').val(data.type);

                            // Update the grand total
                            var grand_total_price = (subtotal + shipping_charge);
                            //console.log(grand_total_price);
                            $('#grand_total_set').html(grand_total_price);
                            $('#grand_total').val(grand_total_price);
                        }
                    });
                } else {
                    alert('Please Select any Shipping Address!');
                }
            });
        });

        $(document).on("change", ".selectedistrict", function() {
            var selectValue = $(this).val();
            var selectedCityName = $(this).find('option:selected').text();
            var selectShipping = $('#shipping_id');
            //console.log(selectShipping);
            selectShipping.find('option').remove();
            selectShipping.append('<option value="">--Select--</option>');
            @foreach ($shippings as $key => $shipping)
                if ({{ $shipping->type }} == 1 && selectValue == 52) {
                    selectShipping.append(
                        `<option value="{{ $shipping->id }}">ঢাকার ভিতরে</option>`);
                } else if ({{ $shipping->type }} == 2 && selectValue != 52) {
                    selectShipping.append(
                        `<option value="{{ $shipping->id }}">ঢাকার বাইরে</option>`);
                }
            @endforeach
        });
</script>

<!--  Division To District Show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/division-district/ajax') }}/" + division_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="district_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                                );
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' +
                                    capitalizeFirstLetter(value.district_name_bn) +
                                    '</option>');
                            });
                            $('select[name="upazilla_id"]').html(
                                '<option value="" selected="" disabled="">Select District</option>'
                                );
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Address Realtionship Division/District/Upazilla Show Data Ajax //
            $('select[name="address_id"]').on('change', function() {
                var address_id = $(this).val();
                $('.selected_address').removeClass('d-none');
                if (address_id) {
                    $.ajax({
                        url: "{{ url('/address/ajax') }}/" + address_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#dynamic_division').text(capitalizeFirstLetter(data
                                .division_name_en));
                            $('#dynamic_division_input').val(data.division_id);
                            $("#dynamic_district").text(capitalizeFirstLetter(data
                                .district_name_bn));
                            $('#dynamic_district_input').val(data.district_id);
                            $("#dynamic_upazilla").text(capitalizeFirstLetter(data
                                .upazilla_name_bn));
                            $('#dynamic_upazilla_input').val(data.upazilla_id);
                            $("#dynamic_address").text(data.address);
                            $('#dynamic_address_input').val(data.address);

                            var inputValue = $('#dynamic_district_input').val();
                            //console.log(inputValue);
                            var selectShipping = $('#shipping_id');
                            selectShipping.find('option').remove();
                            selectShipping.append('<option value="">--Select--</option>');
                            @foreach ($shippings as $key => $shipping)
                                if ({{ $shipping->type }} == 1 && inputValue == 52) {
                                    selectShipping.append(`<option value="{{ $shipping->id }}">Inside Dhaka ({{ $shipping->name }})</option>`);
                                } else if ({{ $shipping->type }} == 2 && inputValue != 52) {
                                    selectShipping.append(`<option value="{{ $shipping->id }}">Outside Dhaka ({{ $shipping->name }})</option>`);
                                }
                            @endforeach
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
</script>

<!--  District To Upazilla Show Ajax -->
<script type="text/javascript">
    $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/district-upazilla/ajax') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="upazilla_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="upazilla_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name_bn + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
</script>

<!-- create address ajax -->
<script type="text/javascript">
    $(document).ready(function() {
            $('#addressStore').on('click', function() {
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var upazilla_id = $('#upazilla_id').val();
                var address = $('#address').val();
                var is_default = $('#is_default').val();
                var status = $('#status').val();

                $.ajax({
                    url: '{{ route('address.ajax.store') }}',
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        division_id: division_id,
                        district_id: district_id,
                        upazilla_id: upazilla_id,
                        address: address,
                        is_default: is_default,
                        status: status,
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#address').val(null);

                        $('select[name="address_id"]').html(
                            '<option value="" selected="" disabled="">Select Address</option>'
                            );
                        $.each(data, function(key, value) {
                            $('select[name="address_id"]').append('<option value="' +
                                value.id + '">' + value.address + '</option>');
                        });
                        $('select[name="division_id"]').html(
                            '<option value="" selected="" disabled="">Select Division</option>'
                            );
                        $('select[name="district_id"]').html(
                            '<option value="" selected="" disabled="">Select District</option>'
                            );
                        $('select[name="upazilla_id"]').html(
                            '<option value="" selected="" disabled="">Select Upazilla</option>'
                            );

                        // Start Message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                type: 'success',
                                title: data.success
                            })
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: data.error
                            })
                        }

                        // End Message
                        $('#Close').click();
                    }
                });
            });
        });
</script>
<script>
    function applyCoupon() {
            var coupon = $('#coupon').val();
            var url = '{{ route('coupon.get') }}';
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                url: url,
                method: "GET",
                data: {
                    'coupon': coupon
                },
                success: function(response) {
                    if ((response.success)) {
                        $('#remove').prop('disabled', false);
                        $('#remove').show();
                        var coupon = response.coupon;
                        var discount = response.discount;
                        //console.log(discount);
                        var currentPrice = parseFloat($('#cartSubTotal').text());
                        var grandPrice = parseFloat($('#grand_total_set').text());
                        var amountOfDiscount = 0;
                        if (!discount) {
                            if (coupon.discount_type == 0) {
                                var discount_amount = currentPrice * coupon.discount / 100;
                                amountOfDiscount = grandPrice - discount_amount;
                            } else {
                                var discount_amount = Math.min(coupon.discount, currentPrice);
                                amountOfDiscount = grandPrice - discount_amount;
                            }
                            $('#grand_total_set').text(amountOfDiscount);
                            $('#coupon_discount').text(discount_amount);
                            $('#grand_total').val(amountOfDiscount);
                            $('#coupon_id').val(coupon.id);
                            $('.discount').val(discount_amount);
                            $('#apply').prop('disabled', true);
                            $('#coupon').prop('disabled', true);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1200
                            })
                            Toast.fire({
                                type: 'success',
                                title: response.success
                            })
                        } else {
                            $('#coupon_id').val(coupon.id);
                            $('.discount').val(discount);
                            $('#coupon_discount').text(discount);
                            amountOfDiscount = grandPrice - discount;
                            $('#grand_total_set').text(amountOfDiscount);
                            $('#grand_total').val(amountOfDiscount);
                            $('#apply').prop('disabled', true);
                            $('#coupon').prop('disabled', true);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1200
                            })
                            Toast.fire({
                                type: 'success',
                                title: response.success
                            })
                        }
                    } else {
                        //console.log("Coupon not found.");
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1200
                        })
                        Toast.fire({
                            type: 'error',
                            title: response.error
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX request failed: " + error);
                }
            });
        }
</script>
<script>
    function removeCoupon() {
            var couponamount = parseFloat($('#coupon_discount').text());
            $('#apply').prop('disabled', false);
            $('#coupon').prop('disabled', false);
            var grandvalue = parseFloat($('#grand_total_set').text());
            var grandamount = grandvalue + couponamount;
            if (couponamount > 0) {
                $('.discount').val('');
                $('#coupon').val('');
                $('#coupon_discount').text('0');
                $('#grand_total_set').text(grandamount);
                $('#grand_total').val(grandamount);
                $('#coupon_id').val('');
                $('#remove').prop('disabled', true);
                $('#remove').hide();
            }
        }
</script>
<script>
    $('.select-new').select2({
            width: '100%',
            dropdownParent: $("#staticBackdrop")
        })
</script>

<script>
    function validateNumberInput(input) {
      input.value = input.value.replace(/e/gi, '');
    }

    function validateNameInput() {
        var nameInput = document.getElementById('name').value;
        var pattern = /^[a-zA-Z\s]*$/;
        if (!pattern.test(nameInput)) {
            alert('আপনার নামে কেবলমাত্র অক্ষর এবং স্পেস থাকতে পারে');
            document.getElementById('name').value = nameInput.replace(/[^a-zA-Z\s]/g, '');
        }
    }

  </script>
@endpush
