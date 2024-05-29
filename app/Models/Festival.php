<?php

namespace App\Models;

use Dipesh79\LaravelNepalAddressSeeder\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

}

