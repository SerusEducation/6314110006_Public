<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index() {
        return view('frontend.history');
    }

    public function uploadSlip (Request $request){
        $slip = $request->file('slip');
        $order_id = $request->order_id;
        $order = Order::find($order_id);
        if($slip) {
            $path = public_path('\\images\\slip\\');
            $fileName = date('YmdHis') . '.' . $slip->extension();
            $slip->move($path,$fileName);
            $order->slip = $fileName;
            $order->save();
            return back()->with('success', 'successfully');

        }else {
            return back()->with('fail', 'fail');
        }
    }
}
