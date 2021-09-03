<?php

namespace App\Listeners;

use App\Events\NewMarketQuotation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMarketQuotationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewMarketQuotation  $event
     * @return void
     */
    public function handle(NewMarketQuotation $event)
    {
        return $event;
    }
}
