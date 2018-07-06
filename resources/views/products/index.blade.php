@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$pageTitle}}</h1>
            </div>
        </div>

        <div class="row">
            <form action="">
                <div class="col-md-3">
                    <select name="sort" class="form-control">
                        <option value="">Не выбрано</option>
                        <option value="desc" @if(request()->input('sort') === 'desc') selected @endif>По убыванию</option>
                        <option value="asc" @if(request()->input('sort') === 'asc') selected @endif>По возрастанию</option>
                    </select>
                </div>
                @if (request()->has('page'))
                    <input type="hidden" name="page" value="{{request()->input('page')}}">
                @endif
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Фильтровать</button>
                    <a href="?" class="btn btn-default">Очистить фильтры</a>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ид_продукта</th>
                        <th>наименование_продукта</th>
                        <th>наименование_поставщика</th>
                        <th>цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                {{$product->id}}
                            </td>
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                                {{$product->vendor->name}}
                            </td>
                            <td>
                                <input type="number"
                                       min="0"
                                       class="product-price"
                                       data-id="{{$product->id}}"
                                       data-url="{{route('product.update-price')}}"
                                       value="{{$product->price}}">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{$products->render()}}
            </div>
        </div>

    </div>


@endsection