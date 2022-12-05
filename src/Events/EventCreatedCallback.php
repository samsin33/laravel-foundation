<?php

namespace Samsin33\Foundation\Events;

class EventCreatedCallback
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
