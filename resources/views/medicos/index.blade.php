@extends('layouts.app')

@section('title', 'Listado de Medicos')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listado de Medicos</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('medicos.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus"></i> NUEVO MEDICO
                    </a>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-sm table-striped table-bordered bg-white shadow fs-12" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Completo</th>
                                <th>Especialidad</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        @if (count($medicos))
                            @foreach ($medicos as $key => $medico)
                                <tr>
                                    <td class="p-2 align-middle">{{ $medico->id }}</td>
                                    <td class="p-2 align-middle">{{ $medico->nombre_completo }}</td>
                                    <td class="p-2 align-middle">{{ $medico->especialidad }}</td>
                                    <td class="p-2 align-middle">{{ $medico->telefono }}</td>
                                    <td class="p-2 align-middle">{{ $medico->correo }}</td>
                                    <td class="p-2 align-middle text-center"> {!! $medico->estado == 1
                                        ? '<span class="badge badge-success shadow">ACTIVO</span>'
                                        : '<span class="badge badge-danger shadow">INACTIVO</span>' !!} </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            @endsection
