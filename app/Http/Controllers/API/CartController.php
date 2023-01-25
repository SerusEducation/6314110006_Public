<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function increment(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            if ($product_id && $user_id) {
                $cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
                $cart->update([
                    'quantity' => $cart->quantity + 1,
                ]);
                return response()->json([
                    'status' => 'success',
                    'quantity' => $cart->quantity
                ]);
            }
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function decrement(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->product_id;
            $user_id = $request->user_id;
            if ($product_id && $user_id) {
                $cart = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
                $cart->update([
                    'quantity' => $cart->quantity - 1,
                ]);
                return response()->json([
                    'status' => 'success',
                    'quantity' => $cart->quantity
                ]);
            }
        }
        return response()->json([
            'status' => 'fail'
        ]);
    }
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            Cart::where('product_id', $request->product_id)->where('user_id', $request->user_id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delete product in cart successfully.'
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Delete product in cart failed.'
        ]);
    }
}
