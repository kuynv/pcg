<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    public function goodsCategory(){
        return $this->hasOne(GoodsCategory::class,'id','good_category_id');
    }
}
