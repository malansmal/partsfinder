<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table    = "orders";
    public $timestamps = false;

    protected $fillable = [
        'id', 'claim_id', 'order_no', 'buyer_order_no', 'name', 'contact_no', 'address', 'email', 'quoted_ids', 'received_date', 'status'
    ];

    public function ClaimInfo(){
        return $this->belongsTo(Claims::class, 'claim_id');
    }

    public static function getOrderNoByClaimId($claimId){
        return self::where('claim_id', $claimId)->first();
    }
}
