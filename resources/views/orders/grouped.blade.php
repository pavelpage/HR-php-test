@extends('layouts.app')

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$pageTitle}}</h1>
            </div>
        </div>

        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#overdue" aria-controls="overdue" role="tab" data-toggle="tab">просроченные</a>
                </li>
                <li role="presentation">
                    <a href="#current" data-url="{{route('order.current')}}" aria-controls="current" role="tab" data-toggle="tab">текущие</a>
                </li>
                <li role="presentation">
                    <a href="#new" data-url="{{route('order.new')}}" aria-controls="new" role="tab" data-toggle="tab">новые</a>
                </li>
                <li role="presentation">
                    <a href="#completed" data-url="{{route('order.completed')}}" aria-controls="completed" role="tab" data-toggle="tab">выполненные</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="overdue">
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
                            @foreach($overdueOrders as $order)
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
                <div role="tabpanel" class="tab-pane" id="current">
                    <div class="lds-dual-ring loading-indicator"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="new">
                    <div class="lds-dual-ring loading-indicator"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="completed">
                    <div class="lds-dual-ring loading-indicator"></div>
                </div>
            </div>

        </div>

    </div>


@endsection