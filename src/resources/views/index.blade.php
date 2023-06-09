@extends('layouts.app')

@section('main')
@if (session('result'))
<div class="flash_message">
    {{ session('result') }}
</div>
@endif
@if( Auth::check() )
<p class="welcome">{{ Auth::user()->name }}さんお疲れ様です！</p>
@endif
<div class="card-container">
    @if(isset($is_attendance_start))
    <a href="/attendance/start" class="attendance-btn">勤務開始</a>
    @else
    <p class="attendance-btn inactive">勤務開始</p>
    @endif

    @if(isset($is_attendance_end))
    <a href="/attendance/end" class="attendance-btn">勤務終了</a>
    @else
    <p class="attendance-btn inactive">勤務終了</p>
    @endif

    @if(isset($is_rest_start))
    <a href="/break/start" class="attendance-btn">休憩開始</a>
    @else
    <p class="attendance-btn inactive">休憩開始</p>
    @endif

    @if(isset($is_rest_end))
    <a href="/break/end" class="attendance-btn">休憩終了</a>
    @else
    <p class="attendance-btn inactive">休憩終了</p>
    @endif
</div>

@endsection