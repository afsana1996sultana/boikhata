@extends('layouts.frontend')
@section('content-frontend')
<main class="main product-shop">
    <div class="container mt-40 mb-30">
        <div class="row">
            <div class="blog-area section-padding">
                <div class="container">
                    <div class="bg-black section__top">
                        <h6 class="text-white text-capitalize">
                            @if (session()->get('language') == 'bangla')
                                ব্লগ
                            @else
                                BLOG
                            @endif
                        </h6>
                    </div>
                    <div class="blog__active">
                        @foreach ($blogs as $blog)
                            <div class="single__blog">
                                <a href="{{ route('blog.details', $blog->slug) }}">
                                    <img src="{{ asset($blog->blog_img) }}" width="100%" alt="">
                                </a>

                                <div class="blog__content">
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog__title">
                                        @if (session()->get('language') == 'bangla')
                                            {{ Str::limit($blog->title_bn, 30) }}
                                        @else
                                            {{ Str::limit($blog->title_en, 30) }}
                                        @endif
                                    </a>
                                    <a class="blog__btn" href="{{ route('blog.details', $blog->slug) }}">read more</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
