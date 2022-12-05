<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventUpdatedCallback;

class EventUpdatedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventUpdatedCallback $event
     * @return mixed
     */
    public function handle(EventUpdatedCallback $event): mixed
    {
        return $event->object->updatedEvent();
    }
}
