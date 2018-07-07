<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::with(['partner', 'items', 'products'])->paginate(50);

        return view('orders.index', [
            'pageTitle' => 'Список заказов',
            'orders' => $orders,
        ]);
    }

    public function groupedList()
    {
        $overdueOrders = Order::with(['partner', 'items', 'products'])
                                    ->overdue()
                                    ->orderBy('delivery_dt', 'desc')
                                    ->limit(50)
                                    ->get();

        return view('orders.grouped', [
            'pageTitle' => 'Список заказов',
            'overdueOrders' => $overdueOrders
        ]);
    }

    public function currentOrders()
    {
        $currentOrders = Order::with(['partner', 'items', 'products'])
            ->current()
            ->orderBy('delivery_dt', 'ASC')
            ->get();

        return view('orders.list', [
            'orders' => $currentOrders
        ]);
    }

    public function newOrders()
    {
        $newOrders = Order::with(['partner', 'items', 'products'])
            ->new()
            ->orderBy('delivery_dt', 'ASC')
            ->limit(50)
            ->get();

        return view('orders.list', [
            'orders' => $newOrders
        ]);
    }

    public function completedOrders()
    {
        $completedOrders = Order::with(['partner', 'items', 'products'])
            ->completed()
            ->orderBy('delivery_dt', 'DESC')
            ->limit(50)
            ->get();

        return view('orders.list', [
            'orders' => $completedOrders
        ]);
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
        //
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
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //

        return view('orders.edit', [
            'pageTitle' => 'Редактировать заказ',
            'order' => $order,
            'actionSave' => route('order.update', $order->id),
            '_method' => "PATCH",
            'partners' => Partner::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $dataSave = $this->validate($request, [
            'order.client_email' => 'required|email',
            'order.partner_id' => 'required|exists:partners,id',
            'order.status' => 'required|in:0,10,20'
        ]);


        $order->update($dataSave['order']);

        return redirect(route('order.edit', $order->id))->with([
            'server_message' => 'Запись обновлена'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
