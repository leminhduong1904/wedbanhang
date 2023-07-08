<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table ="customer";

    public function Bills()
    {
        return $this->hasMany(Bills::class,"id_customer","id");
    }   

}

