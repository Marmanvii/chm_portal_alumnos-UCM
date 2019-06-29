<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\TomarCurso;
use App\TomaBotaCurso;
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

    // -----------------------FUNCIONES DE TOMA DE RAMOS---------------------

    public function tomaIndex()
    {
        $muestracursos = TomarCurso::All();
        return view('Director.Solicitud')->with('muestracursos',$muestracursos);
    }

    public function tomaEdit(Request $request,$id)
    {
        $muestracursos = TomarCurso::find($id);
        $muestracursos->estado = $request->estado;
        $muestracursos->save();
        return redirect()->route('director.toma');
    }

    public function botaIndex()
    {
        $muestracursos = TomaBotaCurso::All();
        return view('Director.Bota')->with('muestracursos',$muestracursos);
    }

    public function botaEdit(Request $request, $id)
    {
        $muestracursos = TomaBotaCurso::find($id);
        $muestracursos->estado = $request->estado;
        $muestracursos->save();
        return redirect()->route('director.bota');
    }

}
