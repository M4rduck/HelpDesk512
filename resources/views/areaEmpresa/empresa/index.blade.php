@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Empresa</h1>
@stop

@section('content')
	<h1>
		Realice Creacion de la Empresa y el Area Donde se Presenta la Incidencia
        <small>Bienvenido</small>
    </h1>

    <ol class="breadcrumb"></ol>


    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
		<div class="box-header with-border">
          <h3 class="box-title">Registro En Nuestra Base de Datos</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label>Ingrese la empresa</label>
                <input class="form-control " multiple="multiple" placeholder="ingrese nombre de la empresa" style="width: 94%;">
                  
              </div>

              <!-- /.form-group -->

 <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label>Ingrese el nit de la empresa</label>
                <input class="form-control" multiple="multiple" placeholder="ingrese nit de la empresa" style="width: 200%;"/>
                  
              </div>
             
              <!-- /.form-group -->
            
            <!-- /.col -->
           
              <!-- /.form-group -->
             
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

      

        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label>Ingrese la Direccion de la empresa</label>
                <input class="form-control" multiple="multiple" placeholder="ingrese Direccion de la empresa" style="width: 200%;"/>
                  
              </div>


    <!-- SELECT2 EXAMPLE -->
    
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label>Ingrese la correo electronico de la empresa</label>
                <input class="form-control" multiple="multiple" placeholder="ingrese correo electronico de la empresa" style="width: 470%;">
                  
              </div>

              <!-- /.form-group -->


             
              <!-- /.form-group -->
            
            <!-- /.col -->
           
              <!-- /.form-group -->
             
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
<br>
       

        
        <!-- /.box-header -->
        <br>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label>Ingrese la ciudad principal de la empresa </label>
                <input class="form-control " multiple="multiple" placeholder="ingrese ciudad principal de la empresa" style="width: 500%;">
                  
              </div>

<br>
<br>

              <input type="button" value="REGISTRAR">
@stop