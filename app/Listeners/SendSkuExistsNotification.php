<?php
// app/Listeners/SendSkuExistsNotification.php

namespace App\Listeners;

use App\Events\SkuExists;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class SendSkuExistsNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(SkuExists $event)
    {
        try {
            $sku = $event->sku;

            $emailContent = "SKU $sku already exists in the database.";

            //mail can be sent to any one, either logged in user or something else.
            Mail::to('test@gmail.com')->send(new \App\Mail\SkuExistsNotification($emailContent));
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
