<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'message', 'image_path'];

    // Relationship with sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship with receiver
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    // Scope to get messages between two users
    public function scopeBetweenUsers($query, $userId1, $userId2)
    {
        return $query->where(function ($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId1)
              ->where('receiver_id', $userId2);
        })->orWhere(function ($q) use ($userId1, $userId2) {
            $q->where('sender_id', $userId2)
              ->where('receiver_id', $userId1);
        })->orderBy('created_at');
    }
}