<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Completion;
use App\Models\Category;
use App\Models\Point;


class CompletionController extends Controller
{
    public function index() {
        $completions = Completion::with('category', 'point')->get();
        $categories = Category::all();
        $points = Point::all();

        return view('completion', compact('completions', 'categories', 'points'));
    }

    public function complete(Request $request) {
        //完了ボタンを押した時の処理を記入
        //completion_tableにデータを保存
        $completion = $request->only(['content', 'category_id', 'point_id']);
        Completion::create($completion);

        //todo_tableから削除
        Todo::find($request->id)->delete();

        //completion_tableからデータを取得
        $completions = Completion::with('category', 'point')->get();
        $categories = Category::all();
        $points = Point::all();

        return redirect('index', compact('completions', 'categories', 'points'));
    }
}
