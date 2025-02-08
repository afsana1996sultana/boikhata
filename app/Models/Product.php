<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function writer(){
    	return $this->belongsTo(Vendor::class,'vendor_id','user_id');
    }

    public function publication(){
    	return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
    public function multi_imgs()
    {
        return $this->hasMany(MultiImg::class);
    }
    public function getProducts() {
        $products = Product::with('stocks')->get();
        return response()->json($products);
    }
}
