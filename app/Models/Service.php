<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'average_time'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'agent_service', 'service_id', 'agent_id');
    }
}
