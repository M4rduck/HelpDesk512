<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="estilos.css">
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form action="" class="formulario">
	<h1 class="formulario__titulo">Nueva Incidencia</h1><br>
	<input type="text" class="formulario__input">
	<label for="" class="formulario__label">Nombre</label>
	<input type="text" class="formulario__input">
	<label for="" class="formulario__label">Descripcion</label>
	<input type="text" class="formulario__input">
	<label for="" class="formulario__label">Solucion</label>
	<input type="text" class="formulario__input">
	<label for="" class="formulario__label">Sw Faq</label>
	<input type="text" class="formulario__input">
	<label for="" class="formulario__label">Puntuacion</label>	
	<input type="submit" class="formulario__submit">
</form>
<script>
	var inputs = document.getElementsByClassName('formulario__input');
	for(var i =0; i < inputs.length; i++){
inputs[i].addEventListener('keyup', function(){
	if(this.value.length>=1){
		this.nextElementSibling.classList.add('fijar');
	}else{
		this.nextElementSibling.classList.remove('fijar');
	}
});
	}


</script>

</body>
</html>