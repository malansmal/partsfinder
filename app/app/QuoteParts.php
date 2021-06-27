<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteParts extends Model
{
    protected $table    = "quote_parts";
    public $timestamps = false;

    protected $fillable = [
        'id', 'quote_no', 'part_number', 'parts_id', 'parts_type', 'price', 'parts_image'
    ];

    public function QuoteInfo(){
        return $this->belongsTo(Quotes::class, 'quote_no');
    }
}
