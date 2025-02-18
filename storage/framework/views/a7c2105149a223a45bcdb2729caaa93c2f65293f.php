<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Dashboard</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        
        <!-- Favicon -->
        <?php
            $logo = get_setting('site_favicon');
        ?>
        <?php if($logo != null): ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset(get_setting('site_favicon')->value ?? 'null')); ?>" />
        <?php else: ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('upload/no_image.jpg')); ?>" alt="<?php echo e(env('APP_NAME')); ?>" />
        <?php endif; ?>

        <!-- Template CSS -->
        <link href="<?php echo e(asset('backend/assets/css/main.css?v=1.1 ' )); ?>" rel="stylesheet" type="text/css" />
        <!-- Custom CSS -->
        <link href="<?php echo e(asset('backend/assets/css/custom.css' )); ?>" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Color Picker -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">

        <!-- front awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" >

        <!-- bootstrap tags input css -->
        <link href="<?php echo e(asset('backend/assets/bootstrap-tags/bootstrap-tagsinput.css ' )); ?>" rel="stylesheet" type="text/css" />

        <!-- Datatable CSS -->
      

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/datatable/css/jquery.dataTables.css ')); ?>">


        <!-- Data Range CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!-- summernote -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

        <?php echo $__env->yieldPushContent('css'); ?>
    </head>

    <body>
        <div class="screen-overlay"></div>
        <!-- ========== Header Section ========== -->
        <?php if(Auth::guard('admin')->user()->role == '2'): ?>
            <?php echo $__env->make('admin.body.vendor_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('admin.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <main class="main-wrap">
            <!-- ========== Header Section ========== -->
            <?php echo $__env->make('admin.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- ========== Main Content Section ========== -->
            <?php echo $__env->yieldContent('admin'); ?>
            <!-- content-main end// -->

            <!-- ========== Footer Section ========== -->
            <?php echo $__env->make('admin.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </main>

        <!-- Datatable Js -->
        <script  src="<?php echo e(asset('backend/datatable/js/jquery-1.11.3.min.js ')); ?>"></script>
        <script  src="<?php echo e(asset('backend/datatable/js/jquery.dataTables.js ')); ?>"></script>
        <script  src="<?php echo e(asset('backend/datatable/js/datatable.js ')); ?>"></script>

        <!-- <script src="<?php echo e(asset('backend/assets/js/vendors/jquery-3.6.0.min.js ')); ?>"></script> -->
        <script src="<?php echo e(asset('backend/assets/js/vendors/bootstrap.bundle.min.js ')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/js/vendors/select2.min.js ')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/js/vendors/perfect-scrollbar.js ')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/js/vendors/jquery.fullscreen.min.js ')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/js/vendors/chart.js ')); ?>"></script>
        <!-- Main Script -->
        <script src="<?php echo e(asset('backend/assets/js/main.js?v=1.1 ')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('backend/assets/js/custom-chart.js ')); ?>" type="text/javascript"></script>

        <!-- toastr js -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- ColorPicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
        <script>
            $('#color').colorpicker();
        </script>

        <!-- bootstrap tags input js -->
        <script src="<?php echo e(asset('backend/assets/bootstrap-tags/bootstrap-tagsinput.min.js ')); ?>" type="text/javascript"></script>

        <!-- Data Range -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <!-- summernote start-->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
          $('.summernote').summernote({
            placeholder: 'Write Description',
            tabsize: 2,
            height: 120,
            minHeight: null,// set minimum height of editor
            maxHeight: null,// set maximum height of editor
            lang: true,
            focus: false,
            toolbar: [
              ['style', ['style']],
              ['fontname', ['fontname']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              // ['insert', ['link', 'picture', 'video']],
              // ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });
        </script>
        <!-- summernote End-->

        <!-- all toastr message show  Update-->
        <script>
            <?php if(Session::has('message')): ?>
            var type = "<?php echo e(Session::get('alert-type','info')); ?>"
            switch(type){
                case 'info':
                toastr.info(" <?php echo e(Session::get('message')); ?> ");
                break;

                case 'success':
                toastr.success(" <?php echo e(Session::get('message')); ?> ");
                break;

                case 'warning':
                toastr.warning(" <?php echo e(Session::get('message')); ?> ");
                break;

                case 'error':
                toastr.error(" <?php echo e(Session::get('message')); ?> ");
                break;
            }
            <?php endif; ?>
        </script>

        <!-- all toastr message show  old-->
        <script type="text/javascript">
            <?php if(Session::has('success')): ?>
              toastr.success("<?php echo e(Session::get('success')); ?>");
            <?php endif; ?>
            <?php if(Session::has('info')): ?>
              toastr.info("<?php echo e(Session::get('info')); ?>");
            <?php endif; ?>
            <?php if(Session::has('warning')): ?>
              toastr.warning("<?php echo e(Session::get('warning')); ?>");
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
              toastr.info("<?php echo e(Session::get('error')); ?>");
            <?php endif; ?>
            <?php if(Session::has('danger')): ?>
              toastr.danger("<?php echo e(Session::get('danger')); ?>");
            <?php endif; ?>
        </script>

        <!-- sweetalert js-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script type="text/javascript">
            $(function(){
                $(document).on('click','#delete',function(e){
                    e.preventDefault();
                    var link = $(this).attr("href");

                    Swal.fire({
                      title: 'Are you sure?',
                      text: "Delete This Data!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                })

              });
            });
        </script>

    <!-- Image Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('footer-script'); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\boikhata\resources\views/admin/admin_master.blade.php ENDPATH**/ ?>