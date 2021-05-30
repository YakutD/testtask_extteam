@extends('layouts.app')

@section('content')
<div class="container">
    @include('guestbook.form')
    <hr>
    @include('guestbook.list')
</div>
@endsection
