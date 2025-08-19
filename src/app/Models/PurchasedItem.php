<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'zip_code', 
        'address', 
        'building',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
