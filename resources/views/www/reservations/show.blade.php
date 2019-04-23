<div>
    <h2>予約詳細</h2>
    <a href="{{ route('www.reservations.edit', $reservation->id) }}">
        <p>予約者氏名: {{ $reservation->user->name }}</p>
        <p>予約開始時刻: {{ $reservation->reserve_time }}</p>
    </a>
    <a href="{{ route('www.reservations.index') }}">予約一覧に戻る</a>
</div>