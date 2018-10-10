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
                                        <button type="button" class="btn btn-box-tool" data-toggle='modal' onclick='addFrom()'><i class="fas fa-eye"></i>
                                        </button>
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
                </div>
</div>