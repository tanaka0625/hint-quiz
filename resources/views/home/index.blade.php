@extends('layouts.app')

@section('content')
    <div>
        <home-component :categories="{{Js::from($categories)}}"></home-component>
    </div>
@endsection