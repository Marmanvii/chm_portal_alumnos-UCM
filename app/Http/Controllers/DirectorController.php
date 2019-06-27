<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\TomarCurso;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = User::All();
        return view('Director.index', compact('directors'));
    }

     public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

/*FUNCIONES DEL DIRECTOR EN LA TOMA DE RAMOS
    public function muestracurso()
    {   
        $muestracursos = TomarCurso::All();
        return view('toma.indexD')->with('muestracursos',$muestracursos);
    }
*/
    public function editaToma($id)
    {
        $tomarcurso = TomarCurso::find($id);
        $tomarcurso->estado = $request->estado;
        $tomarcurso->save();
        return redirect()->route('director.toma');
    }
}
