@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/completion.css') }}">
@endsection

@section('content')
<div class="completion_content">
    <div class="todo__alert">
        @if(session('message'))
        <div class="todo__alert--success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="content__title">
        <h2>完了したTodo一覧</h2>
    </div>
    <div class="completion-table">
        <table class="completion-table__inner">
            <tr class="completion-table__row">
                <th class="completion-table__header">Todo</th>
                <th class="completion__header">カテゴリ▼</th>
                <th class="completion-table__header">期限▼</th>
                <th class="completion-table__header">重要度▼</th>
            </tr>
            @foreach ($completions as $completion)
            <tr class="completion-table__row">
                <form action="/completions/restore" method="post">
                    @csrf
                    <td class="restore-form__item">
                        <p class="restore-form__item-input">{{ $completion['content'] }}</p>
                        <input type="hidden" name="id" value="{{ $completion['id'] }}">
                    </td>
                    <td class="restore-form__item">
                        <p class="restore-form__item-input">{{ $completion['category']['name'] }}</p>
                    </td>
                    <td class="restore-form__item">
                        <p class="restore-form__item-input">{{ $completion['deadline'] }}</p>
                    </td>
                    <td class="restore-form__item">
                        <p class="restore-form__item-input">{{optional($completion->point)->level ?? 'なし'}}</p>
                    </td>
                    <td class="restore-form__button">
                        <button class="restore-form__button-submit">戻す</button>
                    </td>
                </form>
                <form action="/completion/delete" method="post">
                    @method('DELETE')
                    @csrf
                    <td class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $completion['id'] }}">
                        <button class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection