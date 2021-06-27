@extends('layouts.master')

@section('content')
<div class="container-fluid pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card" id="output">
            <div class="card-body table-responsive">
                <h3 class="text-center p-1">Supplier Info</h3><hr/>
                @if(!empty($quote))
                <table class="table table-bordered table-light table-striped">
                    <tbody>
                        <tr class="text-center"><td>Quote No</td><td>{{$quote->quote_no}}</td></tr>
                        <tr class="text-center"><td>Client Name</td><td>{{$quote->name}}</td></tr>
                        <tr class="text-center"><td>Client Email</td><td>{{$quote->email}}</td></tr>
                        <tr class="text-center"><td>Contact No</td><td>{{$quote->contact_no}}</td></tr>
                        <tr class="text-center"><td>Area</td><td>{{$quote->area_name}}</td></tr>
                        <tr class="text-center"><td>Address</td><td>{{$quote->address}}</td></tr>
                        <tr class="text-center"><td>VAT Vendor</td><td>{{$quote->vat_vendor}}</td></tr>
                        <tr class="text-center"><td>Client Quote No</td><td>{{$quote->supplier_quote_no}}</td></tr>
                 </tbody>
                </table>
                @else
                    <div class="alert alert-danger">
                        No information found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
