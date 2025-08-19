<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',     
    'image',
    'condition',
    'name',
    'brand',
    'description',
    'price',
];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'item_category');
    }

    public function mylists()
    {
        return $this->hasMany(Mylist::class);
    }
}
