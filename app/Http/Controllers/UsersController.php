<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        $title = "Danh sách người dùng";
        return view('clients.users.lists',compact('title'));
    }
}