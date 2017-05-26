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
                    List of orders
                    <a href="{{ route('order.random') }}" type="button" class="btn btn-xs btn-primary pull-right">Generate Random Order</a>
                </div>

                <div class="panel-body">
                    <table width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th align="left">Total price</th>
                                <th align="left">Date</th>
                                <th width="40" align="center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td align="left">$ {{$order->total_price}}</td>
                                    <td align="left">{{$order->updated_at}}</td>
                                    <td align="center">
                                        {!! Form::open(['route' => ['order.destroy', $order->id], 'method' => 'DELETE', 'onsubmit' => 'if (!confirm("Do you really want to delete?")){return false;}' ]) !!}
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
