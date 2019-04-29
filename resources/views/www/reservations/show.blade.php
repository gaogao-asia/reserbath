@extends('www.layouts.base')

@section('content')
    <div>
        <h3>{{ $reservation->user->name }}さんの予約</h3>
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
        </tbody>
    </table>
    <p class="text-left">
        <a href="{{ route('www.reservations.index') }}" class="pull-right btn btn-secondary btn-sm active">予約一覧に戻る</a>
    </p>
@endsection
