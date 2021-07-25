<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList()
    {
        return view('order/list', [
            'orders' => Order::query()->paginate(30),
            'title' => 'Order List'
        ]);
    }

    public function edit($id)
    {
        $order = Order::query()->findOrFail($id);

        return view('order/edit', [
            'title' => 'Edit Order #' . $id,
            'order' => $order,
            'partners' => Partner::all(),
            'products' => $order->getProducts()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'client_email' => 'required|email',
            'partner_id' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        Order::query()->find($id)->update($validatedData);

        return redirect('/order/edit/' . $id)->with('success', 'Corona Case Data is successfully updated');
    }
}
