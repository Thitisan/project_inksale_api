<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoicenumbers extends Model
{
    public function bills()
    {
        return $this->belongsToMany(bill::class);
    }
}
