<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventCreatingCallback;

class EventCreatingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventCreatingCallback $event
     * @return mixed
     */
    public function handle(EventCreatingCallback $event): mixed
    {
        return $event->object->creatingEvent();
    }
}
