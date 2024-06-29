@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles de la Venta</h2>

    <div>
        <strong>Cliente:</strong>
        {{ $sale->customer->first_name }} {{ $sale->customer->last_name }}
    </div>
    <div>
        <strong>Total Amount:</strong>
        {{ $sale->total_amount }}
    </div>

    <h3>Productos</h3>
    <ul>
        @foreach($sale->saleDetails as $detail)
            <li>
                {{ $detail->product->name }} - {{ $detail->quantity }} x {{ $detail->unit_price }} = {{ $detail->quantity * $detail->unit_price }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('sales.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
