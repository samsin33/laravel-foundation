<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventDeletingCallback;

class EventDeletingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventDeletingCallback $event
     * @return mixed
     */
    public function handle(EventDeletingCallback $event): mixed
    {
        return $event->object->deletingEvent();
    }
}
