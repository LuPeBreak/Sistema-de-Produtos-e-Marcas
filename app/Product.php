<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'image', 'description','user_id','brand_id','imgsrc'
    ];
    
    public function brand(){
        return $this->BelongsTo(Brand::class);
    }
    public function user(){
        return $this->BelongsTo(User::class);
    }
    
}
