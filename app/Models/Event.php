<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date', 'event_type_id'];

    protected $dates = ['start_date', 'end_date'];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }
}
