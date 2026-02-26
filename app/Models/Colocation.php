<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Colocation extends Model
    {
        public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'left_at')
                    ->withTimestamps();
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
