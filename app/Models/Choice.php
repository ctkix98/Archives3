<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['chapter_id', 'text', 'target_chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function target()
    {
        return $this->belongsTo(Chapter::class, 'target_chapter_id');
    }
}
