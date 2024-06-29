@extends('layouts.app')

@section('title', 'Listado de Medicos')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR MEDICO</h6>
            </div>
            <form method="POST" action="{{ route('medicos.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mt-3">
                            <strong>NOMBRE COMPLETO:</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nombre_completo') is-invalid @enderror"
                                id="nombre_completo" placeholder="Nombre completo" name="nombre_completo"
                                value="{{ old('nombre_completo') }}">
                            @error('nombre_completo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3 mt-3">
                            <strong>ESPECIALIDAD:</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('especialidad') is-invalid @enderror"
                                id="especialidad" placeholder="Especialidad" name="especialidad"
                                value="{{ old('especialidad') }}">
                            @error('especialidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3 mt-3">
                            <strong>MATRICULA:</strong></label>
                            <input type="text"
                                class="form-control form-control-sm @error('matricula') is-invalid @enderror"
                                placeholder="Matricula" name="matricula" value="{{ old('matricula') }}">
                            @error('matricula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>TELEFONO:</strong></label>
                            <input type="number"
                                class="form-control form-control-sm @error('telefono') is-invalid @enderror"
                                placeholder="telefono" name="telefono" value="{{ old('telefono') }}">
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5 mb-3 mt-3">
                            <strong>DIRECCION:</strong></label>
                            <input type="text"
                                class="form-control form-control-sm @error('direccion') is-invalid @enderror"
                                placeholder="direccion" name="direccion" value="{{ old('direccion') }}">
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4 mb-3 mt-3">
                            <strong>CORREO:</strong></label>
                            <input type="email" class="form-control form-control-sm @error('correo') is-invalid @enderror"
                                placeholder="correo" name="correo" value="{{ old('correo') }}">
                            @error('correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                            class="fas fa-save"></i> GUARDAR</button>
                    <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('medicos.index') }}"><i
                            class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
                </div>
            </form>
        </div>
    </div>
@endsection
