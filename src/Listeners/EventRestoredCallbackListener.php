<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventRestoredCallback;

class EventRestoredCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventRestoredCallback $event
     * @return mixed
     */
    public function handle(EventRestoredCallback $event): mixed
    {
        return $event->object->restoredEvent();
    }
}
