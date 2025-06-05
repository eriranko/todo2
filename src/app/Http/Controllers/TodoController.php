<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequests;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        return view ('index');
    }

    public function store(TodoRequest $request) {
        //todo追加処理記入
        $todo = $request->only(['content', 'category_id', 'deadline', 'point_id']);
        Todo::create($todo);

        return redirect('index')->with('message', 'Todoを追加しました');
    }

}

