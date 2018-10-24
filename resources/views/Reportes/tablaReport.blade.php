<br><br>
<div class="table-responsive">
	<table class="table">
		<thead class="bg-info">
			<tr>				
				<th scope="col">Tecnico</th>
				<th scope="col">Descripcion</th>
				<th scope="col">Incidente</th>
				<th scope="col">Fecha</th>
				<th scope="col">Estado</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($incidentes as $inc)
			<tr>
				<td>{{$inc->usuario->name}}</td>
				<td>{{$inc->description}}</td>
				<td>{{$inc->theme}}</td>
				<td>{{$inc->created_at}}</td>
				<td>{{$inc->estado->name}}</td>
			</tr>
			@endforeach			
		</tbody>		
	</table>
	{{ $incidentes->render() }}
</div><br>

