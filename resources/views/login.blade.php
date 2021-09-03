@extends('layout')

@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <p>LogIn Form</p>
        <input type="text" name="email" placeholder="email"> <br>
        <input type="password" name="password" placeholder="password"> <br>
        <button type="submit">LogIn!</button>
    </form>
@endsection
