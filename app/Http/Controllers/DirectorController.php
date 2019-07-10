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

    public function solicitudGrafico()
    {
        $solicitudes=[
            'pendientes' => TomarCurso::where('estado','pendiente')->count(),
            'aceptados' => TomarCurso::where('estado','aceptado')->count(),
            'rechazados' => TomarCurso::where('estado','rechazado')->count()
        ];
        return view('Director.principal2',$solicitudes);
    }
 //funciones nuevas
    public function ramoIndex()
    {
        $muestracursos = Curso::all();
        return view('Director.curso')->with('muestracursos',$muestracursos);
    }
    public function ramoDestroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->route('director.cursos');
    }
    public function modal(Request $request){
        
        //funcion para que no se agreguen dos cursos iguales
        $cursosExistentes = Curso::All();

        foreach($cursosExistentes as $cursosExistente){
            
            if($cursosExistente->nombre == $request->nombre){
                // no se puede agregar el curso
                
                return redirect()->route('director.cursos');
            }
            if($cursosExistente->codigo == $request->codigo){
                // no se puede agregar el curso
                return redirect()->route('director.cursos'); 
            }


        }
        $curso = new Curso();
        $curso->codigo = $request->codigo;
        $curso->nombre = $request->nombre;
        $curso->creditos = $request->creditos;
        $curso->semestre = $request->semestre;
        $curso->save();
        return redirect()->route('director.cursos');
    } 

    //función para editar la creación del curso
    public function ramoEditar(Request $request, $id ){
        $curso = Curso::find($id);
        $cursosExistentes = Curso::All();
        foreach($cursosExistentes as $cursosExistente){
            if($cursosExistente->nombre == $request->nombre){
                return redirect()->route('director.cursos');
            }
    
            if($cursosExistente->codigo == $request->codigo){
                return redirect()->route('director.cursos');
            }
        }

        $curso->codigo = $request->codigo;
        $curso->nombre = $request->nombre;
        $curso->creditos = $request->creditos;
        $curso->semestre = $request->semestre;
        $curso->save();
        return redirect()->route('director.cursos');
    }

    //-------------------------FIN FUNCIONES TOMA DE RAMOS---------------------
}
