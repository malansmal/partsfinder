

<?php $__env->startSection('content'); ?>
<div class="container pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card" id="output">
            <div class="card-body">
                <div class="bg-warning mb-1 pb-2 pt-2 row text-white">
                    <div class="col-md-4 text-left">
                        <span>Part request no: <?php echo e($claims->claim_no); ?></span>
                    </div>
                    <div class="col-md-4 text-left">
                        <span>Status: <?php if($ordered): ?> Quote Ongoing <?php else: ?> Submitted for Order <?php endif; ?></span>
                    </div>
                    <div class="col-md-4 text-left">
                        <?php if($ordered): ?><span>Order No: <?php echo e($order->order_no); ?></span> <?php endif; ?>
                    </div>
                </div>
                <div class="row bg-info p-1 mb-1 text-white">
                    <div class="col-md-3">
                        <span>Make: <?php echo e($claims->MakeInfo->vehiclemake); ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Model: <?php echo e($claims->make_model); ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>Year: <?php echo e($claims->year); ?></span>
                    </div>
                    <div class="col-md-3">
                        <span>VIN: <?php echo e($claims->vin); ?></span>
                    </div>
                </div>

                <?php if(!empty($data)): ?>
                    <div id="parts">
                        <div class="row  table-responsive">
                            <p>Quoted Information: </p>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <?php ($i=1); ?>
                                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-center">
                                                <span class="supplier" onclick="viewSupplier('<?php echo e($quote->supplier_id); ?>', '<?php echo e($quote->quote_no); ?>')"><i class="fa fa-user"></i> Supplier <?php echo e($i); ?><br/>(<i><?php echo e($quote->area_name); ?>)</i></span>
                                            </td>
                                            <?php ($i++); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php ($x = 1); ?>
                                    <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php ($row = $data[$part->id]); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($part->part_description); ?> <br/><i> <?php echo e($part->part_number); ?></i></td>
                                        <?php ($y = 1); ?>
                                        <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="special-td">
                                                <div class="quote-info row special-row">
                                                    <div class="price-type col-md-10">
                                                        <?php if($r['price']): ?>
                                                        <p class="form-control <?php if(in_array($r['id'], $quoteedIds)): ?> this_selected <?php endif; ?>"><?php echo e($r['price']); ?> | <?php echo e(getPercentage($r['price'])); ?>

                                                            <span class="parts_type"><?php echo e($r['parts_type']); ?></span>
                                                        </p>
                                                        <?php else: ?>
                                                            <span class="form-control"></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="img-icon col-md-2">
                                                        <?php if($r['parts_image']): ?>
                                                            <a href="#" class="fa fa-file-image-o view_image" data-url="<?php echo e(URL::asset('part_images/'.$r['parts_image'])); ?>"></a>
                                                        <?php endif; ?>
                                                        <div class="icon"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php ($y++); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>

                                        <?php ($x++); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>
                        <?php if(!$ordered): ?>
                        <div class="row">
                            <p>Requested Buyer Information: </p><hr/>
                            <table  class="table table-bordered">
                                <thead>
                                    <tr><th>Buyer Name</th><th>Contact No</th><th>Email Address</th><th>Area</th></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($claims->client_name); ?></td>
                                        <td><?php echo e($claims->contact_no); ?></td>
                                        <td><?php echo e($claims->client_email); ?></td>
                                        <td><?php echo e($claims->AreaInfo->areaname); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="row">
                                <p>Order Information: </p><hr/>
                                <table  class="table table-bordered">
                                    <thead>
                                    <tr><th>Buyer Order No</th><th>Buyer Name</th><th>Contact No</th><th>Email Address</th><th>Delivery Address</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo e($order->buyer_order_no); ?></td>
                                        <td><?php echo e($order->name); ?></td>
                                        <td><?php echo e($order->contact_no); ?></td>
                                        <td><?php echo e($order->email); ?></td>
                                        <td><?php echo e($order->address); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        No supplier quoted yet.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>