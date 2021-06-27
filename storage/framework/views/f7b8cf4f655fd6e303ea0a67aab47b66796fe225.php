<?php $__env->startSection('content'); ?>
<div class="container-fluid pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card" id="output">
            <div class="card-body table-responsive">
                <h3 class="text-center p-1">Supplier Info</h3><hr/>
                <?php if(!empty($quote)): ?>
                <table class="table table-bordered table-light table-striped">
                    <tbody>
                        <tr class="text-center"><td>Quote No</td><td><?php echo e($quote->quote_no); ?></td></tr>
                        <tr class="text-center"><td>Client Name</td><td><?php echo e($quote->name); ?></td></tr>
                        <tr class="text-center"><td>Client Email</td><td><?php echo e($quote->email); ?></td></tr>
                        <tr class="text-center"><td>Contact No</td><td><?php echo e($quote->contact_no); ?></td></tr>
                        <tr class="text-center"><td>Area</td><td><?php echo e($quote->area_name); ?></td></tr>
                        <tr class="text-center"><td>Address</td><td><?php echo e($quote->address); ?></td></tr>
                        <tr class="text-center"><td>VAT Vendor</td><td><?php echo e($quote->vat_vendor); ?></td></tr>
                        <tr class="text-center"><td>Client Quote No</td><td><?php echo e($quote->supplier_quote_no); ?></td></tr>
                 </tbody>
                </table>
                <?php else: ?>
                    <div class="alert alert-danger">
                        No information found
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>