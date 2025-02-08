<!-- footer start -->
<footer class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="gap-4 support-section d-flex align-items-center">
                        <div class="gap-4 delivery d-flex align-items-center justify-content-between">
                            <i class="fa-solid fa-truck"></i>
                            <h3>Fastest <br> Delivery</h3>
                        </div>
                        <div class="space"></div>
                        <div class="gap-4 support d-flex align-items-center justify-content-between">
                            <i class="fa-solid fa-phone-volume"></i>
                            <h3>24/7 <br> Support</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom" style="background-color: #221F1F;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="footer_widget_address">
                        <a href="{{ route('home') }}" class="mb-15">
                            @php
                                $logo = get_setting('site_footer_logo');
                            @endphp
                            @if($logo != null)
                                <img src="{{ asset(get_setting('site_footer_logo')->value ?? '') }}" alt="{{ env('APP_NAME') }}" class="w-50">
                            @else
                                <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                            @endif
                        </a>
                        <ul>
                            <li><strong>Address: </strong><a href="#"><span>{{ get_setting('business_address')->value ?? 'null' }}</span></a></li>
                            <li><strong>Phone: </strong><a href="tel:{{ get_setting('phone')->value ?? 'null' }}"><span>{{ get_setting('phone')->value ?? 'null' }}</span></a></li>
                            <li><strong>Email: </strong><a href="tel:{{ get_setting('email')->value ?? 'null' }}"><span>{{ get_setting('email')->value ?? 'null' }}</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer_widget">
                        <div class="footer_title">
                            <h3 style="color:#4398fe">Information</h3>
                        </div>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('product.show') }}">Product</a></li>
                            <li><a href="{{ route('all.blogs') }}">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer_widget">
                        <div class="footer_title">
                            <h3 style="color:#4398fe">Company</h3>
                        </div>
                        <ul>
                            @foreach(get_pages_both_footer() as $page)
                                <li>
                                    <a href="{{ route('page.about', $page->slug) }}">
                                        {{ $page->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-3 text-center row">
                <div class="col-12 col-md-10 offset-md-1">
                    <button style="border: 0; background: #4398fe; color: #fff;  border-radius: 3px;padding: 5px 40px;font-size: 16px;margin-bottom:30px">Payment
                        Methods</button>
                    <img src="{{ asset('frontend/assets/imgs/payment.png') }}" alt="payment method">
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 copyright" style="background:#38302B">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 col-12">
                    <div class="flex-wrap d-flex align-items-center">
                        <p class="text-white fs-6">Follow Us</p>
                        <ul class="mb-0 social d-flex align-items-center">
                            <li><a href="{{ get_setting('facebook_url')->value ?? '' }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="{{ get_setting('linkedin_url')->value ?? '' }}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="{{ get_setting('instagram_url')->value ?? '' }}"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="{{ get_setting('youtube_url')->value ?? '' }}"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                        <p class="text-white fs-6">Copyright © 2024. All Rights Reserved By {{ get_setting('copy_right')->value ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <p class="text-center text-white">Developed by <a class="text-white" target="_blank" href="https://classicit.com.bd/"><strong>Classic IT</strong></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="bg-white shadow-lg nest-mobile-bottom-nav d-xl-none mobile_fixed_bottom border-top rounded-top mobile__fixed__none" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">

    <div>
        <ul class="m-0 mb-0 d-flex justify-content-around" style="padding-left:0">
            <li class="text-center"><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> <span> Home</span></a></li>
            <li class="text-center"><a href="{{ route('product.show') }}"><i class="fa-solid fa-shop"></i> <span> Shop</span></a></li>
            <li class="text-center mobile_cart"><a href="">
                    <div class="cart_icon"><i class="fa-solid fa-cart-shopping"></i></div> <span> Cart(<span class="cart-count cartQty"></span>)</span>
                </a></li>
            <li class="text-center" id="mobile__menu__toggle">
                <a href="javascript:void(0);"><i class="fa-solid fa-list"></i> <span> Menu</span></a>
                <div class="mobile_mega_menu">
                    <ul>
                        @foreach (get_categories() as $category)
                            <li>
                                <a href="{{ route('product.category', $category->slug) }}">
                                    @if (session()->get('language') == 'bangla')
                                        {{ $category->name_bn }}
                                    @else
                                        {{ $category->name_en }}
                                    @endif
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <div class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            লেখক
                                        </div>
                                    </div>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach (get_writers() as $writers)
                                                    <li><a href="{{ route('writer.product', $writers->slug)}}">{{ $writers->writer_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div class="accordion-header">
                                        <div class="accordion-button collapsed"  data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            প্রকাশনী
                                        </div>
                                    </div>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                             <ul>
                                                @foreach (get_publications() as $publications)
                                                    <li><a href="{{ route('publication.product', $publications->id)}}">{{ $publications->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            @if(Auth()->check())
            <li class="text-center"><a href="{{ route('dashboard') }}"><i class="fa-solid fa-user"></i> <span> Account</span></a></li>
            @else
            <li class="text-center"><a href="{{ route('login') }}"><i class="fa-solid fa-user"></i> <span> Account</span></a></li>
            @endif
        </ul>
    </div>
</div>