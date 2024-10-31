@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
@endsection

@section('content')

<div class="stamp__content">
    <div class="stamp-form__heading">
        <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
    </div>

<!--勤務開始・終了-->

    <div class="flex__form__group">

        <form class="form" action="{{ route('clock.in') }}" method="POST">
            @csrf
            <div class="form__group-content">
                <div class="form__clock-in-button">
                    <button class="form__button-submit" type="submit"
                    @if($todayClockIn = Auth::user()->clocks()->whereDate('clock_in', now()->toDateString())->first())
                    disabled @endif>
                    勤務開始
                    </button>

                </div>
            </div>
        </form>

        <form class="form" action="{{ route('clock.out') }}" method="POST">
            @csrf
            <div class="form__group-content">
                <div class="form__clock-out-button">
                    <button class="form__button-submit" type="submit" 
                        @if(!($currentClock = Auth::user()->clocks()->latest()->first()) || 
                        $currentClock->clock_out !== null || 
                        !$currentClock->clock_in || 
                        (($latestBreak = $currentClock->breakTimes()->latest()->first()) && !$latestBreak->break_out))
                        disabled @endif>
                        勤務終了
                    </button>

                </div>
            </div>
        </form>
    </div>

<!-- 休憩開始・終了 -->
<div class="flex__form__group">

    <form class="form" action="{{ route('break.in') }}" method="POST">
        @csrf
        <div class="form__group-content">
            <div class="form__break-in-button">
                <button class="form__button-submit" 
                    @if(!Auth::user()->clocks()->latest()->first() || 
                        (Auth::user()->clocks()->latest()->first()->clock_in === null) || 
                        (Auth::user()->clocks()->latest()->first()->clock_out !== null)) disabled @endif>
                    休憩開始
                </button>
            </div>
        </div>
    </form>

    <form class="form" action="{{ route('break.out') }}" method="POST">
        @csrf
        <div class="form__group-content">
            <div class="form__break-out-button">
                <button class="form__button-submit" @if(
        !($currentClock = Auth::user()->clocks()->latest()->first()) || 
        $currentClock->clock_out !== null || 
        !($latestBreak = $currentClock->breakTimes()->latest()->first()) || 
        $latestBreak->break_in === null || 
        $latestBreak->break_out !== null
    ) 
        disabled 
    @endif>
                    休憩終了
                </button>
            </div>
        </div>
    </form>
</div>


</div>
@endsection