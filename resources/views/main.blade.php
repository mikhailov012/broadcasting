@extends('layouts.app')

@section('content')

    <div id="parent-main" data-userdata="{{json_encode($data)}}">
        <div id="main"></div>
    </div>

@endsection
