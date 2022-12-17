<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventRetrievedCallback;

class EventRetrievedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventRetrievedCallback $event
     * @return mixed
     */
    public function handle(EventRetrievedCallback $event): mixed
    {
        return $event->object->retrievedEvent();
    }
}
