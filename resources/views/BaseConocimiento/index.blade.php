@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					
				</div>

				<div class="box-body">
					<div class="form-group">
						<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BASE DE CONOCIMIENTO</title>
<!-- Libreria CSS de Bootstrap -->
   

</head>
<body>
<!-- Barra de navegacion -->

<!-- Contenedor del cuerpo de la pagina -->
  <div class="container">
    <div class="row">
    <div class="row col-xs-12 col-sm--12 col-md-12 col-lg-12 text-center">
      <label for=""> <font face="decorativa">Base De Conocimiento</font>
      </label><br>
      <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#software1">Software</a></li>
    <li><a data-toggle="tab" href="#hardware2">Hardware</a></li>
    <li><a data-toggle="tab" href="#red3">Red</a></li>
  </ul>
        
<!--<a type="button" class="btn btn-primary btn-sm" href="{{route('home')}}">Red</a>
<a type="button" class="btn btn-secondary btn-sm" href="{{route('home')}}">Software</a>
<a type="button" class="btn btn-primary btn-sm" href="{{route('home')}}">Hardware</a> <br>
--><br>
<br>
    </div>
  </div>
  <div class="tab-content">
  <div id="software1" class="tab-pane fade">
  <div class="row">
    <div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text">
<textarea  cols=120 id="tx1" rows=4 style="background-color: #eee; border: none;" placeholder="SOFTWARE"></textarea>         
           </div>
           <br>
           <br>
           <br>

 <div class="row col-xs-12 col-sm--12 col-md-2 col-lg-2 text">
<button type="button" id="tx1b" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Solucion</button>
<!-- modal -->   
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solucion de Incidencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--- fin de modal -->
</div><br>
<br>
 <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
   <label>Fecha:
  </label> <label></label>
</div>
   <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
  <label>Prioridad:
  </label> <label></label>
 </div>
<div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text-left">
<hr class='separador_post'/>
</div>
</div>


  </div>
    <div id="hardware2" class="tab-pane fade">
   <div class="row">
    <div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text">
<textarea  cols=120 id="tx2" rows=4 style="background-color: #eee; border: none;" placeholder="HARDWARE"></textarea>         
           </div>
           <br>
           <br>
           <br>
 <div class="row col-xs-12 col-sm--12 col-md-2 col-lg-2 text">
<button type="button" id="tx2b" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Solucion</button>
<!-- modal -->   
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solucion de Incidencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--- fin de modal -->
</div>
 <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
   <label>Fecha:
  </label> <label></label>
</div>
   <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
  <label>Prioridad:
  </label> <label></label>
 </div>
<div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text-left">
<hr class='separador_post'/>
</div>
</div>
<br>
  </div>
   <div class="tab-content">
  <div id="red3" class="tab-pane fade">
  <div class="row">
    <div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text">
<textarea  cols=120 id="tx1" rows=4 style="background-color: #eee; border: none;" placeholder="RED"></textarea>         
           </div>
           <br>
           <br>
           <br>

 <div class="row col-xs-12 col-sm--12 col-md-2 col-lg-2 text">
<button type="button" id="tx1b" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong">Solucion</button>
<!-- modal -->   
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Solucion de Incidencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--- fin de modal -->
</div><br>
<br>
 <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
   <label>Fecha:
  </label> <label></label>
</div>
   <div class="row col-xs-4 col-sm--4 col-md-4 col-lg-4 text">
  <label>Prioridad:
  </label> <label></label>
 </div>
<div class="row col-xs-12 col-sm--12 col-md-10 col-lg-10 text-left">
<hr class='separador_post'/>
</div>
</div>


  </div>
  <div id="home" class="tab-pane fade in active">
    
  </div>
 <!-- <div class="row">
<div class="row col-xs-12 col-sm--12 col-md-12 col-lg-12 text-center ">
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>
</div> -->
<!-- Libreria de jQuery -->
<!-- Libreria JavaScript de Bootstrap -->
</body>
<style type="text/css">
  
  hr.separador_post { 
 height: 30px;
 border-style: solid;
 border-color: #BFBFBF;
 border-width: 2px 0 0 0;
 border-radius: 20px;
 text-align: center;
}

hr.separador_post:before {
    display: block;
    content: "";
    height: 30px;
    margin-top: -31px;
    border-style: solid;
    border-color: black;
    border-width: 0 0 1px 0;
    -webkit-border-radius:20px;
       -moz-border-radius:20px;
            border-radius:20px;
}

hr.separador_post:after {
    content: '★';
    color: #DC5500;
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: white;
}
</style>
</html>
					</div>
				</div>
				
			</div>
		</div>		
	</div>
@stop