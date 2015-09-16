@extends('frontend.stack.master')

@section('nav')
    @include('frontend/stack/includes/nav')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10 col-sm-offset-1">
            <img class="st img-responsive" src="/img/treatwell-header.jpg">
            <div class="st content member">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <h4>{{ $content['subtitle'] }}</h4>
                            <hr>
                            <h3>{{ $content['title'] }}</h3>
                            <p>{{ $content['body'] }} </p>
                            <p>Je hebt nu {{ $member->referred->count() }} vrienden aangebracht, spaar nu snel voor meer!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row text-center">
                            <div class="st rewards col-xs-12">
                                @foreach($stack->tiers()->get() as $index => $tier)
                                    <div class="col-xs-3">
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
                        <p class="text-center">Wees er snel bij! Je vrienden moeten zich aangemeld hebben binnen: <br/><span class="kkcountdown" data-time="1443139200"></span></p>
                        <div class="share-buttons text-center">
                            <a class="share-fb btn">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a class="share-twitter btn" href="https://twitter.com/intent/tweet?text={{ urlencode('Wil jij ook € 10 korting bij een beauty-, massage-, of kapsalon? Als jij je aanmeldt dan spaar ik voor nóg meer korting.') }}&url={{ urlencode($share['url']) }}">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a class="share-wa btn visible-xs-inline-block" href="whatsapp://send?text={{ 'Hey! Ik heb net € 10 korting gekregen op een behandeling bij één van de ruim 1700 beauty-, massage- en kapsalons op Treatwell.nl. Als jij je nu aanmeldt krijg je ook een tientje korting! Bonus voor mij: als jij je dat doet via deze link dan spaar ik voor nóg meer korting :-). ' . $share['url'] }}" data-action="share/whatsapp/share">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a class="share-email btn" href="mailto:?&subject=Krijg%20een%20tientje%20van%20Treatwell!&body=Spread%20the%20beauty!%20Ik%20heb%20net%20€%2010%20korting%20gekregen%20op%20een%20behandeling%20bij%20één%20van%20de%201700%20beauty-,%20massage-%20en%20kapsalons%20op%20Treatwell.nl.%20Claim%20nu%20ook%20jouw%20korting!%0D%0A%0D%0ABonus%20voor%20mij:%20als%20jij%20je%20aanmeldt%20via%20deze%20link%20dan%20spaar%20ik%20voor%20nóg%20meer%20korting.%0D%0A%0D%0A{{ urlencode($share['url']) }}">
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