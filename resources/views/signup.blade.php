@extends('layout')

@section('content')
    <form action="{{route('signup')}}" method="post">
        @csrf
        <p>SignUp Form</p>
        <input type="text" name="name" placeholder="name"> <br>
        <input type="text" name="email" placeholder="email"> <br>
        <input type="password" name="password" placeholder="password"> <br>
{{--        <input type="password" name="password_confirm" placeholder="password again"> <br>--}}
        <button type="submit">SignUp!</button>
    </form>
@endsection
