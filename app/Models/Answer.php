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

    static function select_hints($choice_id)
    {
        $array = Answer::where('choice_id', '=', $choice_id)->get();

        $hints = [];
        $hint_question_ids = [];
        $max = $array->count()-1;
        while(true)
        {
            $rand = mt_rand(0,$max);

            if(count($hints)>4)
            {
                break;

            }elseif(!in_array($array[$rand]->question_id, $hint_question_ids)){

                $hints[] = $array[$rand];
                $hint_question_ids[] = $array[$rand]->question_id;

            }
        }

        return $hints;
    }
}
