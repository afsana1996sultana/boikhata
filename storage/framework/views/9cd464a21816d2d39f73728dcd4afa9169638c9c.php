<?php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
?>
<aside class="navbar-aside bg-primary" id="offcanvas_aside">
    <div class="aside-top">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-wrap">
            <?php
                $logo = get_setting('site_footer_logo');
            ?>
            <?php if($logo != null): ?>
                <img src="<?php echo e(asset(get_setting('site_footer_logo')->value ?? ' ')); ?>" alt="<?php echo e(env('APP_NAME')); ?>"
                 style="height: 70px !important; min-width: 100px !important;
                 ">
            <?php else: ?>
                <img src="<?php echo e(asset('upload/no_image.jpg')); ?>" alt="<?php echo e(env('APP_NAME')); ?>" style="height: 30px !important; width: 80px !important; min-width: 80px !important;">
            <?php endif; ?>
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-white material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item <?php echo e(($route == 'admin.dashboard')? 'active':''); ?>">
                <a class="menu-link" href="<?php echo e(route('admin.dashboard')); ?>">
                   <i class="fa-solid fa-house fontawesome_icon_custom"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu
                <?php echo e(($route == 'slider.index')? 'active':''); ?>

                <?php echo e(($route == 'slider.edit')? 'active':''); ?>

                <?php echo e(($route == 'slider.create')? 'active':''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('37', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-photo-film fontawesome_icon_custom"></i>
                        <span class="text">Sliders</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('37', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'slider.index') ? 'active':''); ?>" href="<?php echo e(route('slider.index')); ?>">Slider List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('38', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'slider.create') ? 'active':''); ?>" href="<?php echo e(route('slider.create')); ?>">Slider Add</a>
                    <?php endif; ?>
                </div>
            </li>
            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <li class="menu-item has-submenu
                <?php echo e(($route == 'banner.index')? 'active':''); ?>

                <?php echo e(($route == 'banner.edit')? 'active':''); ?>

                <?php echo e(($route == 'banner.create')? 'active':''); ?>

            ">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Banner</span>
                </a>
                <div class="submenu">
                    <a class="<?php echo e(($route == 'banner.index') ? 'active':''); ?>" href="<?php echo e(route('banner.index')); ?>">Banner List</a>
                    <a class="<?php echo e(($route == 'banner.create') ? 'active':''); ?>" href="<?php echo e(route('banner.create')); ?>">Banner Add</a>
                </div>
            </li>
            <?php endif; ?>

            <li class="menu-item has-submenu
                <?php echo e(($prefix == 'admin/product') || ($prefix == 'admin/category')|| ($prefix == 'admin/unit') || ($route == 'attribute.index') || ($prefix == 'admin/brand') ? 'active' : ''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('1', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="fa-solid fa-bag-shopping fontawesome_icon_custom"></i>
                        <span class="text">Products</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('1', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'product.add') ? 'active':''); ?>" href="<?php echo e(route('product.add')); ?>">Product Add</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('2', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'product.all') ? 'active':''); ?>" href="<?php echo e(route('product.all')); ?>">Products</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('5', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($prefix == 'admin/category') ? 'active':''); ?>" href="<?php echo e(route('category.index')); ?>">Subjects</a>
                    <?php endif; ?>
                </div>
            </li>

            <li class="menu-item has-submenu <?php echo e(($prefix == 'admin/writer')?'active':''); ?>">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-stars"></i>
                        <span class="text">Writers</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'writer.index') ? 'active':''); ?>" href="<?php echo e(route('writer.index')); ?>">Writers List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('46', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'writer.create') ? 'active':''); ?>" href="<?php echo e(route('writer.create')); ?>">Writers Add</a>
                    <?php endif; ?>
                </div>
            </li>

            <li class="menu-item has-submenu <?php echo e(($prefix == 'admin/publication')?'active':''); ?>">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-stars"></i>
                        <span class="text">Publications</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('45', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'publication.all') ? 'active':''); ?>" href="<?php echo e(route('publication.all')); ?>">Publications List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('46', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'publication.create') ? 'active':''); ?>" href="<?php echo e(route('publication.create')); ?>">Publications Add</a>
                    <?php endif; ?>
                </div>
            </li>

            <li class="menu-item has-submenu
                <?php echo e(($route == 'campaing.index')? 'active':''); ?>

                <?php echo e(($route == 'campaing.create')? 'active':''); ?>

                <?php echo e(($route == 'campaing.edit')? 'active':''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('41', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                       <i class="fa-solid fa-photo-film fontawesome_icon_custom"></i>
                        <span class="text">Campaigns</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('41', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'campaing.index') ? 'active':''); ?>" href="<?php echo e(route('campaing.index')); ?>">Campaign List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('42', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'campaing.create') ? 'active':''); ?>" href="<?php echo e(route('campaing.create')); ?>">Campaign Add</a>
                    <?php endif; ?>
                </div>
            </li>
          
            <li class="menu-item has-submenu <?php echo e(($route == 'all_orders.index') || ($route == 'all_orders.indexPos') ||($route == 'all_orders.all_vendor_sale_index') ?'active':''); ?>">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('17', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Sales</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('17', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <?php if(Auth::guard('admin')->user()->role == '1' ): ?>
                          <a class="<?php echo e(($route == 'all_orders.index') ? 'active':''); ?>" href="<?php echo e(route('all_orders.index')); ?>" >Online All Orders</a>
                        <?php endif; ?>
                        <a class="<?php echo e(($route == 'all_orders.indexPos') ? 'active':''); ?>" href="<?php echo e(route('all_orders.indexPos')); ?>" >Pos All Orders</a>
                    <?php endif; ?>
                </div>
            </li>
            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <li class="menu-item has-submenu
                <?php echo e(($route == 'stock_report.index')? 'active':''); ?>

            ">
                <a class="menu-link" href="#">
                   <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Report</span>
                </a>
                <div class="submenu">
                    <a class="<?php echo e(($route == 'stock_report.index') ? 'active':''); ?>" href="<?php echo e(route('stock_report.index')); ?>">Product Stock</a>
                </div>
            </li>
            <?php endif; ?>

            <li class="menu-item has-submenu <?php echo e(($route == 'payment.index') || ($route == 'payment.create') ||($route == 'advanced.index') || ($route == 'payment.edit') || ($route == 'advanced.ledger') ?'active':''); ?>">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('57', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-stars"></i>
                        <span class="text">Payments</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('57', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'payment.index') ? 'active':''); ?>" href="<?php echo e(route('payment.index')); ?>">Payment List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('58', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'payment.create') ? 'active':''); ?>" href="<?php echo e(route('payment.create')); ?>">Payment Add</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('57', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'advanced.index') ? 'active':''); ?>" href="<?php echo e(route('advanced.index')); ?>">Advanced Payment</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                        <a class="<?php echo e(($route == 'advanced.ledger') ? 'active':''); ?>" href="<?php echo e(route('advanced.ledger')); ?>">Advanced Payment Ledger</a>
                    <?php endif; ?>
                </div>
            </li>

            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <li class="menu-item has-submenu
            <?php echo e(($route == 'accounts.heads')? 'active':''); ?>

            <?php echo e(($route == 'accounts.ledgers')? 'active':''); ?>

            <?php echo e(($route == 'accounts.heads.create')? 'active':''); ?>

            ">
                <a class="menu-link" href="#">
                <i class="fontawesome_icon_custom fa-solid fa-calculator"></i>
                    <span class="text">Accounts</span>
                </a>
                <div class="submenu">
                    <a class="<?php echo e(($route == 'accounts.heads')? 'active':''); ?> <?php echo e(($route == 'accounts.heads.create')? 'active':''); ?>" href="<?php echo e(route('accounts.heads')); ?>">Account Heads</a>
                    <a class="<?php echo e(($route == 'accounts.ledgers')? 'active':''); ?>" href="<?php echo e(route('accounts.ledgers')); ?>">Cashbook</a>
                </div>
            </li>
           <?php endif; ?>

            <li class="menu-item has-submenu
                <?php echo e(($route == 'staff.index')? 'active':''); ?>

                <?php echo e(($route == 'staff.create')? 'active':''); ?>

                <?php echo e(($route == 'staff.edit')? 'active':''); ?>

                <?php echo e(($route == 'roles.index')? 'active':''); ?>

                <?php echo e(($route == 'roles.create')? 'active':''); ?>

                <?php echo e(($route == 'roles.edit')? 'active':''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('25', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                       <i class="icon material-icons md-pie_chart"></i>
                        <span class="text">Staff</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('25', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'staff.index') ? 'active':''); ?>" href="<?php echo e(route('staff.index')); ?>">All Staff</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('29', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'roles.index') ? 'active':''); ?>" href="<?php echo e(route('roles.index')); ?>">Staff Premissions</a>
                    <?php endif; ?>
                </div>
            </li>

            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                <li class="menu-item has-submenu
                <?php echo e(($route == 'customer.index')? 'active':''); ?>

                <?php echo e(($route == 'customer.create')? 'active':''); ?>

                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Customers</span>
                    </a>
                    <div class="submenu">
                        <a class="<?php echo e(($route == 'customer.create')? 'active':''); ?>" href="<?php echo e(route('customer.create')); ?>">Customer Add</a>
                        <a class="<?php echo e(($route == 'customer.index')? 'active':''); ?>" href="<?php echo e(route('customer.index')); ?>">Customer List</a>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                <li class="menu-item has-submenu
                <?php echo e(($route == 'online.user.list')? 'active':''); ?>

                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Users</span>
                    </a>
                    <div class="submenu">
                        <a class="<?php echo e(($route == 'online.user.list')? 'active':''); ?>" href="<?php echo e(route('online.user.list')); ?>">Online User List</a>
                    </div>
                </li>
            <?php endif; ?>
            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <li class="menu-item has-submenu
                <?php echo e(($route == 'review.index')? 'active':''); ?>

            ">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-stars"></i>
                    <span class="text">Rating & Review</span>
                </a>
                <div class="submenu">
                    <a class="<?php echo e(($route == 'review.index') ? 'active':''); ?>" href="<?php echo e(route('review.index')); ?>">Rating & Review List</a>
                </div>
            </li>
            <?php endif; ?>

            <li class="menu-item has-submenu <?php echo e(($route == 'sms.templates') || ($route == 'sms.providers')?'active':''); ?>">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('33', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="fontawesome_icon_custom fa-solid fa-phone"></i>
                        <span class="text">OTP System</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('34', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'sms.templates') ? 'active':''); ?>" href="<?php echo e(route('sms.templates')); ?>" >SMS Teamplates</a>
                    <?php endif; ?>

                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('35', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'sms.providers') ? 'active':''); ?>" href="<?php echo e(route('sms.providers')); ?>" >SMS Providers</a>
                    <?php endif; ?>
                </div>
            </li>
            <li class="menu-item has-submenu
                <?php echo e(($route == 'blog.index')? 'active':''); ?>

                <?php echo e(($route == 'blog.edit')? 'active':''); ?>

                <?php echo e(($route == 'blog.create')? 'active':''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('21', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-comment"></i>
                        <span class="text">Blog</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('21', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'blog.index') ? 'active':''); ?>" href="<?php echo e(route('blog.index')); ?>">Blog List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('22', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'blog.create') ? 'active':''); ?>" href="<?php echo e(route('blog.create')); ?>">Blog Add</a>
                    <?php endif; ?>
                </div>
            </li>

            <li class="menu-item has-submenu
                <?php echo e(($route == 'page.index')? 'active':''); ?>

                <?php echo e(($route == 'page.edit')? 'active':''); ?>

                <?php echo e(($route == 'page.create')? 'active':''); ?>

            ">
                <?php if(Auth::guard('admin')->user()->role == '1' || in_array('49', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-pages"></i>
                        <span class="text">Pages</span>
                    </a>
                <?php endif; ?>
                <div class="submenu">
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('49', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'page.index') ? 'active':''); ?>" href="<?php echo e(route('page.index')); ?>">Page List</a>
                    <?php endif; ?>
                    <?php if(Auth::guard('admin')->user()->role == '1' || in_array('50', json_decode(Auth::guard('admin')->user()->staff->role->permissions))): ?>
                        <a class="<?php echo e(($route == 'page.create') ? 'active':''); ?>" href="<?php echo e(route('page.create')); ?>">Page Add</a>
                    <?php endif; ?>
                </div>
            </li>

            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <li class="menu-item has-submenu
                <?php echo e(($route == 'subscribers.index')? 'active':''); ?>

            ">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Subscribers</span>
                </a>
                <div class="submenu">
                    <a class="<?php echo e(($route == 'subscribers.index') ? 'active':''); ?>" href="<?php echo e(route('subscribers.index')); ?>">Subsribers List</a>
                </div>
            </li>
            <?php endif; ?>

            <?php if(Auth::guard('admin')->user()->role == '1'): ?>
                <li class="menu-item has-submenu
                <?php echo e(($route == 'contact.index')? 'active':''); ?>

                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-person"></i>
                        <span class="text">Contact list</span>
                    </a>
                    <div class="submenu">
                        <a class="<?php echo e(($route == 'contact.index')? 'active':''); ?>" href="<?php echo e(route('contact.index')); ?>">Contact list</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <hr />
        <?php if(Auth::guard('admin')->user()->role == '1'): ?>
            <ul class="menu-aside">
                <li class="menu-item has-submenu
                <?php echo e(($route == 'setting.index')? 'active':''); ?>

                <?php echo e(($route == 'shipping.index')? 'active':''); ?>

                <?php echo e(($route == 'shipping.create')? 'active':''); ?>

                <?php echo e(($route == 'shipping.edit')? 'active':''); ?>

                <?php echo e(($route == 'order-note.index')? 'active':''); ?>

                <?php echo e(($route == 'order-note.create')? 'active':''); ?>

                <?php echo e(($route == 'order-note.edit')? 'active':''); ?>

                <?php echo e(($route == 'setting.facebook_plugin_setting')? 'active':''); ?>

                ">
                    <a class="menu-link" href="#">
                        <i class="icon material-icons md-settings"></i>
                        <span class="text">Settings</span>
                    </a>
                    <div class="submenu">
                        <a class="<?php echo e(($route == 'setting.index') ? 'active':''); ?>" href="<?php echo e(route('setting.index')); ?>">Home</a>
                        <a class="<?php echo e(($route == 'setting.activation') ? 'active':''); ?>" href="<?php echo e(route('setting.activation')); ?>">Activation</a>
                        <a class="<?php echo e(($route == 'setting.facebook_plugin_setting') ? 'active':''); ?>" href="<?php echo e(route('setting.facebook_plugin_setting')); ?>">Facebook Plugin</a>
                        <a class="<?php echo e(($route == 'shipping.index')||($route == 'shipping.create')||($route == 'shipping.edit') ? 'active':''); ?>" href="<?php echo e(route('shipping.index')); ?>">Shipping Methods</a>
                        <a class="<?php echo e(($route == 'order-note.index')||($route == 'order-note.create')||($route == 'order-note.edit') ? 'active':''); ?>" href="<?php echo e(route('order-note.index')); ?>">Order Note Status</a>
                        <a class="<?php echo e(($route == 'paymentMethod.config') ? 'active':''); ?>" href="<?php echo e(route('paymentMethod.config')); ?>">Payment Methods</a>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
        <br />
        <br />
        <div class="sidebar-widgets">
           <div class="copyright text-center m-25">
              <p>
                 <strong class="d-block">Admin Dashboard</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved
              </p>
           </div>
        </div>
    </nav>
</aside><?php /**PATH C:\xampp\htdocs\boikhata\resources\views/admin/body/sidebar.blade.php ENDPATH**/ ?>