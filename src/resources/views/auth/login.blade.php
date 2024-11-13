<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Atte
            </a>
        </div>

<div class="login__content">
    <div class="login-form__heading">
        <h2>ログイン</h2>
    </div>

    <form class="form" action="/login" method="POST">
        @csrf

        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="パスワード" value="" />
                </div>
                <div class="form__error">
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン
            </button>
        </div>

        <div class="form__register-link">
            <p>アカウントをお持ちでない方はこちらから<br><a href="/register">会員登録</a>
            </p>
        </div>

    </form>
</div>
<footer class="footer">
    <div class="footer__inner">
        <h5>Atte, inc.</h5>
    </div>
</footer>
</body>
</html>