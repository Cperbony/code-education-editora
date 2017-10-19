{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('title', $errors) !!}
{!! Form::label('title', 'Titulo', ['class' => 'control-label']) !!}
{!! Form::text('title', null, ['class' => 'form-control']) !!}
{!! Form::error('title', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('subtitle', $errors) !!}
{!! Form::label('subtitle', 'Subtítulo', ['class' => 'control-label']) !!}
{!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
{!! Form::error('subtitle', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('price', $errors) !!}
{!! Form::label('price', 'Preço', ['class' => 'control-label']) !!}
{!! Form::text('price', null, ['class' => 'form-control']) !!}
{!! Form::error('price', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup(['categories', 'categories.*'], $errors) !!}
{!! Form::label('categories[]', 'Categorias', ['class' => 'control-label']) !!}
{!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => 'true']) !!}
{!! Form::error('categories', $errors) !!}
{!! Form::error('categories.*', $errors) !!}
{!! Html::closeFormGroup() !!}
