<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Category;
use App\Models\Answer;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::where('category_id', '=', $request->category_id)->get();
        $choices = Choice::where('category_id', '=', $request->category_id)->get();

        $data = [
            'choices' => $choices,
            'questions' => $questions,
            'category' => Category::find($request->category_id)
        ];

       return view('post.index', $data);
    }

    public function add(Request $request)
    {
        $new_answer = new Answer;
        $new_answer->question_id = $request->question_id;
        $new_answer->choice_id = $request->choice_id;
        $new_answer->user_id = 0;
        $new_answer->text = $request->answer_text;
        $new_answer->save();

        return redirect('/post/'. $request->category_id);

    }

    
}
