<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pengirimans';

    public function users()
    {
        return $this->morphTo();
    }
}
