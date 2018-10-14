@if ($comentarios->isNotEmpty())
    <br>
    @foreach ($comentarios as $comentario)
    @php
        $fecha = new \DateTime($comentario->created_at);
    @endphp
    <div class="item">
        <i class="fa fa-user fa-2x" style="color:  {!! is_null($comentario->agent) ? $comentario->user->roles->first()->color : $comentario->agent->roles->first()->color !!}; margin-left: 15px"></i>

        <p class="message">
          <a class="name">
            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {!! $fecha->format('H:i') !!}</small>
            {!! is_null($comentario->agent) ? $comentario->user->name : $comentario->agent->name !!}
          </a>
          {!! $comentario->comment !!}
        </p>
      </div>
    @endforeach       
@else
     <div class="item">
         <p>No hay comentarios creados</p>
     </div>
@endif