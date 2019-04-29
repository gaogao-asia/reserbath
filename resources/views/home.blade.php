@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('www.reservations.create') }}" class="btn btn-primary btn-lg active" role="button"
       aria-pressed="true">風呂を予約する</a>
@endsection
