<div class="row">
                <div class="col-md-12">
                @if(session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                @endif
                    
                @if(count($errors))
                    <div class="alert alert-success">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @foreach($bases->chunk(2) as $chunk)
                        <div class="row">
                            @foreach($chunk as $base)
                            <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{ $base->name }}</h3>
                                    <div class="box-tools pull-right">
                                        <a href="{{ route('baseConocimiento.show', $base->id )}}" class="btn btn-box-tool"><i class="fas fa-eye"></i></a>
                                        {!! Form::button('<i class="fa fa-pencil"></i>', 
                                                            ['class'=>'btn btn-box-tool',
                                                                        'data-toggle' =>'modal',
                                                                        'onclick'=>'editFrom('.$base->id.')']) !!}
                                        {!! Form::button('<i class="fa fa-minus"></i>', ['class'=>"btn btn-box-tool", 'data-widget'=>"collapse"]) !!}                                        
                                    </div>
                                </div>
                                    <div class="box-body">
                                        {{ $base->description }}
                                    </div>
                                    <div class="box-footer">
                                        @forelse($base->tags as $tag)
                                        <span class="label label-info">{{ $tag->name }}</span>
                                        @empty
                                        <em>Sin etiquetas</em>
                                        @endforelse
                                    </div>   
                            </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                    {{ $bases->links() }}
                </div>
</div>