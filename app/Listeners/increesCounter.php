<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\HttpKernel\EventListener\SaveSessionListener;

class increesCounter
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
    public function handle(VideoViewer $event)
    {
        if(!Session()->has('videoVisited')){
            $this ->updateVideo($event -> video);
        }else{
            return false;
        }
        
    }
    function updateVideo($video){
        $video -> viewer =  $video -> viewer + 1;
        $video -> save();
        Session()->put('videoVisited',$video->id);
    }
}
