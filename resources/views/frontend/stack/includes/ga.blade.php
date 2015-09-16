
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            @if(isset($member) && isset($analytics))
                ga('create','{{ $analytics['ga'] }}',{'userId': '{{$member->id}}'});ga('send','pageview');
            @else
                ga('create','{{ $analytics['ga'] }}','auto');ga('send','pageview');
            @endif

        </script>
