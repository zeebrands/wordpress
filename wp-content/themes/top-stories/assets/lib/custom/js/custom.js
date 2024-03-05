window.addEventListener("load", function () {
    jQuery(document).ready(function ($) {
        "use strict";
        $("body").addClass("page-loaded");
    });
});

let timerInterval;
let timeClock = document.getElementById("twp-time-clock");


function myTimer() {
    const date = new Date();
    timeClock.innerHTML = date.toLocaleTimeString();
}

jQuery(document).ready(function ($) {
    "use strict";

    if(timeClock){
        timerInterval = setInterval(myTimer, 1000);
    }

    // Hide Comments
    $('.top-stories-no-comment .booster-block.booster-ratings-block, .top-stories-no-comment .comment-form-ratings, .top-stories-no-comment .twp-star-rating').hide();
    $('.tooltips').append("<span></span>");
    $(".tooltips").mouseenter(function () {
        $(this).find('span').empty().append($(this).attr('data-tooltip'));
    });
    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $(".site-content").offset().top
        }, 500);
    });
    // Rating disable
    if (top_stories_custom.single_post == 1 && top_stories_custom.top_stories_ed_post_reaction) {
        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();
    }
    // Add Class on article
    $('.theme-article-area').each(function () {
        $(this).addClass('theme-article-loaded');
    });
    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    // Header Search show
    $('.header-searchbar').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
    });
    $(".header-searchbar-inner").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
        $('body').removeClass('body-scroll-locked');
    });
    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function () {
        $('.header-searchbar').toggleClass('header-searchbar-active');
        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);
        $('body').addClass('body-scroll-locked');
    });
    $('input, a, button').on('focus', function () {
        if ($('.header-searchbar').hasClass('header-searchbar-active')) {
            if ($(this).hasClass('skip-link-search-top')) {
                $('.header-searchbar #search-closer').focus();
            }
            if (!$(this).parents('.header-searchbar').length) {
                $('.header-searchbar .search-field').focus();
            }
        }
    });
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('.header-searchbar').hasClass('header-searchbar-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);
            }
            if ($('body').hasClass('top-stories-trending-news-active')) {
                $('.trending-news-main-wrap').slideToggle();
                $('body').toggleClass('top-stories-trending-news-active');
                $('.navbar-control-trending-news').focus();
            }
        }
    });
    // Action On Esc Button
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);
            }
        }
    });
    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    // Offcanvas Close
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);
    });
    // Offcanvas Close
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Offcanvas re focus on close button
    $('input, a, button').on('focus', function () {
        if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
            if ($(this).hasClass('skip-link-off-canvas')) {
                if (!$("#offcanvas-menu #social-nav-offcanvas").length == 0) {
                    $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
                } else if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
                    $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
                }
            }
        }
    });
    $('.skip-link-offcanvas').focus(function () {
        $(".button-offcanvas-close").focus();
    });
    // Trending News Start
    $('.navbar-control-trending-news').click(function () {
        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('top-stories-trending-news-active');
        $('#trending-collapse').focus();
    });
    $('.top-stories-skip-link-end').focus(function () {
        $('#trending-collapse').focus();
    });
    $('.top-stories-skip-link-start').focus(function () {
        $('.trending-news-main-wrap .column:last-child .entry-meta a').focus();
    });
    $('#trending-collapse').click(function () {
        $('.trending-news-main-wrap').slideToggle();
        $('body').toggleClass('top-stories-trending-news-active');
        $('.navbar-control-trending-news').focus();
    });
    // Trending News End
    // Single Post content gallery slide

    var rtled = false;

    if( $('body').hasClass('rtl') ){
        rtled = true;
    }

    $("figure.wp-block-gallery.has-nested-images.columns-1, .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">' + top_stories_custom.next_svg + '</button>',
            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">' + top_stories_custom.prev_svg + '</button>',
            dots: false,
            rtl: rtled
        });
    });
    // Content Gallery popup Start
    $('.entry-content .gallery, .widget .gallery, .wp-block-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });
    // Content Gallery popup End
    // Banner Block 1
    $(".theme-slider-block").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-block-navtabs').find('.slide-prev-lead'),
            nextArrow: $(this).closest('.theme-block-navtabs').find('.slide-next-lead'),
            dots: false,
        });
    });
    // Banner Block 1
    $(".theme-main-slider-block").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            prevArrow: $(this).closest('.theme-main-banner').find('.slide-prev-lead'),
            nextArrow: $(this).closest('.theme-main-banner').find('.slide-next-lead'),
            dots: false,
        });
    });

    $(".header-recent-entries").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            arrows: false,
            dots: false,
            rtl: rtled
        });
    });

    $(".ticker-slides").each(function () {
        $(this).slick({
            infinite: true,
            speed: 1000,
            autoplaySpeed: 1200,
            slidesToShow: 1,
            adaptiveHeight: true,
            nextArrow: '.slide-next-ticker',
            prevArrow: '.slide-prev-ticker',
            vertical:true,
            verticalSwiping: true
        });

        // Pause Autoplay on click
        $('.ticker-control-pause').click(function() {
            $('.ticker-slides').slick('slickPause');
            $(this).removeClass('pp-button-active');
            $('.ticker-control-play').addClass('pp-button-active');
        });

        // Autoplay active on click
        $('.ticker-control-play').click(function() {
            $('.ticker-slides').slick('slickPlay');
            $(this).removeClass('pp-button-active');
            $('.ticker-control-pause').addClass('pp-button-active');
        });
    });

    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });

    $(window).scroll(function () {

        if ($(window).scrollTop() > $(window).height() / 2) {
            $(".scroll-up").fadeIn(300);
        } else {
            $(".scroll-up").fadeOut(300);
        }

    });

    // Scroll to Top on Click
    $('.scroll-up').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });

});