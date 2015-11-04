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
            <img class="st img-responsive" src="/img/sint-header-title.jpg">
            <div class="st content">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <p>Laat je kind(eren) een tekening voor Sinterklaas maken. 's Avonds doen ze de tekening in hun schoen. Maak een foto van de tekening en voeg deze tekening toe aan de video. Je ontvangt een video download per e-mail waarin Sinterklaas de kinderen vertelt dat hij heel erg blij is met de mooie tekening. Zo blij zelfs dat hij de tekening heeft ingelijst.</p>
                            <p><strong>Doe mee met deze actie en ontvang deze video geheel gratis.</strong></p>
                            <p>
                            1. Meld je aan.<br />
                            2. Ontvang de cadeaucode voor de video<br />
                            3. Laat je kind een tekening maken voor Sinterklaas en stop deze in zijn/haar schoen<br />
                            4. Ga naar Sint.tv en upload de tekening<br />
                            5. Ontvang direct de video en laat hem de volgende ochtend zien aan jouw kind<br />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="st signup">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <h3>CLAIM DE CADEAUCODE !</h3>
                        <p>Meld je aan via:</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 text-center">
                        <a href="#" class="st btn-facebook btn btn-lg btn-block fb-login"><i class="fa fa-facebook-official"></i> Facebook</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2 text-center">
                        <p class="divider">{{ trans('messages.or') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        {!! Form::open(['class' => '', 'url' => 'auth/email']) !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Jouw email']) !!}
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('', ['class' => 'st btn btn-email']) !!}
                                </span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="hidden fbCustomEmail">
                    {!! Form::open(['class' => '', 'id' => 'fbCustomEmailForm', 'url' => 'auth/facebook']) !!}
                    {!! Form::hidden('email', null, ['id' => 'fbCustomEmail']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection

@section('footer')
    @include('frontend/stack/includes/footer')
@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop

@section('after-body-open')
    @include('frontend/stack/includes/fb')
@endsection