@extends('layouts.app')

@section('title', 'Nuevo Estudiante')

@section('content')

    <div class="container-fluid">
        {{-- alertas --}}
        @include('common.alert')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="font-weight-bold text-primary"><i class="fas fa-user-plus"></i> REGISTRAR ESTUDIANTE</h6>
            </div>
            <form method="POST" action="{{ route('estudiantes.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Nombres:</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nombres') is-invalid @enderror" id="nombres"
                                placeholder="Nombres" name="nombres" value="{{ old('nombres') }}"
                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('nombres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Apellidos</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('apellidos') is-invalid @enderror" id="apellidos"
                                placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}"
                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))">
                            @error('apellidos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Fecha Nacimiento:</strong><span style="color:red;">*</span>
                            <input type="date"
                                class="form-control form-control-sm @error('fecha_nacimiento') is-invalid @enderror"
                                id="fecha_nacimiento" placeholder="Fecha Nacimiento:" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento') }}">
                            @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Documento:</strong> <span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('documento') is-invalid @enderror" id="documento"
                                placeholder="Documento" name="documento" value="{{ old('documento') }}"
                                onkeypress="return event.charCode>=48 && event.charCode<=57">
                            @error('documento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Direci&oacute;n</strong><span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('direccion') is-invalid @enderror" id="direccion"
                                placeholder="Direci&oacute;n" name="direccion" value="{{ old('direccion') }}" required>
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Correo:</strong><span style="color:red;">*</span></label>
                            <input type="correo" class="form-control form-control-sm @error('correo') is-invalid @enderror"
                                id="correo" placeholder="Correo" name="correo" value="{{ old('correo') }}" required>
                            @error('correo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Celular:</strong><span style="color:red;">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm @error('telefono') is-invalid @enderror" id="telefono"
                                placeholder="Nro Celular" name="telefono" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Nombre Referencia:</strong></label>
                            <input type="text"
                                class="form-control form-control-sm @error('nombre_referencia') is-invalid @enderror"
                                id="nombre_referencia" placeholder="Nombre Referencia" name="nombre_referencia"
                                value="{{ old('nombre_referencia') }}">
                            @error('nombre_referencia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3 mb-3 mt-3">
                            <strong>Tel&eacute;fono Referencia</strong></label>
                            <input type="text"
                                class="form-control form-control-sm @error('telefono_referencia') is-invalid @enderror"
                                id="telefono_referencia" placeholder="Tel&eacute;fono Referencia" name="telefono_referencia"
                                value="{{ old('telefono_referencia') }}">
                            @error('telefono_referencia')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-success btn-user float-right mb-3"><i
                            class="fas fa-save"></i> GUARDAR</button>
                    <a class="btn btn-outline-primary float-right mr-3 mb-3" href="{{ route('estudiantes.index') }}"><i
                            class="fas fa-arrow-left fa-sm text-primary-100"></i> CANCELAR</a>
                </div>
            </form>
        </div>

    </div>


@endsection
