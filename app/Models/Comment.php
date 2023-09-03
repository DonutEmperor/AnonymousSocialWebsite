<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $fillable = ['thread_id', 'body', 'upvotes', 'downvotes', 'report_count', 'creator_ip'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
