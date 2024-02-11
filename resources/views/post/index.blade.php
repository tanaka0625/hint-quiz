@extends('layouts.app')

@section('content')
    <div>
        <post-component :choices="{{Js::from($choices)}}" :questions="{{Js::from($questions)}}" :category="{{Js::from($category)}}"></post-component>
    </div>
@endsection