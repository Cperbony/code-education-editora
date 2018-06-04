<?php

namespace CodeEduBook\Pub;

use CodeEduBook\Models\Book;
use Illuminate\Http\UploadedFile;

class BookCoverUpload
{

    public function upload(Book $book, UploadedFile $cover)
    {
        \Storage::disk(config('codeedubook.book_storage'))
            ->putFileAs($book->ebook_template, $cover, $book->cover_ebook_name);
    }
}