<?php

namespace Samsin33\Foundation\Listeners;

use Samsin33\Foundation\Events\EventSavingCallback;

class EventSavingCallbackListener
{
    /**
     * Handle the event.
     *
     * @param EventSavingCallback $event
     * @return mixed
     */
    public function handle(EventSavingCallback $event): mixed
    {
        return $event->object->savingEvent();
    }
}
