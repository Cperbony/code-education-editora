<?php

namespace CodeEduBook\Jobs;

use CodeEduBook\Models\Book;
use CodeEduBook\Pub\BookExport;
use CodeEduUser\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class GenerateBook implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;
    /**
     * @var Book
     */
    private $book;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param Book $book
     * @param User $user
     */
    public function __construct(User $user, Book $book)
    {
        $this->user = $user->author;
        $this->book = $book;

    }

    /**
     * Execute the job.
     *
     * @param BookExport $bookExport
     * @return void
     * @throws \Exception
     */
    public function handle(BookExport $bookExport)
    {
        $bookExport->export($this->book);
        $easyBookCmd = "easybook/book publish --no-interaction --dir={$this->book->disk} {$this->book->id}";
        exec("php " . base_path("$easyBookCmd print"));
        exec("php " . base_path("$easyBookCmd kindle"));
        exec("php " . base_path("$easyBookCmd ebook"));
        $bookExport->compress($this->book);
//        $exception = new \Exception("Job Falhou");
//        $this->fail($exception);
//        throw $exception;
    }
}
