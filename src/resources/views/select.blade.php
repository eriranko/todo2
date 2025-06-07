@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/select.css') }}">
@endsection

@section('content')
<div class="select_content">
    <div class="todo_alert">
        @if ($errors->any())
        <div class="todo__alert--danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <h2>Todo編集</h2>
    <form class="select-form" action="/todos/update" method="post">
        @method('PATCH')
        @csrf
        <div class="select-form__group">
            <div class="select-form__title">
                <p>Todo：</p>
            </div>
            <div class="select-form__item">
                <input class="select-form__item-input" type="text" name="content" value="{{ $todo['content'] }}">
                <input type="hidden" name="id" value="{{ $todo['id'] }}">
            </div>
        </div>
        <div class="select-form__group">
            <div class="select-form__title">
                <p>カテゴリ：</p>
            </div>
            <div class="select-form__item">
                <select class="select-form__item-select" name="category_id" value="{{ $todo['category_id'] }}">
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="select-form__group">
            <div class="select-form__title">
                <p>期限：</p>
            </div>
            <div class="select-form__item">
                <input class="select-form__item-input" type="date" name="deadline" value="{{ $todo['deadline'] }}">
            </div>
        </div>
        <div class="select-form__group">
            <div class="select-form__title">
                <p>重要度：</p>
            </div>
            <div class="select-form__item">
                @foreach($points as $point)
                <div class="select-form__item-inner">
                    <input class="select-form__item-radio" type="radio" name="point_id" value="{{ $todo['point_id'] }}">
                    <label for="{{$point['id']}}">{{$point['level']}}</label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit">登録する</button>
        </div>
    </form>

</div>
@endsection