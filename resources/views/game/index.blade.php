@extends('layouts.app')

@section('content')
    <game-component :hints="{{Js::from($hints)}}" :status="{{Js::from($status)}}" :category="{{Js::from($category)}}" 
    :choices="{{Js::from($choices)}}" :correct_choice="{{Js::from($correct_choice)}}"></game-component>
@endsection