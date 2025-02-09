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
                                <?php $__currentLoopData = get_categories()->take(13); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a
                                            href="<?php echo e(route('product.category', $category->slug)); ?>">
                                            <?php if(session()->get('language') == 'bangla'): ?>
                                                <?php echo e($category->name_bn); ?>

                                            <?php else: ?>
                                                <?php echo e($category->name_en); ?>

                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <a href="<?php echo e(route('home')); ?>">
                            <?php
                                $logo = get_setting('site_logo');
                            ?>
                            <?php if($logo != null): ?>
                                <img src="<?php echo e(asset(get_setting('site_logo')->value ?? 'null')); ?>"
                                    alt="<?php echo e(env('APP_NAME')); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('upload/no_image.jpg')); ?>"
                                    alt="<?php echo e(env('APP_NAME')); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 col-xl-6 ">
                    <div class="header-search">
                        <form action="<?php echo e(route('product.search')); ?>" method="post">
                            <?php echo csrf_field(); ?>
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
                            <a href="<?php echo e(route('cart.show')); ?>"><i
                                    class="fa-solid fa-cart-shopping"></i></a>
                            <span class="cartQty"></span>
                        </div>
                        <div class="border_border"></div>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="header-sign">
                                <i class="fa fa-user"></i> অ্যাকাউন্ট
                            </a>
                        <?php endif; ?>
                        <?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('login')); ?>" class="header-sign">
                                <i class="fa fa-user"></i> সাইন ইন
                            </a>
                            <a href="<?php echo e(route('register')); ?>" class="header-sign">
                                <i class="fa fa-user"></i> সাইন আপ
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-area" style="background-color: #4398fe;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 d-lg-block d-none">
                    <div class="main-menu">
                        <ul class="p-0 mb-0 d-flex align-items-center">
                            <li><a href="<?php echo e(route('home')); ?>">হোম</a></li>
                            <li><a href="">লেখক <i class="fa fa-angle-down"></i> </a>
                                <ul class="mega_menu">
                                    <div class="row g-0">
                                        <div class="col">
                                            <ul class="single-megamenu">
                                                <?php $__currentLoopData = get_writers()->take(40); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                        <a href="<?php echo e(route('writer.product', $writers->slug)); ?>"><?php echo e($writers->writer_name); ?></a>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <li><a href="<?php echo e(route('authors')); ?>" class="seemore">আরো দেখুন...</a></li>
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
                                                <?php $__currentLoopData = get_publications()->take(40); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publications): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a
                                                href="<?php echo e(route('publication.product', $publications->id)); ?>"><?php echo e($publications->name); ?></a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('publications')); ?>" class="seemore">আরো দেখুন...</a></li>
                                                </ul>
                                            </div>
                                    </div>
                                </ul>
                            </li>
                            <?php $__currentLoopData = get_categories()->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a
                                        href="<?php echo e(route('product.category', $category->slug)); ?>">
                                        <?php if(session()->get('language') == 'bangla'): ?>
                                            <?php echo e($category->name_bn); ?>

                                        <?php else: ?>
                                            <?php echo e($category->name_en); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
<?php /**PATH C:\xampp\htdocs\boikhata\resources\views/frontend/body/header.blade.php ENDPATH**/ ?>