<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Carbon date setup
     *
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    /**
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    /**
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }
}
