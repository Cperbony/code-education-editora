<?php
$table = Table::withContents($chapters->items())->striped()
    ->callback('Ações', function ($field, $chapter) use($book) {
        $linkEdit = route('chapters.edit', ['book' => $book->id, 'chapter' => $chapter->id]);
        $linkDestroy = route('chapters.destroy', ['book' => $book->id, 'chapter' => $chapter->id]);
        $deleteForm = "delete-form-{$chapter->id}";

        $form = Form::open(['route' =>
                ['chapters.destroy', 'book' => $book->id, 'chapter' => $chapter->id],
                'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) .
            Form::close();

        $anchorDestroy = Button::link('Excluir')
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
