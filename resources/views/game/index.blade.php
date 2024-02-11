@extends('layouts.app')

@section('content')
    <game-component :hints="{{Js::from($hints)}}" :status="{{Js::from($status)}}" :category="{{Js::from($category)}}"></game-component>
@endsection