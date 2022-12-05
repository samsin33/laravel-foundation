<?php

namespace Samsin33\Foundation\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Samsin33\Foundation\Events\EventCreatedCallback;
use Samsin33\Foundation\Events\EventCreatingCallback;
use Samsin33\Foundation\Events\EventDeletedCallback;
use Samsin33\Foundation\Events\EventDeletingCallback;
use Samsin33\Foundation\Events\EventForceDeletedCallback;
use Samsin33\Foundation\Events\EventReplicatingCallback;
use Samsin33\Foundation\Events\EventRestoredCallback;
use Samsin33\Foundation\Events\EventRestoringCallback;
use Samsin33\Foundation\Events\EventRetrievedCallback;
use Samsin33\Foundation\Events\EventSavedCallback;
use Samsin33\Foundation\Events\EventSavingCallback;
use Samsin33\Foundation\Events\EventTrashedCallback;
use Samsin33\Foundation\Events\EventUpdatedCallback;
use Samsin33\Foundation\Events\EventUpdatingCallback;
use Samsin33\Foundation\Listeners\EventCreatedCallbackListener;
use Samsin33\Foundation\Listeners\EventCreatingCallbackListener;
use Samsin33\Foundation\Listeners\EventDeletedCallbackListener;
use Samsin33\Foundation\Listeners\EventDeletingCallbackListener;
use Samsin33\Foundation\Listeners\EventForceDeletedCallbackListener;
use Samsin33\Foundation\Listeners\EventReplicatingCallbackListener;
use Samsin33\Foundation\Listeners\EventRestoredCallbackListener;
use Samsin33\Foundation\Listeners\EventRestoringCallbackListener;
use Samsin33\Foundation\Listeners\EventRetrievedCallbackListener;
use Samsin33\Foundation\Listeners\EventSavedCallbackListener;
use Samsin33\Foundation\Listeners\EventSavingCallbackListener;
use Samsin33\Foundation\Listeners\EventTrashedCallbackListener;

class FoundationEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EventRetrievedCallback::class => [
            EventRetrievedCallbackListener::class,
        ],
        EventCreatingCallback::class => [
            EventCreatingCallbackListener::class,
        ],
        EventCreatedCallback::class => [
            EventCreatedCallbackListener::class,
        ],
        EventUpdatingCallback::class => [
            EventUpdatingCallback::class,
        ],
        EventUpdatedCallback::class => [
            EventUpdatedCallback::class,
        ],
        EventSavingCallback::class => [
            EventSavingCallbackListener::class,
        ],
        EventSavedCallback::class => [
            EventSavedCallbackListener::class,
        ],
        EventDeletingCallback::class => [
            EventDeletingCallbackListener::class,
        ],
        EventDeletedCallback::class => [
            EventDeletedCallbackListener::class,
        ],
        EventTrashedCallback::class => [
            EventTrashedCallbackListener::class,
        ],
        EventForceDeletedCallback::class => [
            EventForceDeletedCallbackListener::class,
        ],
        EventRestoringCallback::class => [
            EventRestoringCallbackListener::class,
        ],
        EventRestoredCallback::class => [
            EventRestoredCallbackListener::class,
        ],
        EventReplicatingCallback::class => [
            EventReplicatingCallbackListener::class,
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
