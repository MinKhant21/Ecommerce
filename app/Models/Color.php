<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillabe = ['slug' , 'name'];
    public function product(){
        return $this->belongsToMany(Product::class,'product_color');
    }
    use HasFactory;
}