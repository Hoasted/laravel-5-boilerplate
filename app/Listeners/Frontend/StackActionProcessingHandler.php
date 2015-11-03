<?php

namespace App\Listeners\Frontend;

use App\Events\Frontend\StackActionProcessing;
use App\Providers\EmarsysServiceProvider;
use App\StackAction;
use App\StackActionLog;
use App\StackIntegration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

//class StackActionProcessingHandler implements ShouldQueue
class StackActionProcessingHandler
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
     * @param  StackActionProcessing  $event
     * @return void
     */
    public function handle(StackActionProcessing $event)
    {
        $stackActionLog = $event->stackActionLog;
        if($stackActionLog->has_run == false)
        {
            $stackAction = $stackActionLog->action()->first();
            if( ($event->type === 'realtime' && $stackAction->type === 'realtime') || ($event->type === 'batch' && $stackAction->type === 'batch'))
            {
                $stackIntegration = $stackAction->integration;
                if($stackIntegration->is_enabled == true)
                {
                    switch($stackIntegration->type)
                    {
                        case 'emarsys':
                            $result = $this->handleEmarsys($stackIntegration, $stackAction, $stackActionLog);
                            break;
                        case 'facebook':
                            $result = $this->handleFacebook($stackIntegration, $stackAction, $stackActionLog);
                    }
                }
            }
        }
    }

    /**
     * @param StackIntegration $stackIntegration
     * @param StackAction $stackAction
     */
    private function handleEmarsys(StackIntegration $stackIntegration, StackAction $stackAction, StackActionLog $stackActionLog)
    {
        if($stackIntegration->config['username'] && $stackIntegration->config['password'])
        {
            $stackMember = $stackActionLog->member()->first();
            $emarsys = new \App\Services\Emarsys($stackIntegration->config['username'], $stackIntegration->config['password']);
            $triggerCampaignData = array
            (
                'key_id' => "3",
                "external_id" => $stackMember->email,
                "data" => null
            );
            $triggerCampaignData = json_encode($triggerCampaignData);
            $triggerCampaign = $emarsys->send('POST', 'event/788/trigger', $triggerCampaignData);
            $stackActionLog->has_run = true;
            $stackActionLog->ran_on = \Carbon\Carbon::now();
            $stackActionLog->save();
        } else {
            return false;
        }

    }

    /**
     * @param StackIntegration $stackIntegration
     * @param StackAction $stackAction
     * @param StackActionLog $stackActionLog
     */
    private function handleFacebook(StackIntegration $stackIntegration, StackAction $stackAction, StackActionLog $stackActionLog)
    {
        dd($stackActionLog->member());
    }
}
