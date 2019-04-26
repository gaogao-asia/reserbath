@extends('layouts.app')

@section('content')
    <div>
        <h3>予約の編集</h3>
        <p class="text-right">
            <a href="{{ route('www.reservations.index') }}" class="pull-right btn btn-secondary btn-sm active">予約一覧に戻る</a>
        </p>
    </div>
    {!! Form::model($reservation, ['url' => route('www.reservations.update', $reservation), 'method' => 'put']) !!}
    <div class="form-group">
        {!! Form::label('user_id', 'ユーザーID') !!}
        {!! Form::number('user_id', $value = null, $attributes = ['id' => 'user_id', 'class' => 'form-control', 'placeholder' => '']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('reserve_time', __('models.reservation.reserve_time')) !!}
        {!! Form::datetime('reserve_time', $value = null, $attributes = ['id' => 'reserve_time', 'class' => 'form-control', 'placeholder' => 'Enter your resevation bath time!!']) !!}
    </div>
    {!! Form::submit('予約内容を変更する', $attributes =['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
