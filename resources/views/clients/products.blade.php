@extends('layouts.client')

@section('title')
{{$title}}
@endsection

@section('sidebar')
    {{-- @parent --}}
    <p>Home sidebar</p>
@endsection

@section('content')
    <h1>Sản phẩm</h1>
@endsection


@section('css')
    <style type="text/css">

        header {
            background: yellow;
        }    
    </style>

@endsection

@section('js')
<script type='text/javascript'>
    </script>
    
@endsection