<?php
$table = Table::withContents($categories->items())->striped()
               ->callback('Ações', function ($field, $category) {
               $linkEdit = route('categories.edit', ['category' => $category->id]);
               $linkDestroy= route('categories.destroy', ['category' => $category->id]);
               $deleteForm = "delete-form-{$category->id}";

               $form = Form::open(['route' =>
               ['categories.destroy', 'category' => $category->id],
               'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']).
               Form::close();

               $anchorDestroy = Button::link('Excluir')
                               ->asLinkTo($linkDestroy)->addAttributes([
                                'onclick' => "event.preventDefault();
                                document.getElementById(\"{$deleteForm}\").submit();"
                   ]);

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
