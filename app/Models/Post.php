<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(related: User::class);
    }

    public function getCreatedAt($value)
    {
        return Carbon::now();
        // return Carbon::parse($value)->format('Y-m-d');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
