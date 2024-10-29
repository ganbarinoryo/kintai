@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
@endsection

@section('content')

<div class="stamp__content">
    <div class="stamp-form__heading">
        <h2>福場凛太郎さんお疲れ様です！</h2>
    </div>

<!--勤務開始・終了-->

<div class="flex__form__group">

    <form class="form">
        <div class="form__group-content">
            <div class="form__clock-in-button">
                <button class="form__button-submit" type="submit">
                    勤務開始
            </button>
            </div>
        </div>
    </form>

    <form class="form">
        <div class="form__group-content">
            <div class="form__clock-out-button">
                <button class="form__button-submit" type="submit">勤務終了
            </button>
            </div>
        </div>
    </form>
</div>

<!--休憩開始・終了-->

<div class="flex__form__group">

    <form class="form">
        <div class="form__group-content">
            <div class="form__break-in-button">
                <button class="form__button-submit" type="submit">休憩開始
            </button>
            </div>
        </div>
    </form>

    <form class="form" action="">
        <div class="form__group-content">
            <div class="form__break-out-button">
                <button class="form__button-submit" type="submit">休憩終了
            </button>
            </div>
        </div>
    </form>
</div>

</div>
@endsection