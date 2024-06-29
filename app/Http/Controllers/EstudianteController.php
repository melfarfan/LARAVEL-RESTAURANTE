<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{

    public function index()
    {
        if (Auth::user()->can('estudiantes.index')) {
            abort(403, 'Unauthorized action.');
        }
        $estudiantes = Estudiante::paginate(11);
        return view('estudiantes.index', [
            'estudiantes' => $estudiantes,
        ]);
    }

    public function create()
    {
        if (Auth::user()->can('estudiantes.create')) {
            abort(403, 'Unauthorized action.');
        }
        return view('estudiantes.create');
    }

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
        $estudiante = Estudiante::create([
            'fecha_registro' => now(),
        ] + $request->all());

        // CREAR USUARIO PARA EL ESTUDIANTE
        $user = new User();
        $user->first_name = $estudiante->nombres;
        $user->last_name = $estudiante->apellidos;
        $user->email = $estudiante->correo;
        $user->mobile_number = $estudiante->telefono;
        $user->password = Hash::make($estudiante->documento);
        $user->role_id = 3;
        $user->status = 1;
        $user->save();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante creado satisfactoriamente.');
    }

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', [
            'estudiante' => $estudiante
        ]);
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', [
            'estudiante' => $estudiante
        ]);
    }

    public function update(Request $request, Estudiante $estudiante)
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
        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado satisfactoriamente');
    }

    public function destroy(Estudiante $estudiante)
    {
        if ($estudiante->estado == 1) {
            return redirect()->route('estudiantes.index')
                ->with('error', 'No se puede eliminar un estudiante activo');
        }
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado satisfactoriamente');
    }
    public function actualizarEstado($estudiante_id, $estado)
    {
        try {
            DB::beginTransaction();
            // Update Status
            Estudiante::whereId($estudiante_id)->update(['estado' => $estado]);
            DB::commit();
            return redirect()->route('estudiantes.index')->with('success', 'Estado del estudiante actualizado correctamente!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
