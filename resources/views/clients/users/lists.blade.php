@extends('layouts.client')

@section('title')
{{$title}}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <h1>{{$title}}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th width="10%">Thời gian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
            </tr>
        </tbody>
    </table>
@endsection
