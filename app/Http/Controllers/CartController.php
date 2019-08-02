<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use Cart;

class CartController extends Controller
{
    public function store(StoreCartRequest $request)
    {
    	$cart = Cart::add([
            'id' => $request->product_id,
            'name' => $request->name,
            'weight' => 0,
            'qty' => $request->quantity,
            'price' => (int)$request->price,
            'options' => [
                'image_url' => $request->image_url
            ]
        ]);

        $cart = $cart->toArray();
        $cart['price'] = number_format($cart['price']);
        $cart['subtotal'] = number_format(Cart::subtotal(0,'.',''));
        $cart['count'] = Cart::content()->count();

        return $cart;
    }

    public function destroy($id)
    {
        Cart::remove($id);
        $subtotal = number_format(\Cart::subtotal(0,'.',''));

        return response()->json(['status' => __('carts.deleted'), 'subtotal' => $subtotal]);
    }

    public function checkout()
    {
        return view('orders.checkout');
    }

    public function update(Request $request)
    {
        $cart = Cart::update($request->rowId, ['qty' => $request->qty]);
        $cart_total = number_format($cart->price * $cart->qty);
        $subtotal = number_format(\Cart::subtotal(0,'.',''));

        return response()->json(['status' => 'carts.updated', 'cart_total' => $cart_total, 'subtotal' => $subtotal]);
    }
}
