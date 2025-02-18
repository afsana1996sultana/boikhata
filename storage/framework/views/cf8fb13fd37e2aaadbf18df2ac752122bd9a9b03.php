<?php $__env->startSection('admin'); ?>
    <style type="text/css">
        table,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td {
            border: 1px solid #dee2e6 !important;
        }

        th {
            font-weight: bolder !important;
        }

        .icontext .icon i {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        .select2-container--default .select2-selection--single {
            background-color: #f9f9f9;
            border: 2px solid #eee;
            border-radius: 0 !important;
        }
    </style>
<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order detail</h2>
        </div>
    </div>
    <div class="card">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 mb-lg-0 mb-15">
                    <span class="text-white"> <i class="material-icons md-calendar_today"></i>
                        <b><?php echo e($order->created_at ?? ''); ?></b> </span> <br />
                    <small class="text-white">Order ID: <?php echo e($order->invoice_no ?? ''); ?></small>
                </div>
                <?php
                    $payment_status = $order->payment_status;
                    $delivery_status = $order->delivery_status;
                    $note_status = $order->note_status;
                ?>
                <div class="col-lg-8 col-md-8 ms-auto text-md-end">
                    <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" id="update_note_status">
                        <?php $__currentLoopData = $ordernotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordernote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ordernote->name); ?>" <?php if($note_status == $ordernote->name): ?> selected <?php endif; ?>>
                                <?php echo e($ordernote->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" id="update_payment_status">
                        <option value="">-- select one --</option>
                        <option value="unpaid" <?php if($payment_status == 'unpaid'): ?> selected <?php endif; ?>>Unpaid</option>
                        <option value="paid" <?php if($payment_status == 'paid'): ?> selected <?php endif; ?>>Paid</option>
                    </select>

                    <?php if($delivery_status != 'delivered' && $delivery_status != 'cancelled'): ?>
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200" id="update_delivery_status">
                            <option value="pending" <?php if($delivery_status == 'pending'): ?> selected <?php endif; ?>>Pending</option>
                            <option value="holding" <?php if($delivery_status == 'holding'): ?> selected <?php endif; ?>>Holding
                            </option>
                            <option value="processing" <?php if($delivery_status == 'processing'): ?> selected <?php endif; ?>>Processing
                            </option>
                            <option value="shipped" <?php if($delivery_status == 'shipped'): ?> selected <?php endif; ?>>Shipped</option>
                            <option value="delivered" <?php if($delivery_status == 'delivered'): ?> selected <?php endif; ?>>Delivered
                            </option>
                            <?php if(Auth::guard('admin')->user()->role !== '2' || Auth::guard('admin')->user()->role !== '5' ||
                                in_array('20', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                                <?php if($order->user_id != 1): ?>
                                    <option value="cancelled" <?php if($delivery_status == 'cancelled'): ?> selected <?php endif; ?>
                                        style="color:red">Cancelled
                                    </option>
                                <?php endif; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <input type="text" class="form-control d-inline-block mb-lg-0 mr-5 mw-200"
                            value="<?php echo e($delivery_status); ?>" disabled>
                    <?php endif; ?>
                </div>
            </div>
        </header>
            <!-- card-header end// -->
        <div class="card-body">
            <div class="row mt-20 order-info-wrap">
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                Name: <?php echo e($order->name ?? ''); ?> <br />
                                <?php if($order->email): ?>
                                    Email: <?php echo e($order->email ?? ''); ?> <br />
                                <?php endif; ?>
                                Phone: <?php echo e($order->phone ?? ''); ?>

                            </p>
                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop1<?php echo e($order->user_id); ?>"
                                style="color:blue">Edit Customer</a>
                        </div>
                    </article>
                </div>
                <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Order Id: <?php echo e($order->invoice_no ?? ''); ?> </br>
                                Shipping: <?php echo e($order->shipping_name ?? ''); ?> <br />
                                Pay method: <?php if($order->payment_method == 'cod'): ?>
                                    Cash On Delivery
                                <?php else: ?>
                                    <?php echo e($order->payment_method); ?>

                                <?php endif; ?> <br />
                                Status: <?php
                                    $status = $order->delivery_status;
                                    if ($order->delivery_status == 'cancelled') {
                                        $status = 'Received';
                                    }

                                ?>
                                <?php echo $status; ?>

                            </p>
                        </div>
                    </article>
                </div>
                <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                Address: <?php echo e(isset($order->address) ? ucwords($order->address . ',') : ''); ?>

                                <?php echo e(isset($order->upazilla->name_en) ? ucwords($order->upazilla->name_en . ',') : ''); ?>

                                <?php echo e(isset($order->district->district_name_en) ? ucwords($order->district->district_name_en . ',') : ''); ?>

                            </p>
                        </div>
                    </article>
                </div>
                <!-- col// -->
                <form action="<?php echo e(route('admin.orders.update', $order->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="col-md-12 mt-40">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Invoice</th>
                                    <td><?php echo e($order->invoice_no ?? ''); ?></td>
                                    <th>Email</th>
                                    <td><input type="" class="form-control" name="email"
                                            value="<?php echo e($order->email ?? 'Null'); ?>"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Shipping Address</th>
                                    <td>
                                        <label for="district_id" class="fw-bold text-black"><span
                                                class="text-danger">*</span> District</label>
                                        <select class="form-control select-active" name="district_id" id="district_id"
                                            required <?php if($order->user_id == 1): ?> <?php endif; ?>>
                                            <option selected="" value="">Select District</option>
                                            <?php $__currentLoopData = get_districts($order->district_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <option value="<?php echo e($district->id); ?>" <?php echo e($district->id == $order->district_id ? 'selected': ''); ?>><?php echo e(ucwords($district->district_name_bn)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="upazilla_id" class="fw-bold text-black"><span
                                                class="text-danger">*</span> Zone</label>
                                        <select class="form-control select-active" name="upazilla_id" id="upazilla_id"
                                            required <?php if($order->user_id == 1): ?> <?php endif; ?>>
                                            <option selected="" value="">Select Zone</option>
                                            <?php $__currentLoopData = get_upazilla_by_district_id($order->district_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upazilla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($upazilla->id); ?>"
                                                    <?php echo e($upazilla->id == $order->upazilla_id ? 'selected' : ''); ?>>
                                                    <?php echo e(ucwords($upazilla->name_en)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>

                                    <td>
                                        <label for="address" class="fw-bold text-black"><span class="text-danger">*</span> Address</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo e($order->address ?? 'Null'); ?>" <?php if($order->user_id == 1): ?> <?php endif; ?>>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>
                                        <select class="form-control select-active" name="payment_method"
                                            id="payment_method"
                                            <?php if($order->user_id == 1): ?> <?php endif; ?>>
                                            <option selected="" value="">Select Payment Method</option>
                                            <option value="cod" <?php if($order->payment_method == 'cod'): ?> selected <?php endif; ?>>
                                                Cash</option>
                                            <option value="bkash" <?php if($order->payment_method == 'bkash'): ?> selected <?php endif; ?>>
                                                Bkash</option>
                                            <option value="nagad" <?php if($order->payment_method == 'nagad'): ?> selected <?php endif; ?>>
                                                Nagad</option>
                                        </select>
                                    </td>

                                    <th>Discount</th>
                                    <td><input type="number" <?php if($order->user_id == 1): ?> readonly <?php endif; ?>
                                            class="form-control" name="discount" value="<?php echo e($order->discount); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td>
                                        <?php
                                            $status = $order->delivery_status;
                                            if ($order->delivery_status == 'cancelled') {
                                                $status = 'Received';
                                            }
                                        ?>
                                        <span
                                            class="badge rounded-pill alert-success text-success"><?php echo $status; ?></span>
                                    </td>

                                    <th>Payment Date</th>
                                    <td><?php echo e(date_format($order->created_at, 'Y/m/d')); ?></td>
                                </tr>
                                <tr>
                                    <th>Sub Total</th>
                                    <td><?php echo e($order->sub_total); ?> <strong>Tk</strong></td>

                                    <th>Total</th>
                                    <td><?php echo e($order->grand_total); ?> <strong>Tk</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- col// -->
            </div>
            <!-- row // -->
            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                <?php if($delivery_status == 'pending' || $delivery_status == 'holding' || $delivery_status == 'processing' || $delivery_status == 'picked_up'): ?>
                    <div class="row mb-3 custom__select">
                        <div class="col-7 col-md-6"></div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <select id="siteID" class="form-control selectproduct " style="width:100%">
                                <option> Select Product To Order</option>
                                <?php $__currentLoopData = $products->where('stock_qty', '!=', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($product->discount_type == 1) {
                                            $price_after_discount = $product->regular_price - $product->discount_price;
                                        } elseif ($product->discount_type == 2) {
                                            $price_after_discount = $product->regular_price - ($product->regular_price * $product->discount_price) / 100;
                                        }
                                        $Price = $product->discount_price ? $price_after_discount : $product->regular_price;
                                    ?>
                                <?php if($product->is_varient): ?>
                                    <?php $__currentLoopData = $product->stocks->where('qty', '!=', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            if ($product->discount_type == 1) {
                                                $price_after_discount = $stock->price - $product->discount_price;
                                            } elseif ($product->discount_type == 2) {
                                                $price_after_discount = $stock->price - ($stock->price * $product->discount_price) / 100;
                                            }
                                            $Price = $product->discount_price ? $price_after_discount : $stock->price;
                                        ?>
                                      <option class="addToOrder" data-order_id="<?php echo e($order->id); ?>" data-id="<?php echo e($stock->id); ?>" data-product_id="<?php echo e($product->id); ?>">  <?php echo e($product->name_en); ?> (<?php echo e($stock->varient); ?>)(<?php echo e($stock->qty); ?>) =<?php echo e($Price); ?>৳</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <option class="addToOrder" data-order_id="<?php echo e($order->id); ?>" data-product_id="<?php echo e($product->id); ?>"> <?php echo e($product->name_en); ?>(<?php echo e($product->stock_qty); ?>)=<?php echo e($Price); ?>৳</option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                   <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                                        <?php if($delivery_status == 'pending' ||$delivery_status == 'holding' || $delivery_status == 'processing' ||$delivery_status == 'picked_up' ||$delivery_status == 'shipped'): ?>
                                            <th width="5%">
                                                Delete
                                            </th>
                                        <?php endif; ?>
                                   <?php endif; ?>
                                    <th width="30%">Product</th>
                                    <th width="20%" class="text-center">Unit Price</th>
                                    <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                                       <th width="10%" class="text-center">Quantity</th>
                                    <?php endif; ?>
                                    <!--<th width="15%" class="text-center">Vendor Comission</th>-->
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->order_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                                        <?php if($delivery_status == 'pending' ||$delivery_status == 'holding' || $delivery_status == 'processing' ||$delivery_status == 'picked_up' ||$delivery_status == 'shipped'): ?>
                                            <td class="text-center">
                                                <?php if(count($order->order_details) > 1): ?>
                                                    <a id="delete" href="<?php echo e(route('delete.order.product', $orderDetail->id)); ?>">
                                                        <button type="button" class="btn_main misty-color">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                    <?php else: ?>
                                                    <button class="cart_actionBtn btn_main misty-color" disabled>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td>
                                        <a class="itemside">
                                            <div class="left">
                                                <img src="<?php echo e(asset($orderDetail->product->product_thumbnail ?? ' ')); ?>"
                                                    width="40" height="40" class="img-xs" alt="Item" />
                                            </div>
                                            <div class="info">
                                                <span class="text-bold">
                                                    <?php echo e($orderDetail->product->name_en ?? ' '); ?>

                                                </span>
                                                    <span>(
                                                        <?php if($orderDetail->is_varient && count(json_decode($orderDetail->variation)) > 0): ?>
                                                        <?php $__currentLoopData = json_decode($orderDetail->variation); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $varient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span><?php echo e($varient->attribute_name); ?> :
                                                            <?php echo e($varient->attribute_value); ?></span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>)
                                                    </span>
                                                    <?php
                                                        if ($orderDetail->is_varient) {
                                                            $jsonString = $orderDetail->variation;
                                                            $combinedString = '';
                                                            $jsonArray = json_decode($jsonString, true);
                                                            foreach ($jsonArray as $attribute) {
                                                                if (isset($attribute['attribute_value'])) {
                                                                    $combinedString .= $attribute['attribute_value'] . '-';}
                                                            }
                                                            $combinedString = rtrim($combinedString, '-');
                                                            $stockId = App\Models\ProductStock::where('varient', $combinedString)->first();
                                                        }
                                                    ?>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo e($orderDetail->price ?? '0.00'); ?></td>
                                    
                                    <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                                        <td class="text-center qunatity_change">
                                            <input type="hidden" value="<?php echo e($orderDetail->product_id); ?>" class="product_id">
                                            <input type="hidden" value="<?php echo e($orderDetail->id); ?>" class="orderdetail_id">
                                            <?php if($orderDetail->is_varient == 1): ?>
                                                <input type="hidden" value="<?php echo e($stockId->id); ?>" class="stock_id">
                                            <?php endif; ?>
                                            <!-- decress btn -->
                                            <button type="button"
                                                class="input-group-text rounded-0 bg-navy add_btn <?php if(in_array($delivery_status, ['pending', 'holding', 'processing', 'picked_up','shipped'])): ?> decress_quantity changeQuantity <?php endif; ?>"
                                                data-type="-"><i class="fa-solid fa-minus"></i></button>
                                            <!-- quantity input -->
                                            <input class="form-control text-center quantity_input najmul__product__details"
                                                value="<?php echo e($orderDetail->qty); ?>" min="1" max="" type="text"
                                                name="qty<?php echo e($key); ?>" disabled>
                                            <!-- incress btn-->
                                            <button type="button"
                                                class="input-group-text rounded-0 bg-navy add_btn <?php if(in_array($delivery_status, ['pending', 'holding', 'processing', 'picked_up'])): ?>  incress_quantity changeQuantity <?php endif; ?>" data-type="+"  ><i class="fa-solid fa-plus"></i></button>
                                            <input type="hidden" type="text" name="qty<?php echo e($key); ?>"
                                                value="<?php echo e($orderDetail->qty); ?>">
                                        </td>
                                    <?php endif; ?>
                                    <!--<td class="text-center"><?php echo e($orderDetail->v_comission * $orderDetail->qty); ?></td>-->
                                    <td class="text-end" id="item_totalPrice_<?php echo e($key); ?>"><?php echo e($orderDetail->price * $orderDetail->qty); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Subtotal:</dt>
                                                <dd id="subtotal"><?php echo e($order->sub_total ?? '0.00'); ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Shipping cost:</dt>
                                                <dd><?php echo e($order->shipping_charge ?? '0.00'); ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Discount:</dt>
                                                <dd><b class=""><?php echo e($order->discount); ?></b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Others:</dt>
                                                <dd><b class=""><?php echo e($order->others); ?></b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd id="grandtotal"><b class="h5"><?php echo e($order->grand_total); ?></b>
                                                <dd id="buyingprice" style="display: none"><b class="h5"><?php echo e($order->totalbuyingPrice); ?></b>
                                                </dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">Status:</dt>
                                                <dd>
                                                    <?php
                                                        $status = $order->delivery_status;
                                                        if ($order->delivery_status == 'cancelled') {$status = 'Received';}
                                                    ?>
                                                    <span class="badge rounded-pill alert-success text-success"><?php echo $status; ?></span>
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                     <!-- table-responsive// -->
                </div>
                <!-- col// -->
                <div class="col-lg-1"></div>
                <div>
                    <input type="hidden" name="sub_total" class="subtotalof" value="<?php echo e($order->sub_total); ?>">
                    <input type="hidden" name="grand_total" class="grandtotalof" value="<?php echo e($order->grand_total); ?>">
                    <input type="hidden" name="totalbuyingPrice" class="totalbuyingPriceof"
                        value="<?php echo e($order->totalbuyingPrice); ?>">
                </div>
                    <?php if(in_array($delivery_status, ['pending', 'holding', 'processing', 'picked_up','shipped'])): ?>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-end">
                            <button type="button" disabled class="btn btn-primary">Update Order</button>
                        </div>
                    <?php endif; ?>
                <!-- col// -->
                </form>
            </div>
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('footer-script'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="shipping_id"]').on('change', function() {
                var shipping_cost = $(this).val();
                if (shipping_cost) {
                    $.ajax({
                        url: "<?php echo e(url('/checkout/shipping/ajax')); ?>/" + shipping_cost,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            //console.log(data);
                            $('#ship_amount').text(data.shipping_charge);

                            let shipping_price = parseInt(data.shipping_charge);
                            let grand_total_price = parseInt($('#cartSubTotalShi').val());
                            grand_total_price += shipping_price;
                            $('#grand_total_set').html(grand_total_price);
                            $('#total_amount').val(grand_total_price);
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

        /* ============ Update Payment Status =========== */
        $('#update_payment_status').on('change', function() {
            var order_id = <?php echo e($order->id); ?>;
            var status = $('#update_payment_status').val();
            $.post('<?php echo e(route('orders.update_payment_status')); ?>', {
                _token: '<?php echo e(@csrf_token()); ?>',
                order_id: order_id,
                status: status
            }, function(data) {
                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            });
        });

        /* ============ Update Delivery Status =========== */
        $('#update_delivery_status').on('change', function() {
            var order_id = <?php echo e($order->id); ?>;
            var status = $('#update_delivery_status').val();
            $.post('<?php echo e(route('orders.update_delivery_status')); ?>', {
                _token: '<?php echo e(@csrf_token()); ?>',
                order_id: order_id,
                status: status
            }, function(data) {
                // console.log(data);
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
                location.reload();
            });
        });

        /* ============ Update Note Status =========== */
        $('#update_note_status').on('change', function(){
            var order_id = <?php echo e($order->id); ?>;
            var status = $('#update_note_status').val();
            $.post('<?php echo e(route('orders.update_note_status')); ?>', {
                _token:'<?php echo e(@csrf_token()); ?>',
                order_id:order_id,
                status:status
            }, function(data){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 1000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--  Division To District Show Ajax -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="division_id"]').on('change', function() {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "<?php echo e(url('/division-district/ajax')); ?>/" + division_id,
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
                        url: "<?php echo e(url('/address/ajax')); ?>/" + address_id,
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
                            var selectShipping = $('#shipping_id');
                            selectShipping.find('option').remove();
                            selectShipping.append('<option value="">--Select--</option>');
                            <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                if (<?php echo e($shipping->type); ?> == 1 && inputValue == 52) {
                                    selectShipping.append(`<option value="<?php echo e($shipping->id); ?>">Inside Dhaka (<?php echo e($shipping->name); ?>)</option>`);
                                } else if (<?php echo e($shipping->type); ?> == 2 && inputValue != 52) {
                                    selectShipping.append(`<option value="<?php echo e($shipping->id); ?>">Outside Dhaka (<?php echo e($shipping->name); ?>)</option>`);
                                }
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        url: "<?php echo e(url('/district-upazilla/ajax')); ?>/" + district_id,
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

    <!-- Customer Edit Modal -->
    <div class="modal fade" id="staticBackdrop1<?php echo e($order->user_id); ?>" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="<?php echo e(route('admin.user.update', $order->user_id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span
                                        class="text-danger">*</span> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter the name"
                                    value="<?php echo e($order->user->name ?? 'Null'); ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span
                                        class="text-danger">*</span> Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter the email"
                                    value="<?php echo e($order->user->email ?? 'Null'); ?>">
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="division_id" class="fw-bold text-black col-form-label"><span
                                        class="text-danger">*</span> Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter the phone"
                                    value="<?php echo e($order->user->phone ?? 'Null'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        //remove
        $(document).on('click', '.changeQuantity', function() {
            var product_id = $(this).closest('.qunatity_change').find('.product_id').val();
            var stock_id = $(this).closest('.qunatity_change').find('.stock_id').val();
            var orderdetail_id = $(this).closest('.qunatity_change').find('.orderdetail_id').val();
            var qtyInput = $(this).closest('.qunatity_change').find('.quantity_input');
            var type = $(this).data('type');
            var key = $(this).closest('tr').index();
            var data = {
                'product_id': product_id,
                'stock_id': stock_id,
                'orderdetail_id': orderdetail_id,
                'type': type,
                'qty': qtyInput.val(),
            }

            $.ajax({
                method: "get",
                url: '<?php echo e(route('order.quantity.update')); ?>',
                data: data,
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message, 'message');
                        var currentPrice = parseFloat($('#subtotal').text());
                        var currentgrandPrice = parseFloat($('#grandtotal').text());
                        var currentbuyingprice = parseFloat($('#buyingprice').text());
                        if (response.type == '+') {
                            currentPrice += parseFloat(response.price);
                            currentgrandPrice += parseFloat(response.price);
                            currentbuyingprice += parseFloat(response.buyingPrice);
                            qtyInput.val(parseInt(qtyInput.val()) + 1);
                        } else {
                            currentPrice -= parseFloat(response.price);
                            currentgrandPrice -= parseFloat(response.price);
                            currentbuyingprice -= parseFloat(response.buyingPrice);
                            qtyInput.val(parseInt(qtyInput.val()) - 1);
                        }
                        var itemTotalPrice = parseFloat(response.price * qtyInput.val());
                        $('#item_totalPrice_' + key).text(itemTotalPrice.toFixed(2));
                        $('#subtotal').text(currentPrice);
                        $('#grandtotal').text(currentgrandPrice);
                        $('#buyingprice').text(currentbuyingprice);
                        $('.subtotalof').val(currentPrice);
                        $('.grandtotalof').val(currentgrandPrice);
                        $('.totalbuyingPriceof').val(currentbuyingprice);

                        var Quantity = response.qty;
                        var product_price = response.price;
                        var productnewprice = product_price * Quantity;
                        $('.price_qty').text(productnewprice);
                        var updatedQty = parseInt(qtyInput.val());
                        //console.log(updatedQty)
                        $('input[name="qty' + key + '"]').val(updatedQty);
                        // $('input[name="qty' + key + '"]').prop('disabled', false).val(updatedQty).prop('disabled', true);
                    } else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });

        /* add to cart */

        /* add to cart */

        $(document).on('change', '.selectproduct', function() {
            var selectedOption = $(this).find(':selected');
            var productId = selectedOption.data('product_id');
            var stockId = selectedOption.data('id');
            var orderId = selectedOption.data('order_id');
            var data = {
                product_id: productId,
                stock_id: stockId,
                order_id: orderId
            }
            $.ajax({
                url: '<?php echo e(route('order.itemAdd')); ?>',
                method: "Post",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    console.log(response)
                    if (response.status == 'success') {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                        toastr.success(response.message, 'message');
                    } else {
                        toastr.error(response.error, 'Error');
                    }
                }
            });
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $(".selectproduct").select2();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\boikhata\resources\views/backend/sales/all_orders/show.blade.php ENDPATH**/ ?>