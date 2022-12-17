<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventForceDeletedCallback;

class EventForceDeletedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventForceDeletedCallback $event
     * @return mixed
     */
    public function handle(EventForceDeletedCallback $event): mixed
    {
        return $event->object->forceDeletedEvent();
    }
}
