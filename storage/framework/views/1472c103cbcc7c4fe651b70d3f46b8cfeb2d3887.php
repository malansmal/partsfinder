

<?php $__env->startSection('content'); ?>
<div class="container pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if(\Session::has('message')): ?>
                    <div class="alert alert-success">
                        <ul>
                            <li><?php echo \Session::get('message'); ?></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <?php if($ordered): ?>
                        <div class="alert alert-danger">
                            <p class="text-center">You already submitted your order for this request.</p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <p class="text-center">Please see quote bellow for parts wanted. Click on <i></i> to view photo of the part when available.</p>
                            <p class="text-center">Select parts with price to proceed the order. Please check your details and enter an Order number.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <div class="row bg-info p-1 mb-1 text-white">
                    <p>Parts Request No: <?php echo e($order_no); ?></p>
                </div>

                <div class="table-responsive">
                    <table class="table-bordered table-striped" width="100%">
                        <thead>
                        <tr style="background-color: #555a64;color: #fff;height: 36px;">
                            <th class="text-center" width="25%">Make</th>
                            <th class="text-center" width="25%">Model</th>
                            <th class="text-center" width="25%">Year</th>
                            <th class="text-center" width="25%">VIN</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <td><?php echo e($claims->MakeInfo->vehiclemake); ?></td>
                            <td><?php echo e($claims->make_model); ?></td>
                            <td><?php echo e($claims->year); ?></td>
                            <td><?php echo e($claims->vin); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <?php if(!empty($data)): ?>
                <form class="form-horizontal" role="form" method="POST"  action="<?php echo e(action('HomeController@order')); ?>" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="claim_id" value="<?php echo e($claims->id); ?>"/>
                    <input type="hidden" name="claim_no" value="<?php echo e($claims->claim_no); ?>"/>
                    <input type="hidden" name="order_no" value="<?php echo e($order_no); ?>"/>

                    <div id="parts" class="mt-2">
                        <div class="table-responsive">
                            <table class="table-bordered table-hover" width="100%">
                                <tbody>
                                    <tr style="background-color: #555a64;color: #fff;">
                                        <td width="25%" class="text-center">Parts Description</td>
                                        <?php ($i=1); ?>
                                        <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-center">
                                                <span><i class="fa fa-user"></i> Supplier <?php echo e($i); ?><br/>(<i><?php echo e($quote->area_name); ?>)</i></span>
                                            </td>
                                            <?php ($i++); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php ($x = 1); ?>
                                    <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php ($row = $data[$part->id]); ?>
                                    <tr class="text-center">
                                        <input type="hidden" class="input" id="selected_quote_<?php echo e($x); ?>" value="" name="selected_quote[]" />
                                        <td class="text-center"><?php echo e($part->part_description); ?> <br/><i> <?php echo e($part->part_number); ?></i></td>
                                        <?php ($y = 1); ?>
                                        <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <div class="quote-info row">
                                                    <div class="price-type col-8">
                                                        <?php if($r['price']): ?>
                                                        <p class="form-control <?php if(in_array($r['id'], $quoteedIds)): ?> this_selected <?php else: ?> select_this <?php endif; ?> select_<?php echo e($x); ?>" data-selected="" data-id="<?php echo e($r['id']); ?>" data-row-key="<?php echo e($x); ?>" data-col-key="<?php echo e($y); ?>">&#82;<?php echo e(getPercentage($r['price'])); ?>

                                                            <span class="parts_type"><?php echo e($r['parts_type']); ?></span>
                                                        </p>
                                                        <?php else: ?>
                                                            <span class="form-control"></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="img-icon col-4">
                                                        <?php if($r['parts_image']): ?>
                                                            <a href="#" class="fa fa-file-image-o view_image" data-url="<?php echo e(URL::asset('part_images/'.$r['parts_image'])); ?>"></a>
                                                        <?php endif; ?>
                                                        <div class="icon">
                                                            <?php if(in_array($r['id'], $quoteedIds)): ?> <i class="fa fa-check-circle fa-success" title="Selected for order"></i> <?php endif; ?>
                                                        </div>
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
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox">
                                <label class="mr-4" for="vat_vendor">Please confirm if you are a VAT vendor</label>
                                <input type="checkbox" class="custom-control-input" id="vat_vendor" value="Yes" name="vat_vendor" />
                                <label class="custom-control-label" for="vat_vendor">Tick if VAT applicable</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-2 special-row">
                                    <label for="vat_no"><i class="fa fa-asterisk text-danger conditional-asterisk" style="display: none;"></i>VAT No:</label>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="vat_no" class="form-control" name="vat_no" placeholder="Vat No" value=""/>
                                </div>
                                <div class="col-md-3 special-row">
                                    <label for="buyer_order_no"><i class="fa fa-asterisk text-danger"></i>Order No:</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="buyer_order_no" name="buyer_order_no" value="" placeholder="Order No" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                            <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Name</th>
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Contact No</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" class="form-control" id="name" name="name" value="<?php echo e($claims->client_name); ?>" required /></td>
                                <td><input type="text" class="form-control" id="contact" name="contact_no" value="<?php echo e($claims->contact_no); ?>" required /></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                            <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Address</th>
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Email Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" class="form-control" id="address" name="address" placeholder="Enter Delivery Address" required /></td>
                                <td><input type="email" class="form-control" id="email" name="email" value="<?php echo e($claims->client_email); ?>" required /></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php if(!$ordered): ?>
                        <div class="form-group text-center mt-2">
                            <button class="btn btn-primary" id="submit_order" type="submit" name="submit" disabled>
                                <i class="fa fa-envelope"></i> Send Order
                            </button>
                        </div>
                    <?php endif; ?>
                </form>
                <?php else: ?>
                    <div class="alert alert-danger">
                        No supplier quoted yet. We will inform if any supplier quote to the requested parts.
                    </div>
                <?php endif; ?>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div id="myModal_body"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <script>
                    $(document).ready( function(){
                        //Remove row
                        $(document).on("click", "a.view_image", function () {
                            let imgUrl = $(this).data('url');
                            let imgElement = "<img src='"+imgUrl+"' class='img-fluid'/>";
                            $("#myModal_body").children().remove();
                            $("#myModal_body").append(imgElement);
                            $("#myModal").modal('show');
                        });

                        $(document).on("change", "#vat_vendor", function(){
                            if($(this).prop("checked") == true){
                                $('.conditional-asterisk').show();
                                $('input#vat_no').attr("required", true);
                            }else{
                                $('.conditional-asterisk').hide();
                                $('input#vat_no').attr("required", false);
                            }
                        });

                        $(document).on("click", "p.select_this", function () {
                            let rowKey = $(this).data('row-key');
                            let selected = $.trim($(this).attr('data-selected'));
                            let val =  $(this).data('id');
                            let notSelected = true;

                            if(selected === 'Yes'){
                                $(this).attr('data-selected','');
                                $(this).removeClass('this_selected');
                                $("#selected_quote_"+rowKey).val('');
                                $(this).parent().next().find('div.icon').children().remove();
                            }else{
                                $(".select_"+rowKey).each(function(){
                                    selected = $.trim($(this).attr('data-selected'));
                                    if(selected === 'Yes')
                                        notSelected = false;
                                });

                                if(notSelected){
                                    $(this).attr('data-selected','Yes');
                                    $(this).addClass('this_selected');
                                    $("#selected_quote_"+rowKey).val(val);
                                    $(this).parent().next().find('div.icon').append('<i class="fa fa-check-circle fa-success" title="Selected for order"></i>');
                                }else{
                                    $.notify({
                                        title: '<strong>Error!</strong>',
                                        message: 'You can not select same project from multiple supplier'
                                    }, {
                                        type: 'danger',
                                        z_index: 100000
                                    });
                                }
                            }
                            notSelected = true;
                            $(".input").each(function(){
                                selected = $.trim($(this).val());
                                if(selected)
                                    notSelected = false;
                            });

                            if(!notSelected){
                                $("#submit_order").prop("disabled",false);
                            }else{
                                $("#submit_order").prop("disabled",true);
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>