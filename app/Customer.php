<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function bills()
    {
        return $this->hasMany(bill::class, 'customer_id', 'id');
    }
}
