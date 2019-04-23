<div>
    <h2>予約一覧</h2>

    <a href="{{ route('www.reservations.create') }}">新規予約追加</a>

    <ul>
        @foreach($reservations as $reservation)
            <li>
                <a href="{{ route('www.reservations.show', [$reservation->id]) }}">
                    <p>予約者氏名: {{ $reservation->user->name }}</p>
                    <p>予約開始時刻: {{ $reservation->reserve_time }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</div>