<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    public function ink()
    {
        return $this->belongsToMany(ink::class);
    }
    public function seller()
    {
        return $this->belongsToMany(seller::class);
    }
    public function customer()
    {
        return $this->belongsToMany(customer::class);
    }
    public function invoices()
    {
        return $this->hasOne(invoicenumbers::class,'id','invoicenumber_id');
    }
}
