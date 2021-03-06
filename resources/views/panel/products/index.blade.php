@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    List of products
                    <div class="pull-right">

                        <a href="{{ route('product.create') }}" type="button" class="btn btn-xs btn-primary">Create Product</a>
                        <a href="{{ route('product.random') }}" type="button" class="btn btn-xs btn-primary">Generate Random Product</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Stock Quantity</th>
                                <th width="100" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td align="center">{{$product->price}}</td>
                                    <td align="center">{{$product->stock_quantity}}</td>
                                    <td align="center">
                                        <a href="{{ route('product.edit', $product->id) }}" type="button" class="btn btn-xs btn-info" style="display: inline-block;">Edit</a>
                                        &nbsp;
                                        {!! Form::open(['route' => ['product.destroy', $product->id], 'method' => 'DELETE', 'style' => 'display: inline-block;', 'onsubmit' => 'if (!confirm("Do you really want to delete?")){return false;}']) !!}
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
