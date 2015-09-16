@extends('frontend.stack.master')

@section('nav')
    @include('frontend/stack/includes/nav')
@endsection

@section('content')
    <div class="row">

        <div class="col-sm-10 col-sm-offset-1">
            <img class="st img-responsive" src="https://images.treatwell.com/jdP_ikhIOLvPpPWR65xtGYAa2qs=/810x543/00d81edcd49641e08696a3490e2d5477/Detailpage_GiftCardimage_509_1.jpg">
            <div class="st content">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="st header">
                            <h4>{{ $content['subtitle'] }}</h4>
                            <hr>
                            <h3>{{ $content['title'] }}</h3>
                            <p>{{ $content['body'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="st signup">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-center">
                        <h3>{{ $content['signuptitle'] }}</h3>
                        <p>{{ trans('messages.signupwith') }}</p>
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
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('messages.email')]) !!}
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                <span class="input-group-btn">
                                    {!! Form::submit(trans('messages.submit'), ['class' => 'st btn btn-email']) !!}
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