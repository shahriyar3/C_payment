<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payments';

    protected $fillable = ['user_id', 'user_name', 'token', 'decrypted_data', 'amount', 'payment_id', 'transaction_id', 'status', 'result', 'user_ip', 'user_agent'];

    protected $casts = [
        'decrypted_data' => Json::class,
        'result' => Json::class
    ];
}
