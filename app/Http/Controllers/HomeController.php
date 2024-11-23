<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{   
    public $data = [];
    public function index() {
        $this->data['title'] = "Đào tạo lập trình web";

        $users = DB::select("select * from user where email=:email",['email' => 'hai@gmail.com']);

        dd($users);

        return view('clients.home',$this->data);
    }

    public function product() {
        $this->data['title'] = "Sản phẩm";
        return view('clients.products',$this->data);
    }

    public function downloadImage(Request $request) {
        dd($request->image);
    }
}