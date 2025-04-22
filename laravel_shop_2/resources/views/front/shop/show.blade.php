@extends('front.layout.master')

@section('title','Product')

@section('content')
    {{-- Breadcrumb Section Begin --}}
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="index"><i class="fa fa-home"></i> Home</a>
                        <a href="shop">Shop</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Breadcrumb Section End --}}

    {{-- Product Shop Section Begin --}}
    <div class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 products-sidebar-filter">
                    @include('front.shop.components.products-sidebar-filter')
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="front/img/products/{{$product->productImages[0]->path}}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach($product->productImages as $productImage)
                                    <div class="pt active" data-imgbigurl="front/img/products/{{$productImage->path}}">
                                        <img src="front/img/products/{{$productImage->path}}" alt="">
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$product->tag}}</span>
                                    <h3>{{$product->name}}</h3>
                                    <a href="" class="heart-icon"><i class="icon_heart_alt"></i></a>
                                </div>
                                <div class="pd-rating">
                                    @for($i=1;$i<=5;$i++)
                                        @if($i<= $avgRating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    
                                    @endfor
                                    <span>({{count($product->productComments)}})</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{$product->content}}</p>
                                    @if($product->discount != null)
                                        <h4>${{$product->discount}} <span>{{$product->price}}</span></h4>
                                    @else
                                        <h4>${{$product->price}}</h4>
                                    @endif
                                </div>
                                <div class="pd-color">
                                    <h6>Color</h6>
                                    <div class="pd-color-choose">
                                        @foreach(array_unique(array_column($product->productDetails->toArray(), 'color')) as $color)
                                        <div class="cc-item">
                                            <input type="radio" id="cc-{{$color}}">
                                            <label for="cc-{{$color}}" class="cc-{{$color}}"></label>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <div class="pd-size-choose">
                                    @foreach(array_unique(array_column($product->productDetails->toArray(), 'size')) as $size)
                                    <div class="sc-item">
                                        <input type="radio" id="{{$size}}-size">
                                        <label for="{{$size}}-size">{{$size}}</label>
                                    </div>
                                    @endforeach
                                    
                                </div>
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                    <a href="cart/add/{{$product->id}}" class="primary-btn pd-cart">Add To Cart</a>
                                </div>
                                <div class="pd-tags">
                                    <li><span>CATEGORIES</span>: {{$product->productCategory->name}}</li>
                                    <li><span>TAGS</span>: {{$product->tag}}</li>
                                </div>
                                <div class="pd-share">
                                    <div class="p-code">Sku : {{$product->sku}}</div>
                                    <div class="pd-social">
                                        <a href=""><i class="ti-facebook"></i></a>
                                        <a href=""><i class="ti-twitter-alt"></i></a>
                                        <a href=""><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a></li>
                                <li><a href="#tab-2" data-toggle="tab">SPECIFICATIONS</a></li>
                                <li><a href="#tab-3" data-toggle="tab">Customer Review (02)</a></li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        {!! $product->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        @for($i=1;$i<=5;$i++)
                                                            @if($i <= $avgRating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{count($product->productComments)}})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">
                                                        ${{$product->price}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add To Cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">{{$product->qty}} in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">{{$product->weight}}kg</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-size">
                                                        @foreach(array_unique(array_column($product->productDetails->toArray(), 'size')) as $size)
                                                        {{$size}},
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Color</td>
                                                <td>
                                                    @foreach(array_unique(array_column($product->productDetails->toArray(), 'color')) as $color)
                                                    <span class="cs-color cs-{{$color}}"></span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">{{$product->sku}}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{count($product->productComments)}} Comments</h4>
                                        <div class="comment-option">
                                            @foreach($product->productComments as $comment)
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    <img src="front/img/user/{{$comment->user->avatar ?? 'default_user.jpg'}}" alt="">
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        @for($i=1;$i<=5;$i++)
                                                            @if($i<=$comment->rating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <h5>{{$comment->name}} <span>{{date('d M Y',strtotime($comment->created_at))}}</span></h5>
                                                    <div class="at-reply">{{$comment->messages}}</div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>
                                            <form action="" method="post" class="comment-form">
                                                <div class="row">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="user_id" value="{{Illuminate\Support\Facades\Auth::user()->id ?? null}}">
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Name" name="name">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" placeholder="Email" name="email">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea name="messages" id="" cols="30" rows="10" placeholder="Messages"></textarea>

                                                        <div class="personal-rating">
                                                            <h6>Your Rating</h6>
                                                            <div class="rate">
                                                                <input type="radio" id="star5" name="rating" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" name="rating" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" name="rating" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" name="rating" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" name="rating" value="1" />
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="site-btn">Send message</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Product Shop Section End --}}

    {{-- Related Products Section Begin --}}
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $product)
                <div class="col-lg-3 col-sm-6">
                    @include('front.components.product-item')
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Related Products Section End --}}
    
@endsection