<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    
    protected $fillable = [
        'user_id',
        'name',
        'world_name',
        'port',
        'ip',
        'container_id',
        'status',
        'version',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
