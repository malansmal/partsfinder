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
                    <div class="alert alert-info">
                        <p class="text-center">If you are looking for parts you can not find on the website, Please complete the form below with the parts you need and we will forward your request to our all parts suppliers in your area for the make of vehicle. Part Suppliers will reply direct to you, via phone or email with prices ONLY when parts are available. If no reply is received within 24 Hours, please assume parts are not available and make other arrangments. For Insurance Claims please contact assessor to obtain new or alternate parts.</p>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal" role="form" method="POST"  action="findme" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="make"><i class="fa fa-asterisk text-danger"></i>Make</label>
                                <select class="form-control my-vehicle" id="make" name="make_id" required>
                                    <option value="">Select Vehicle</option>
                                    <?php $__currentLoopData = $vechiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->vehiclemake); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="model"><i class="fa fa-asterisk text-danger"></i>Model</label>
                                <input type="text" class="form-control" id="model" name="make_model" placeholder="Enter Model" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year"><i class="fa fa-asterisk text-danger"></i>Year</label>
                                <input type="number" class="form-control" id="year" name="year" placeholder="Vehicle Year" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="vin">VIN:</label>
                                <input type="text" class="form-control" id="vin" name="vin" placeholder="Vehicle Identity number" />
                            </div>
                        </div>
                    </div>

                    <div id="parts">
                        <?php for($x = 1; $x <= 3; $x++): ?>
                        <div class="row part part_<?php echo e($x); ?>">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="description_<?php echo e($x); ?>"><i class="fa fa-asterisk text-danger"></i>Part Description <?php echo e($x); ?>:</label>
                                    <input type="text" class="form-control description" id="description_<?php echo e($x); ?>" name="description[<?php echo e($x-1); ?>]" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="part_number_<?php echo e($x); ?>">Part Number (If available)<?php echo e($x); ?>:</label>
                                    <input type="text" class="form-control part_number" name="part_number[<?php echo e($x-1); ?>]" />
                                </div>
                            </div>
                            <div class="col-md-4 row special-row">
                                <div class="col-md-7">
                                    <div class="preview-images-zone" id="preview-images-zone_<?php echo e($x); ?>">
                                        <span>Upload photo if available</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="image_upload_<?php echo e($x); ?>" class="btn btn-success" id="upload_image_<?php echo e($x); ?>"><i class="fa fa-file-picture-o"></i>Select</label>
                                        <input type="file" accept=".jpg, .jpeg, .png" class="image_upload"  name="image_upload[<?php echo e($x-1); ?>]" id="image_upload_<?php echo e($x); ?>" style="display: none;">
                                    </div>
                                </div>
                            <?php if($x < 3): ?>
                                <div class="col-md-1"><i class="fa fa-minus remove" title="Remove Part"></i></div>
                            <?php else: ?>
                                <div class="col-md-1">
                                    <i class="fa fa-minus remove" title="Remove Part"></i>
                                    <i class="fa fa-plus add" title="Add More Part"></i>
                                </div>
                            <?php endif; ?>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>

                    <div class="row pt-2 pb-2">
                        <div class="col-md-6">
                            <label for="reference_cn">Reference (Please include Claim Number if Insurance Claim):</label>
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="reference_cn" class="form-control" name="reference_cn" value="" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area"><i class="fa fa-asterisk text-danger"></i>Area</label>
                                <select class="form-control my-area" id="area" name="area_id" required>
                                    <option value="">Select Area</option>
                                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($area->id); ?>"><?php echo e($area->areaname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><i class="fa fa-asterisk text-danger"></i>Name:</label>
                                <input type="text" class="form-control" id="name" name="client_name" placeholder="Enter your name" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact"><i class="fa fa-asterisk text-danger"></i>Contact No:</label>
                                <input type="text" class="form-control" id="contact" name="contact_no" placeholder="Enter your contact no" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><i class="fa fa-asterisk text-danger"></i>Email Address:</label>
                                <input type="email" class="form-control" id="email" name="client_email" placeholder="Enter your email" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="submit">
                            <i class="fa fa-envelope"></i> Send Email
                        </button>
                    </div>
                </form>

                <script>
                    $(document).ready( function(){
                        $('#make').select2({
                            placeholder: 'Select Vehicle'
                        });
                        $('.my-area').select2({
                            placeholder: 'Select Area'
                        });

                        //Add new row
                        $(document).on("click", "i.add", function () {
                            var rows = $('#parts > .part').length;
                            var id = parseInt(rows) +1;
                            var ind = id -1;
                            var div = '<div class="row part part_'+id+ '">' +
                                '<div class="col-md-4"><div class="form-group"><label for="description_'+id+ '"><i class="fa fa-asterisk text-danger"></i>Part Description '+id+':</label><input type="text" class="form-control description" id="description_'+id+ '" name="description[' + ind + ']" required /></div></div>'+
                                '<div class="col-md-4"><div class="form-group"><label for="part_number_'+id+ '">Part Number (If available) '+id+':</label><input type="text" class="form-control part_number" id="part_number_'+id+ '" name="part_number[' + ind + ']" /></div></div>'+
                                '<div class="col-md-4 row special-row"><div class="col-md-7"><div class="preview-images-zone" id="preview-images-zone_'+id+'"><span>Upload photo if available</span></div></div>'+
                                '<div class="col-md-3"><div class="form-group"><label for="image_upload_'+id+ '" class="btn btn-success" id="upload_image_'+id+ '"><i class="fa fa-file-picture-o"></i>Select</label>'+
                                '<input type="file" accept=".jpg, .jpeg, .png" class="image_upload" name="image_upload[' + ind + ']" id="image_upload_'+id+ '" style="display: none;"></div></div>'+
                                '<div class="col-md-1"><i class="fa fa-minus remove" title="Remove this Part"></i><i class="fa fa-plus add" title="Add More Part"></i></div></div></div>';

                            $("#parts").append(div);
                            if (rows == 1)
                                $(this).addClass('fa-minus remove').removeClass('fa-plus add');
                            else
                                //$(this).remove();
                                $(this).removeClass('fa-plus add');
                        });

                        //Remove row
                        $(document).on("click", "i.fa-minus", function () {
                            $(this).parent().parent().parent().remove();
                            var root = $(this);
                            var rows = $('#parts > .part').length;
                            var id = parseInt(rows);
                            $(".remove").each(function(){
                                if(id ==1){
                                    if(!$(this).next().hasClass('fa-plus add')){
                                        $(this).addClass('fa-plus add');
                                    }
                                    $(this).removeClass('fa-minus remove');
                                }
                            });

                            var i = 0;
                            $(".description").each(function(){
                                var iid = i +1;
                                $(this).prev().attr('for', 'description_'+iid);
                                $(this).prev().html('<i class="fa fa-asterisk text-danger"></i> Part Description '+iid+ ':');
                                $(this).attr('id', 'description_'+iid);
                                $(this).attr('name', 'description['+i+']');
                                $(this).parent().parent().parent().attr('class', 'row part part_'+iid);
                                i++;
                            });
                            i = 0;
                            $(".part_number").each(function(){
                                var iid = i +1;
                                $(this).prev().attr('for', 'part_number_'+iid);
                                $(this).prev().html('<i class="fa fa-asterisk text-danger"></i> Part Number (If available) '+iid+ ':');
                                $(this).attr('id', 'part_number_'+iid);
                                $(this).attr('name', 'part_number['+i+']');
                                i++;
                            });
                            i = 0;
                            $(".image_upload").each(function(){
                                var iid = i +1;
                                $(this).prev().attr('for', 'image_upload_'+iid);
                                $(this).prev().attr('id', 'upload_image_'+iid);
                                $(this).attr('id', 'image_upload_'+iid);
                                $(this).attr('name', 'image_upload['+i+']');
                                i++;
                            });
                            i = 0;
                            $(".preview-images-zone").each(function(){
                                var iid = i +1;
                                $(this).attr('id', 'preview-images-zone_'+iid);
                                i++;
                            });
                        });


                        $(document).ready(function() {
                            $(document).on("change",".image_upload", function () {
                                let idTxt = $(this).attr('id');
                                var arr = idTxt.split("_");
                                var x = arr.pop();
                                readImage(x);

                            });

                            $(document).on('click', '.image-cancel', function() {
                                let idTxt = $(this).parent().parent().attr('id');
                                $(this).parent().parent().empty();
                                $("#"+idTxt).append("<span>Upload photo if available</span>");
                            });
                        });

                        function readImage(id_index) {
                            if (window.File && window.FileList && window.FileReader) {

                                var files = event.target.files; //FileList object
                                var output = $("#preview-images-zone_"+id_index);

                                for (let i = 0; i < files.length; i++) {
                                    var file = files[i];

                                    if (!file.type.match('image')) continue;

                                    var picReader = new FileReader();

                                    picReader.addEventListener('load', function (event) {
                                        var picFile = event.target;
                                        var html =  '<div class="preview-image">' +
                                            '<div class="image-cancel">x</div>' +
                                            '<div class="image-zone"><img id="pro-img-' + id_index + '" class="img-thumbnail" src="' + picFile.result + '"></div>' +
                                            '</div>';
                                        output.empty();
                                        output.append(html);
                                    });
                                    picReader.readAsDataURL(file);
                                }

                                $("#image_upload").val('');
                            } else {
                                console.log('Browser not support');
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>