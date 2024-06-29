@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Editar Cliente
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="first_name">Nombre</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $customer->first_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellido</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $customer->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile_number">Teléfono</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="{{ $customer->mobile_number }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
