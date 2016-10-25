$(function() {
    //Load Facebook + Twitter SDK
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        (navigator.language == 'fr') ? js.src = "http://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8" : js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8"
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));

    //Off-canvas menu
    $('[data-toggle="offcanvas"]').on('click', function() {
        $('.row-offcanvas-left').toggleClass('active');
        if ($('.row-offcanvas-left').hasClass('active')) {
            $('#btnTextXS').blur();
            $('#btnTextXS').text('X');
        } else {
            $('#btnTextXS').text('Menu');
            $('#btnTextXS').blur();
        }
    });

    //Patch visuel de la présentation du menu si on n'est pas sur mobile
    if ($(window).width() > 767) {
        $('#listMenu').wrap('<div class="row"></div>');
    }
});