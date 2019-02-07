<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $statuses = [
        0 => 'Нывый',
        10 => 'Подтвержден',
        20 => 'Завершен'
    ];

    public function index(){
        $orders = Order::all();

        $amounts = [];

        foreach($orders as $order){
            $order_price = 0;
            foreach ($order->products as $product){
                $order_price += $product->price * $product->pivot->quantity;
            }
            $amounts[$order->id] = $order_price;
        }

        $statuses = $this->statuses;
        return view('orders.index', compact('orders', 'amounts', 'statuses'));
    }

    public function edit($id){
        $order = Order::find($id);
        $partners = Partner::where('id', '!=', $order->partner->id)->get();
        $statuses = $this->statuses;
        $order_price = 0;

        foreach ($order->products as $product){
            $order_price += $product->price * $product->pivot->quantity;
        }

        return view('orders.edit', compact('order', 'partners', 'statuses', 'order_price'));
    }

    public function update(Request $request){
        $val = $this->validate($request, [
           'order_id' => 'required|integer',
           'email' => 'required',
           'partner' => 'required',
           'status' => 'required'
        ]);

        if(! $val){
            return redirect()->back()->with([
                'alert' => 'Проблема с заполнением формы. Попробуйте заново.',
                'alertClass' => 'warning'
            ]);
        }

        file_put_contents('info.txt', print_r($request->all(), true));

        $order = Order::find($request->input('order_id'));

        $order->client_email = $request->input('email');
        $order->partner_id = $request->input('partner');
        $order->status = $request->input('status');

        if(! $order->save()){
            return redirect()->back()->with([
                'alert' => 'Не удалось сохранить изменения.',
                'alertClass' => 'danger'
            ]);
        }

        return redirect()->back()->with([
            'alert' => 'Изменения успешно сохранены!',
            'alertClass' => 'success'
        ]);
    }


}
