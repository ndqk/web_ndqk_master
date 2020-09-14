<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Entity\{Cart, CartItem, Order, OrderItem};

class OrderController extends Controller
{
    public function orderRequest(Request $request){
        $customer_id = Auth::guard('customer')->user()->id;
        $cart = Cart::where('customer_id', $customer_id)->first();
        $cartItems = $cart->cartItems()->with('product')->get();
        // $newOrder = new Order([
        //     'customer_id' => $customer_id,
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'address' => $request-
        // ]);
        $newOder = [
            'customer_id' => $customer_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'shipping' => 0,
            'subtotal' => 0,
            'status' => 0
        ];
        return $newOder;
       
    }
}
