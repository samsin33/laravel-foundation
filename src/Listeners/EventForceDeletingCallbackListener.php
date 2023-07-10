<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventForceDeletingCallback;

class EventForceDeletingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventForceDeletingCallback $event
     * @return mixed
     */
    public function handle(EventForceDeletingCallback $event): mixed
    {
        return $event->object->forceDeletedEvent();
    }
}
