<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    // 正解を選択　出題できるチョイスが無い場合はfalseを返す
    public function select_correct_choice()
    {
        $list = Category::join('choices','choices.category_id','=','categories.id')
                        ->join('answers','answers.choice_id','=','choices.id')
                        ->where('categories.id','=', $this->id)
                        ->get();
        
        // 選択されたカテゴリーの選択肢に対する総回答数が5より少なければ0を返す
        if(count($list)<5)
        {
            return false;
        }

        // $listにいる選択肢のID配列
        $choice_ids = $list->pluck('choice_id')->unique()->values();

        $list2 = [];
        for($i=0; $i<$choice_ids->count(); $i++)
        {
            
            // 候補の選択肢がいくつの質問に回答されているかを出す
            $answer_count = $list->where('choice_id', $choice_ids[$i])->pluck('question_id')->unique()->values()->count();

            // その選択肢が5つ以上の質問に回答されていれば出題可能
            if($answer_count>4)
            {
                // list2には出題可能な選択肢のIDが入る
                $list2[$i] = $choice_ids[$i];
            }

            
        }

        if(count($list2) == 0)
        {
            return false;   
        }

        // 正解のIDをランダムに選択
        $correct_choice_id = $list2[mt_rand(0,count($list2)-1)];

        $correct_choice = Choice::find($correct_choice_id);

        return $correct_choice;

        
    }
}
