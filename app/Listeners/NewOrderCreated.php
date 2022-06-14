<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewOrder;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

use App\Models\Admin;

class NewOrderCreated
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewOrder $event) // add event name ("New Order") before $event 
    {
        $admins = Admin::where('orders', 1)->get(); // select who will be notified (who will listen to the event)
        // NewOrderNotification          👇👇👇  created by the command php artisan make:notification NewOrderNotification
        Notification::send($admins, new NewOrderNotification($event->order)); // send the notification of the newOrder event to the notified list ($admins)

    }
}
