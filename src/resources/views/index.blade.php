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
        <div class="search__group">
            <div class="search-item">
                <div class="search__title">
                    <h3>Todo検索</h3>
                </div>
                <form class="search-form" action="">
                    <div class="search-form__item">
                        <input class="search-form__item-input" type="text">
                    </div>
                    <div class="search__button">
                        <button class="search__button-submit">検索</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="search__group">
            <div class="search-item">
                <div class="search__title">
                    <h3>カテゴリ検索</h3>
                </div>
                <form class="search-form" action="">
                    <div class="search-form__item">
                        <select class="search-form__item-select" name="category-search" id="">
                            <option value="カテゴリid">カテゴリ名</option>
                        </select>
                    </div>
                    <div class="search__button">
                        <button class="search__button-submit">検索</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="search__group">
            <div class="search-item">
                <div class="search__title">
                    <h3>重要度検索</h3>
                </div>
                <form class="search-form" action="">
                    <div class="search-form__item">
                        <input class="search-form__item-checkbox" name="" value="" id="" type="checkbox">
                    </div>
                    <div class="search__button">
                        <button class="search__button-submit">検索</button>
                    </div>
                </form>
            </div>
        </div>
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
                <button class="button-form__categories-submit" onclick="location.href='/todos/create'">＋ Todoを作成する</button>
            </div>
        </div>
        <form class="button-form" action="/todos/csv" method="">
            <div class="button-form__csv">
                <button class="button-form__csv-submit" type="submit" name="content">＋ CSVを作成する</button>
            </div>
        </form>
        <form class="button-form" action="/todos/calendar" method="">
            <div class="button-form__calendar">
                <button class="button-form__calendar-submit" type="submit" name="content">＋ カレンダーを表示</button>
            </div>
        </form>
    </div>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__header">カテゴリ▼</th>
                <th class="todo-table__header">期限▼</th>
                <th class="todo-table__header-point">重要度▼</th>
            </tr>
            <!--データベースにあるものを１つずつ表示する foreach($todos as $todo) 編集ボタンでやるならinputじゃなくていいんじゃね？-->
            <tr class="todo-table__row">
                <form action="/todos/update" method="post">
                    <td class="update-form__item">
                        <input class="update-form__item-input" type="text" name="content" value="todoの中身">
                    </td>
                    <td class="update-form__item">
                        <input class="update-form__item-input" type="text" name="category" value="categoryの中身">
                    </td>
                    <td class="update-form__item">
                        <input class="update-form__item-input" type="text" name="deadline" value="期限の中身">
                    </td>
                    <td class="update-form__item">
                        <input class="update-form__item-point" type="text" name="point" value="重要度の中身">
                    </td>
                    <td class="update-form__button">
                        <button class="update-form__button-submit">編集</button>
                    </td>
                </form>
                <form action="/todos/finish" method="post">
                    <td class="finish-form__button">
                        <button class="finish-form__button-submit">完了</button>
                    </td>
                </form>
                <form action="/todos/delete" method="post">
                    <td class="delete-form__button">
                        <button class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
        </table>
    </div>
</div>
@endsection