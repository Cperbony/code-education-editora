<?php
$table = Table::withContents($users->items())->striped()
               ->callback('Ações', function ($field, $user) {
               $linkEdit = route('codeeduuser.users.edit', ['user' => $user->id]);
               $linkDestroy= route('codeeduuser.users.destroy', ['user' => $user->id]);
               $deleteForm = "delete-form-{$user->id}";

               $form = Form::open(['route' =>
               ['codeeduuser.users.destroy', 'user' => $user->id],
               'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']).
               Form::close();

               $anchorDestroy = Button::link('Excluir')
                               ->asLinkTo($linkDestroy)->addAttributes([
                                'onclick' => "event.preventDefault();
                                document.getElementById(\"{$deleteForm}\").submit();"
                   ]);

               if($user->id == \Auth::user()->id) {
                   $anchorDestroy->disable();
               }

               $anchorFlag = '<a title = "Não é possível excluir o próprio usuário">Excluir</a>';
               $anchorDestroy = $user->id == \Auth::user()->id ? $anchorFlag : $anchorDestroy;

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
