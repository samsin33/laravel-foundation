<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventReplicatingCallback;

class EventReplicatingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventReplicatingCallback $event
     * @return mixed
     */
    public function handle(EventReplicatingCallback $event): mixed
    {
        return $event->object->createdEvent();
    }
}
