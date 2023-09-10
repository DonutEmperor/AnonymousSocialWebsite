<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    use HasFactory;
    use Searchable;

    public $timestamps = false;
    protected $fillable = ['board_id', 'title', 'description'];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
