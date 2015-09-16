<?php

namespace App\Listeners\Frontend;

use App\Events\Frontend\StackMemberSignedUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Providers\EmarsysServiceProvider;

class StackMemberSignedUpHandler
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
        $stackMember = $event->stackMember;
        if($stackMember->is_valid_signup_ip == true)
        {
            $stack = $stackMember->stack()->first();
            $stackIntegration = $stack->integrations()->where('type', '=', 'emarsys')->first();
            $emarsys = new \App\Services\Emarsys($stackIntegration->config['username'], $stackIntegration->config['password']);
            $findUser = $emarsys->send('GET', 'contact/3=' . $stackMember->email);
            if($findUser->replyCode == 0){
                //USER FOUND
            } else {
                $emarsysUser = array
                (
                  '3' => $stackMember->email,
                  '31' => '1',
                  '5533' => '3',
                  '5982' => 'Facebook App',
                  '8103' => '3',
                  '8309' => 'NL',
                  '8310' => 'Netherlands'
                );
                $emarsysUser = json_encode($emarsysUser);
                $createUser = $emarsys->send('POST', 'contact', $emarsysUser);
            }
            
        }
        
    }
}
