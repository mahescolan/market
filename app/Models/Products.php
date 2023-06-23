<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table="Products";
   protected $fillable=['name','price','image','category_id','register_id'];
   public function createdBy()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    public function product_r()
    {
        return $this->belongsTo(register::class,'register_id');
    }
}
