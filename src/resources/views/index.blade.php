@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo_content">
    <div class="todo__alert">
        @if(session('message'))
        <div class="todo__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="search">
        <form class="search-form" action="/todos/search" method="get">
            @csrf
            <div class="search__group">
                <div class="search-item">
                    <div class="search-form__title">
                        <h3>Todo</h3>
                    </div>
                    <div class="search-form__item">
                        <div class="search-form__item">
                            <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="search__group">
                <div class="search-item">
                    <div class="search-form__title">
                        <h3>カテゴリ</h3>
                    </div>
                    <div class="search-form__item">
                        <select class="search-form__item-select" name="category_id">
                            <option value="">カテゴリー選択</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="search__group">
                <div class="search-item">
                    <div class="search-form__title">
                        <h3>重要度</h3>
                    </div>
                    <div class="search-form__item">
                        @foreach ($points as $point)
                            <input class="search-form__item-checkbox" name=point_id id="{{$point['id']}}" type="checkbox">
                            <label for="{{$point['id']}}">{{$point['level']}}</label>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="search__button">
                <button class="search__button-submit">検索</button>
            </div>
        </form>
    </div>
    <div class="button-wrapper">
        <div class="button-form" action="/todos/create" method="post">
            @csrf
            <div class="button-form__create">
                <button class="button-form__create-submit" onclick="location.href='/todos/create'">＋ Todoを作成する</button>
            </div>
        </div>
        <div class="button-form" action="/categories/create" method="post">
            @csrf
            <div class="button-form__categories">
                <button class="button-form__categories-submit" onclick="location.href='/todos/create'">＋ 〇〇を作成する</button>
            </div>
        </div>
        <form class="button-form" action="/todos/csv" method="get">
            <div class="button-form__csv">
                <button class="button-form__csv-submit" type="submit" name="content">＋ CSVを作成する</button>
            </div>
        </form>
        <form class="button-form" action="/todos/calendar" method="">
            <div class="button-form__calendar">
                <button class="button-form__calendar-submit" type="submit" name="content">＋ 〇〇を作成する</button>
            </div>
        </form>
    </div>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header-no">No.▼</th>
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__header">カテゴリ <a href="/?sort=category_id&order={{ $order }}">▽</a></th>
                <th class="todo-table__header">期限 <a href="/?sort=deadline&order={{ $order }}">▽</a></th>
                <th class="todo-table__header">重要度 <a href="/?sort=point_id&order={{ $order }}">▽</a></th>
            </tr>
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <form action="/todos/select" method="get">
                    @csrf
                    <td class="update-form__item">
                        <p class="update-form__item-input">番号</p>
                    </td>
                    <td class="update-form__item">
                        <p class="update-form__item-input">{{ $todo['content'] }}</p>
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    </td>
                    <td class="update-form__item">
                        <p class="update-form__item-input">{{ $todo['category']['name'] }}</p>
                    </td>
                    <td class="update-form__item">
                        <p class="update-form__item-input">{{ $todo['deadline'] }}</p>
                    </td>
                    <td class="update-form__item">
                        <p class="update-form__item-input">{{optional($todo->point)->level ?? 'なし'}}</p>
                    </td>
                    <td class="update-form__button">
                        <button class="update-form__button-submit">編集</button>
                    </td>
                </form>
                <form action="/completions" method="post">
                    @csrf
                    <td class="completion-form__button">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button class="completion-form__button-submit">完了</button>
                    </td>
                </form>
                <form action="/todos/delete" method="post">
                    @method('DELETE')
                    @csrf
                    <td class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        <button class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection