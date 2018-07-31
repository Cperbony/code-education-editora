<?php

namespace CodePub\Providers;

use CodeEduBook\Events\BookPreIndexEvent;
use CodeEduStore\Events\OrderPostProcessEvent;
use CodePub\Listeners\BookMakeTotal;
use CodePub\Listeners\BookRankingUpdate;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BookPreIndexEvent::class => [
            BookMakeTotal::class
        ],
        OrderPostProcessEvent::class => [
          BookRankingUpdate::class
        ],
        'CodePub\Events\SomeEvent' => [
            'CodePub\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
