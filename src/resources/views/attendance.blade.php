<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atte</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
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
    <div class="flex__attendance__content">
        <a class="button_left" href="{{ route('attendance.show', ['date' => $date->copy()->subDay()->toDateString()]) }}">＜</a>
        <div class="center">{{ $date->format('Y-m-d') }}</div>
        <a class="button_right" href="{{ route('attendance.show', ['date' => $date->copy()->addDay()->toDateString()]) }}">＞</a>
    </div>

    <!--データテーブル-->
    <div class="data-table">
        <table>
            <tr>
                <th>id</th>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
            @foreach ($users as $user)
                @foreach ($user->clocks as $clock)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($clock->clock_in)->format('H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($clock->clock_out)->format('H:i:s') }}</td>
                        <td>@php
                            // 総休憩時間を計算
                            $totalBreakTime = $clock->breakTimes->sum(function($break) {
                                return strtotime($break->break_out) - strtotime($break->break_in);
                            });
                            echo gmdate("H:i:s", $totalBreakTime);
                        @endphp</td>
                        <td>@php
                            // 勤務終了時間を取得
                            $clockOut = $clock->clock_out ? strtotime($clock->clock_out) : time();
                            // 勤務時間を計算
                            $work_time = ($clockOut - strtotime($clock->clock_in)) - $totalBreakTime;
                            echo gmdate("H:i:s", $work_time);
                        @endphp</td>
                    </tr>
                @endforeach
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