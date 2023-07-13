<?php

namespace Samsin33\Foundation\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Samsin33\Foundation\Console\Commands\FoundationModelMakeCommand;
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

class FoundationServiceProvider extends ServiceProvider
{
    protected static array $eventListeners = [
        EventRetrievedCallback::class => [
            EventRetrievedCallbackListener::class, 'handle'
        ],
        EventCreatingCallback::class => [
            EventCreatingCallbackListener::class, 'handle'
        ],
        EventCreatedCallback::class => [
            EventCreatedCallbackListener::class, 'handle'
        ],
        EventUpdatingCallback::class => [
            EventUpdatingCallback::class, 'handle'
        ],
        EventUpdatedCallback::class => [
            EventUpdatedCallback::class, 'handle'
        ],
        EventSavingCallback::class => [
            EventSavingCallbackListener::class, 'handle'
        ],
        EventSavedCallback::class => [
            EventSavedCallbackListener::class, 'handle'
        ],
        EventDeletingCallback::class => [
            EventDeletingCallbackListener::class, 'handle'
        ],
        EventDeletedCallback::class => [
            EventDeletedCallbackListener::class, 'handle'
        ],
        EventTrashedCallback::class => [
            EventTrashedCallbackListener::class, 'handle'
        ],
        EventForceDeletedCallback::class => [
            EventForceDeletedCallbackListener::class, 'handle'
        ],
        EventRestoringCallback::class => [
            EventRestoringCallbackListener::class, 'handle'
        ],
        EventRestoredCallback::class => [
            EventRestoredCallbackListener::class, 'handle'
        ],
        EventReplicatingCallback::class => [
            EventReplicatingCallbackListener::class, 'handle'
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
        $this->registerCommands();
        $this->registerEvents();
    }

    /**
     * Register the Foundation Artisan commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FoundationModelMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the Foundation BaseModel events.
     *
     * @return void
     */
    protected function registerEvents(): void
    {
        foreach (self::$eventListeners as $event => $listeners) {
            Event::listen($event, $listeners);
        }
    }
}
