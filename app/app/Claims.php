<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    protected $table    = "claims";
    public $timestamps = false;

    protected $fillable = [
        'id', 'claim_no', 'client_name', 'contact_no', 'client_email', 'make_id', 'make_model', 'vin', 'year', 'received_date', 'area_id', 'reference_cn'
    ];

    public function MakeInfo(){
        return $this->belongsTo(VehicleMake::class, 'make_id');
    }

    public function AreaInfo(){
        return $this->belongsTo(Areas::class, 'area_id');
    }

    public function OrderInfo()
    {
        return $this->hasMany(Orders::class, 'id');
    }

    public static function claimById($id){
        return self::where('id',$id)->first();
    }
    public static function claimByNo($claimNo){
        return self::where('claim_no',$claimNo)->first();
    }
}
