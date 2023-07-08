<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected  $table =  "bills";         

    public function BillDetails()
{
    return $this->hasMany(BillDetail::class,"id_bill","id");
}
    public function Customer()
{
    return $this->belongsTo(Customer::class,"id_customer","id");
}
}
