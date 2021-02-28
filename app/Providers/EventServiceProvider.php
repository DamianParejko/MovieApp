<?php

namespace App\Providers;

use App\Events\CommentCreated;
use App\Events\PostLikeCreated;
use App\Events\CommentLikeCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\NotificationCommentCreated;
use App\Listeners\NotificationPostLikeCreated;
use App\Listeners\NotificationCommentLikeCreated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentCreated::class => [
            NotificationCommentCreated::class,          
        ],
        PostLikeCreated::class => [ 
            NotificationPostLikeCreated::class
        ],
        CommentLikeCreated::class => [
            NotificationCommentLikeCreated::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
