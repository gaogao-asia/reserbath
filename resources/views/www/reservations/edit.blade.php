<div>
    {!! Form::model($reservation, ['url' => route('www.reservations.update', $reservation), 'method' => 'put']) !!}

    <div>
        {!! Form::label('user_id', 'ユーザーID') !!}
        {!! Form::number('user_id', $value = null) !!}
    </div>
    <div>
        {!! Form::label('reserve_time', __('models.reservation.reserve_time')) !!}
        {!! Form::datetime('reserve_time', $value = null, $attributes = ['id' => 'reserve_time']) !!}
    </div>
    {!! Form::submit('予約内容を変更する') !!}
    {!! Form::close() !!}
</div>