@extends('front.layout.master')

@section('title',"Result")

@section('content')

    {{-- Breadcrumb Section Begin --}}
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index"><i class="fa fa-home"></i> Home</a>
                        <a href="shop">Shop</a>
                        <span>Result</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Breadcrumb Section End --}}

    
    {{-- Shopping Cart Section Begin --}}
    <div class="checkout-section spad">
        <div class="container">
            <form action="" method="post" class="checkout-form">
                @csrf
                <div class="row">
                    <h2>{{$nofitication}}</h2>
                </div>
                <a href="./" class="btn btn-primary mt-5">Continue shopping</a>
            </form>
        </div>
    </div>
    {{-- Shopping Cart Section End --}}

@endsection