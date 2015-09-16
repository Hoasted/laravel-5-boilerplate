$(function(){
    $(document).ready(function()
    {
        $(".kkcountdown").kkcountdown();
    });

    $('.st.fb-login').on('click', function(e)
    {
        e.preventDefault()
        ga('send', 'event', 'button', 'click', 'facebookAuth');
        FB.login(function(response)
        {
        if(response && response.authResponse && response.status === 'connected')
           {
               var grantedScopes = response.authResponse.grantedScopes.split(",");
               if(grantedScopes.indexOf('email') >= 0)
               {
                   FB.api('/me?fields=email', function(response)
                   {
                       swal({
                           title: trans.emailcorrect,
                           text: response.email,
                           type: "info",
                           showCancelButton: true,
                           confirmButtonColor: "#4dc247",
                           confirmButtonText: trans.yes,
                           allowOutsideClick: false,
                           cancelButtonText: trans.no,
                           closeOnConfirm: false,
                           closeOnCancel: false
                       }, function(isConfirm){
                           if (isConfirm) {
                               ga('send', 'event', 'button', 'click', 'facebook-email-correct');
                               window.location.href = '/auth/facebook';
                           } else {
                               $("body").on('keyup', '#fb-email-confirmation', function (e)
                               {
                                   if (e.keyCode == 13) {
                                       afterSwalFbConfirmation();
                                   }
                               });
                               swal({
                                   title: "What is your correct email?",
                                   html: '<div id="fb-email-confirmation-group" class="form-group"><p id="fb-email-confirmation-error"></p><input class="confirm-input form-control" id="fb-email-confirmation" type="email" placeholder="Email" /></div>',
                                   confirmButtonText: trans.submit,
                                   closeOnConfirm: false,
                                   allowOutsideClick: false,
                                   inputType: "email",
                               }, afterSwalFbConfirmation);
                               $('#fb-email-confirmation').select();
                           }
                       });
                   });

                   //window.location.href = '/auth/facebook';
               } else {
                   swal("Ooops..", trans.nopermission, "error");
               }
           }
        }, {
            scope: 'email',
            return_scopes: true,
            auth_type: 'rerequest'
        });
    });

    $('.share-fb').on('click', function(e)
    {
        e.preventDefault();
        ga('send', 'event', 'button', 'click', 'share-facebook');
        FB.ui(
            {
                method: 'share',
                href: getShareUrl()
            }, function(response)
            {
                $.ajax
                (
                    {
                        url: '/collect/share/facebook',
                        cache: false
                    }
                ).done(function(response)
                    {
                        ga('send', 'social', 'facebook', 'share', getShareUrl());
                    }
                );
            }
        )
    });

    $('.share-twitter').on('click', function(e)
    {
        e.preventDefault();
        ga('send', 'event', 'button', 'click', 'share-twitter');
        twttr.events.bind('tweet', function(event)
        {
            $.ajax
            (
                {
                    url: '/collect/share/twitter',
                    cache: false
                }
            ).done(function(response)
                {
                    ga('send', 'social', 'facebook', 'tweet', getShareUrl());
                }
            );
        });
    });

    $('.share-wa').on('click', function(e)
    {
        ga('send', 'event', 'button', 'click', 'share-whatsapp');
    });

    $('.share-email').on('click', function(e)
    {
        ga('send', 'event', 'button', 'click', 'share-email');
    });


    if (window.location.href.indexOf("member/") > -1) {
        var zClient = new ZeroClipboard( $("#copy-link") );
        zClient.on( "ready", function( readyEvent )
        {
            // alert( "ZeroClipboard SWF is ready!" );
            zClient.on("aftercopy", function (event)
            {
                // `this` === `client`
                // `event.target` === the element that was clicked
                //event.target.style.display = "none";
                ga('send', 'event', 'button', 'click', 'copy-link-to-clipboard');
                $('#copy-link').tooltip({placement: 'right',trigger: 'manual'}).tooltip('show');
                setTimeout(function()
                {
                    $('#copy-link').tooltip('hide');
                }, 1000);
            });
        });
    }

    function IsEmail(email)
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function afterSwalFbConfirmation(data)
    {
        swal.disableButtons();
        var email = $('#fb-email-confirmation').val();
        if(IsEmail(email) === true)
        {
            submitFacebookEmail(email);
        } else {
            $('#fb-email-confirmation-group').addClass('has-error');
            $('#fb-email-confirmation-error').html(trans.emailnotvalid);
            swal.enableButtons();
        }
    }

    function submitFacebookEmail(email)
    {
        ga('send', 'event', 'button', 'click', 'facebook-email-custom');
        $('#fbCustomEmail').val(email);
        $('#fbCustomEmailForm').submit();
    }
});