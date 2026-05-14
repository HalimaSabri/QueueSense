<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticsLog extends Model
{
    protected $fillable = ['ticket_id', 'wait_time', 'service_time'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
