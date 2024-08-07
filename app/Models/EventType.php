<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'background_color', 'text_color', 'border_color'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
