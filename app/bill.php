<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    public function ink()
    {
        return $this->belongsTo(ink::class);
    }
    public function seller()
    {
        return $this->belongsTo(seller::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
