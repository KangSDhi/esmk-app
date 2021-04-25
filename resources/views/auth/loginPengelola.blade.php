@extends('auth.shared.layout')

@section('title', $title)

@section('content')
    <form action="{{ route('post.loginPengelola') }}" method="post">
        @csrf
        <input type="email" name="email" id="email">
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
@endsection
