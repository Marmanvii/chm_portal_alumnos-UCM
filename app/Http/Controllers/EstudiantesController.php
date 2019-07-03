<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\TomarCurso;
use App\TomaBotaCurso;



use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Practicasprofesionale;
use App\PostulacionesPractica;


class EstudiantesController extends Controller
{
    public function index(request $request)
    {


        //dd($request->all()); // muestra el contenido del request

        $students = User::All();
        return view('Estudiantes.index', compact('students'));
    }

    public function solicitud_practica(Request $request)
    {
        $datos = new PostulacionesPractica;
        $datos->practicaid = $request->idpractica;
        $datos->alumnoid = $request->idalumno;
        $datos->fecha = '01-01-01';
        $datos->estado = 'Pendiente';

        $datos->save();
        return redirect(route('CatPag'));
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
       
    }

    public function destroy($id)
    {
        //
    }




    // ----------------------------FUNCIONES DE TOMA DE RAMOS-------------------------------
    public function tomacurso()
    {
        $cursos = Curso::All();
        $user = User::find(Auth::User()->id);
        return view('Estudiantes.Solicitud')->with('user',$user)->with('cursos',$cursos);
    }

    public function crea_toma_curso()
    {
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();
        return view('Estudiantes.create')->with('user',$user)->with('cursos',$cursos);
    }

//FUNCION QUE GUARDA EL CURSO SELECCIONADO
    public function modal(Request $request){
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();

        
        //toma el nombre del curso y lo asocia a su codigo 
        foreach($cursos as $curso){
            if($request->nombre == $curso->nombre ){
                $laid= $curso->id;
            }
        }
        $tomacursos=TomarCurso::All();
        foreach($tomacursos as $tomacurso){
            if($tomacurso->user_id == $user->id){
                if($tomacurso->curso_id == $laid){
                    return redirect()->route('usuario.toma');           
                }
            }
        }
        $tomacurso = new TomarCurso();
        $tomacurso->user_id = $user->id;
        $tomacurso->curso_id = $laid;
        $tomacurso->motivo = $request->motivo;
        $tomacurso->save();
        return redirect()->route('usuario.toma');
    }   

    public function eliminarToma($id)
    {
        $tomacurso = TomarCurso::find($id);
        $tomacurso->delete();
        return redirect()->route('usuario.toma');
    }

    public function botacurso()
    {
        $cursos = Curso::All();
        $user = User::find(Auth::User()->id);
        return view('Estudiantes.Bota')->with('user',$user)->with('cursos',$cursos);
    }

    public function eliminarBota($id)
    {
        $tomacurso = TomaBotaCurso::find($id);
        $tomacurso->delete();
        return redirect()->route('usuario.bota');
    }

    public function modal2(Request $request){
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();
        
        //toma el nombre del curso y lo asocia a su codigo 
        foreach($cursos as $curso){
            if($request->nombre == $curso->nombre){
                $laid= $curso->id;
            }
        }

        $tomacursos=TomaBotaCurso::All();
        foreach($tomacursos as $tomacurso){
            if($tomacurso->user_id == $user->id){
                if($tomacurso->curso_id == $laid){
                    return redirect()->route('usuario.bota');           
                }
            }
        }
        $tomacurso = new TomaBotaCurso();
        $tomacurso->user_id = $user->id;
        $tomacurso->curso_id = $laid;
        $tomacurso->save();
        return redirect()->route('usuario.bota');
    } 

    // ---------------FIN FUNCIONES TOMA DE RAMOS-----------------

    public function catalogopracticas()
    {
        $estudiante=Auth::user();
        $practica_en_curso=PostulacionesPractica::where('alumnoid','=',$estudiante->id)->pluck('practicaid');
        $Coleccion= Practicasprofesionale:: where('Estado', '=', 'Aprobado')->
                                            whereNotIn('id',$practica_en_curso)->
                                            orderBy('updated_at', 'desc')->
                                            paginate(5);
        return view('Estudiantes.CatalogoPractica',compact('Coleccion'));
    }

    public function practicasdetalle(Request $request)
    {
        $Practicas= Practicasprofesionale:: where('Estado', '=', 'Aprobado')
                                    ->where('id',$request->id)
                                    ->get();

        return view ('Estudiantes.PracticasDetalle', compact('Practicas'));
    }



}
