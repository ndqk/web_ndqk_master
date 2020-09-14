<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

use App\Entity\{Product, CartItem, Cart};

class CartController extends Controller
{
    public function index(){
        if(Auth::guard('customer')->check()){
            return $this->userIndex();
        }
        $cartItems = session('cart');
        // return $cartItems;
        return view('site.cart.detail_session', compact('cartItems'));
    }

    private function userIndex(){
        $cart = Auth::guard('customer')->user()->cart()->first();
        $cartItems = $cart ? $cart->cartItems()->with(['product' => function($q){
                                                    $q->with(['images' => function($q){
                                                        $q->where('status', 0);
                                                    }]);
                                                }])->get() : null;
        
        return view('site.cart.detail', compact('cartItems'));
    }

    public function indexPost(){
        // session()->forget('cart');
        // return session('cart');
        if(Auth::guard('customer')->check()){
            return $this->userIndexPost();
        }
        $cart = session('cart') ?? null;
        return response()->json(view()->make('site.cart.cart', ['cart' => $cart])->render());
    }

    private function userIndexPost(){
        $customer = Auth::guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();
        $cartItems = $cart->cartItems()->get();
        $cartRes = [];
        foreach($cartItems as $cartItem){
            $product = $cartItem->product()->first();
            $cartRes[$cartItem->id] = $product;
            $cartRes[$cartItem->id]['image'] = $product->images()->where('status', 0)->first()->image;
            $cartRes[$cartItem->id]['quantity'] = $cartItem->quantity;
        }
        // return $cartRes;
        return response()->json(view()->make('site.cart.cart', ['cart' => $cartRes])->render());
    }

    public function store(Product $product){
        //return session('cart');
        if(Auth::guard('customer')->check())
            return $this->userStore($product);
        $cart = session()->get('cart');
        $image = $product->images()->where('status', 0)->first();

        if(!$cart){
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'quantity' => 1,
                    'image' => $image->image
                ]
            ];
            session()->put('cart', $cart);
            return 1;
        }
        
        if(isset($cart[$product->id])){
            $cart[$product->id]['quantity']++;
            session()->put('cart', $cart);

            return sizeof($cart);
        }

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'discount' => $product->discount,
            'quantity' => 1,
            'image' => $image->image
        ];
        
        session()->put('cart', $cart);

        return sizeof($cart);
    }

    private function userStore(Product $product){
        $customer = Auth::guard('customer')->user();
        $cart = Cart::where('customer_id', $customer->id)->first();

        if(!$cart){
            $cart = new Cart(['customer_id' => $customer->id, 'status' => 0]);
            $cart->save();
            $cartItem = new CartItem([
                'product_id' => $product->id,
                'cart_id' => $cart->id,
                'quantity' => 1,
                'status' => 0
            ]);
            $cartItem->save();
            return 1;
        }
        $cartItems = $cart->cartItems()->get();
        $cartItem = $cartItems->firstWhere('product_id', $product->id);
        if($cartItem){
            CartItem::findOrFail($cartItem->id)->update([
                'quantity' => $cartItem->quantity + 1
            ]);
            return $cartItems->count();
        }

        $cartItem = new CartItem([
            'product_id' => $product->id,
            'cart_id' => $cart->id,
            'quantity' => 1,
            'status' => 0
        ]);
        $cartItem->save();
        return $cartItems->count() + 1;
       
    }

    public function deletePost($id){
        if(Auth::guard('customer')->check()){
            return $this->userDeletePost($id);
        }
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            if(sizeof($cart) <= 1){
                session()->forget('cart');
                $cart = null;
            }
            else{
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
           
        }
        return response()->json(view()->make('site.cart.cart', ['cart' => $cart])->render());
    }

    private function userDeletePost($id){
        $customer_id = Auth::guard('customer')->user()->id;
        $cart = Cart::where('customer_id', $customer_id)->first();
        CartItem::findOrFail($id)->delete();
        $cartItems = $cart->cartItems()->get();
        if(!$cartItems->count()){
            $cart->delete();
            return response()->json(view()->make('site.cart.cart', ['cart' => null])->render());
        }
        $cartRes = [];
        foreach($cartItems as $cartItem){
            $product = $cartItem->product()->first();
            $cartRes[$cartItem->id] = $product;
            $cartRes[$cartItem->id]['image'] = $product->images()->where('status', 0)->first()->image;
        }
        // return $cartRes;
        return response()->json(view()->make('site.cart.cart', ['cart' => $cartRes])->render());
        
    }

    public function delete($id){
        if(Auth::guard('customer')->check()){
            return $this->userDelete($id);
        }
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            if(sizeof($cart) <= 1){
                session()->forget('cart');
                $cart = null;
            }
            else{
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
           
        }
        return redirect()->back()->with('status', 'Xóa thành công');

    }

    private function userDelete($id){
        $customer_id = Auth::guard('customer')->user()->id;
        $cart = Cart::where('customer_id', $customer_id)->first();
        CartItem::findOrFail($id)->delete();
        $cartItems = $cart->cartItems()->get();
        if(!$cartItems->count()){
            $cart->delete();
        }
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
