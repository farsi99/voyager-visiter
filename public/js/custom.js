(function ($) {
    "use strict";
    $(document).ready(function () {

        /*
        Mean Menu Responsive
        ============================*/
        $('nav#main-menu').meanmenu();
        /*
        Slider Crousel
        ============================*/
        $(".all-slide").owlCarousel({
            items: 1,
            nav: true,
            dots: false,
            autoplay: true,
            loop: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            mouseDrag: false,
            touchDrag: false,
        });

        $(".all-slide").on("translate.owl.carousel", function () {
            $(".slider-text *").removeClass("animated fadeInUp").css("opacity", "0");
            $(".slider-text *").removeClass("animated fadeInDown").css("opacity", "0");
        });

        $(".all-slide").on("translated.owl.carousel", function () {
            $(".slider-text *").addClass("animated fadeInUp").css("opacity", "1");
            $(".slider-text *").addClass("animated fadeInDown").css("opacity", "1");
        });


        /*
        Property Crousel
        ============================*/
        $(".property-thumb").owlCarousel({
            autoPlay: false,
            slideSpeed: 2000,
            nav: true,
            dots: false,
            pagination: false,
            navigation: true,
            items: 1,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        });




        /*
        Date Picker
        ============================*/
        $("#arrival-date").datepicker();
        $("#arrival-date").datepicker("option", "showAnim", 'slideDown');
        $("#outgoing-date").datepicker();
        $("#outgoing-date").datepicker("option", "showAnim", 'slideDown');
        /*
        scrollUp
        ============================*/
        $.scrollUp({
            scrollText: '<i class="fa fa-angle-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });
        /*
        Counter Js
        ============================*/
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
        /*
        Stikey Js
        ============================*/
        (function () {
            var nav = $('.mnmenu-sec');
            var scrolled = false;
            $(window).scroll(function () {
                if (120 < $(window).scrollTop() && !scrolled) {
                    nav.addClass('sticky_menu animated fadeInDown').animate({ 'margin-top': '0px' });
                    scrolled = true;
                }
                if (120 > $(window).scrollTop() && scrolled) {
                    nav.removeClass('sticky_menu animated fadeInDown').css('margin-top', '0px');
                    scrolled = false;
                }
            });
        }());
        /*
        Magnific Popup
        ============================*/
        $('.gallery-photo').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
        });
        /*
        Preeloader
        ============================*/
        $(window).load(function () {
            $('#preloader').fadeOut();
            $('#preloader-status').delay(200).fadeOut('slow');
            $('body').delay(200).css({ 'overflow-x': 'hidden' });
        });

        /*
        Popup de connexion
        ============================
        */
        $(".connect").click(function () {
            $(".popin").toggle('slow');
        });

        $('.btn-fermer').click(function () {
            $(".popin").toggle('slow');
        });

        //ajax pour la connextion
        $("#formlogin").click(function () {
            var url = $("#urlLogin").val(),
                username = $("#username").val(),
                password = $("#password").val();
            $.ajax({
                type: 'post',
                data: { '_username': username, '_password': password },
                url: url,
                success: function (data) {
                    if (data == 'success') {
                        return true;
                    } else {
                        return false;
                    }
                }

            });
        });

    });
})(jQuery);
