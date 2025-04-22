@extends('layouts.backend')
@section('content')
    <a href="{{route('admin.categories.create')}}" class="btn btn-primary mb-3">Create new</a>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatable" class="table table-border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Link</th>
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
    $(document).ready(function() {
        $('#datatable').DataTable({
            autoWidth: false,
            ajax: "{{route('admin.categories.data')}}",
            processing: true,
            serverSide: true,
            pageLength: 2,
            columns: [
                {
                    data: 'name',
                },
                {
                    data: 'link',
                },
                {
                    data: 'created_at',
                },
                {
                    data: 'edit',
                },
                {
                    data: 'delete',
                },
            ]
        })
    })
    
</script>

@endsection