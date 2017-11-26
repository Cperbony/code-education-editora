{!! Html::openFormGroup('password', $errors) !!}
{!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
{!! Form::password('password', ['class' => 'form-control']) !!}
{!! Form::error('password', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup() !!}
{!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'control-label']) !!}
{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
{!! Html::closeFormGroup() !!}