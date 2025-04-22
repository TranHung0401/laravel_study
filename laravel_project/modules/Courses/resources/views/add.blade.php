@extends('layouts.backend')
@section('content')
    <form action="" method='post'>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control title {{$errors->has('name')?'is-invalid':''}}" placeholder="Name..." value="{{old('name')}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control slug {{$errors->has('slug')?'is-invalid':''}}" placeholder="Slug..." value="{{old('slug')}}"> 
                    @error('slug')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Choose teacher</label>
                    <select name="teacher_id" id="" class="form-select {{$errors->has('teacher_id')?'is-invalid':''}}">
                        <option value="0">Choose teacher</option>
                        <option value="1">HungTran</option>
                    </select>
                    @error('teacher_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Code</label>
                    <input type="text" name="code" class="form-control {{$errors->has('code')?'is-invalid':''}}" placeholder="Code...">
                    @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" name="price" class="form-control {{$errors->has('price')?'is-invalid':''}}" placeholder="Price...">
                    @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Sale price</label>
                    <input type="number" name="sale_price" class="form-control {{$errors->has('sale_price')?'is-invalid':''}}" placeholder="Sale price...">
                    @error('sale_price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Attached document</label>
                    <select name="is_document" id="" class="form-select {{$errors->has('is_document')?'is-invalid':''}}">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    @error('is_document')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-select {{$errors->has('status')?'is-invalid':''}}">
                        <option value="0">Not released yet</option>
                        <option value="1">Has debuted</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Supports</label>
                    <textarea name="supports" class="form-control {{$errors->has('supports')?'is-invalid':''}}" placeholder="Supports..."></textarea>
                    @error('supports')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Content</label>
                    <textarea name="detail" class="form-control {{$errors->has('detail')?'is-invalid':''}}" placeholder="detail..."></textarea>
                    @error('detail')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row align-items-end mb-4">
                <div class="col-7">
                    <label for="">Thumbnail</label>
                    <input type="text" name="thumbnail" class="form-control {{$errors->has('thumbnail')?'is-invalid':''}}" placeholder="Sale price...">
                    @error('thumbnail')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-2 d-grid">
                    <button type="button" class="btn btn-primary ">Choose image</button>
                </div>
                <div class="col-3 ">
                    <img src="https://hoanghamobile.com/tin-tuc/wp-content/uploads/2023/07/anh-dep-thien-nhien-thump.jpg" alt="">
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{route('admin.users.index')}}" class="btn btn-danger">Cancel</a>
            </div>

        </div>
        @csrf
    </form>
@endsection

@section('stylesheet')
<style>
    img {
        max-width: 100%;
        height: auto;
    }
</style>

@endsection