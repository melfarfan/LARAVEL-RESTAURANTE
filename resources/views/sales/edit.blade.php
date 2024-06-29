<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Sale</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('sales.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>User:</strong>
                    <select name="user_id" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $sale->user_id ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total Amount:</strong>
                    <input type="text" name="total_amount" class="form-control" placeholder="Total Amount" value="{{ $sale->total_amount }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection -->



<!-- resources/views/sales/edit.blade.php -->
@extends('layouts.app')

@section('content')
<form action="{{ route('sales.update', $sale->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Selección del Cliente -->
    <div>
        <label for="customer_id">Cliente:</label>
        <select name="customer_id" id="customer_id">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Detalles de los Productos -->
    <div id="product-details">
        @foreach($sale->saleDetails as $detail)
            <div class="product-detail">
                <label for="product_id">Producto:</label>
                <select name="product_id[]">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $detail->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                <label for="quantity">Cantidad:</label>
                <input type="number" name="quantity[]" value="{{ $detail->quantity }}" min="1">
                <label for="unit_price">Precio Unitario:</label>
                <input type="number" name="unit_price[]" value="{{ $detail->unit_price }}" step="0.01" min="0">
                <button type="button" onclick="removeProductDetail(this)">Eliminar</button>
            </div>
        @endforeach
    </div>
    <button type="button" onclick="addProductDetail()">Agregar Producto</button>

    <!-- Botón de Enviar -->
    <button type="submit">Actualizar Venta</button>
</form>

<script>
    function addProductDetail() {
        const productDetail = document.querySelector('.product-detail').cloneNode(true);
        document.getElementById('product-details').appendChild(productDetail);
    }

    function removeProductDetail(button) {
        button.parentElement.remove();
    }
</script>
@endsection
