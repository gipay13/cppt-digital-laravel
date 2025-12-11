<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = ['id'];

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->born_date)->age.' Tahun',
        );
    }
}
