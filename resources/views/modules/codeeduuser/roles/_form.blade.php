{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('name', $errors) !!}
{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
{!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('description', $errors) !!}
{!! Form::label('description', 'Descrição', ['class' => 'control-label']) !!}
{!! Form::text('description', null, ['class' => 'form-control']) !!}
{!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('roles.*', $errors) !!}
{!! Form::label('roles[]', 'Papel de Usuário', ['class' => 'control-label']) !!}
{!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'multiple' => true]) !!}
{!! Form::error('roles.*', $errors) !!}
{!! Html::closeFormGroup() !!}