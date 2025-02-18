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

<?php if($products -> isEmpty()): ?>
    <h5 class="p-4 text-center text-danger">Product Not Found </h5>
<?php else: ?>
    <div class="advance___search">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('product.details',$product->slug)); ?>">
                <?php if($loop->index == (count($products) - 1)): ?>
                    <div class="list border-bottom">
                        <div style="display:flex; gap:5px">
                            <img src="<?php echo e(asset($product->product_thumbnail)); ?>" style="width: 50px; height: 50px;">
                            <div class="ml-3 d-flex flex-column" style="margin-left: 10px;">
                                <span style="color: black;font-weight:700;line-height:1"><?php echo e($product->name_bn); ?> </span>
                                <span style="color: black;font-size:12px"><?php echo e($product->writer->writer_name); ?> (<i style="color:#000;font-size:12px"><?php echo e($product->publication->name); ?></i>)</span>
                                <?php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                ?>
                            </div>
                        </div>
                        <div>
                            <?php if($product->discount_price > 0): ?>
                            <div>
                                <small style="background: #4398fe;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                <div class="product-price">
                                    <span class="price"> ৳<?php echo e(formatNumberInBengali($price_after_discount)); ?> </span>
                                </div>
                            </div>
                            <?php else: ?>
                                <div>
                                    <small style="background: #4398fe;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                    <div class="product-price">
                                        <span class="price"> ৳<?php echo e(formatNumberInBengali($product->regular_price)); ?> </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="list border-bottom">
                        <div style="display:flex; gap:5px">
                            <img src="<?php echo e(asset($product->product_thumbnail)); ?>" style="width: 50px; height: 50px;">
                            <div class="ml-3 d-flex flex-column" style="margin-left: 10px;">
                                <span style="color: black;font-weight:700;line-height:1"><?php echo e($product->name_bn); ?> </span>
                                <span style="color: black;font-size:12px"><?php echo e($product->writer->writer_name); ?> (<i style="color:#000;font-size:12px"><?php echo e($product->publication->name); ?></i>)</span>
                                <?php
                                    if($product->discount_type == 1){
                                        $price_after_discount = $product->regular_price - $product->discount_price;
                                    }elseif($product->discount_type == 2){
                                        $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price / 100);
                                    }
                                ?>
                            </div>
                        </div>
                        <div>
                            <?php if($product->discount_price > 0): ?>
                            <div>
                                <small style="background: #4398fe;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                <div class="product-price">
                                    <span class="price"> ৳<?php echo e(formatNumberInBengali($price_after_discount)); ?> </span>
                                </div>
                            </div>
                            <?php else: ?>
                                <div>
                                    <small style="background: #4398fe;border-radius: 10px;padding: 3px 5px;font-size: 10px;">স্টকে আছে</small>
                                    <div class="product-price">
                                        <span class="price"> ৳<?php echo e(formatNumberInBengali($product->regular_price)); ?> </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\boikhata\resources\views/frontend/product/advance_search.blade.php ENDPATH**/ ?>