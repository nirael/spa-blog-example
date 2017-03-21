<?php

namespace App\Listeners;

use App\Events\BanListEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\BanList;

class BanListListener
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
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(BanListEvent $event)
    {
         $ips = Cache::get('banned');
        if($event->update){
            if(!BanList::where('id',$event->update)->first()){
                BanList::create(['ip' => $event->update]);
            $ips[] = $event->update;
            Cache::forever('banned',$ips);
            }
        }
        if($event->remove){
            $ip = BanList::where(['ip' => $event->remove])->first();
            if($ip){
                $ip->delete();
            //You cannot access the event object from here , my friend...(FUCK IT FUCK IT!!!!)
            Cache::forever('banned',BanList::all(['ip'])->map(function($x){
                return $x->ip;
            })->all());
            }
        }
    }
}
