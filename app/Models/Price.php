<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prices';

    protected $fillable = ['price'];

    public function scopeGetByCurrency($query, $currency)
    {
        return $query->where('currency', '=', $currency);
    }
}
