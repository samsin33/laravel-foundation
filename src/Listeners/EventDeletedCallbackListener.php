<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventDeletedCallback;

class EventDeletedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventDeletedCallback $event
     * @return mixed
     */
    public function handle(EventDeletedCallback $event): mixed
    {
        return $event->object->deletedEvent();
    }
}
