<?php

namespace App\Events\Frontend;

use App\Events\Event;
use App\StackMember;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StackMemberSignedUp extends Event
{
    use SerializesModels;
    public $stackMember;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(StackMember $stackMember)
    {
        $this->stackMember = $stackMember;
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
