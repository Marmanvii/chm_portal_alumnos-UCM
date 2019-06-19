<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Practicasprofesionale;


class EmpresaController extends Controller
{
    public function index()
    {
        return view('Empresa.index');
    }

    public function CreacionPracticasProfesionales(Request $request)
    {
        $errores = 0;
        return view('Empresa.CreacionPracticasProfesionales', compact('errores', 'request'));
    }


     public function VerificacionPracticaProfesional(Request $request)
    {
        $errores[0] = "";
        $errores[1] = "";
        $errores[2] = "";
        $errores[3] = "";
        $errores[4] = "";
        $errores[5] = "";
        $actividad = 0;
        if($request->Actividad1 != null)
            $actividad ++;
        if($request->Actividad2 != null)
            $actividad ++;
        if($request->Actividad3 != null)
            $actividad ++;
        if($request->Actividad4 != null)
            $actividad ++;
        if($actividad == 0)
            $errores[0] = "Debe haber al menos una actividad";

        $campos = 0;

        if($request->DesdeH == null){
            $errores[1] = "Debe ingresar Hora";  //error de no dato DesdeH ingresado
            $campos ++;
        }
        if($request->HastaH == null){
            $errores[2] = "Debe ingresar Hora";  //error de no dato HastaH ingresado
            $campos ++;
        }
        if($request->Enfoque == null){
            $errores[3] = "Debe ingresar Enfoque";  //error de no dato Enfoque ingresado
            $campos ++;
        }
        if($request->PuestoOfrecido == null){
            $errores[4] = "Debe ingresar Puesto Ofrecido";  //error de no dato Puesto Ofrecido ingresado
            $campos ++;
        }
        
        if($actividad == 0 || $campos != 0){
            return view('Empresa.CreacionPracticasProfesionales', compact('errores', 'request'));
        }else{
            if($request->DesdeD == $request->HastaD){
                $errores[5] = "No se puede trabajar semana corrida";    //error mismos dias elegidos
                return view('Empresa.CreacionPracticasProfesionales', compact('errores', 'request'));
            }else{
                $desdeD = $request->DesdeD;
                $hastaD = $request->HastaD;

                if($desdeD < $hastaD){
                    $Dias = 0;
                    for($i = 0; $desdeD < $hastaD; $i++){
                        $desdeD = ($desdeD + 1)%7;
                        $Dias ++;
                    }
                }else{
                    $Dias = 1;
                    for($i = 0; $desdeD > $hastaD; $i++){
                        $desdeD = ($desdeD + 1)%7;
                        $Dias ++;
                    }
                }
                if($request->DesdeH == $request->HastaH){
                    $errores[2] = "No se puede seleccionar la misma hora";    //No hay diferencia de horas, se entra y sale a la misma hora
                    return view('Empresa.CreacionPracticasProfesionales', compact('errores', 'request'));
                }
                else{
                    $errores[2] = "";
                    $tipo = $request->DesdeH[6] . $request->DesdeH[7];  //Tipo de hora AM o PM

                    $Hora1 = ($request->DesdeH[0] * 10) + $request->DesdeH[1];
                    if ($tipo == "PM")
                        $Hora1 = ($request->DesdeH[0] * 10) + $request->DesdeH[1] + 12;
    
                    $Min1 = ($request->DesdeH[3] * 10) + $request->DesdeH[4];
                    
                    $tipo = $request->HastaH[6] . $request->HastaH[7];
                    $Hora2 = ($request->HastaH[0] * 10) + $request->HastaH[1];
                    if ($tipo == "PM")
                        $Hora2 = ($request->HastaH[0] * 10) + $request->HastaH[1] + 12;
                    $Min2 = ($request->HastaH[3] * 10) + $request->HastaH[4];
                    $HorasT = $Hora2 - $Hora1;
                    $MinT = $Min2 - $Min1;
                    
                    if($HorasT < 0){
                        $HorasT = $HorasT + 24;
                    }
                    if($MinT < 0){
                        $HorasT --;
                        $MinT = $MinT + 60;
                    }
                    return view('Empresa.Boletin', compact('Dias', 'HorasT', 'MinT','actividad', 'request'));
                }
            }
        }
        return view('Empresa.CreacionPracticasProfesionales', compact('errores'));
    }

    public function InsercionPracticaProfesional(Request $request)
    {
        if(isset($_POST['update_data'])){
            $now = new \DateTime();
            DB::table('practicasprofesionales')
            ->where('id', $request->id)
            ->update([
                'DiasDesde' => $request->DesdeD, 
                'DiasHasta' => $request->HastaD, 
                'HorasDesde' => $request->DesdeH, 
                'HorasHasta' => $request->HastaH, 
                'Actividad1' => $request->Actividad1, 
                'Actividad2' => $request->Actividad2, 
                'Actividad3' => $request->Actividad3, 
                'Actividad4' => $request->Actividad4, 
                'PuestoOfrecido' => $request->PuestoOfrecido,
                'Enfoque' => $request->Enfoque,
                'updated_at' =>$now
            ]);
            $update = 1;
            return redirect('/empresa/practicas/mostrar')->with('update',$update);
        }
        else{
            if($request->Actividad1 == "")
            $request->Actividad1 = " ";
        
            if($request->Actividad2 == "")
                $request->Actividad2 = " ";
                
            if($request->Actividad3 == "")
                $request->Actividad3 = " ";
                
            if($request->Actividad4 == "")
                $request->Actividad4 = " ";
            
            $now = new \DateTime();
            DB::table('practicasprofesionales')->insert([
                ['EmpresaId' => Auth::user()->id, 
                'DiasDesde' => $request->DesdeD, 
                'DiasHasta' => $request->HastaD, 
                'HorasDesde' => $request->DesdeH, 
                'HorasHasta' => $request->HastaH, 
                'Actividad1' => $request->Actividad1, 
                'Actividad2' => $request->Actividad2, 
                'Actividad3' => $request->Actividad3, 
                'Actividad4' => $request->Actividad4, 
                'PuestoOfrecido' => $request->PuestoOfrecido,
                'Enfoque' => $request->Enfoque,
                'updated_at' =>$now],
            ]);
            $request->DesdeD = "";
            $request->HastaD = "";
            $request->DesdeH = "";
            $request->HastaH = "";
            $request->Actividad1 = "";
            $request->Actividad2 = "";
            $request->Actividad3 = "";
            $request->Actividad4 = "";
            $request->PuestoOfrecido = "";
            $request->Enfoque = "";
            $errores = 1;
            return redirect('/empresa/practicas/mostrar')->with('errores',$errores);
        }
    }

    public function MostrarPracticas()
    {
        $Practicas = DB::table('practicasprofesionales')->where('EmpresaId', Auth::user()->id)->get();
        
        return view('Empresa.MostrarPracticas', compact('Practicas'));
    }

    public function EliminarPracticas(Request $request)
    {
        if (isset($_POST['delete_button'])) {

            $PracticaBorrar = DB::table('practicasprofesionales')->where('id', $request->id)->delete();

            return redirect('/empresa/practicas/mostrar')->with('Eliminado', 'Hola');

        }else if(isset($_POST['update_button'])){

            
            $auxiliar = DB::table('practicasprofesionales')->where('id', $request->id)->first();
            $request->DesdeH = $auxiliar->HorasDesde;
            $request->HastaH = $auxiliar->HorasHasta;
            $request->Actividad1 = $auxiliar->Actividad1;
            $request->Actividad2 = $auxiliar->Actividad2;
            $request->Actividad3 = $auxiliar->Actividad3;
            $request->Actividad4 = $auxiliar->Actividad4;
            $request->PuestoOfrecido = $auxiliar->PuestoOfrecido;
            $request->Enfoque = $auxiliar->Enfoque;
            $errores = 1;
            
            return view('Empresa.EditarPracticasProfesionales', compact('errores','request'));

        }else if(isset($_POST['view_button'])){
            $datos = Practicasprofesionale::where('id', $request->id)->first();
            
            return view('Empresa.ViewPracticas', compact('datos'));
        }
    }

    public function VerificarPracticas(Request $request)
    {
        $errores[0] = "";
        $errores[1] = "";
        $errores[2] = "";
        $errores[3] = "";
        $errores[4] = "";
        $errores[5] = "";
        $actividad = 0;
        if($request->Actividad1 != null)
            $actividad ++;
        if($request->Actividad2 != null)
            $actividad ++;
        if($request->Actividad3 != null)
            $actividad ++;
        if($request->Actividad4 != null)
            $actividad ++;
        if($actividad == 0)
            $errores[0] = "Debe haber al menos una actividad";

        $campos = 0;

        if($request->DesdeH == null){
            $errores[1] = "Debe ingresar Hora";  //error de no dato DesdeH ingresado
            $campos ++;
        }
        if($request->HastaH == null){
            $errores[2] = "Debe ingresar Hora";  //error de no dato HastaH ingresado
            $campos ++;
        }
        if($request->Enfoque == null){
            $errores[3] = "Debe ingresar Enfoque";  //error de no dato Enfoque ingresado
            $campos ++;
        }
        if($request->PuestoOfrecido == null){
            $errores[4] = "Debe ingresar Puesto Ofrecido";  //error de no dato Puesto Ofrecido ingresado
            $campos ++;
        }
        
        if($actividad == 0 || $campos != 0){
            return view('Empresa.EditarPracticasProfesionales', compact('errores', 'request'));
        }else{
            if($request->DesdeD == $request->HastaD){
                $errores[5] = "No se puede trabajar semana corrida";    //error mismos dias elegidos
                return view('Empresa.EditarPracticasProfesionales', compact('errores', 'request'));
            }else{
                $desdeD = $request->DesdeD;
                $hastaD = $request->HastaD;

                if($desdeD < $hastaD){
                    $Dias = 0;
                    for($i = 0; $desdeD < $hastaD; $i++){
                        $desdeD = ($desdeD + 1)%7;
                        $Dias ++;
                    }
                }else{
                    $Dias = 1;
                    for($i = 0; $desdeD > $hastaD; $i++){
                        $desdeD = ($desdeD + 1)%7;
                        $Dias ++;
                    }
                }
                if($request->DesdeH == $request->HastaH){
                    $errores[2] = "No se puede seleccionar la misma hora";    //No hay diferencia de horas, se entra y sale a la misma hora
                    return view('Empresa.EditarPracticasProfesionales', compact('errores', 'request'));
                }
                else{
                    $errores[2] = "";
                    $tipo = $request->DesdeH[6] . $request->DesdeH[7];  //Tipo de hora AM o PM
                    
                    $Hora1 = ($request->DesdeH[0] * 10) + $request->DesdeH[1];
                    if ($tipo == "PM")
                        $Hora1 = ($request->DesdeH[0] * 10) + $request->DesdeH[1] + 12;
    
                    $Min1 = ($request->DesdeH[3] * 10) + $request->DesdeH[4];
                    
                    $tipo = $request->HastaH[6] . $request->HastaH[7];
                    $Hora2 = ($request->HastaH[0] * 10) + $request->HastaH[1];
                    if ($tipo == "PM")
                        $Hora2 = ($request->HastaH[0] * 10) + $request->HastaH[1] + 12;
                    $Min2 = ($request->HastaH[3] * 10) + $request->HastaH[4];
                    $HorasT = $Hora2 - $Hora1;
                    $MinT = $Min2 - $Min1;
                    
                    if($HorasT < 0){
                        $HorasT = $HorasT + 24;
                    }
                    if($MinT < 0){
                        $HorasT --;
                        $MinT = $MinT + 60;
                    }
                    return view('Empresa.BoletinEditar', compact('Dias', 'HorasT', 'MinT','actividad', 'request'));
                }
            }
        }
        return view('Empresa.EditarPracticasProfesionales', compact('errores'));
    }

    public function destroy($id)
    {
        //
    }
}
