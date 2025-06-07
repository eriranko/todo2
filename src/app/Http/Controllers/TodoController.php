<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Point;

class TodoController extends Controller
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
        $todos = Todo::with('category', 'point')->orderBy($sort, $order)->get();
        $categories = Category::all();
        $points = Point::all();

        return view ('index', compact('todos', 'categories', 'points', 'order'));
    }

    public function create() {
        $categories = Category::all();
        $points = Point::all();

        return view ('create', compact('categories', 'points'));
    }

    public function store(TodoRequest $request) {
        //todo追加処理記入
        $todo = $request->only(['content', 'category_id', 'deadline', 'point_id']);
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを追加しました');
    }

    public function select(Request $request) {
        //編集するTodoを選び、表示する処理を記入
        $todo = Todo::find($request->id);
        $categories = Category::all();
        $points = Point::all();

        return view ('select', compact('todo', 'categories', 'points'));
    }

    public function update(TodoRequest $request) {
        $todo = $request->only(['content', 'category_id', 'deadline', 'point_id']);
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを変更しました');
    }

    public function destroy(Request $request) {
        Todo::find($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    //todo検索
    public function search(Request $request) {
        $todos = Todo::with('category', 'point')->CategorySearch($request->category_id)->PointSearch($request->point_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();
        $points = Point::all();

        return view('index', compact('todos', 'categories', 'points'));
    }

}

