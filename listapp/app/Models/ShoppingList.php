<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = ['owner', 'is_shared', 'share_code'];

    // Relationship to child items
    public function items()
    {
        return $this->hasMany(ShoppingItem::class);
    }
}
