<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventTrashedCallback;

class EventTrashedCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventTrashedCallback $event
     * @return mixed
     */
    public function handle(EventTrashedCallback $event): mixed
    {
        return $event->object->createdEvent();
    }
}
