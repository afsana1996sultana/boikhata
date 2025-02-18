<?php $__env->startPush('css'); ?>
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

        @media  screen and (max-width: 1023px) {
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
            color: #4398fe;
        }

        .single-review-item {
            border-top: 1px solid #4398fe;
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
            background: #4398fe6b;
            color: #4398fe;
            border: 0;
            border-radius: 4px;
            padding: 5px 10px;
            transition: all .5s ease-in-out;
        }

        .single-book:hover button {
            background: #4398fe;
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
            color: #4398fe !important;
        }
    </style>
    <!-- Image zoom -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/magiczoomplus/magiczoomplus.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('meta'); ?>
    <meta property="og:title" content="<?php echo e($product->name_en); ?>">
    <meta property="og:image" content="<?php echo e(asset($product->product_thumbnail)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-frontend'); ?>
    <?php echo $__env->make('frontend.common.maintenance', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb d-flex align-items-center" style="justify-content: space-between;cursor: pointer;">
                    <a href="<?php echo e(route('home')); ?>" rel="nofollow"><i class="mr-5 fi-rs-home"></i>
                        <?php if(session()->get('language') == 'bangla'): ?>
                            <?php echo e($product->category->name_bn ?? 'No Category'); ?>

                        <?php else: ?>
                            <?php echo e($product->category->name_en ?? 'No Category'); ?>

                        <?php endif; ?>
                    </a>
                    <div class="product__item d-md-none d-sm-block">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dots__dropdown">
                                <li><a class="dropdown-item" href="<?php echo e(route('home')); ?>">Home</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('category_list.index')); ?>">Categories</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('product.show')); ?>">Shop</a></li>
                                <?php if(auth()->guard()->check()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">My Account</a></li>
                                <?php endif; ?>
                                <?php if(auth()->guard()->guest()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('login')); ?>">Login</a></li>
                                <?php endif; ?>
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
                                <div class="showpdf">
                                    <div data-bs-toggle="modal">
                                        <?php $__currentLoopData = $product->multi_imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="pdf-link">
                                                <img src="<?php echo e(asset($img->photo_name)); ?>" alt="Product Image" class="thumbnail_book_image">
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="detail-info">
                                    <?php
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
                                    ?>

                                    <input type="hidden" id="discount_amount" value="<?php echo e($discount); ?>">
                                    <h2 class="title-detail">
                                        <?php echo e($product->name_bn); ?>

                                    </h2>
                                    <h4 class="title-detail">
                                       <strong class="text-black">লেখক : </strong>
                                        <?php echo e($product->writer->writer_name ?? 'No Authors'); ?>

                                    </h4>
                                    <h6 class="category_show">ক্যাটেগরি : <?php echo e($product->category->name_bn); ?></h6>
                                    <div class="d-inline-block">
                                        <div class="mb-5 hot_stock">In Stock </div>
                                    </div>

                                     <div class="clearfix product-price-cover">
                                        <div class="float-left product-price primary-color" style="display: block">
                                            <?php if($product->discount_price <= 0): ?>
                                                <span class="current-price">৳<?php echo e(formatNumberInBengali($product->regular_price)); ?></span>
                                            <?php else: ?>
                                                <span class="current-price">৳<?php echo e(formatNumberInBengali($amount)); ?></span>
                                                <?php if($product->discount_type == 1): ?>
                                                    <span class="save-price font-md color3 ml-15">৳<?php echo e(formatNumberInBengali($discount)); ?> Off </span>
                                                <?php elseif($product->discount_type == 2): ?>
                                                    <span class="save-price font-md color3 ml-15"><?php echo e(formatNumberInBengali($product->discount_price)); ?>% Off</span>
                                                <?php endif; ?>
                                                    <span class="old-price font-md ml-15">৳<?php echo e(formatNumberInBengali($product->regular_price)); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row" id="attribute_alert"></div>
                                </div>
                                <div class="row" id="stock_alert"></div>

                                <?php if($product->short_description_en != null): ?>
                                    <div class="product__info__text">
                                        <p><?php echo $product->short_description_en ?? ''; ?></p>
                                    </div>
                                <?php endif; ?>

                                <div class="buy_button">
                                    <input type="hidden" id="product_id" value="<?php echo e($product->id); ?>">
                                    <input type="hidden" id="pname" value="<?php echo e($product->name_en); ?>">
                                    <input type="hidden" id="product_price" value="<?php echo e($amount); ?>">
                                    <input type="hidden" id="minimum_buy_qty" value="<?php echo e($product->minimum_buy_qty); ?>">
                                    <input type="hidden" id="qty" value="1">
                                    <input type="hidden" id="stock_qty" value="<?php echo e($product->stock_qty); ?>">
                                    <input type="hidden" id="pvarient" value="">
                                    <input type="hidden" id="buyNowCheck" value="0">
                                    <button type="submit" onclick="buyNow()"><i class="fa-solid fa-bag-shopping"></i> এখুনি কিনুন</button>
                                    <button type="submit" onclick="addToCart()"><i class="fa-solid fa-cart-shopping"></i> কার্টে যুক্ত করুন</button>
                                </div>

                                <div class="share_button">
                                   <div class="social_share">
                                        <button id="shareButton"><i class="fa-solid fa-share-nodes"></i>Share this Book</button>
                                        <div class="share__social d-none">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-facebook-f" title="facebook"></i></a>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode(url()->current())); ?>&title=<?php echo e(urlencode($product->name_en)); ?>" target="_blank"><i class="fab fa-linkedin-in" title="linkedin"></i></a>
                                            <a href="https://www.youtube.com/share?url=<?php echo e(urlencode(url()->current())); ?>" target="_blank"><i class="fab fa-youtube" title="youtube"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                <table class="table no-border">
                                    <tbody id="">
                                        <h5>বেশি বিক্রিত বই</h5>
                                        <?php $__currentLoopData = $last_30_days_sales->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $today_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $MostSellProduct = \App\Models\Product::find($today_product->product_id);
                                            ?>
                                            <?php if($MostSellProduct !== null): ?>
                                                <tr>
                                                    <td class="image product-thumbnail product__detail__page">
                                                        <a href="<?php echo e(route('product.details', $MostSellProduct->slug)); ?>">
                                                            <img src="<?php echo e(asset($MostSellProduct->product_thumbnail)); ?>" alt="<?php echo e($MostSellProduct->name_bn); ?>">
                                                        </a>
                                                        <h6 class="mb-5">
                                                            <a href="<?php echo e(route('product.details', $MostSellProduct->slug)); ?>" class="text-heading">
                                                                <?php echo e(\Illuminate\Support\Str::words(strip_tags($MostSellProduct->name_bn ?? ''), 2, '....')); ?>

                                                            </a>
                                                            <?php if($MostSellProduct->writer): ?>
                                                                <a href="<?php echo e(route('writer.product', $MostSellProduct->writer->slug)); ?>" class="mt-1 d-block">
                                                                    <?php echo e(\Illuminate\Support\Str::words(strip_tags($MostSellProduct->writer->writer_name ?? ''), 2, '....')); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                            <div>
                                                                <?php
                                                                    if ($MostSellProduct->discount_type == 1) {
                                                                        $price_after_discount = $MostSellProduct->regular_price - $MostSellProduct->discount_price;
                                                                    } elseif ($MostSellProduct->discount_type == 2) {
                                                                        $price_after_discount = $MostSellProduct->regular_price - ($MostSellProduct->regular_price * $MostSellProduct->discount_price) / 100;
                                                                    }
                                                                ?>

                                                                <?php if($MostSellProduct->discount_price > 0): ?>
                                                                    <span style="margin-bottom: 0; font-weight: bold;">
                                                                        ৳<?php echo e(formatNumberInBengali($price_after_discount)); ?>

                                                                    </span>
                                                                    <span style="margin-bottom: 0; color: #4398fe; font-weight: bold;">
                                                                        <del>৳<?php echo e(formatNumberInBengali($MostSellProduct->regular_price)); ?></del>
                                                                    </span>
                                                                <?php else: ?>
                                                                    <span style="margin-bottom:0; font-weight: bold;">
                                                                        ৳<?php echo e(formatNumberInBengali($MostSellProduct->regular_price)); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <input type="hidden" id="product_id" value="<?php echo e($MostSellProduct->id); ?>">
                                                            <input type="hidden" id="pname" value="<?php echo e($MostSellProduct->name_en); ?>">
                                                            <input type="hidden" id="product_price" value="<?php echo e($amount); ?>">
                                                            <input type="hidden" id="minimum_buy_qty" value="<?php echo e($MostSellProduct->minimum_buy_qty); ?>">
                                                            <input type="hidden" id="qty" value="1">
                                                            <input type="hidden" id="stock_qty" value="<?php echo e($MostSellProduct->stock_qty); ?>">
                                                            <input type="hidden" id="pvarient" value="">
                                                            <input type="hidden" id="buyNowCheck" value="0">
                                                            <button type="submit" onclick="addToCart()">
                                                                <i class="fa-solid fa-cart-shopping"></i> কার্টে যুক্ত করুন
                                                            </button>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php
                                            $data = \App\Models\Review::where('product_id', $product->id)->where('status', 1)->get();
                                        ?>
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                            href="#reviews">পর্যালোচনা (<?php echo e($data->count()); ?>)</a>
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
                                                <?php if(session()->get('language') == 'bangla'): ?>
                                                    <?php echo $product->description_en ?? 'No Product Long Descrption'; ?>

                                                <?php else: ?>
                                                    <?php echo $product->description_bn ?? 'No Product Logn Descrption'; ?>

                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img class="img-fluid" src="<?php echo e(asset($product->writer->writer_image ?? '')); ?>" alt="<?php echo e($product->writer->writer_name ?? ''); ?>">
                                            </div>
                                            <div class="col-md-10">
                                                <div class="authors_details">
                                                    <p>লেখকের জীবনী</p>
                                                    <h6><?php echo e($product->writer->writer_name ?? 'No Authors'); ?></h6>
                                                    <p><?php echo e($product->writer->description ?? 'No Discriptions'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="reviews">
                                        <div class="product__review__system">
                                            <h6>ক্রেতার পর্যালোচনা:</h6>
                                            <h5><?php echo e($product->name_bn); ?></h5>
                                            <form action="<?php echo e(route('review.store')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                                <input type="hidden" name="user_id"
                                                    value="<?php echo e(Auth::user()->id ?? 'null'); ?>">
                                                <div class="product__rating">
                                                    <label for="rating">পর্যালোচনা <span
                                                            class="text-danger">*</span></label>
                                                    <div class="rating-checked">
                                                        <input type="radio" name="rating" value="5"
                                                            style="--r: #4398fe" />
                                                        <input type="radio" name="rating" value="4"
                                                            style="--r: #4398fe" />
                                                        <input type="radio" name="rating" value="3"
                                                            style="--r: #4398fe" />
                                                        <input type="radio" name="rating" value="2"
                                                            style="--r: #4398fe" />
                                                        <input type="radio" name="rating" value="1"
                                                            style="--r: #4398fe" />
                                                    </div>
                                                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger"><?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="review__form">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="name">নাম <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="name"
                                                                    value="<?php echo e(old('name')); ?>">
                                                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <p class="text-danger"><?php echo e($message); ?></p>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="summary">সারসংক্ষেপ <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="summary" id="summary"
                                                                    value="<?php echo e(old('summary')); ?>">
                                                                <?php $__errorArgs = ['summary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <p class="text-danger"><?php echo e($message); ?></p>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="review">পর্যালোচনা <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="review" id="review"
                                                                    value="<?php echo e(old('review')); ?>">
                                                                <?php $__errorArgs = ['review'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <p class="text-danger"><?php echo e($message); ?></p>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">পর্যালোচনা জমা দিন</button>
                                                </div>
                                            </form>
                                            <div class="review_list">
                                                <?php
                                                    $data = \App\Models\Review::where('product_id', $product->id)
                                                        ->latest()
                                                        ->get();
                                                ?>
                                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($value->status == 1): ?>
                                                        <div class="single-review-item">
                                                            <div class="rating">
                                                                <?php if($value->rating == '1'): ?>
                                                                    <i class="fa fa-star"></i>
                                                                <?php elseif($value->rating == '2'): ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                <?php elseif($value->rating == '3'): ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                <?php elseif($value->rating == '4'): ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                <?php elseif($value->rating == '5'): ?>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                    <i class="fa fa-star"></i>
                                                                <?php endif; ?>
                                                            </div>
                                                            <h5 class="review-title"><?php echo e($value->summary); ?></h5>
                                                            <h6 class="review-user"><?php echo e($value->name); ?></h6>
                                                            <span class="review-description"><?php echo $value->review; ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <?php $__currentLoopData = $relatedProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo $__env->make('frontend.common.product_grid_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\boikhata\resources\views/frontend/product/product_details.blade.php ENDPATH**/ ?>