<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Completion;
use App\Models\Category;
use App\Models\Point;


class CompletionController extends Controller
{
    public function index(Request $request) {

        $sort = $request->sort;
        $order = $request->order;

        //パラメータなしの場合、category_idの降順(desc)を設定
        if (is_null($sort) && is_null($order)) {
            $sort = 'id';
            $order = 'desc';
        }

        $orderpram = "desc";

        //設定されたデータの並びがdescの場合、viewのリンクパラメータ$orderに昇順(asc)を設定
        if($order=="desc") {
            $orderpram="asc";
        }

        //idのソートデータを取得して返す・・1ページに10件までのページネーションつけたい
        $completions = Todo::with('category', 'point')->where('is_completed', '=', 1)->orderBy($sort, $order)->get();
        $categories = Category::all();
        $points = Point::all();

        return view('completion', compact('completions', 'categories', 'points'));
    }

    public function complete(Request $request) {
        //完了ボタンを押したら、そのIDのフラグ（isCompleted）を探してくる
        //todo_tableのis_completedの数字を1に変更する
        $completion = Todo::find($request->id);
        if ($completion) {
            $completion['is_completed'] = 1;
            $completion->save();
        }
        //$completion['is_completed'] = 1;

        //todo_tableの全データのうち、is_completedが1のもののみ取得
        $completions = Todo::with('category', 'point')->where('is_completed', '=', 1)->get();
        $categories = Category::all();
        $points = Point::all();

        return redirect('index', compact('completions', 'categories', 'points'));
    }
}
