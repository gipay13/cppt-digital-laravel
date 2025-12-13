<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cppt extends Model
{
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
