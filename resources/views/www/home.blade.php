@extends('www.layouts.base')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <main-content></main-content>
@endsection
