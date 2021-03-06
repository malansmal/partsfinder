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
                            <p class="text-center">Click on Photo Icon <i class="fa fa-file-picture-o"></i> next to Part Descrition to view sample of parts when available.</p>
							<p class="text-center">Please upload sample photo of available part/s quoted for.</p>
							<p class="text-center">Please remove/delete part/s from quote if not available.</p>
                        </div>
                    @endif
                @endif
                <div class="col">
                    <h3>Parts Request No: {{$quote_no}}</h3>
                </div>

                <div class="row bg-info p-1 mb-1 text-white">
                    <div class="col-md-3">
                        <span>Make: {{$claims->MakeInfo->vehiclemake}}</span>
                    </div>
                    <div class="col-md-3">
                        <span>Model: {{$claims->make_model}}</span>
                    </div>
                    <div class="col-md-3">
                        <span>Year: {{$claims->year}}</span>
                    </div>
                    <div class="col-md-3">
                        <span>VIN: {{$claims->vin}}</span>
                    </div>
                </div>

                <form class="form-horizontal" role="form" method="POST"  action="{{action('HomeController@insertQuote')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="claim_id" value="{{$claims->id}}"/>
                    <input type="hidden" name="claim_no" value="{{$claims->claim_no}}"/>
                    <input type="hidden" name="quote_no" value="{{$quote_no}}"/>
                    <input type="hidden" name="supplier_id" value="@if(!empty($supplier)){{$supplier->id}}@else 0 @endif" />
                    <div id="parts">
                        @php($x=1)
                        @foreach($parts as $part)
                        <div class="row part part_{{$x}}">
                            <input type="hidden" name="part_id[{{$x-1}}]" value="{{$part->id}}">
                            <div class="col-md-2">
                                <p>Part Description:</p>
                                <div class="row">
                                    <div class="col-6">
                                        <span>{{$part->part_description}}</span>
                                    </div>
                                    <div class="col-6">
                                        @if(!empty($part->part_image))
                                        <span class="fa fa-file-image-o view_image" data-url="{{URL::asset('part_images/'.$part->part_image)}}"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Part Number</label>
                                    <input type="text" class="form-control"  name="part_number[{{$x-1}}]" placeholder="Enter Part No" value="{{$part->part_number}}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="price_{{$x}}"><i class="fa fa-asterisk text-danger"></i>Price Excl. VAT</label>
                                    <input type="text" class="form-control price" name="price[{{$x-1}}]" required />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="part_type_{{$x}}"><i class="fa fa-asterisk text-danger"></i>Parts Type</label>
                                    <select class="form-control part_type" id="part_type_{{$x}}" name="part_type[{{$x-1}}]" required>
                                        <option value="">Select</option>
                                        <option value="Used">Used</option>
                                        <option value="Alt">Alternate</option>
										<option value="New">New</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 row special-row">
                                <div class="col-md-7">
                                    <div class="preview-images-zone" id="preview-images-zone_{{$x}}">
                                        <span>Upload photo if available</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="image_upload_{{$x}}" class="btn btn-success" id="upload_image_{{$x}}"><i class="fa fa-file-picture-o"></i>Add Photo</label>
                                        <input type="file" accept=".jpg, .jpeg, .png" class="image_upload"  name="image_upload[{{$x-1}}]" id="image_upload_{{$x}}" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-md-1"><i class="fa fa-minus remove" title="Remove Part"></i></div>
                            </div>
                        </div>
                        @php($x++)
                        @endforeach
                    </div>

                    <div class="row">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name"><i class="fa fa-asterisk text-danger"></i>Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="@if(!empty($supplier)){{$supplier->name}}@endif" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact"><i class="fa fa-asterisk text-danger"></i>Contact No:</label>
                                <input type="text" class="form-control" id="contact" name="contact_no" value="{{getSupplierContactNo($supplier)}}" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email"><i class="fa fa-asterisk text-danger"></i>Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{getSupplierEmail($supplier)}}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area"><i class="fa fa-asterisk text-danger"></i>Area</label>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address"><i class="fa fa-asterisk text-danger"></i>Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{getSupplierAddress($supplier)}}" required />
                            </div>
                        </div>
                    </div>
                    @if($hours <= 48 && !$quoted)
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit" name="submit">
                            <i class="fa fa-envelope"></i> Send Quote
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
                            $("#"+idTxt).append("<span>Upload photo if available</span>");
                        });
                        $(document).on("click", "i.fa-minus", function () {
                            
                            $(this).parent().parent().parent().remove();
                            
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
