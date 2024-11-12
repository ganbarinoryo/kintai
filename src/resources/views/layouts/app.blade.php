<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
  @yield('css')
</head>

<body>
        <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Atte</a>

<!--ヘッダー右側のリンク３つ-->
          <ul class="flex__header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
                <a href="/">ホーム</a>
            </li>

            <li class="header-nav__item">
                <form action="/worker" method="get">
                    @csrf
                    <button class="header-nav__button">ユーザー一覧</button>
                </form>
            </li>

            <li class="header-nav__item">
                <form action="/work_history" method="get">
                    @csrf
                    <button class="header-nav__button">個別勤怠一覧</button>
                </form>
            </li>

            <li class="header-nav__item">
                <form action="/attendance" method="get">
                    @csrf
                    <button class="header-nav__button">日付一覧</button>
                </form>
            </li>
            <li class="header-nav__item">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="header-nav__button">ログアウト</button>
                </form>
            </li>
            @endif
          </ul>

</div>
</header>

  <main>
    @yield('content')
  </main>

  <footer class="footer">
    <div class="footer__inner">
        <h5>Atte, inc.</h5>
    </div>
</footer>

</body>
</html>