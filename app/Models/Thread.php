<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Thread extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $fillable = ['topic_id', 'title', 'content', 'created_at', 'updated_at', 'upvotes', 'downvotes', 'report_count', 'creator_ip'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
