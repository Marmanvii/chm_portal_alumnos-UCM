<!--{{-- Restriccion de acceso - Leer comentario en layout.redirect--}}
@include('layout.redirect')

@extends('layout.master') -->

@section('title')
  <title>Perfil Profesor</title>
  <title>Perfil Profesor</title>
@endsection

@section('styles')
  @include('layout.materialize')
@endsection

@section('body')
  @foreach ($professors as $professor) {{-- Obtención de los datos del profesor --}}

    @if ($professor->id == Auth::user()->id)
        <div class="row"> <!--Seccion izquierda con datos escenciales Nombre y RUT -->
          <div class="col s4">
            <div class="card-panel z-depth-5"> 
            <div align="center">    
              @if (empty(Auth::user()->foto))  
                <img src="/images/default.png") style="width:40%">
              @else
                <img src="{{$professor->foto}}") style="width:40%">
              @endif
            </div> <!--Recoger nombre y RUT de la BD-->
              <h4><i class="material-icons">person</i>&nbsp{{$professor->nombres}}&nbsp{{$professor->apellidos}}
              </h4>               
              <div class="divider"></div>
              <div class="section">
                <h5><b>RUT</b></h5>
                <p><b><i>&nbsp&nbsp{{$professor->rut}}</i></b></p>
              </div>
              <div class="divider"></div>
              <div class="section">
                <h5><b>Cargo</b></h5>
                <p><b><i>&nbsp&nbsp{{$professor->cargo}}</i></b></p>
              </div>            
            </div>
          </div>
          
          <div class="col s8">  <!--Seccion mensaje de bienvenida al tipo de usuario-->
            <div class="card-panel z-depth-4">
              <h4>Bienvenido, Profesor&nbsp</h4> 
            </div>

            <!--Inicio del conjunto de collapsibles de información -->

            <ul class="collapsible"> <!--Collapsible de información principal -->
              <li>
                <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                  &nbsp<b>Información Personal</b></h6> </div>
                <div class="collapsible-body">
                  <span>
                  	<div class="section">
                      <h7><b>Departamento</b></h7>
                      <p><i>&nbsp&nbsp{{$professor->departamento}} </i></p>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                      <h7><b>Email</b></h7>
                      <p><i>&nbsp&nbsp{{$professor->email}}</i></p>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                      <h7><b>Dirección</b></h7>
                      <p><i>&nbsp&nbsp{{$professor->direccion_actual}}</i></p>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                      <h7><b>Teléfono</b></h7>
                      <p><i>&nbsp&nbsp{{$professor->telefono}}</i></p>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                      <h7><b>Celular</b></h7>
                      <p><i>&nbsp&nbsp{{$professor->celular}} </i></p>
                    </div> 
                  </span>
                </div>
              </li>
            </ul>
            
            <ul class="collapsible"> <!--Collapsible de información extra1-->
              <li>
                <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                  &nbsp<b>Información 2</b></h6> </div>
                <div class="collapsible-body">
                  <span>
                    <div class="section">
                      <h7><b>Ejemplo título</b></h7>
                      <p><i>&nbsp&nbspInformación respectiva al ejemplo.</i></p>
                    </div> 
                  </span>
                </div>
              </li>
            </ul>

            <ul class="collapsible"> <!--Collapsible de información extra2-->
              <li>
                <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                  &nbsp<b>Información 3</b></h6> </div>
                <div class="collapsible-body">
                  <span>
                    <div class="section">
                      <h7><b>Ejemplo título</b></h7>
                      <p><i>&nbsp&nbspInformación respectiva al ejemplo.</i></p>
                    </div> 
                  </span>
                </div>
              </li>
            </ul>
          </div>

    @if ($professor->id == Auth::user()->id) 

    <div class="row">
      <div class="col s12"> 
          <h5 class="left-align"><i class="material-icons">person</i><b>&nbspDatos Personales</b></h5>    
          <div class="card horizontal z-depth-1"> {{--Creacion de card superior con datos de usuario--}}
              <div class="col s3 indigo" style="position: relative; top: 0px">
                  <h6 style = "color:white;"><b>Nombre:</b></h6>
                  <h6 style = "color:white;"><b>RUT:</b></h6>
                  <h6 style = "color:white;"><b>Email:</b></h6>
                  <h6 style = "color:white;"><b>Cargo:</b></h6>
                  <h6 style = "color:white;"><b>Teléfono:</b></h6>
                  <h6 style = "color:white;"><b>Celular:</b></h6>
              </div>
              <div class="col s9" style="position: relative; top: 0px"> 
                  <h6>&nbsp{{$professor->nombres}}&nbsp{{$professor->apellidos}}</h6> 
                  <h6>&nbsp{{$professor->rut}}</h6>
                  <h6>&nbsp{{$professor->email}}</h6>
                  <h6>&nbsp{{$professor->cargo}}</h6>
                  <h6>&nbsp{{$professor->telefono}}</h6>
                  <h6>&nbsp{{$professor->celular}}</h6>
              </div>
              <div class="col s2">  
                  <div>    
                      @if (empty(Auth::user()->foto))  
                        <img src="/images/default.png" class="center-align" style="width:85%; position: relative; left: 29px; top: 10px">
                      @else
                        <img src="{{$professor->foto}}" class="center-align" style="width:85%; position: relative; left: 29px; top: 10px">
                      @endif
                  </div>
              </div>
          </div>
          </div>
      </div> 

      <div class="row">
        <div class="col s6">     
          <div class="card-panel z-depth-1"> <!--Rectangulito donde estará el título y el botón desplegable -->
            <h5 class="left-align"><b>&nbspInformación nº1</b></h5> 
          </div>
        </div>      

        <div class="col s6">            
            <div class="card-panel z-depth-1"> <!--Rectangulito donde estará el título y el botón desplegable -->
              <h5 class="left-align"><b>&nbspInformación nº2</b></h5>
              <ul class="collapsible"> <!--Collapsible de información-->
                <li>
                  <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                    &nbsp<b>Información X</b></h6> </div>
                  <div class="collapsible-body">
                    <span>
                      <div class="section">
                        1
                      </div> 
                    </span>
                  </div>
                  <div class="collapsible-body">
                    <span>
                        <div class="section">
                          2
                        </div> 
                      </span>
                  </div>
                  <div class="collapsible-body">
                    <span>
                      3
                    </span>
                  </div>
                  <div class="collapsible-body">
                    <span>
                      <div class="section">
                        4
                      </div> 
                    </span>
                  </div>
                </li>
              </ul>
  
              <ul class="collapsible"> <!--Collapsible de información-->
                <li>
                  <div class="collapsible-header"><i class="material-icons">chrome_reader_mode</i>
                    &nbsp<b>Información Y</b></h6> </div>
                  <div class="collapsible-body">
                    <span>
                      <div class="section">
                        <h7><b>Ejemplo título</b></h7>
                        <p><i>&nbsp&nbspInformación respectiva al ejemplo.</i></p>
                      </div> 
                    </span>
                  </div>
                </li>
              </ul>
            </div>

  

        </div>
    @endif
  @endforeach
@endsection

@section('scripts')
  <script src={{ asset('js/nav_scripts.js') }}></script>
@endsection