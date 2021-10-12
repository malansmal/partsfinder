@extends('layouts.master')

@section('content')
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #bdbdbd;
        }
    </style>
<div class="container pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                    <script>
                        setTimeout(function() {
                            window.location.href = "http://partfinders.co.za";
                        }, 5000);
                    </script>
                @else
                    <div class="alert alert-info">
                        <p class="text-center">If you are looking for parts you can not find on the website,
                            Please complete the form below with the parts you need and we will forward your request
                            to all  our parts suppliers in your area for the make of vehicle selected. We will notify you when suppliers has quoted.
                            If no reply is received within 48 Hours, please assume parts are not available and make other arrangments.
                            For Insurance Claims contact the assessor to authorise new or alternate parts after 48 hours.</p>
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="POST"  action="findme" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                                <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                    <th class="text-center" width="25%"><i class="fa fa-asterisk text-danger"></i>Make</th>
                                    <th class="text-center" width="25%"><i class="fa fa-asterisk text-danger"></i>Model</th>
                                    <th class="text-center" width="25%"><i class="fa fa-asterisk text-danger"></i>Year</th>
                                    <th class="text-center" width="25%">VIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control my-vehicle" id="make" name="make_id" required>
                                            <option value="">Select Vehicle</option>
                                            @foreach($vechiles as $vehicle)
                                                <option value="{{$vehicle->id}}">{{$vehicle->vehiclemake}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="model" name="make_model" placeholder="Enter Model" required />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" id="year" name="year" placeholder="Vehicle Year" required />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="vin" name="vin" placeholder="Vehicle Identity Number" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="parts" class="table-responsive">
                        <table class="table-bordered table-striped" id="partsTable">
                            <thead>
                                <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                    <th class="text-center"><i class="fa fa-asterisk text-danger"></i>Part Description</th>
                                    <th class="text-center">Part No (If available)</th>
                                    <th class="text-center">Add Photo (If available)</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="35%">
                                        <input type="text" class="form-control description" id="description_1" name="description[]" placeholder="Part Description" required />
                                    </td>
                                    <td width="35%">
                                        <input type="text" class="form-control part_number" id="part_number_1" name="part_number[]" placeholder="Part No" />
                                    </td>
                                    <td width="20%">
                                        <input type="file" accept=".jpg, .jpeg, .png" class="image_upload"  name="image_upload[]" id="image_upload_1">
                                    </td>
                                    <td width="10%" class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row pb-2">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success add mt-2">Add a Part</button>
                        </div>
                    </div>

                    <div class="row pt-2 pb-2">
                        <div class="col-md-6">
                            <label for="reference_cn">Reference (Please include Claim Number if Insurance Claim):</label>
                        </div>

                        <div class="col-md-6">
                            <input type="text" id="reference_cn" class="form-control" name="reference_cn" value="" />
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                                <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                    <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Area</th>
                                    <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control my-area" id="area" name="area_id" required>
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->areaname}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="name" name="client_name" placeholder="Enter your name" required />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                            <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Contact No</th>
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Email Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="contact" name="contact_no" placeholder="Enter your contact no" required />
                                </td>
                                <td>
                                    <input type="email" class="form-control" id="email" name="client_email" placeholder="Enter your email" required />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <p class="text-center">When submitting your request, you agree to our   <a href="http://www.partfinders.co.za/index.php?a=28&b=140" target="_blank" title="Terms and Conditions" onMouseOver="window.status='Term and Conditions'; return true" onMouseOut="window.status=' '">Terms and Conditions</a>
                            </p>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="submit">
                            <i class="fa fa-envelope"></i> Submit Request
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
                        $(document).on("click", "button.add", function () {
                            var rows = $('#partsTable tbody  tr').length;
                            var id = parseInt(rows) +1;
                            //var $tr = $(this).closest('tr');
                            var $tr = $('#partsTable > tbody > tr:last-child');
                            var ind = parseInt(rows) - 1;
                            var tr = '<tr>' +
                                '<td width="35%"><input type="text" class="form-control description" id="description_'+id+ '" name="description[]" placeholder="Part Description" required /></td>' +
                                '<td width="35%"><input type="text" class="form-control part_number" id="part_number_'+id+ '" name="part_number[]"  placeholder="Part No" />' +
                                '<td width="20%"><input type="file" accept=".jpg, .jpeg, .png" class="image_upload" name="image_upload[]" id="image_upload_'+id+ '"/></td>' +
                                '<td width="10%" class="text-center"><button type="button" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button></td></tr>';

                            $tr.after(tr);
                            if (rows == 1){
                                $('#partsTable').find("tr:eq(1)").find("td:eq(3)").html('<button type="button" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button>');
                            }
                        });

                        //Remove row
                        $(document).on("click", "button.remove", function () {
                            $(this).parent().parent().remove();
                            var rows = $('#partsTable tbody  tr').length;
                            if (rows == 1){
                                $('#partsTable').find("tr:eq(1)").find("td:eq(3)").html('');
                            }

                            var i = 0;
                            $(".description").each(function(){
                                var iid = i +1;
                                $(this).attr('id', 'description_'+iid);
                                $(this).attr('name', 'description['+i+']');
                                i++;
                            });
                            i = 0;
                            $(".part_number").each(function(){
                                var iid = i +1;
                                $(this).attr('id', 'part_number_'+iid);
                                $(this).attr('name', 'part_number['+i+']');
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
                                let arr = idTxt.split('_');
                                let id = arr[1];
                                $("#"+idTxt).append('<label for="image_upload_'+id+'" class="btn btn-success input_height" id="upload_image_'+id+'"><i class="fa fa-file-picture-o"></i>Add Photo</label>');
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
@endsection
