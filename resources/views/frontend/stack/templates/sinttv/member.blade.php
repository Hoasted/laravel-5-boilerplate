@extends('frontend.stack.master')

@section('nav')
    @include('frontend/stack/includes/nav')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10 col-sm-offset-1">
            <div class="st video">
                {{-- <img class="st img-responsive" src="/img/sint-header-video.jpg"> --}}
                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://player.vimeo.com/video/140920074' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
            </div>
            <img class="st img-responsive" src="/img/sint-header-title-2.jpg">
            <div class="st content member">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <h3>Ontvang korting op je persoolijke sint.tv video, Deel deze actie met je vrienden!</h3>
                            <p>Jij gunt je vrienden toch ook de gratis tekening in schoen video? Deel nu super makkelijk deze actie en ontvang nog meer korting bij Sint.tv. Als je vrienden meedoen met deze actie ontvangen ook zij de gratis tekening in je schoen video. Hoe meer vrienden zich via jou aanmelden en een video maken, hoe meer korting jij verdient. De actie loopt t/m 5 december 2015.</p>
                            <p><strong>Je hebt nu {{ $member->referred->count() }} vrienden aangebracht. Zorg er ook voor dat ze een tekening in schoen video maken.</strong></p>
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
                                    <div style="left:{{ $tier->position }}%;" class="tier-{{ $index + 1 }} {{ ($member->referred->count() >= $tier->signups_required) ? 'active-color progress-bar-color' : 'no-color' }}"><span><strong>{{ $tier->small_description }}</strong></span></div>
                                @endforeach
                                <div class="progress-bar progress-bar-color" style="width: {{ $barPosition }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row st share">
                    <div class="col-xs-10 col-xs-offset-1">
                        <h3 class="text-center">{{ $content['sharetitle'] }}</h3>
                        <p class="text-center">Wees er snel bij! Je vrienden moeten zich aangemeld hebben binnen: <br/><span class="kkcountdown" data-time="1449273600"></span></p>
                        <div class="share-buttons text-center">
                            <a class="share-fb btn">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a class="share-twitter btn" href="https://twitter.com/intent/tweet?text={{ urlencode('Gratis Video Sint.tv') }}&url={{ urlencode($share['url']) }}">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a class="share-wa btn visible-xs-inline-block" href="whatsapp://send?text={{ 'Gratis Video Sint.tv ' . $share['url'] }}" data-action="share/whatsapp/share">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                            <a class="share-email btn" href="mailto:?subject=Gratis%20Video%20Sint.tv&body=Gratis%20Video%20Sint.tv%0A%0A{{ urlencode($share['url']) }}">
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
