<?php

namespace App\Http\Controllers\Admin;

use App\Utilities\Common;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductServiceInterface;

class ProductImageController extends Controller
{
    protected  $productService;

    public function __construct(ProductServiceInterface $productService) 
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $product = $this->productService->find($product_id);
        $productImages = $product->productImages;

        return view('admin.product.image.index', compact('product','productImages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image')) {
            $data['path'] = Common::uploadFile($request->file('image'), 'front/img/products');
            unset($data['image']);
            ProductImage::create($data);
        }

        return redirect('admin/product/'.$data['product_id'].'/image');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id,$id)
    {
        $filename = ProductImage::find($id)->path;
        if($filename != ''){
            unlink('front/img/products/'.$filename);
        }

        ProductImage::find($id)->delete();

        return redirect('admin/product/'.$product_id.'/image');
    }
}
