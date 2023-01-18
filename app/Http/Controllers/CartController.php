<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Auth::user()->carts;
        return view('frontend.cart', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->get('product_id');
        $cart = Cart::firstOrNew([
            'user_id' => $user_id,
            'product_id' =>$product_id,
        ]);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return back()->withSuccess('Add product to cart successfully.');
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
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->withSuccess('Delete product in cart successfully.');
    }
    public function increment(Cart $cart) {
        $cart->quantity += 1;
        $cart->save();
        return back()->withSuccess('Increment product successfully.');
    }
    public function decrement(Cart $cart) {
        if ($cart->quantity > 0) {
            $cart->quantity -= 1;
            $cart->save();
            return back()->withSuccess('Decrement product successfully.');
        }
        return back()->withFail('Decrement product from 0 failed.');
    }
}
