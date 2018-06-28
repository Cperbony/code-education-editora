<?php
$table = Table::withContents($books->items())->striped()
    ->callback('Ações', function ($field, $book) {
        $linkEdit = route('books.edit', ['book' => $book->id]);
        $linkDestroy = route('books.destroy', ['book' => $book->id]);
        $linkChapters = route('chapters.index', ['book' => $book->id]);
        $linkCovers = route('books.cover.store', ['book' => $book->id]);
        $linkExport = route('books.export', ['book' => $book->id]);
        $deleteFormId = "delete-form-{$book->id}";

        $deleteForm = Form::open(['route' =>
                ['books.destroy', 'book' => $book->id],
                'method' => 'DELETE', 'id' => $deleteFormId, 'style' => 'display:none']) .
            Form::close();

        $anchorDestroy = Button::link('Enviar para Lixeira')
            ->asLinkTo($linkDestroy)->addAttributes([
                'onclick' => "event.preventDefault();
                                document.getElementById(\"{$deleteFormId}\").submit();"
            ]);

        $anchorExport = Button::link('Exportar')
            ->asLinkTo($linkExport)->addAttributes([
                'onclick' => "event.preventDefault();exportBook(\"$linkExport\");"
            ]);

        $buttonExport = Button::link('Exportar')->asLinkTo($anchorExport);
        $buttonChapter = Button::link('Capítulos')->asLinkTo($linkChapters);
        $buttonCover = Button::link('Cover')->asLinkTo($linkCovers);
        $buttonEdit = Button::link('Editar')->asLinkTo($linkEdit);

        return "<ul class=\"list-inline\">" .
            "<li>" . $anchorExport . "</li>" .
            "<li>|</li>" .
            "<li>" . $buttonChapter . "</li>" .
            "<li>|</li>" .
            "<li>" . $buttonCover . "</li>" .
            "<li>|</li>" .
            "<li>" . $buttonEdit . "</li>" .
            "<li>|</li>" .
            "<li>" . $anchorDestroy . "</li>" .
            "</ul>" .
            $deleteForm;
    });
?>
{!! $table !!}
