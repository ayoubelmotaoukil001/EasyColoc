<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'user_id',
        'colocation_id',
        'entry_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        
        return $this->belongsTo(Category::class);
    }
}
