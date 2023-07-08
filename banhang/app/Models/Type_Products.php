<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Products extends Model
{
    use HasFactory;
    protected $table ="type_products";

    public function Products()
    {
        return $this->hasMany(Product::class,"id_type","id");
    }
}