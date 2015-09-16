@extends('frontend.stack.master')

@section('nav')
    @include('frontend/stack/includes/nav')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10 col-sm-offset-1">
            <img class="st img-responsive" src="https://images.treatwell.com/jdP_ikhIOLvPpPWR65xtGYAa2qs=/810x543/00d81edcd49641e08696a3490e2d5477/Detailpage_GiftCardimage_509_1.jpg">
            <div class="st content member">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <h4>{{ $content['subtitle'] }}</h4>
                            <hr>
                            <h3>{{ $content['title'] }}</h3>

                            <p><span class="kkcountdown" data-time="1441974469"></span></p>
                            <p>{{ $content['body'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row text-center">
                            <div class="st rewards col-xs-12">
                                @foreach($stack->tiers()->get() as $index => $tier)
                                    <div style="float:left; display: inline-block; width: {{ (100 / $stack->tiers()->count()) - 0.01 }}%;">
                                        @if($tier->image)
                                            <img class="img-responsive img-circle" src="{{ $tier->image }}" />
                                        @endif
                                        <p>{{ $tier->description }}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st progress-tiers">
                            <div class="progress tiers-{{ $stack->tiers()->count() }}">
                                @foreach ($stack->tiers()->get() as $index => $tier)
                                    <div style="left:{{ $tier->position }}%;" class="tier-{{ $index + 1 }} {{ ($member->referred->count() >= $tier->signups_required) ? 'active-color progress-bar-color' : 'no-color' }}"><span>{{ $tier->signups_required }}</span></div>
                                @endforeach
                                <div class="progress-bar progress-bar-color" style="width: {{ $barPosition }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row st share">
                    <div class="col-xs-10 col-xs-offset-1">
                        <h3 class="text-center">{{ $content['sharetitle'] }}</h3>
                        <div class="share-buttons text-center">
                            <a class="share-fb btn">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a class="share-twitter btn" href="https://twitter.com/intent/tweet?text={{ urlencode($share['prefilled']) }}&url={{ urlencode($share['url']) }}">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a class="share-wa btn visible-xs-inline-block" href="whatsapp://send?text={{ $share['prefilled'] }}" data-action="share/whatsapp/share">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a class="share-email btn" href="mailto:?bcc=share%40app.treatwell.nl&subject=Sparen%20voor%20een%20gratis%20behandeling&body=%20%20%20Hallo%20vriend%21%20%20%20%0D%0A%20%20%20%20%20%20%0D%0A%20%20%20Bij%20Treatwell%20kan%20ik%20sparen%20voor%20een%20gratis%20behandeling%21%20Wil%20jij%20dit%20ook%20of%20wil%20je%20me%20helpen%20sparen%3F%20%20%20%0D%0A%20%20%20%20%20%20%0D%0A%20%20%20Schrijf%20je%20dan%20hier%20in%3A%20http%3A%2F%2Ftest-app.social.dev%2Freferral%2FSCKCShBpho9pAxEE%20%20%20">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </div>
                        <p class="text-center share-manual">{{ trans('messages.sharemanual') }}</p>
                        <div class="text-center col-xs-8 col-xs-offset-2">
                            <div class="input-group">
                                <input type="text" class="form-control text-center copy-link" value="{{ $share['url'] }}" onClick="this.select();" readonly>
                                <div id="copy-link" class="btn btn-primary input-group-addon" title="{{ trans('messages.linkcopied') }}" data-clipboard-text="{{ $share['url'] }}"><i class="fa fa-clipboard"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection

@section('footer')
    @include('frontend/stack/includes/footer')
@endsection

@section('after-scripts-end')
    <script src="/js/vendor/ZeroClipboard.min.js"></script>
@stop

@section('after-body-open')
    @include('frontend/stack/includes/fb')
    @include('frontend/stack/includes/twitter')
@endsection

@section('before-javascript')
    <script>
        function getShareUrl()
        {
            return '{{ $share['url'] }}';
        }

        function getSharePrefilled()
        {
            return '{{ $share['prefilled'] }}';
        }

        function getShareTitle()
        {
            return '{{ $share['title'] }}';
        }

        function getShareDescription()
        {
            return '{{ $share['description'] }}';
        }
    </script>
@endsection