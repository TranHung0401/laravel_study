@extends('layouts.backend')
@section('content')
    <a href="{{route('admin.users.create')}}" class="btn btn-primary mb-3">Create new</a>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatable" class="table table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Group</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Group</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
        <tbody>
            


        </tbody>
    </table>
@endsection

@section('script')
<script>
    let table = new DataTable('#datatable', {
        ajax: "{{route('admin.users.data')}}",
        processing: true,
        serverSide: true,
        "aoColumns": [
            { "data": "name" },
            { "data": "email" },
            { "data": "group_id" },
            { "data": "created_at" },
            { "data": "edit" },
            { "data" : "delete" }
        ]
    });
</script>

@endsection