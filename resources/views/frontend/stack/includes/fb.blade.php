<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId   :   '1500759416886149',
            status  :   true,
            xfbml   :   true,
            version :   'v2.5',
            cookie  :   true
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>