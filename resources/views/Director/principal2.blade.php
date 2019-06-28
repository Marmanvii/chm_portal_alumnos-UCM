{{-- Mantenemos estandar base --}}
@extends('layout.master')

{{-- Cambiamos titulo de pagina --}}
@section('title')
  <title>Director</title>
@endsection

{{-- Incluimos los archivos a utilizar para front --}}
@section('styles')
  @include('layout.materialize') {{-- De usar materialize, incluimos desde el layout --}}
@endsection

{{-- Aqui trabajamos todo el contenido de la vista --}}
@section('body')
  {{-- Contenido --}}

<ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul><ul>
<div class="center">
<a href="{{route('directorToma.index')}}" class="waves-effect waves-light btn-large"><i class="material-icons left"></i>Lista solicitudes </a>
<a href="{{route('directorTomaBota.index')}}" class="waves-effect waves-light btn-large"><i class="material-icons right"></i>Lista botar</a>
</div>

<br>
<br>
<br>
<br>


@endsection


