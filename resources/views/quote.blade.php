@extends('layouts.master')

@section('content')
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
                    @if($quoted)
                        <div class="alert alert-danger">
                            <p class="text-center">You have already submitted your quote on this parts request.</p>
                        </div>
                    @elseif($hours > 48)
                        <div class="alert alert-danger">
                            <p class="text-center">Sorry the time has expired to quote on this parts request</p>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="text-center">Thank you for replying to our email request to quote on parts wanted. Please only quote on parts available.</p>
                            <p class="text-center">Click on Photo Icon <i class="fa fa-file-picture-o"></i> next to Part Description to view sample of parts when available.</p>
                            <p class="text-center">Please upload sample photo of available part/s quoted for.</p>
                            <p class="text-center">Please remove/delete part/s from quote if not available.</p>
                        </div>
                    @endif
                @endif
                <div class="col">
                    <h3>Parts Request No: {{$quote_no}}</h3>
                </div>

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
                            <tr class="text-center">
                                <td>{{$claims->MakeInfo->vehiclemake}}</td>
                                <td>{{$claims->make_model}}</td>
                                <td>{{$claims->year}}</td>
                                <td>{{$claims->vin}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <form class="form-horizontal" role="form" method="POST"  action="{{action('HomeController@insertQuote')}}" 
                	enctype="multipart/form-data"
                	onsubmit="submit.disabled = true; return true;">
                    {{csrf_field()}}
                    <input type="hidden" name="claim_id" value="{{$claims->id}}"/>
                    <input type="hidden" name="claim_no" value="{{$claims->claim_no}}"/>
                    <input type="hidden" name="quote_no" value="{{$quote_no}}"/>
                    <input type="hidden" name="supplier_id" value="@if(!empty($supplier)){{$supplier->id}}@else 0 @endif" />
                    <div id="parts" class="table-responsive">
                        <table class="table-bordered table-striped" id="partsTable">
                            <thead>
                                <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                    <th class="text-center" width="25%"><i class="fa fa-asterisk text-danger"></i>Part Description</th>
                                    <th class="text-center" width="15%">Part No</th>
                                    <th class="text-center" width="15%"><i class="fa fa-asterisk text-danger"></i>Price (Excl. VAT)</th>
                                    <th class="text-center" width="15%"><i class="fa fa-asterisk text-danger"></i>Parts Type</th>
                                    <th class="text-center" width="15%">Add Photo (If available)</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        @php($x=1)
                        @foreach($parts as $part)
                        <tr>
                            <input type="hidden" name="part_id[{{$x-1}}]" value="{{$part->id}}">
                            <td>
                                {{$part->part_description}}
                                @if(!empty($part->part_image))
                                    <span class="fa fa-file-image-o view_image" data-url="{{URL::asset('part_images/'.$part->part_image)}}"></span>
                                @endif
                            </td>
                            <td><input type="text" class="form-control"  name="part_number[{{$x-1}}]" placeholder="Enter Part No" value="{{$part->part_number}}"></td>
                            <td><input type="text" class="form-control price" name="price[{{$x-1}}]" required /></td>
                            <td>
                                <select class="form-control part_type" id="part_type_{{$x}}" name="part_type[{{$x-1}}]" required>
                                    <option value="">Select</option>
                                    <option value="Used">Used</option>
                                    <option value="Alt">Alternate</option>
                                    <option value="New">New</option>
                                </select>
                            </td>
                            <td>
                                <input type="file" accept=".jpg, .jpeg, .png" class="image_upload"  name="image_upload[{{$x-1}}]" id="image_upload_{{$x}}">
                            </td>
                            <td class="text-center"><button type="button" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></button></td>

                        </tr>
                        @php($x++)
                        @endforeach
                            </tbody></table>
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
                                <div class="col-md-4">
                                    <label for="supplier_quote_no"><i class="fa fa-asterisk text-danger"></i>Your Quote No:</label>
                                </div> 

                                <div class="col-md-8">
                                    <input type="text" id="supplier_quote_no" class="form-control" name="supplier_quote_no" value="" required/>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                            <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                <th class="text-center" width="33%"><i class="fa fa-asterisk text-danger"></i>Name</th>
                                <th class="text-center" width="33%"><i class="fa fa-asterisk text-danger"></i>Contact No</th>
                                <th class="text-center" width="33%"><i class="fa fa-asterisk text-danger"></i>Email Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" class="form-control" id="name" name="name" value="@if(!empty($supplier)){{$supplier->name}}@endif" required /></td>
                                <td><input type="text" class="form-control" id="contact" name="contact_no" value="{{getSupplierContactNo($supplier)}}" required /></td>
                                <td><input type="email" class="form-control" id="email" name="email" value="{{getSupplierEmail($supplier)}}" required /></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table-bordered table-striped" width="100%">
                            <thead>
                            <tr style="background-color: #555a64;color: #fff;height: 36px;">
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Area</th>
                                <th class="text-center" width="50%"><i class="fa fa-asterisk text-danger"></i>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select class="form-control my-area" id="area" name="area_name" required>
                                        <option value="">Select Area</option>
                                        @foreach($areas as $area)
                                            @if($area->id == $claims->area_id)
                                                <option value="{{$area->areaname}}" selected>{{$area->areaname}}</option>
                                            @else
                                                <option value="{{$area->areaname}}" >{{$area->areaname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" id="address" name="address" value="{{getSupplierAddress($supplier)}}" required /></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($hours <= 48 && !$quoted)
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="submit">
                            <i class="fa fa-envelope"></i> Submit Quote
                        </button>
                    </div>
                    @endif
                </form>

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

                    $(document).ready( function(){
                        $('.my-area').select2({
                            placeholder: 'Select Area'
                        });
                        $(document).on("click", "span.view_image", function () {
                            let imgUrl = $(this).data('url');
                            let imgElement = "<img src='"+imgUrl+"' class='img-fluid'/>";
                            $("#myModal_body").children().remove();
                            $("#myModal_body").append(imgElement);
                            $("#myModal").modal('show');
                        });

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
                        $(document).on("click", "button.remove", function () {

                            $(this).parent().parent().remove();
                            
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
