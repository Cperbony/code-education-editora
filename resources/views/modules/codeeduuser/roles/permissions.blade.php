@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Permissões de {{$role->name}}</h3>
        </div>
        <div class="row">
            {!! Form::open(['route' => ['codeeduuser.roles.permissions.update', $role->id],
            'class' => 'form', 'method' => 'PUT']) !!}
<ul class="list-group">
    @foreach($permissionsGroup as $pg)
        <li class="list-group-item">
            <h4 class="list-group-item-heading">
                <strong>{{ $pg->description }}</strong>
            </h4>
                <p class="list-group-item-text">
                    <ul class="list-inline">
                        <?php
                            $permissionsSubGroup = $permissions->filter(function($value) use($pg){
                                return $value->name == $pg->name;
                                    });
                        ?>
                        @foreach($permissionsSubGroup as $permission)
                            <li>
                                <div class="checkbox">
                                    <label for="">
                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
{{ $role->permissions->contains('id', $permission->id) ?'checked="checked"' : ''}}/>
                                        {{$permission->resource_description}}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </p>
        </li>
    @endforeach
</ul>


            {!! Html::openFormGroup() !!}
            {!! Button::primary('Salvar')->submit() !!}
            {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection