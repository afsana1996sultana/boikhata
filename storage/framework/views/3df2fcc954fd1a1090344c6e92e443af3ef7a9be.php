
    <div class="single-book card">
        <?php if($product->discount_price > 0): ?>
            <span class="ribbon1">
                <?php if($product->discount_type == 1): ?>
                    <span class="discount">৳ <?php echo e(formatNumberInBengali($product->discount_price)); ?> ছাড়</span>
                <?php elseif($product->discount_type == 2): ?>
                    <span class="discount"><?php echo e(formatNumberInBengali($product->discount_price)); ?>% ছাড়</span>
                <?php endif; ?>
            </span>
        <?php endif; ?>

        <a href="<?php echo e(route('product.details', $product->slug)); ?>">
            <img src="<?php echo e(asset($product->product_thumbnail)); ?>" alt="<?php echo e($product->name_bn); ?>">
            <h6 class="px-2 py-2 mb-0 text-center lh-base fs-6 fw-normal"><?php echo e(\Illuminate\Support\Str::words(strip_tags($product->name_bn), 4,'....')); ?></h6>
        </a>
        <small class="text-center" style="color: #000;"><?php echo e(\Illuminate\Support\Str::words(strip_tags($product->writer->writer_name ?? ''), 5,'....')); ?></small>
        <div class="p-2 d-flex justify-content-between align-items-center single__book__item">
            <div>
                <?php
                if ($product->discount_type == 1) {
                    $price_after_discount = $product->regular_price - $product->discount_price;
                } elseif ($product->discount_type == 2) {
                    $price_after_discount =
                    $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                }
                ?>

                <?php if($product->discount_price > 0): ?>
                    <span style="margin-bottom: 0; font-weight: bold;">৳<?php echo e(formatNumberInBengali($price_after_discount)); ?></span>
                    <span style="margin-bottom: 0; color: #4398fe; font-weight: bold;"><del>৳<?php echo e(formatNumberInBengali($product->regular_price)); ?></del></span>
                <?php else: ?>
                    <span style="margin-bottom:0; font-weight: bold;">৳<?php echo e(formatNumberInBengali($product->regular_price)); ?></span>
                <?php endif; ?>
            </div>

            <div>
                <input type="hidden" id="pfrom" value="direct">
                <input type="hidden" id="product_product_id" value="<?php echo e($product->id); ?>" min="1">
                <input type="hidden" id="<?php echo e($product->id); ?>-product_pname" value="<?php echo e($product->name_en); ?>">
                <input type="hidden" id="buyNowCheck" value="0">
                <button onclick="addToCartDirect(<?php echo e($product->id); ?>)">কার্টে যুক্ত করুন</button>
            </div>
        </div>
    </div>
<?php /**PATH C:\xampp\htdocs\boikhata\resources\views/frontend/common/product_grid_view.blade.php ENDPATH**/ ?>