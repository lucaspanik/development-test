@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of products
                    <a href="{{ route('product.random') }}" type="button" class="btn btn-xs btn-primary pull-right">Generate Random Product</a>
                </div>

                <div class="panel-body">
                    <table width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th align="center">Price</th>
                                <th align="center">Stock Quantity</th>
                                <th width="40" align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td align="center">{{$product->price}}</td>
                                    <td align="center">{{$product->stock_quantity}}</td>
                                    <td align="center">

                                        {!! Form::open(['route' => ['product.destroy', $product->id], 'method' => 'DELETE' ]) !!}
                                            {!! Form::submit("x", ['class' => 'btn btn-xs btn-danger',  'alt' => 'Remove', 'title' => 'Remove']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
