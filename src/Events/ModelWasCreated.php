<?php

namespace Harrysbaraini\Loggable\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ModelWasCreated
{
    use SerializesModels;

    public $record;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $record)
    {
        $this->record = $record;
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
