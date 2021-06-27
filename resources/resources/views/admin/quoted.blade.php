@extends('layouts.master')

@section('content')
<div class="container pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card" id="output">
            <div class="card-body">
                <div class="bg-warning mb-1 pb-2 pt-2 row text-white">
                    <div class="col-md-4 text-left">
                        <span>Part request no: {{$claims->claim_no}}</span>
                    </div>
                    <div class="col-md-4 text-left">
                        <span>Status: @if($ordered) Quote Ongoing @else Submitted for Order @endif</span>
                    </div>
                    <div class="col-md-4 text-left">
                        @if($ordered)<span>Order No: {{$order->order_no}}</span> @endif
                    </div>
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

                @if(!empty($data))
                    <div id="parts">
                        <div class="row  table-responsive">
                            <p>Quoted Information: </p>
                            <table class="table table-bordered table-sm">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        @php($i=1)
                                        @foreach($quotes as $quote)
                                            <td class="text-center">
                                                <span class="supplier" onclick="viewSupplier('{{ $quote->supplier_id}}', '{{$quote->quote_no }}')"><i class="fa fa-user"></i> Supplier {{$i}}<br/>(<i>{{$quote->area_name}})</i></span>
                                            </td>
                                            @php($i++)
                                        @endforeach
                                    </tr>
                                    @php($x = 1)
                                    @foreach($parts as $part)

                                    @php($row = $data[$part->id])
                                    <tr>
                                        <td class="text-center">{{$part->part_description}} <br/><i> {{$part->part_number}}</i></td>
                                        @php($y = 1)
                                        @foreach($row as $r)
                                            <td class="special-td">
                                                <div class="quote-info row special-row">
                                                    <div class="price-type col-md-10">
                                                        @if($r['price'])
                                                        <p class="form-control @if(in_array($r['id'], $quoteedIds)) this_selected @endif">{{$r['price'] }} | {{getPercentage($r['price'])}}
                                                            <span class="parts_type">{{$r['parts_type']}}</span>
                                                        </p>
                                                        @else
                                                            <span class="form-control"></span>
                                                        @endif
                                                    </div>
                                                    <div class="img-icon col-md-2">
                                                        @if($r['parts_image'])
                                                            <a href="#" class="fa fa-file-image-o view_image" data-url="{{URL::asset('part_images/'.$r['parts_image'])}}"></a>
                                                        @endif
                                                        <div class="icon"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            @php($y++)
                                        @endforeach
                                    </tr>

                                        @php($x++)
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        @if(!$ordered)
                        <div class="row">
                            <p>Requested Buyer Information: </p><hr/>
                            <table  class="table table-bordered">
                                <thead>
                                    <tr><th>Buyer Name</th><th>Contact No</th><th>Email Address</th><th>Area</th></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$claims->client_name}}</td>
                                        <td>{{$claims->contact_no}}</td>
                                        <td>{{$claims->client_email}}</td>
                                        <td>{{$claims->AreaInfo->areaname}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="row">
                                <p>Order Information: </p><hr/>
                                <table  class="table table-bordered">
                                    <thead>
                                    <tr><th>Buyer Order No</th><th>Buyer Name</th><th>Contact No</th><th>Email Address</th><th>Delivery Address</th></tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$order->buyer_order_no}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->contact_no}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->address}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="alert alert-danger">
                        No supplier quoted yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
