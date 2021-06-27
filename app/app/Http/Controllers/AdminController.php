<?php

namespace App\Http\Controllers;

use App\Claims;
use App\Orders;
use App\Parts;
use App\QuoteParts;
use App\Quotes;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pendingOrders = Orders::where('status', 'Pending')->get();
        $completedOrder = Orders::where('status', 'Completed')->get();
        $ongoingOrder = Orders::where('status', 'Bought')->get();
        $used = [];
        $pending = [];

        foreach($pendingOrders as $p){
            $used[] = $p->claim_id;
            $pending[] = $p->claim_id;
        }

        foreach($completedOrder as $complete){
            $used[] = $complete->claim_id;
        }

        foreach($ongoingOrder as $ongoing){
            $used[] = $ongoing->claim_id;
        }

        $quoteOngoing = Claims::whereNotIn('id', $used)->get();
        $orderedQuote = Claims::whereIn('id', $pending)->get();

        return view('admin.home',['quoteOngoing' => $quoteOngoing, 'pendingOrders' => $pendingOrders, 'orderedQuote' => $orderedQuote]);
    }

    public function viewQuote(Request $request){
        $claimNo= $request->get('claimNo');
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

        return view('admin.quoted',['order'=>$order, 'ordered'=>$ordered, 'claims'=>$claims, 'parts'=>$parts, 'quotes'=>$quotes, 'data'=> $data, 'quoteedIds'=> $quoteedIds]);
    }

    function viewSupplier(Request $request){
        $id = $request->get('supplier_id');
        $quote_no = $request->get('quote_no');

        $quote = Quotes::where('quote_no',$quote_no)->where('supplier_id',$id)->first();

        return view('admin.supplier',['quote'=>$quote]);

    }
}
