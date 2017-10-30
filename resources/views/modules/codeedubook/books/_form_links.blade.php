<?php
$table = Table::withContents($books->items())->striped()
    ->callback('Ações', function ($field, $book) {
        $linkEdit = route('books.edit', ['book' => $book->id]);
        $linkDestroy = route('books.destroy', ['book' => $book->id]);
        $deleteForm = "delete-form-{$book->id}";

        $form = Form::open(['route' =>
                ['books.destroy', 'book' => $book->id],
                'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) .
            Form::close();

        $anchorDestroy = Button::link('Enviar para Lixeira')
            ->asLinkTo($linkDestroy)->addAttributes([
                'onclick' => "event.preventDefault();
                                document.getElementById(\"{$deleteForm}\").submit();"
            ]);

        $buttonEdit = Button::link('Editar')->asLinkTo($linkEdit);

        return "<ul class=\"list-inline\">" .
            "<li>" . $buttonEdit . "</li>" .
            "<li>|</li>" .
            "<li>" . $anchorDestroy . "</li>" .
            "</ul>" .
            $form;
    });
?>
{!! $table !!}
