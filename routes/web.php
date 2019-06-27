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

#Profesores#
Route::get('/profesor', 'ProfesoresController@index')->name('profesor');

#Director#
Route::get('/director', 'DirectorController@index')->name('director');

#Secretaria#
Route::get('/secretaria', 'SecretariaController@index')->name('secretaria');

#Empresa#
Route::get('/empresa', 'EmpresaController@index')->name('empresa');



#RUTAS DE TOMA DE RAMOS#

Route::get('/decisionToma',function(){
	return view('toma.principal');
})->name('toma.decisionToma');


// RUTAS PARA SOLICITAR RAMOS DE PARTE DEL ESTUDIANTE
Route::get('/tomacurso','EstudiantesController@tomacurso')->name('usuario.toma');
Route::get('/tomacurso/crea','EstudiantesController@crea_toma_curso')->name('crea.toma');
//Route::post('/tomado','EstudiantesController@guardacurso')->name('usuario.guarda');
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


//RUTAS DE LA TOMA DE RAMOS PARTE DIRECTOR
Route::get('/decisionTomaD',function(){
	return view('toma.principal2');
})->name('toma.decisionToma2');

Route::resource('directorToma','TomaDirectorController');

Route::resource('directorTomaBota','TomaBotaDirectorController');


//Route::get('/tomacursoD','DirectorController@muestracurso')->name('director.toma');
//Route::post('/editado','DirectorController@editaToma')->name('diretor.toma');



