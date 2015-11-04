<!doctype html>
<html class="no-js" lang="en">
<head>
    <!--
        Application built by Hoasted
        Visit our website at hoasted.com
    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Gratis Video Sint.tv</title>
    <meta name="description" content="Gratis Video Sint.tv">
    <meta name="author" content="Sint.tv">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@sinttv">
    <meta name="twitter:title" content="Gratis Video Sint.tv">
    <meta name="twitter:description" content="Gratis Video Sint Tv">
    <meta name="twitter:creator" content="@sinttv">
    <meta name="twitter:image" content="">

    <meta property="og:title" content="Gratis Video Sint.tv" />
    <meta property="og:url" content="https://gratis.sint.tv/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" /> 
    <meta property="og:site_name" content="Gratis Sint.tv" />
    <meta property="fb:app_id" content="1500759416886149" />

    @yield('meta')

    @yield('before-styles-end')
    {!! HTML::style('css/vendor/sweetalert2.css') !!}
    {!! HTML::style(elixir('css/frontend.css')) !!}
    @yield('after-styles-end')

    @yield('before-javascript')

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- Icons-->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    {!! HTML::script("js/vendor/modernizr-2.8.3.min.js") !!}
    @include('frontend.stack.includes.translation')
</head>
<body class="st">
@yield('after-body-open')
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

@yield('nav')
<div class="st container">
    @include('includes.partials.messages')
    @yield('content')
</div><!-- container -->
@yield('footer')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
{!! HTML::script('js/vendor/bootstrap.min.js') !!}

@yield('before-scripts-end')
{!! HTML::script('js/vendor/sweetalert2.min.js') !!}
{!! HTML::script('js/vendor/kkcountdown.js') !!}
{!! HTML::script(elixir('js/frontend.js')) !!}
@yield('after-scripts-end')

@include('frontend.stack.includes.ga')
<!--
        Application built by Hoasted
        Visit our website at hoasted.com
-->
</body>
</html>
