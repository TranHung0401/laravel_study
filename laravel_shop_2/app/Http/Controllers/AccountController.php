<?php

namespace App\Http\Controllers;

use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\User\UserServiceInterface;
use App\Services\Order\OrderServiceInterface;

class AccountController extends Controller
{
    protected $userServiceInterface;

    public function __construct(UserServiceInterface $userServiceInterface,
                                OrderServiceInterface $orderServiceInterface)
    {
        $this->userServiceInterface = $userServiceInterface;
        $this->orderServiceInterface = $orderServiceInterface;
    }

    public function login()
    {

        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client
        ];

        $remember = $request->remember;

        if(Auth::attempt($credentials,$remember)){
            
            // return redirect('');
            return redirect()->intended(''); // chuyen ve trang truoc do
        }else {
            return back()->with('nofitication','Email or password is wrong.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function register()
    {

        return view('front.account.register');
    }

    public function postRegister(Request $request)
    {
        if($request->password != $request->confirm_password)
        {
            return back()->with('nofitication','ERROR: password do not match');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client
        ];

        $user = $this->userServiceInterface->create($data);

        if($user){
            return redirect('account/login')->with('nofitication','Register success login now');
        }

    }

    public function myOrderIndex() {

        $orders = $this->orderServiceInterface->getOderByUserId(Auth::id());

        return view('front.account.my-order.index', compact('orders'));
    }

    public function myOrderShow($id) {
        $order = $this->orderServiceInterface->find($id);

        return view('front.account.my-order.show', compact('order'));
    }
}
