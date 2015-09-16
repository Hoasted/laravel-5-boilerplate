<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Tientje van Treatwell! Wil jij ook € 10 korting bij een beauty-, massage-, of kapsalon? Als jij je aanmeldt dan spaar ik voor nóg meer korting.</title>
    <meta name="description" content="Jij gunt je vrienden toch wel een ontspannen massage nieuwe coupe of verzorgde nagels? Deel nu super makkelijk deze actie en ontvang nog meer Treatwell korting. Als je vrienden meedoen aan deze actie, ontvangen zij ook een Tientje van Treatwell in hun mail. Hoe meer vrienden zich via jou aanmelden, hoe meer korting jij krijgt. Win-win dus!">
    <meta name="author" content="Treatwell">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@treatwellnl">
    <meta name="twitter:title" content="Tientje van Treatwell! Wil jij ook € 10 korting bij een beauty-, massage-, of kapsalon? Als jij je aanmeldt dan spaar ik voor nóg meer korting.">
    <meta name="twitter:description" content="Jij gunt je vrienden toch wel een ontspannen massage nieuwe coupe of verzorgde nagels? Deel nu super makkelijk deze actie en ontvang nog meer Treatwell korting. Als je vrienden meedoen aan deze actie, ontvangen zij ook een Tientje van Treatwell in hun mail. Hoe meer vrienden zich via jou aanmelden, hoe meer korting jij krijgt. Win-win dus!">
    <meta name="twitter:creator" content="@treatwellnl">
    <meta name="twitter:image" content="/img/treatwell-header.jpg">

    <meta property="og:title" content="Tientje van Treatwell! Wil jij ook € 10 korting bij een beauty-, massage-, of kapsalon? Als jij je aanmeldt dan spaar ik voor nóg meer korting." />
    <meta property="og:url" content="https://www.tientjevantreatwell.nl/" />
    <meta property="og:image" content="/img/treatwell-header.jpg" />
    <meta property="og:description" content="Jij gunt je vrienden toch wel een ontspannen massage nieuwe coupe of verzorgde nagels? Deel nu super makkelijk deze actie en ontvang nog meer Treatwell korting. Als je vrienden meedoen aan deze actie, ontvangen zij ook een Tientje van Treatwell in hun mail. Hoe meer vrienden zich via jou aanmelden, hoe meer korting jij krijgt. Win-win dus!" /> 
    <meta property="og:site_name" content="Tientje van Treatwell" />

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
</body>
</html>
