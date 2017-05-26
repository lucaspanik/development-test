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

            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $title }}
                </div>

                <div class="panel-body">
                    @if (isset($product))
                        <form action="{{ route('product.update', $product->id) }}" method="post" accept-charset="utf-8">
                        {!! method_field('PUT') !!}
                    @else
                        <form action="{{ route('product.store') }}" method="post" accept-charset="utf-8">
                    @endif

                        {!! csrf_field() !!}
                        <label>
                            Name:<br>
                            <input type="text" name="name" value="{{ $product->name or old('name') }}" placeholder="______">
                        </label>
                        <br>
                        <label>
                            Price:<br>
                            <input type="text" name="price" value="{{ $product->price or old('price') }}" min="1" step="any" />
                        </label>
                        <br>
                        <label>
                            Stock Quantity:<br>
                            <input type="number" name="stock_quantity" value="{{ $product->stock_quantity or old('stock_quantity') }}" min="0" placeholder="">
                        </label>
                        <br>

                        <a href="{{ route('product.index') }}" type="button" class="btn btn-default">Cancel</a>
                        &nbsp;
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
