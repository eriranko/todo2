<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__utilities">
                <a class="header__logo" href="/">
                    Todo管理
                </a>
            </div>
            <div class="header-nav">
                <li class="header-nav__item">
                    <a class="header-nav__list" href="/completions">完了したタスク</a>
                    <a class="header-nav__list" href="/categories">カテゴリ一覧</a>
                </li>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>