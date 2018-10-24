<table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Name</th>
                                <th>description</th>
                                <th>User</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($request as $base)
                            <tr>
                                <td>{{ $base->id }}</td>
                                <td>{{ $base->name }}</td>
                                <td>{{ $base->description }}</td>
                                @forelse($base->users as $user)
                                        <td>{{ $user->name }}</td>
                                @empty
                                        <td>no user</td>
                                @endforelse
                                <td width="10px">
                                    <a href="{{ route('baseConocimiento.show', $base->id )}}" class="btn btn-sm btn-info">show</a>
                                </td>
                                <td width="10px">
                                {!! Form::button('activate', 
                                            ['class'=>'btn btn-sm btn-primary',
                                             'onclick'=>'editBase('.$base->id.')']) !!}
                                
                                </td>                           
                            </tr>
                        @endforeach
                        </tbody>   
                    </table>     	
{{ $request->render()}}