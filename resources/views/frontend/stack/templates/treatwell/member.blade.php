@extends('frontend.stack.master')

@section('nav')
    @include('frontend/stack/includes/nav')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10 col-sm-offset-1">
            <img class="st img-responsive" src="/img/bedankt-header-image-treatwell.jpg">
            <div class="st content member">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <h3>{{ $content['title'] }}</h3>
                            <p>{{ $content['body'] }} </p>
                            <p>Je hebt nu {{ $member->referred->count() }} vrienden aangebracht. Zorg er ook voor dat ze boeken!</p>
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
                        <p class="text-center">Wees er snel bij! Je vrienden moeten zich aangemeld hebben binnen: <br/><span class="kkcountdown" data-time="1444435200"></span></p>
                        <div class="share-buttons text-center">
                            <a class="share-fb btn">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a class="share-twitter btn" href="https://twitter.com/intent/tweet?text={{ urlencode('Wil jij ook € 10 korting bij je favoriete salon? Als jij je aanmeldt dan spaar ik voor nóg meer korting.') }}&url={{ urlencode($share['url']) }}">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a class="share-wa btn visible-xs-inline-block" href="whatsapp://send?text={{ 'Hey! Ik heb net van Treatwell € 10 korting gekregen op een kapper, massage- of beautysalon. Als jij je nu via deze link aanmeldt krijg je ook een tientje korting! ' . $share['url'] }}" data-action="share/whatsapp/share">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a class="share-email btn" href="mailto:?subject=Wil%20je%20ook%20%E2%82%AC10%20korting%20op%20je%20favoriete%20salon%3F&amp;body=Hi!%20Je%20kan%20nu%20super%20makkelijk%20%E2%82%AC10%20korting%20krijgen%20op%20een%20kapper%2C%20massage-%20of%20beautysalon%20bij%20jou%20in%20de%20buurt.%20Meld%20je%20vandaag%20aan%20voor%20het%20Tientje%20van%20Treatwell%20en%20claim%20ook%20jouw%20korting.%20Ik%20heb%20het%20net%20ook%20gedaan!%0A%0ABonus%20voor%20mij%3A%20als%20jij%20je%20aanmeldt%20via%20deze%20link%20dan%20spaar%20ik%20voor%20n%C3%B3g%20meer%20korting.%0A%0A{{ urlencode($share['url']) }}">
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
