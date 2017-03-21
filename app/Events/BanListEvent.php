<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\BanList;

class BanListEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $update,$remove;
    public function __construct($update=null,$remove=null)
    {
        $this->update = $update;
        $this->remove = $remove;
        if(!Cache::get('banned',null)){
            Cache::forever('banned',BanList::all(['ip'])->map(function($x){
                return $x->ip;
            })->all());
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
   
}
