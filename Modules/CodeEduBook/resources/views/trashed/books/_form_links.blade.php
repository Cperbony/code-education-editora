<?php
    $table = Table::withContents($books->items())->striped()
        ->callback('Ações', function ($field, $book) {
            $linkView = route('trashed.books.show', ['book' => $book->id]);
            $linkDestroy = route('books.destroy', ['book' => $book->id]);
            $restoreForm = "restore-form-{$book->id}";

            $form = Form::open(['route' =>
                    ['trashed.books.update', 'book' => $book->id],
                    'method' => 'PUT', 'id' => $restoreForm, 'style' => 'display:none']) .
                Form::hidden('redirect_to', URL::previous()) .
                Form::close();

            $anchorRestore = Button::link('Restaurar')
                ->asLinkTo($linkDestroy)->addAttributes([
                    'onclick' => "event.preventDefault();
                                document.getElementById(\"{$restoreForm}\").submit();"
                ]);

            $buttonEdit = Button::link('Ver')->asLinkTo($linkView);

            return "<ul class=\"list-inline\">" .
                "<li>" . $buttonEdit . "</li>" .
                "<li>|</li>" .
                "<li>" . $anchorRestore . "</li>" .
                "</ul>" .
                $form;
        });
?>
{!! $table !!}
