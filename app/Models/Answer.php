<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
