<div>
    {!! Form::open(['url' => route('www.reservations.store'), 'method' => 'post']) !!}

    <div>
        {!! Form::label('reserve_time', __('models.reservation.reserve_time')) !!}
        {!! Form::datetime('reserve_time', $value = null, $attributes = ['id' => 'reserve_time']) !!}
    </div>
    {!! Form::submit('予約する') !!}
    {!! Form::close() !!}
</div>