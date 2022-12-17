<?php

namespace Samsin33\Foundation\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Bus\PendingDispatch;
use Samsin33\Foundation\Jobs\ProcessQueue;

trait QueueTrait
{
    /**
     * @var Authenticatable|null
     */
    protected ?Authenticatable $queue_user = null;

    /**
     * @param string $queue_name
     * @param mixed $data
     * @param $current_user
     * @return mixed
     */
    public function processQueue(string $queue_name, array $data, $current_user = null): mixed
    {
        $this->queue_user = $current_user;
        return $this->$queue_name($data);
    }

    /**
     * @param string $queue_name
     * @param array $data
     * @return PendingDispatch
     */
    public function dispatchQueue(string $queue_name, array $data = []): PendingDispatch
    {
        return ProcessQueue::dispatch($queue_name, $this, $data, self::currentUser());
    }
}
