<?php

namespace App\Listeners\Frontend;

use App\Events\Frontend\StackActionProcessing;
use App\Events\Frontend\StackMemberSignedUp;
use App\StackActionLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Event;

class StackMemberReachedTierHandler
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
     * @param  StackMemberSignedUp  $event
     * @return void
     */
    public function handle(StackMemberSignedUp $event)
    {
        $stackMemberReferrer = $event->stackMember->referredBy()->first();
        if($stackMemberReferrer)
        {
            $stack = $stackMemberReferrer->stack()->first();
            $stackTiers = $stack->tiers()->get();
            $reachedStackTier = $stackTiers->where('signups_required', $stackMemberReferrer->referred()->count())->first();
            if($reachedStackTier)
            {
                $actions = $reachedStackTier->actions()->get();
                if(count($actions) > 0)
                {
                    foreach($actions as $action)
                    {
                        $stackActionLog = new StackActionLog();
                        $stackActionLog->action_id = $action->id;
                        $stackActionLog->member_id = $stackMemberReferrer->id;
                        $stackActionLog->has_run = false;
                        $stackActionLog->save();
                        Event::fire(new StackActionProcessing($stackActionLog, 'realtime'));
                    }
                }
            }

            // $actions = $stack->actions()->where('tier_id', '=', null)->where('is_enabled','=',true)->get();
            // if(count($actions) > 0)
            // {
            //     foreach($actions as $action)
            //     {
            //         $stackActionLog = StackActionLog::where('action_id', '=', $action->id)->where('member_id', '=', $stackMemberReferrer->id)->first();
            //         if(!$stackActionLog)
            //         {
            //             $stackActionLog = new StackActionLog();
            //             $stackActionLog->action_id = $action->id;
            //             $stackActionLog->member_id = $stackMemberReferrer->id;
            //             $stackActionLog->has_run = false;
            //             $stackActionLog->save();
            //         }
            //         Event::fire(new StackActionProcessing($stackActionLog, 'realtime'));
            //     }
            // }
        }
    }
}
