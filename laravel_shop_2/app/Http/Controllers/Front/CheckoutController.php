<?php

namespace App\Http\Controllers\Front;

// use App\Utilities\VNPay;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;

class CheckoutController extends Controller
{
    private $orderServiceInterface;
    private $orderDetailServiceInterface;
    public function __construct(OrderServiceInterface $orderServiceInterface,
                                OrderDetailServiceInterface $orderDetailServiceInterface)
    {
        $this->orderServiceInterface = $orderServiceInterface;
        $this->orderDetailServiceInterface = $orderDetailServiceInterface;
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view('front.checkout.index',compact('carts','total','subtotal'));
    }

    public function addOrder(Request $request)
    {
        // Them don hang

        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;

        $order = $this->orderServiceInterface->create($data);
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        // Them chi tiet don hang
        $carts = Cart::content();
        foreach($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->price*$cart->qty,
            ];

            $this->orderDetailServiceInterface->create($data);
        }

        if($order->payment_type == 'pay_later') {
            // Gui email
            $this->sendMail($order,$total,$subtotal);

            // Xoa gio hang
            Cart::destroy();

            // Tra ve ket qua thong bao
            return redirect('checkout/result')->with('nofitication','Success,You will pay on delivery.Please check your email');
        
        }
        
        if($order->payment_type == 'online_pay') {
            // Lay url thanh toan VNPay
            // $data_url = VNPay::vnpay_create_payment([
            //     'vnp_TxnRef' => $order->id, // Id don hang
            //     'vnp_OrderInfo' => 'Description order',
            //     'vnp_Amount' => Cart::total(0,'','')*23070, //tong gia don hang, nhan voi ty gia chuyen sang tien Viet
            // ]);

            // return redirect()->to($data_url);

            // Gui email
            $this->sendMail($order,$total,$subtotal);

            return redirect('checkout/result')->with('nofitication','Success,You will pay on delivery.Please check your email');
        }
        
    }

    public function vnPayCheck(Request $request)
    {
        // Lay data tu url do VNPay gui ve qua $vnp_Returnurl
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Ma phan hoi ket qua thanh toan, 00 la thanh cong
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //order id
        $vnp_Amount = $request->get('vnp_Amount'); //So tien thanh toan

        // Kiem tra data, xem ket qua VNPay tra ve hop le khong
        if($vnp_ResponseCode != null){
            // Neu thanh cong
            if($vnp_ResponseCode == 00){
                Cart::destroy();
                // Thong bao ket qua
                return redirect('checkout.result')
                ->with('nofitication','Success! Has paid online. Please check your email.');
            }else {
                // Xoa don hang da them vao database
                $this->orderServiceInterface->delete($vnp_TxnRef);
                // Thon bao loi
                return redirect('checkout.result')
                ->with('nofitication','Error! Payment fail or canceled.');

            }
        }

    }

    public function result()
    {
        $nofitication = session('nofitication');
        return view('front.checkout.result',compact('nofitication'));
    }

    private function sendMail($order,$total,$subtotal)
    {
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order','total','subtotal'), 
        function ($message) use ($email_to) {
            $message->from('hung@hungtran.com', 'Hung Tran');
            $message->to($email_to, $email_to);
            $message->subject('Order Nofitication');
        });

    }
}
