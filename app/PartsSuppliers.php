<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartsSuppliers extends Model
{
    protected $table    = "partssuppliers";
    public $timestamps = false;

    protected $fillable = [
        'id', 'name', 'contactname', 'telno', 'faxno','email', 'email2', 'addr1', 'addr2'
    ];

    public static function getSupplierByAreaMakeId($areaId, $makeId){
        return self::select('partssuppliers.id as supplier_id','partssuppliers.name as supplier_name','partssuppliers.contactname as contact_name','partssuppliers.email as supplier_email','partssuppliers.email2 as supplier_email2')
            ->join('partsupplier_area', 'partssuppliers.id', '=', 'partsupplier_area.partssupplierid')
            ->join('partssupplier_vehiclemake', 'partssupplier_vehiclemake.partssupplierid', '=', 'partssuppliers.id')
            ->orderBy('partssuppliers.name')
            ->where( 'partsupplier_area.areaid', $areaId)
            ->where( 'partssupplier_vehiclemake.vehiclemakeid', $makeId)
            ->get();
    }
}
