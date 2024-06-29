<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('clientes.index')) {
            abort(403, 'Unauthorized action.');
        }
        $clientes = Cliente::paginate(11);
        return view('clientes.index', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('clientes.create')) {
            abort(403, 'Unauthorized action.');
        }
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documento' => ['required', 'unique:estudiantes'],
            'nombres' => ['required', 'max:255'],
            'apellidos' => ['required', 'max:255'],
            'fecha_nacimiento' => ['required', 'max:255'],
            'correo' => ['required', 'max:255', 'unique:estudiantes'],
            'telefono' => ['required', 'numeric'],
            'direccion' => ['required', 'max:255'],
        ]);
        //Registrar fecha de registro internamente
        $cliente = Cliente::create([
            'fecha_registro' => now(),
        ] + $request->all());

        // CREAR USUARIO PARA EL CLIENTE
        $user = new User();
        $user->first_name = $cliente->nombres;
        $user->last_name = $cliente->apellidos;
        $user->email = $cliente->correo;
        $user->mobile_number = $cliente->telefono;
        $user->password = Hash::make($cliente->documento);
        $user->role_id = 3;
        $user->status = 1;
        $user->save();
        return redirect()->route('clientes.index')
            ->with('success', 'cliente creado satisfactoriamente.');
    }

    public function show(Cliente $cliente)
    {
         return view('clientes.show', [
            'cliente' => $cliente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', [
            'cliente' => $cliente
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombres' => ['required', 'max:255'],
            'apellidos' => ['required', 'max:255'],
            'fecha_nacimiento' => ['required', 'max:255'],
            'documento' => ['required', 'max:255'],
            'direccion' => ['required', 'max:255'],
            'correo' => ['required', 'max:255'],
            'telefono' => ['required', 'max:255'],
            'fecha_registro' => ['required', 'max:255'],
        ]);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')
            ->with('success', 'Clientes actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if ($cliente->estado == 1) {
            return redirect()->route('clientes.index')
                ->with('error', 'No se puede eliminar un estudiante activo');
        }
        $cliente->delete();
        return redirect()->route('clientes.index')
            ->with('success', 'cliente eliminado satisfactoriamente');
    }
    public function actualizarEstado($cliente_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Cliente::whereId($cliente_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('clientes.index')->with('success', 'Estado del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
