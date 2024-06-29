@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Detalles del Cliente
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $customer->first_name }} {{ $customer->last_name }}</p>
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $customer->mobile_number }}</p>
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
                        </form>
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Volver al Listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
