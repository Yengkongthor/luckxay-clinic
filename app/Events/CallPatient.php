<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallPatient implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $receptionDepartmentCode;
    private $patient;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receptionDepartmentCode, $patient)
    {
        $this->receptionDepartmentCode = $receptionDepartmentCode;
        $this->patient = $patient;
    }

    public function broadcastWith()
    {
        return [
            'patient' => $this->patient
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Reception.' . $this->receptionDepartmentCode);
    }
}
