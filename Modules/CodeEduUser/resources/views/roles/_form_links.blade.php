<?php
$table = Table::withContents($roles->items())->striped()
               ->callback('Ações', function ($field, $role) {
               $linkEdit = route('codeeduuser.roles.edit', ['role' => $role->id]);
               $linkDestroy= route('codeeduuser.roles.destroy', ['role' => $role->id]);
               $deleteForm = "delete-form-{$role->id}";

               $form = Form::open(['route' =>
               ['codeeduuser.roles.destroy', 'role' => $role->id],
               'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']).
               Form::close();

               $anchorDestroy = Button::link('Excluir')
                               ->asLinkTo($linkDestroy)->addAttributes([
                                'onclick' => "event.preventDefault();
                                document.getElementById(\"{$deleteForm}\").submit();"
                   ]);

               $anchorFlag = '<a title = "Não é possível excluir a própria permissão">Excluir</a>';
               $anchorDestroy = $role->id == \Auth::user()->id ? $anchorFlag : $anchorDestroy;

               $buttonEdit = Button::link('Editar')->asLinkTo($linkEdit);

                   return "<ul class=\"list-inline\">".
                   "<li>". $buttonEdit ."</li>" .
                   "<li>|</li>" .
                   "<li>".$anchorDestroy."</li>" .
                   "</ul>".
                   $form;
     });
?>
{!! $table !!}
