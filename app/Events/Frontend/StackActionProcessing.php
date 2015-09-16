<?php

namespace App\Events\Frontend;

use App\Events\Event;
use App\StackActionLog;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StackActionProcessing extends Event
{
    use SerializesModels;
    public $stackActionLog;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StackActionLog $stackActionLog, $type)
    {
        $this->stackActionLog = $stackActionLog;
        $this->type = $type;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
