@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Listado de Clientes
                        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-right">Crear Cliente</a>
                    </div>
                    <div class="card-body">
                        @if ($customers->isEmpty())
                            <p>No hay clientes registrados.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->mobile_number }}</td>
                                            <td>
                                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
