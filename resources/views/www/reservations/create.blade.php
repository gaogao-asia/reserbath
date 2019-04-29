@extends('www.layouts.base')

@section('content')
    <div>
        <h3>予約の追加</h3>
        <p class="text-right">
            <a href="{{ route('www.reservations.index') }}"
               class="pull-right btn btn-secondary btn-sm active">予約一覧に戻る</a>
        </p>
    </div>
    {!! Form::open(['url' => route('www.reservations.store'), 'method' => 'post']) !!}

    {!! Form::hidden('base_time', $baseTime) !!}

    <div class="form-group">
        {!! Form::label('reserve_time', __('models/reservation.reserve_time') . ' (予約枠は30分です)') !!}
        {!! Form::select('reserve_time', $timeOptions, null, ['id' => 'reserve_time', 'class' => 'form-control', 'placeholder' => 'Enter your resevation bath time!!']) !!}
    </div>
    {!! Form::submit('予約する', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
