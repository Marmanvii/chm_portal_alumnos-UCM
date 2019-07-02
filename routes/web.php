<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Auth Middleware#
Auth::routes();

#Home & Index#
Route::get('/', function () {return view('home');});
Route::get('/home', 'HomeController@index')->name('home');

#Cambiar foto#
Route::patch('/home/perfil/cambio_foto', 'HomeController@cambiar_foto');

#Estudiantes#
Route::get('/estudiante', 'EstudiantesController@index')->name('estudiante');
Route::post('/estudiante/solicitud_practicas', 'EstudiantesController@solicitud_practica')->name('solicitudpractica');
Route::get('/estudiante/practicasofertadas', 'EstudiantesController@catalogopracticas')->name('CatPag');
Route::get('/estudiante/practicasofertadas/detalle', 'EstudiantesController@practicasdetalle')->name('DetallePractica');


#Profesores#
Route::get('/profesor', 'ProfesoresController@index')->name('profesor');
Route::get('/profesores_reserva', function () {
        return view('Profesores.reserva');
});
Route::post('/agregar_reserva_profesores', 'ProfesoresController@agregar_reserva');
Route::get('/profesores_listado_reservas', 'ProfesoresController@listado_reservas')->name('Prof_listado_reservas');

#Coordinador de practicas#
Route::get('/profesor/coordinador', 'CoordinadorController@AprobarPracticas')->name('MostrarPracticas');
Route::post('/profesor/coordinador', 'CoordinadorController@CambiarEstado')->name('CambiarEstado');


#Director#
Route::get('/director', 'DirectorController@index')->name('director');

#Secretaria#
Route::get('/secretaria', 'SecretariaController@index')->name('secretaria');
Route::get('/secretaria_reserva', function () {
        return view('Secretaria.reserva');
});
Route::get('/secretaria_agregar_sala', function () {
        return view('Secretaria.agregar_sala');
});
Route::get('secretaria_listado_reservas/{id}/destroy',[
    'uses' => 'SecretariaController@destroy',
    'as'   => 'secretaria_listado_reservas.destroy']
);

Route::get('secretaria_listado_reserva/{id}/destroy',[
    'uses' => 'SecretariaController@destroy_confirmar_reserva',
    'as'   => 'secretaria_listado_reserva.destroy']
);

Route::get('secretaria_listado_reservas/{id}/edit',[
    'uses' => 'SecretariaController@edit',
    'as'   => 'secretaria_listado_reservas.edit']
);

Route::get('secretaria_listado_reserva/{id}/edit',[
    'uses' => 'SecretariaController@edit_reserva',
    'as'   => 'secretaria_listado_reserva.edit']
);

Route::post('secretaria_listado_reservas/{id}/update',[
    'uses' => 'SecretariaController@update',
    'as'   => 'secretaria_listado_reservas.update']
);

Route::get('secretaria_listado_salas/{id}/destroy',[
    'uses' => 'SecretariaController@destroysala',
    'as'   => 'secretaria_listado_salas.destroy']
);
Route::get('lista_reserva/{id}',['as' => 'lista_reserva.show', 'uses' => 'SecretariaController@show']);
Route::get('/secretaria_listado_reservas', 'SecretariaController@listado_reservas')->name('listado_reservas');
Route::get('/secretaria_listado_salas', 'SecretariaController@listado_salas')->name('listado_salas');

Route::get('/secretaria_confirmar_listado_reservas', 'SecretariaController@confirmar_listado_reservas')->name('confirmar_listado_reservas');

Route::post('/agregar_sala', 'SecretariaController@agregar_sala');
Route::post('/agregar_reserva_secretaria', 'SecretariaController@agregar_reserva');

#Empresa#
Route::get('/empresa', 'EmpresaController@index')->name('empresa');




#--------------------------------RUTAS DE TOMA DE RAMOS---------------------------------------#

// -----------ESTUDIANTES--------------
Route::get('/decisionToma',function(){
	return view('Estudiantes.principal');
})->name('toma.decisionToma');


// RUTAS PARA SOLICITAR RAMOS DE PARTE DEL ESTUDIANTE
Route::get('/tomacurso','EstudiantesController@tomacurso')->name('usuario.toma');
Route::get('/tomacurso/crea','EstudiantesController@crea_toma_curso')->name('crea.toma');
Route::post('/tomado2','EstudiantesController@modal')->name('usuario.guarda2');

Route::get('tomacurso{id}/destroy',[
	'uses'=>'EstudiantesController@eliminarToma',
	'as'=>'tomacurso.destroy'
]);


// RUTAS PARA BOTAR UN RAMO
Route::get('/botacurso','EstudiantesController@botacurso')->name('usuario.bota');
Route::post('/botado','EstudiantesController@modal2')->name('usuario.guarda3');

Route::get('botacurso{id}/destroy',[
	'uses'=>'EstudiantesController@eliminarBota',
	'as'=>'botacurso.destroy'
]);


//----------- DIRECTOR------------------------------
Route::get('/decisionTomaD',function(){
	return view('Director.principal2');
})->name('toma.decisionToma2');
//---solicitudes de tomar ramos-------
Route::get('/directorToma','DirectorController@tomaIndex')->name('director.toma');
Route::put('/directorEdita/{id}','DirectorController@tomaEdit')->name('director.edita');
//---solicitudes de botar ramos------
Route::get('/directorTomaBota','DirectorController@botaIndex')->name('director.bota');
Route::put('/directorEditaBota/{id}','DirectorController@botaEdit')->name('director.botaedita');

#-----------------------------FIN RUTAS DE TOMA DE RAMOS----------------------------------------#

Route::get('/empresa/practicas', 'EmpresaController@CreacionPracticasProfesionales');
Route::post('/empresa/practicas/carga', 'EmpresaController@VerificacionPracticaProfesional');
Route::post('/empresa/practicas/enviar', 'EmpresaController@InsercionPracticaProfesional');
Route::get('/empresa/practicas/mostrar', 'EmpresaController@MostrarPracticas');
Route::post('/empresa/practicas/mostrar', 'EmpresaController@EliminarPracticas');
Route::post('/empresa/practicas/editar', 'EmpresaController@VerificarPracticas');

