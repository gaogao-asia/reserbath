@extends('layouts.app')

@section('content')
  <div>
      <h3>予約の追加</h3>
      <p class="text-right">
          <a href="{{ route('www.reservations.index') }}" class="pull-right btn btn-secondary btn-sm active">予約一覧に戻る</a>
      </p>
  </div>
  {!! Form::open(['url' => route('www.reservations.store'), 'method' => 'post']) !!}

  <div class="form-group">
      {!! Form::label('reserve_time', __('models.reservation.reserve_time')) !!}
      {!! Form::datetime('reserve_time', $value = null, $attributes = ['id' => 'reserve_time', 'class' => 'form-control', 'placeholder' => 'Enter your resevation bath time!!']) !!}
  </div>
  {!! Form::submit('予約する', $attributes =['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
@endsection
