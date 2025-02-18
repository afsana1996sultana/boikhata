<?php $__env->startSection('admin'); ?>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product List <span class="badge rounded-pill alert-success"> <?php echo e(count($products)); ?> </span></h2>
        <div>
            <?php if(Auth::guard('admin')->user()->role !== '5' || in_array('1', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
            <a href="<?php echo e(route('product.add')); ?>" class="btn btn-primary"><i class="material-icons md-plus"></i>Add Product</a>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Name (English)</th>
                            <th scope="col">Name (Bangla)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product Price </th>
							<th scope="col">Quantity </th>
							<th scope="col">Discount </th>
                            <th scope="col">Featured</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($key+1); ?> </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="<?php echo e(asset($item->product_thumbnail)); ?>" class="img-sm" alt="Userpic" style="width: 80px; height: 70px;">
                                    </div>
                                </a>
                            </td>
                            <td> <?php echo e($item->name_en ?? 'NULL'); ?> </td>
                            <td> <?php echo e($item->name_bn ?? 'NULL'); ?> </td>
                            <td> <?php echo e($item->category->name_en); ?> </td>
                            <td> <?php echo e($item->regular_price ?? 'NULL'); ?> </td>
                            <td>
                                <?php if($item->is_varient): ?>
                                    Varient Product
                                <?php else: ?>
                                    <?php echo e($item->stock_qty ?? 'NULL'); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                            	<?php if($item->discount_price > 0): ?>
                                    <?php if($item->discount_type == 1): ?>
                                        <span class="badge rounded-pill alert-info">৳<?php echo e($item->discount_price); ?> off</span>
                                    <?php elseif($item->discount_type == 2): ?>
                                        <span class="badge rounded-pill alert-success"><?php echo e($item->discount_price); ?>% off</span>
                                    <?php endif; ?>
                                <?php else: ?>
								 	<span class="badge rounded-pill alert-danger">No Discount</span>
								<?php endif; ?>
                            </td>
                            <td>
                                <?php if($item->is_featured == 1): ?>
                                  <a href="<?php echo e(route('product.featured',['id'=>$item->id])); ?>">
                                    <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                  </a>
                                <?php else: ?>
                                  <a href="<?php echo e(route('product.featured',['id'=>$item->id])); ?>" > <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($item->status == 1): ?>
                                  <a href="<?php echo e(route('product.in_active',['id'=>$item->id])); ?>">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                <?php else: ?>
                                  <a href="<?php echo e(route('product.active',['id'=>$item->id])); ?>" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <?php if(Auth::guard('admin')->user()->role !== '5' || in_array('3', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('product.edit',$item->id)); ?>">Edit info</a>
                                        <?php endif; ?>
                                        
                                        <?php if(Auth::guard('admin')->user()->role == '2'): ?>
                                            <a class="dropdown-item text-danger" href="<?php echo e(route('product.delete',$item->id)); ?>" id="delete">Delete</a>
                                        <?php else: ?>
                                            <?php if(Auth::guard('admin')->user()->role == '1' || in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                                                <a class="dropdown-item text-danger" href="<?php echo e(route('product.delete',$item->id)); ?>" id="delete">Delete</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\boikhata\resources\views/backend/product/product_view.blade.php ENDPATH**/ ?>