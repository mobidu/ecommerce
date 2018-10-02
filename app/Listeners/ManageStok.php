<?php

namespace App\Listeners;

use App\Events\OrderShipment;
use App\Product;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ManageStok
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
     * @param  OrderShipment  $event
     * @return void
     */
    public function handle(OrderShipment $event)
    {
        $komisi = 0;
        $order = $event->order->order_detail;
        $customer = $event->order->customer;
        if($order){
            foreach ($order as $o){
                Product::editStokBarang($o->kode_produk, $o->qty);
            }
        }


    }
}
