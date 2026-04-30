<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'server_id',
        'external_id',
        'invoice_url',
        'amount',
        'status',
    ];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
