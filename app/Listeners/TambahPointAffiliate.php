<?php

namespace App\Listeners;

use App\Events\OrderShipment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TambahPointAffiliate
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
        $referral = $customer->referal;
        if($referral){
            $saldo_referral = $referral->saldo ? $referral->saldo : 0;
            if($order){
                foreach ($order as $o){
                    $komisi = $o->product->komisi ? $o->product->komisi+$komisi : 0;
                }
            }

            $saldo_referral = $saldo_referral + $komisi;

            $referral->saldo = $saldo_referral;

            if($referral->save()){
                \Log::info('Info Mutasi Saldo Referal : Berhasil Menyimpan mutasi saldo referal untuk Nomor Invoice : '.$event->order->invoice);
            }
        }


    }
}
