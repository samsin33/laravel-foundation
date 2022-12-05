<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventUpdatingCallback;

class EventUpdatingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventUpdatingCallback $event
     * @return mixed
     */
    public function handle(EventUpdatingCallback $event): mixed
    {
        return $event->object->updatingEvent();
    }
}
