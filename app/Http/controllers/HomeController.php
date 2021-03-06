<?php

namespace App\Http\Controllers;

use App\Areas;
use App\Claims;
use App\Orders;
use App\Parts;
use App\PartsSuppliers;
use App\QuoteParts;
use App\Quotes;
use App\VehicleMake;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = VehicleMake::orderBy('vehiclemake', 'ASC')->get();
        $areas = Areas::orderBy('areaname', 'ASC')->get();
        return view('home',['vechiles'=>$vehicles, 'areas'=>$areas ]);
    }

    public function findMe(Request $request){
      
        $descriptions   = $request->get('description');
        $partNumber     =  $request->get('part_number');
        $images         = $request->file('image_upload');
        $destinationPath= public_path()."/part_images";
        $areaId         = $request->get('area_id');
        $makeId         = $request->get('make_id');
        $client_name    =  $request->get('client_name');
        $client_email   =  $request->get('client_email');
        
       

        $data = $request->only(['client_name', 'contact_no', 'client_email', 'make_id', 'make_model', 'vin', 'year', 'received_date', 'area_id', 'reference_cn']);
        $claimNo = $data['claim_no'] = getQuoteNumber();
        $data['received_date'] = getCurrentDateTime();

        $claim = Claims::create($data);

        $claimId = $claim->id;

        foreach ($descriptions as $key=> $description){
            $part_number = $partNumber[$key];
            $fileName = '';
            if(isset($images[$key])){
                $file = $images[$key];
                $fileName = getRandomString(10);
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = $fileName.'.'.$extension;
                $file->move($destinationPath, $fileName);
            }
            $partData['claims_id']          = $claimId;
            $partData['part_description']   = $description;
            $partData['part_number']        = $part_number;
            $partData['part_image']         = $fileName;

            $part = Parts::create($partData);
        }
        

        $subject = "New PartFinders parts request found! $claimNo";
        //Need to send email here
        $suppliers = PartsSuppliers::getSupplierByAreaMakeId($areaId, $makeId);
 
        foreach ($suppliers as $supplier){
            $name   = $supplier->supplier_name;
            $email  = $supplier->supplier_email;
            $supId  = $supplier->supplier_id;
            $partlink = URL::to("/sendQuote/$supId/$claimNo");

            if(!empty($email)){
                sendHimMail($email, $name, $partlink, $subject, 'part_request_received', '', '');
            }

            if(!empty($supplier->supplier_email2)){
                sendHimMail($supplier->supplier_email2, $name, $partlink, $subject, 'part_request_received', '', '');
            }
        }

        //Send email to admin
        $partlink = URL::to("/sendQuote/0/$claimNo");

        sendHimMail('quote@partsfinder.co.za', 'Partfinders Quote', $partlink, $subject, 'mail_body', $claimNo, '');

        $quotelink = URL::to("/myPart/$claimNo");
        $subject = "PartFinders parts request received - $claimNo";

        sendHimMail($client_email, $client_name, $quotelink, $subject, 'request_submitted', $claimNo, '');

        return back()->with('message', 'Your parts request was submitted successfully!');

    }

    public function sendQuote($supplierId, $claimNo){
        $supplier   = PartsSuppliers::find($supplierId);
        $claims     = Claims::claimByNo($claimNo);
        $received   = $claims->received_date;
        $now        = getCurrentDateTime();
        $from       = Carbon::parse($received);
        $to         = Carbon::parse($now);
        $hours      = $to->diffInHours($from);
        $quote      = Quotes::where('supplier_id', $supplierId)->where('claim_id', $claims->id)->first();
        $quoted     = !empty($quote->id) ? true : false;
        $parts      = Parts::where('claims_id',$claims->id)->get();
        $quote_no   = getQuoteNumber();
        $areas = Areas::orderBy('areaname', 'ASC')->get();
       
        return view('quote',['quoted' => $quoted, 'supplier' => $supplier, 'claims'=>$claims, 'parts'=>$parts, 'quote_no'=>$quote_no, 'hours'=>$hours , 'areas'=>$areas ]);
    }

    public function insertQuote(Request $request){

        $parts      = $request->get('part_id');
        $prices     = $request->get('price');
        $partNumber = $request->get('part_number');
        $partType   = $request->get('part_type');
        $quoteNo    = $request->get('quote_no');
        $supplier_id= $request->get('supplier_id');
        $images     = $request->file('image_upload');
        $claim_no   = $request->get('claim_no');
        $imagePath  = getPartImageLocation();

        if(empty($supplier_id) || trim($supplier_id) == 0){
            $supplierArr = [
                'name' => $request->get('name'),
                'telno' => $request->get('contact_no'),
                'email' => $request->get('email'),
                'adr1' => $request->get('address')
            ];

            $supplier_id = DB::table('partssuppliers')->insertGetId($supplierArr);
        }

        $quote      = $request->only(['claim_id','quote_no', 'supplier_quote_no', 'supplier_id', 'name', 'contact_no', 'area_name', 'address', 'email', 'vat_vendor']);

        $quote['supplier_id'] = $supplier_id;
        $quote['quote_date'] = getCurrentDate();

        $quotes = Quotes::create($quote);

        foreach ($parts as $key=> $partId){
            $price      = $prices[$key];
            $part_type  = $partType[$key];
            $partNo     = $partNumber[$key];
            $fileName = '';

            if(isset($images[$key])){
                $file = $images[$key];
                $fileName = getRandomString(10);
                $extension = strtolower($file->getClientOriginalExtension());
                $fileName = $fileName.'.'.$extension;
                $file->move($imagePath, $fileName);
            }
            $partData['quote_no']   = $quoteNo;
            $partData['part_number']= $partNo;
            $partData['parts_id']   = $partId;
            $partData['parts_type'] = $part_type;
            $partData['price']      = $price;
            $partData['parts_image']= $fileName;

            $part = QuoteParts::create($partData);
        }

        //Send email to user
        $client = Claims::where('claim_no', $claim_no)->first();
        $quotelink = URL::to("/myPart/$claim_no");
        $subject = "PartFinders new quote received from supplier  for Parts Request No:$claim_no";
        sendHimMail($client->client_email, $client->client_name, $quotelink, $subject, 'quote_received', $claim_no, '');

        //Send email to supplier
        $subject = "PartFinders quote received and send to buyer - $claim_no";
        $supplierName = $request->get('name');
        $supplierEmail = $request->get('email');

        sendHimMail($supplierEmail, $supplierName, '', $subject, 'quote_submitted', $claim_no, '');

        return redirect()->action(
            "HomeController@sendQuote",[$supplier_id, $claim_no]
        )->with('message', 'Your quote for parts was submitted successfully!');
    }

    public function myPart($claimNo){
        $claims = Claims::claimByNo($claimNo);
        $parts  = Parts::where('claims_id',$claims->id)->orderBy('claims_id','asc')->get();
        $quotes = Quotes::where('claim_id',$claims->id)->orderBy('quote_no','asc')->get();
        $data = [];
        foreach ($parts as $part){
            $part_id = $part->id;
            foreach ($quotes as $quote){
                $quote_no = $quote->quote_no;
                $data[$part_id][$quote_no] = QuoteParts::where('quote_no',$quote_no)->where('parts_id',$part_id)->first();
            }
        }
        $order          = Orders::where('claim_id', $claims->id)->first();
        $ordered        = !empty($order->id) ? true : false;
        $quoteedIds     = ($ordered) ? explode(',',$order->quoted_ids) : [];

        $order_no = $claimNo;
        return view('quoted',['order'=>$order, 'ordered'=>$ordered, 'claims'=>$claims, 'parts'=>$parts, 'quotes'=>$quotes, 'data'=> $data, 'order_no'=> $order_no,  'quoteedIds'=> $quoteedIds]);
    }

    public function order(Request $request){
        $data = $request->only(['claim_id', 'order_no', 'buyer_order_no', 'name', 'contact_no', 'address', 'email']);
        $data['status'] = 'Pending';
        $data['received_date'] = getCurrentDateTime();
        $quotedIds = $request->get('selected_quote');
        $data['quoted_ids'] = implode(',', $quotedIds);
        $claim_no = $request->get('claim_no');
        $order_no = $request->get('buyer_order_no');
        $order = Orders::create($data);

        //Send email to supplier
        $subject = "PartFinders order request was received for Parts Request No: $claim_no";
        $clientName = $request->get('name');
        $clientEmail = $request->get('email');
        sendHimMail($clientEmail, $clientName, '', $subject, 'order_received', $claim_no, $order_no);

        //Send email to admin
        $subject = "Order request submitted for Parts Request No: $claim_no";
        sendHimMail('order@partsfinder.co.za', 'PartFinders Order', '', $subject, 'order_submitted', $claim_no, $order_no);

        return redirect()->action(
            "HomeController@myPart",[$claim_no]
        )->with('message', 'Your parts order was placed successfully! PartFinders will contact you shortly');
    }
}
