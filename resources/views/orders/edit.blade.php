@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$pageTitle}}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('order.index')}}">Список заказов</a>
                    </li>
                    <li class="active">{{$pageTitle}}</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @include('form_blocks.errors')
                @include('form_blocks.session_info')
            </div>
        </div>


        <div class="row">
            <form action="{{$actionSave}}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                {!! csrf_field() !!}

                @if(!empty($_method))
                    <input type="hidden" name="_method" value="{{$_method}}">
                @endif

                <fieldset>

                    <div class="form-group">
                        <label for="email-input" class="col-md-3 control-label">Email</label>
                        <div class="col-md-4">
                            <input id="email-input" type="text" class="form-control" name="order[client_email]" value="{{ $order->client_email or '' }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="partner-input" class="col-md-3 control-label">Партнер</label>
                        <div class="col-md-4">
                            <select name="order[partner_id]" id="partner-input" class="form-control">
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}" @if($partner->id == $order->partner_id) selected @endif>{{$partner->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                </fieldset>

                <fieldset>
                    <h3>Продукты</h3>
                    <div class="form-group">
                        <ul class="list-group col-md-4 col-md-offset-3">
                            @foreach($order->items as $item)
                                <li class="list-group-item">
                                    <span class="badge">{{$item->quantity}}</span>
                                    {{$item->product->name}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="status-input" class="col-md-3 control-label">Статус заказа</label>
                        <div class="col-md-4">
                            <select name="order[status]" id="status-input" class="form-control">
                                <option value="0" @if($order->status === 0) selected @endif>Новый</option>
                                <option value="10" @if($order->status === 10) selected @endif>Подтвержден</option>
                                <option value="20" @if($order->status === 20) selected @endif>Завершен</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Общая сумма заказа</label>
                        <div class="col-md-4">
                            <b>{{$order->fullPrice()}}</b>
                        </div>
                    </div>
                </fieldset>


                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

@endsection