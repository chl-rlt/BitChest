<?php

namespace App\Events;

use App\Models\Market;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMarketQuotation implements shouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $marketsValues;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $marketsValues)
    {
        $this->marketsValues = $marketsValues;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new.quotations';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('markets_quotations');
    }
}
