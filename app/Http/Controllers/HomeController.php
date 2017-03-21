<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Request as R;
use \App\Events\BanListEvent;

class HomeController extends Controller
{
   
    public function __construct(){
         event(new BanListEvent);
    }

    public function main(){
        $ip = R::ip();
        $banned = Cache::get('banned',null);
        Log::info([$banned,$ip]);
        if(in_array($ip, $banned))
                return abort(404);
        return view('main');
    }
    public function panel(){
        return view('admin');
    }
    
}
