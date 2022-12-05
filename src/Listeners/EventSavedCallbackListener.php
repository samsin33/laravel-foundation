<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventSavedCallback;

class EventSavedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventSavedCallback $event
     * @return mixed
     */
    public function handle(EventSavedCallback $event): mixed
    {
        return $event->object->savedEvent();
    }
}
