<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/worker.css') }}" />
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
    <div class="worker__content">
        <h2>ユーザー一覧</h2>
    </div>

    <!--データテーブル-->
    <div class="data-table">
        <table>
            <tr>
                <th>id</th>
                <th>名前</th>
            </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
            </tr>
        @endforeach
        </table>

        <div class="flex__pagination">{{ $users->links('pagination::Bootstrap-4') }}</div>
    </div>
</main>

<footer class="footer">
    <div class="footer__inner">
        <h5>Atte, inc.</h5>
    </div>
</footer>

</body>
</html>
</body>