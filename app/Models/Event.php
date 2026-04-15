<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'description', 'banner', 'category', 'category_id', 'location', 'date', 'start_time', 'end_time', 'quota', 'price', 'user_id', 'organizer_id'])]
class Event extends Model
{
    public function category_rel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, TicketType::class);
    }
}
