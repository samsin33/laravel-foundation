<?php

namespace Samsin33\Foundation\Events;

class EventDeletingCallback
{
    public $object;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
