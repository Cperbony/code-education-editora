<?php

namespace CodeEduBook\Database\Seeders;

use CodeEduBook\Models\Book;
use CodeEduBook\Models\Chapter;
use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        foreach ($books as $book) {
            factory(Chapter::class, 5)
                ->make()
                ->each(function ($chapter) use ($book) {
                    $chapter->book_id = $book->id;
                    $chapter->save();
                });
        }
    }
}
