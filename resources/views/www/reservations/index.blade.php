@extends('www.layouts.base')

@section('content')
    <div>
        <h3>予約一覧</h3>
        <p class="text-right">
            <a href="{{ route('www.reservations.create') }}" class="pull-right btn btn-primary btn-sm active">新規予約追加</a>
        </p>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">予約者氏名</th>
            <th scope="col">予約開始時刻</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations as $reservation)
            <tr>
                <th scope="row">
                    <a href="{{ route('www.reservations.show', [$reservation->id]) }}">
                        {{ $reservation->id}}
                    </a>
                </th>
                <td>
                    {{ $reservation->user->name }}
                </td>
                <td>{{ $reservation->reserve_time }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
