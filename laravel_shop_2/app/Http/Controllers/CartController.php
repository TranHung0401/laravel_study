<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Product\ProductServiceInterface;

class CartController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService) 
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart',compact('carts','total','subtotal'));
    }

    public function add(Request $request) {

        if($request->ajax())
        {
            $product = $this->productService->findProduct($request->productId);

            $response['cart'] = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->discount ?? $product->price,
                'weight' => 0,
                'options' => [
                    'images' => $product->productImages
                ]
            ]);

            $response['count'] = Cart::count();
            $response['total'] = Cart::total();

            return $response;
        }

        return back();

    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            Cart::remove($request->rowId);
            $response['cart'] = Cart::content();
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subtotal'] = Cart::subtotal();
            return $response;
        }

        return back();

    }

    public function destroy()
    {
        Cart::destroy();

    }

    public function update(Request $request)
    {
        $response['cart'] = Cart::update($request->rowId, $request->qty);
        $response['count'] = Cart::count();
        $response['total'] = Cart::total();
        $response['subtotal'] = Cart::subtotal();
        return $response;
    }
}
