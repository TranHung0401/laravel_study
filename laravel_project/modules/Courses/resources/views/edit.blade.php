@extends('layouts.backend')
@section('content')
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <form action="" method='post'>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control {{$errors->has('name')?'is-invalid':''}}" placeholder="Name..." value="{{old('name') ?? $user->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="mail" name="email" class="form-control {{$errors->has('email')?'is-invalid':''}}" placeholder="Email..." value="{{old('email') ?? $user->email}}"> 
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Group</label>
                    <select name="group_id" id="" class="form-select {{$errors->has('group_id')?'is-invalid':''}}">
                        <option value="0">Choose group</option>
                        <option value="1">Admintrator</option>
                    </select>
                    @error('group_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Passwrod</label>
                    <input type="password" name="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" placeholder="Passwrod...">
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-danger">Cancel</a>
            </div>

        </div>
        @csrf
        @method('PUT')
    </form>
@endsection