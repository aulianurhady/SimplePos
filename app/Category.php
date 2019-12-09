<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function product()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'id');
    }
}
