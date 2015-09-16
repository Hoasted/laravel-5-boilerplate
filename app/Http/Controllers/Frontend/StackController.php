<?php namespace App\Http\Controllers\Frontend;

use Event;
use App\Events\Frontend\StackMemberSignedUp;
use App\StackIntegration;
use App\StackIp;
use App\StackMember;
use Facebook\Authentication\AccessToken;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Stack;
use Illuminate\Support\Facades\View;

class StackController extends Controller
{
    public function show(Request $request, $slug, $referral_token = null)
    {
        $data = [];
        $stack = Stack::where('slug' , '=', $slug)->firstOrFail();
        $referral_user = $stack->members()->where('referral_token', $referral_token)->first();
        if($referral_user){
            $request->session()->put('referral_user', $referral_user->id);
        }

        $content = $stack->content()->where('key', '=', 'index.content')->first();
        if($content){
            $data['content'] = $content->meta;
        }

        $analytics = $stack->content()->where('key', '=', 'general.analytics')->first();
        if($analytics)
        {
            $data['analytics'] = $analytics->meta;
        }
        $template = $stack->template()->first();
        if($template)
        {
            return view('frontend.stack.templates.' . $template->slug . '.index', $data);
        } else {
            return view('frontend.stack.index', $data);
        }
    }

    public function member(Request $request, $slug, $referral_token)
    {
        $data = [];
        $stack = Stack::where('slug' , '=', $slug)->firstOrFail();
        $stackMember = $stack->members()->where('referral_token', $referral_token)->first();
        $referralCount = $stackMember->referred->count();
        $request->session()->put('stackMember_id', $stackMember->id);

        $barPosition = 0;
        foreach($stack->tiers()->get() as $index => $tier)
        {
            if($stackMember->referred()->count() >= $tier->signups_required)
            {
                $barPosition = $tier->position;
            }
        }

        $content = $stack->content()->where('key', '=', 'member.content')->first();
        if($content){
            $data['content'] = $content->meta;
        }

        $analytics = $stack->content()->where('key', '=', 'general.analytics')->first();
        if($analytics)
        {
            $data['analytics'] = $analytics->meta;
        }

        $share = $stack->content()->where('key', '=', 'general.share')->first();
        if($share){
            $data['share'] = $share->meta;
        }
        //TODO
        $data['stack'] = $stack;
        $data['member'] = $stackMember;
        $data['barPosition'] = $barPosition;
        $data['share']['url'] = url('referral/' . $referral_token);;
        $data['share']['email'] = View::make('frontend/stack/email/share/basic');

        $template = $stack->template()->first();
        if($template)
        {
            return view('frontend.stack.templates.' . $template->slug . '.member', $data);
        } else {
            return view('frontend.stack.member', $data);
        }
    }

    public function facebookAuth(Request $request, $slug)
    {
        try
        {
            $stack = Stack::where('slug' , '=', $slug)->firstOrFail();
            $stackIntegration = StackIntegration::where('stack_id', '=', $stack->id)->where('type', '=', 'facebook')->where('is_enabled', '=', true)->firstOrFail();
            $fb = new Facebook([
                'app_id' => $stackIntegration->config['appId'],
                'app_secret' => $stackIntegration->config['appSecret'],
                'default_graph_version' => 'v2.4',
            ]);
            $jsHelper = $fb->getJavaScriptHelper();
            $accessToken = $jsHelper->getAccessToken();
            if(!isset($accessToken))
            {
                throw new Exeption('Facebook Authentication failed');
            }
            $fb->setDefaultAccessToken($accessToken);
            $response = $fb->get('/me?fields=email,name,first_name,last_name,locale,gender');
            $userNode = $response->getGraphUser();
            if ($request->has('email'))
            {
                $userNode['email'] = $request->input('email');
            }
            $stackMember = StackMember::where('stack_id', '=', $stack->id)->where('email', '=', $userNode['email'])->first();
            if(!$stackMember)
            {
                $validSignupIp = $this->validSignupIp($request, $stack);
                $stackMember = new StackMember();
                $stackMember->email = $userNode['email'];
                $stackMember->referral_token = $this->generateRandomToken($stack->id);
                $stackMember->is_valid_signup_ip = $validSignupIp;
                $stackMember->name = $userNode['name'];
                $stackMember->first_name = $userNode['first_name'];
                $stackMember->last_name = $userNode['last_name'];
                $stackMember->gender = $userNode['gender'];
                $stackMember->locale = $userNode['locale'];
                $stackMember->fb_id = $userNode['id'];
                $stackMember->fb_accesstoken = $accessToken;
                $stackMember->ip = $request->getClientIp();
                $stackMember->stack_id = $stack->id;
                if($request->session()->get('referral_user'))
                {
                    $stackMember->referred_by = $request->session()->get('referral_user');
                }
                $stackMember->save();
            } else {
                $stackMember->fb_id = $userNode['id'];
                $stackMember->fb_accesstoken = $accessToken;
                $stackMember->save();
            }
            Event::fire(new StackMemberSignedUp($stackMember));
            return redirect('member/' . $stackMember->referral_token);

        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        } catch(Exeption $e) {
            return redirect()->back()->withInput()->withErrors($e);
        }
    }

    public function emailAuth(Request $request, $slug)
    {
        try
        {
            $this->validate($request, [
                'email' => 'required|email'
            ]);

            $stack = Stack::where('slug' , '=', $slug)->firstOrFail();
            $stackMember = StackMember::where('stack_id', '=', $stack->id)->where('email', '=', $request->input('email'))->first();
            if(!$stackMember)
            {
                $validSignupIp = $this->validSignupIp($request, $stack);
                $stackMember = new StackMember();
                $stackMember->email = $request->input('email');
                $stackMember->referral_token = $this->generateRandomToken($stack->id);
                $stackMember->is_valid_signup_ip = $validSignupIp;
                $stackMember->ip = $request->getClientIp();
                $stackMember->stack_id = $stack->id;
                if($request->session()->get('referral_user'))
                {
                    $stackMember->referred_by = $request->session()->get('referral_user');
                }
                $stackMember->save();
            }
            Event::fire(new StackMemberSignedUp($stackMember));
            return redirect('member/' . $stackMember->referral_token);

        } catch(Exeption $e) {
            return redirect()->back()->withInput()->withErrors($e);
        }
    }

    public function facebookCollectShare(Request $request)
    {
        $response['success'] = false;
        if(!$request->session()->has('stackMember_id')){
            return $response;
        }
        $stackMember = \App\StackMember::find($request->session()->get('stackMember_id'));
        if($stackMember)
        {
            $stackShare = new \App\StackShare();
            $stackShare->member_id = $stackMember->id;
            $stackShare->type = 'facebook';
            $stackShare->ip = $request->getClientIp();
            $stackShare->save();
            $response['success'] = true;
            return $response;
        } else {
            return $response;
        }
    }

    public function twitterCollectShare(Request $request)
    {
        $response['success'] = false;
        if(!$request->session()->has('stackMember_id')){
            return $response;
        }
        $stackMember = \App\StackMember::find($request->session()->get('stackMember_id'));
        if($stackMember)
        {
            $stackShare = new \App\StackShare();
            $stackShare->member_id = $stackMember->id;
            $stackShare->type = 'twitter';
            $stackShare->ip = $request->getClientIp();
            $stackShare->save();
            $response['success'] = true;
            return $response;
        } else {
            return $response;
        }
    }

    private function validSignupIp($request, $stack)
    {
        $ip = StackIp::where('ip', '=', $request->getClientIp())->where('stack_id', '=', $stack->id)->first();
        if($ip)
        {
            StackIp::where('ip', '=', $request->getClientIp())->where('stack_id', '=', $stack->id)->increment('signups');
        } else {
            $ip = new StackIp();
            $ip->ip = $request->getClientIp();
            $ip->stack_id = $stack->id;
            $ip->signups = 1;
            $ip->save();
        }

        if($ip->signups >= $stack->max_signups_ip)
        {
            return false;
        } else {
            return true;
        }
    }

    private function generateRandomToken($stackId)
    {
        $validToken = false;
        while($validToken === false)
        {
            $randomToken = str_random(4);
            $memberWithToken = StackMember::where('stack_id', '=', $stackId)->where('referral_token', '=', $randomToken)->first();
            if(!$memberWithToken)
            {
                $validToken = true;
                return $randomToken;
            }
        }
    }

}
