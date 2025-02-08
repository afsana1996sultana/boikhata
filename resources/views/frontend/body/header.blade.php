<!-- header start -->
<header>
    <div class="py-3 header-top sticky-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xl-3">
                    <div class="category_bars d-flex align-items-center justify-content-evenly">
                        <div>
                            <i class="fa-solid fa-list-ul" id="categoryToggle"></i>
                            <ul class="header_category d-none" id="categoryMenu">
                                @foreach(get_categories()->take(13) as $category)
                                    <li>
                                        <a
                                            href="{{ route('product.category', $category->slug) }}">
                                            @if (session()->get('language') == 'bangla')
                                                {{ $category->name_bn }}
                                            @else
                                                {{ $category->name_en }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ route('home') }}">
                            @php
                                $logo = get_setting('site_logo');
                            @endphp
                            @if($logo != null)
                                <img src="{{ asset(get_setting('site_logo')->value ?? 'null') }}"
                                    alt="{{ env('APP_NAME') }}">
                            @else
                                <img src="{{ asset('upload/no_image.jpg') }}"
                                    alt="{{ env('APP_NAME') }}">
                            @endif
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-6 ">
                    <div class="header-search">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <input type="text" class="search-field search" onfocus="search_result_show()"
                                onblur="search_result_hide()" name="search"
                                placeholder="বইয়ের নাম, পাবলিকেশন ও লেখক দিয়ে অনুসন্ধান করুন">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="shadow-lg searchProducts"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-3 d-none d-lg-flex align-items-center">
                    <div class="gap-4 d-flex align-items-center justify-content-end">
                        <div class="header-cart">
                            <a href="{{ route('cart.show') }}"><i
                                    class="fa-solid fa-cart-shopping"></i></a>
                            <span class="cartQty"></span>
                        </div>
                        <div class="border_border"></div>
                        @auth
                            <a href="{{ route('dashboard') }}" class="header-sign">
                                <i class="fa fa-user"></i> অ্যাকাউন্ট
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="header-sign">
                                <i class="fa fa-user"></i> সাইন ইন
                            </a>
                            <a href="{{ route('register') }}" class="header-sign">
                                <i class="fa fa-user"></i> সাইন আপ
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-area" style="background-color: #F06A25;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 d-lg-block d-none">
                    <div class="main-menu">
                        <ul class="p-0 mb-0 d-flex align-items-center">
                            <li><a href="{{ route('home') }}">হোম</a></li>
                            <li><a href="">লেখক <i class="fa fa-angle-down"></i> </a>
                                <ul class="mega_menu">
                                    <div class="row g-0">
                                        <div class="col">
                                            <ul class="single-megamenu">
                                                @foreach(get_writers()->take(40) as $writers)
                                                <li>
                                                        <a href="{{ route('writer.product', $writers->slug) }}">{{ $writers->writer_name }}</a>
                                                    </li>
                                                    @endforeach
                                                    <li><a href="{{route('authors')}}" class="seemore">আরো দেখুন...</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </ul>
                            </li>
                            <li><a href="">প্রকাশনী <i class="fa fa-angle-down"></i> </a>
                                <ul class="mega_menu">
                                    <div class="row g-0">
                                        <div class="col">
                                            <ul class="single-megamenu">
                                                @foreach(get_publications()->take(40) as $publications)
                                                <li><a
                                                href="{{ route('publication.product', $publications->id) }}">{{ $publications->name }}</a>
                                            </li>
                                            @endforeach
                                            <li><a href="{{route('publications')}}" class="seemore">আরো দেখুন...</a></li>
                                                </ul>
                                            </div>
                                    </div>
                                </ul>
                            </li>
                            @foreach(get_categories()->take(5) as $category)
                                <li>
                                    <a
                                        href="{{ route('product.category', $category->slug) }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $category->name_bn }}
                                        @else
                                            {{ $category->name_en }}
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
