<?php

namespace CodeEduBook\Notifications;

use CodeEduBook\Models\Book;
use CodeEduUser\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookExported extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Book $book
     */
    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'nexmo', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Seu livro foi exportado com sucesso')
            ->greeting("Olá {$this->user->name}!")
            ->line("o livro {$this->book->title}")
            ->action('Download', route('books.download', ['id' => $this->book->id]))
            ->line('Ficamos felizes por usar nossa aplicação!');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage())
            ->content("o livro {$this->book->title} foi exportado." . PHP_EOL)
            ->content("Fazer o download em " . route('books.download', ['id' => $this->book->id]));
    }
    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'book' => $this->book->toArray()
        ];
    }
}
