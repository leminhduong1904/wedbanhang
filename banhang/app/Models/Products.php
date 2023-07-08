<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table ="products";

    public  function TypeProduct()
{
    return $this->belongTo(Type_Products::class,"id_type","id");
}
public function BillDetail()
{
    return $this->hasMany(BillDetail::class,"id_product","id");
}
}
