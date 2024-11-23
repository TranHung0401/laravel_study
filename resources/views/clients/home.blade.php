@extends('layouts.client')

@section('title')
{{$title}}
@endsection

@section('sidebar')
    {{-- @parent --}}
    <p>Home sidebar</p>
@endsection

@section('content')
    <h1>Trang chủ</h1>
@endsection


@section('css')
    <style type="text/css">

        header {
            background: red;
        }    
    </style>

@endsection

@section('js')
<script type='text/javascript'>
    </script>
    
@endsection