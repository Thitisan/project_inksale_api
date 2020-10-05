<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ink extends Model
{
    public function bills()
    {
        return $this->belongsToMany(bill::class, 'ink_id', 'id');
    }
}
