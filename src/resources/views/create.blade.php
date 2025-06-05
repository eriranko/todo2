@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="create_content">
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
    <h2>Todo登録</h2>
    <form class="create-form" action="/todos" method="post">
        @csrf
        <div class="create-form__group">
            <div class="create-form__title">
                <p>Todo：</p>
            </div>
            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="content">
            </div>
        </div>
        <div class="create-form__group">
            <div class="create-form__title">
                <p>カテゴリ：</p>
            </div>
            <div class="create-form__item">
                <select class="create-form__item-select" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="create-form__group">
            <div class="create-form__title">
                <p>期限：</p>
            </div>
            <div class="create-form__item">
                <input class="create-form__item-input" type="date" name="deadline">
            </div>
        </div>
        <div class="create-form__group">
            <div class="create-form__title">
                <p>重要度：</p>
            </div>
            <div class="create-form__item">
                <div class="create-form__item-inner">
                    <input class="create-form__item-radio" type="radio" name="point" value="高い">
                    <label for="高">高い</label>
                </div>
                <div class="create-form__item-inner">
                    <input class="create-form__item-radio" type="radio" name="point" value=普通">
                    <label for="中">普通</label>
                </div>
                <div class="create-form__item-inner">
                    <input class="create-form__item-radio" type="radio" name="point" value="低い">
                    <label for="低">低い</label>
                </div>
            </div>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit">登録する</button>
        </div>
    </form>

</div>
@endsection