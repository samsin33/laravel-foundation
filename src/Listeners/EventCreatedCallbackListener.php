<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventCreatedCallback;

class EventCreatedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventCreatedCallback $event
     * @return mixed
     */
    public function handle(EventCreatedCallback $event): mixed
    {
        return $event->object->createdEvent();
    }
}
