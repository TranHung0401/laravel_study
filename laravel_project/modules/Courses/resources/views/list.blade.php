@extends('layouts.backend')
@section('content')
    <a href="{{route('admin.courses.create')}}" class="btn btn-primary mb-3">Create new</a>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatable" class="table table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
        <tbody>
        </tbody>
    </table>
    @include('parts.backend.delete')
@endsection

@section('script')
<script>
    let table = new DataTable('#datatable', {
        ajax: "{{route('admin.courses.data')}}",
        processing: true,
        serverSide: true,
        "aoColumns": [
            { "data": "name" },
            { "data": "price" },
            { "data": "status" },
            { "data": "created_at" },
            { "data": "edit" },
            { "data" : "delete" }
        ]
    });
</script>

@endsection