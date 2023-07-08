<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills_Detail extends Model

{
    use HasFactory;
    protected  $table =  "bill_detail";         

    public function Products()
{
    return $this->belongsTo(Product::class,"id_product","id");
}
public function Bill()
{
    return $this->belongsTo(Bill::class,"id_bill","id");
}
}
