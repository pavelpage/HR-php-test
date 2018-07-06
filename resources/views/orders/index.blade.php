@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{$pageTitle}}
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ид_заказа</th>
                            <th>название_партнера</th>
                            <th>стоимость_заказа</th>
                            <th>наименование_состав_заказа</th>
                            <th>статус_заказа</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <a href="{{route('order.edit', $order->id)}}">
                                    {{$order->id}}
                                </a>
                            </td>
                            <td>
                                {{$order->partner->name}}
                            </td>
                            <td>
                                {{$order->fullPrice()}}
                            </td>
                            <td>
                                {{$order->productsString()}}
                            </td>
                            <td>
                                {{$order->statusString()}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{$orders->render()}}
            </div>
        </div>

    </div>

@endsection