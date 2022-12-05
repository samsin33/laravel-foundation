<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventRestoringCallback;

class EventRestoringCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventRestoringCallback $event
     * @return mixed
     */
    public function handle(EventRestoringCallback $event): mixed
    {
        return $event->object->restoringEvent();
    }
}
