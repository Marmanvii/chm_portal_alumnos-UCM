<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\TomarCurso;
use App\TomaBotaCurso;
class EstudiantesController extends Controller
{
    public function index()
    {
        $students = User::All();
        return view('Estudiantes.index', compact('students'));
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
       
    }

    public function destroy($id)
    {
        //
    }

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
        //dd($request->nombre);
        $user = User::find(Auth::User()->id);
        $cursos = Curso::All();

        
        //toma el nombre del curso y lo asocia a su codigo 
        foreach($cursos as $curso){
            if($request->nombre == $curso->nombre ){
                $laid= $curso->id;
            }
        }
                /*
                //validacion de que no pueda ingresar dos veces un curso
                $tomacursos = TomarCurso::All();
                foreach($tomacursos as $tomacurso){
                    if($tomacurso->user_id == $user->id){
                        if($tomacurso->curso_id == $curso->id){
                            //dd('curso repetido');
                            return redirect()->route('usuario.toma');           
                        }
                    }
                }
                $tomacursos = new TomarCurso();
                $tomacurso->user_id = $user->id;
                $tomacurso->curso_id = $curso->id;
                $tomacurso->save();
                return redirect()->route('usuario.toma');           
            }
        }*/
        $tomacursos=TomarCurso::All();
        foreach($tomacursos as $tomacurso){
            if($tomacurso->user_id == $user->id){
                if($tomacurso->curso_id == $laid){
                    //dd('curso repetido');
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
                    //dd('curso repetido');
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

}
