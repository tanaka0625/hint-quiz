<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Choice;
use App\Models\Answer;
use App\Models\Question;

class GameController extends Controller
{
    public function index(Request $request) {
        // カテゴリー取得
        $category = Category::find($request->category_id);

        // 選択肢を全て選択
        $choices = Choice::where('category_id', $category->id)->get();

        // 正解を決定
        $correct_choice = $category->select_correct_choice();


        if(!$correct_choice)
        {
            
            $data = [
                'category' => $category,
                'hints' => [],
                'status' => 'NG',
                'choices' => [],
                'correct_choice' => []
            ];

        }else{

            $hints = [];

            // 正解のヒントを5つ取得
            $answers = Answer::select_hints($correct_choice->id);
            $questions = [];
            for($i=0; $i<count($answers); $i++)
            {
                $hints[$i]['answer'] = $answers[$i];
                $hints[$i]['question'] = Question::find($answers[$i]->question_id);
            }
          

            $data = [
                'category' => $category,
                'hints' => $hints,
                'status' => 'OK',
                'choices' => $choices,
                'correct_choice' => $correct_choice
            ];
        }

        return view('game.index', $data);
    }
}
