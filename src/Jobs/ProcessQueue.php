<?php

namespace Samsin33\Foundation\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $queue_name;
    protected mixed $object;
    protected mixed $current_user;
    protected array $data;

    /**
     * Create a new job instance.
     *
     * @param string $queue_name
     * @param mixed $object
     * @param array $data
     * @param mixed|null $current_user
     */
    public function __construct(string $queue_name, mixed $object, array $data = [], mixed $current_user = null)
    {
        $this->queue_name = $queue_name;
        $this->object = $object;
        $this->current_user = $current_user;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->object->processQueue($this->queue_name, $this->data, $this->current_user);
    }
}
