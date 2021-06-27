<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MessageSending
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
    public function handle($event)
    {
    	if (!Storage::exists('rate-limiter.txt')) {
		    Storage::disk('public')->put('rate-limiter.txt',now());
		    Storage::disk('public')->put('counter.txt',1);
		}


		$timer = Carbon::parse(Storage::disk('public')->get('rate-limiter.txt'))->diffInHours(now());

		if($timer >= 1)
		{
			Storage::disk('public')->put('rate-limiter.txt',now());
			Storage::disk('public')->put('counter.txt',1);
		}

		$counter = Storage::disk('public')->get('counter.txt');

        if($timer < 1 && $counter < 15)
        {
			Storage::disk('public')->put('counter.txt',$counter = $counter + 499);

            return true;
        }
        else
        {
	        Storage::disk('public')->delete('rate-limiter.txt');
	        Storage::disk('public')->delete('counter.txt');
        	return false;
        }
    }
}
