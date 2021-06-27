<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table    = "quotes";
    public $timestamps = false;

    protected $fillable = [
        'id', 'claim_id', 'quote_no', 'supplier_quote_no', 'supplier_id', 'name', 'contact_no', 'address', 'area_name', 'email', 'vat_vendor', 'quote_date'
    ];

    public function QuoteInfo()
    {
        return $this->hasMany(QuoteParts::class, 'quote_no');
    }
}
