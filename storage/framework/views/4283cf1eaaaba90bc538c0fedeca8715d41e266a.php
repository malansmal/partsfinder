<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <title>Part Finder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="content for search" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap/css/bootstrap-datepicker3.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.css')); ?>">
    <?php echo $__env->yieldContent('style-script'); ?>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap-datepicker.min.js')); ?>"></script>

    <script src="<?php echo e(asset('/plugins/notify/bootstrap-notify.js')); ?>"></script>
    <script src="<?php echo e(asset('/plugins/select2/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>

</head>


<body>
<div class="container-fluid">
    <?php echo $__env->yieldContent('header'); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('footer'); ?>
</div>
</body>

</html>
