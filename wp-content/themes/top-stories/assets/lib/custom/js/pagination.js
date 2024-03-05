jQuery(document).ready(function ($) {

    var ajaxurl = top_stories_pagination.ajax_url;

    function top_stories_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(top_stories_pagination.paged) + 1;
    var maxpage = top_stories_pagination.maxpage;
    var nextLink = top_stories_pagination.nextLink;
    var loadmore = top_stories_pagination.loadmore;
    var loading = top_stories_pagination.loading;
    var nomore = top_stories_pagination.nomore;
    var pagination_layout = top_stories_pagination.pagination_layout;

    $('.twp-loading-button').click(function () {
        var pageSection = $(".data-bg");
        pageSection.each(function (indx) {

            if ($(this).attr("data-background")) {

                $(this).css("background-image", "url(" + $(this).data("background") + ")");

            }

        });
        if ((!$('.twp-no-posts').hasClass('twp-no-posts'))) {

            $('.twp-loading-button').text(loading);
            $('.twp-loging-status').addClass('twp-ajax-loading');
            $('.twp-loaded-content').load(nextLink + ' .theme-article-area', function () {
                if (paged < 10) {
                    var newlink = nextLink.substring(0, nextLink.length - 2);
                } else {

                    var newlink = nextLink.substring(0, nextLink.length - 3);
                }
                paged++;
                paged = "=" + paged;
                newlink = newlink.replace("paged=", "paged");
                nextLink = newlink + paged + "/";
                paged = paged.replace("=", "");
                if (paged > maxpage) {
                    $('.twp-loading-button').addClass('twp-no-posts');
                    $('.twp-loading-button').text(nomore);
                } else {
                    $('.twp-loading-button').text(loadmore);
                }

                $('.twp-loaded-content .theme-article-area').each(function(){
                    $(this).addClass(paged + '-twp-article-ajax');
                });

                var lodedContent = $('.twp-loaded-content').html();
                $('.twp-loaded-content').html('');

                if ($('.article-wraper').hasClass('archive-layout-masonry')) {

                    if ($('.archive-layout-masonry').length > 0) {
                        var content = $(lodedContent);
                        content.hide();
                        grid = $('.archive-layout-masonry');
                        grid.append(content);
                        grid.imagesLoaded(function () {
                            content.show();

                            var winwidth = $(window).width();
                            $(window).resize(function () {
                                winwidth = $(window).width();
                            });

                            if (winwidth > 990) {
                                grid.masonry('appended', content).masonry();
                            } else {
                                grid.masonry('appended', content);
                            }

                        });
                    }

                } else {

                    $('.content-area .article-wraper').append(lodedContent);

                }

                $('.twp-loging-status').removeClass('twp-ajax-loading');

                $('.theme-article-area').each(function () {

                    if (!$(this).hasClass('theme-article-loaded')) {

                        $(this).addClass(paged + '-twp-article-ajax');
                        $(this).addClass('theme-article-loaded');
                        $(this).find('.theme-video-panel').addClass( paged + '-twp-video-ajax' );
                        $(this).find('.theme-video-panel').removeClass('video-main-wraper');
                    }

                });
            });

        }
    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {
            var pageSection = $(".data-bg");
            pageSection.each(function (indx) {

                if ($(this).attr("data-background")) {

                    $(this).css("background-image", "url(" + $(this).data("background") + ")");

                }

            });
            if (!$('.top_stories-auto-pagination').hasClass('twp-ajax-loading') && !$('.top_stories-auto-pagination').hasClass('twp-no-posts') && maxpage > 1 && top_stories_is_on_screen('.top_stories-auto-pagination')) {
                $('.top_stories-auto-pagination').addClass('twp-ajax-loading');
                $('.top_stories-auto-pagination').text(loading);

                $('.twp-loaded-content').load(nextLink + ' .theme-article-area', function () {

                    if (paged < 10) {
                        var newlink = nextLink.substring(0, nextLink.length - 2);
                    } else {

                        var newlink = nextLink.substring(0, nextLink.length - 3);
                    }
                    paged++;
                    nextLink = newlink + paged + '/';
                    if (paged > maxpage) {
                        $('.top_stories-auto-pagination').addClass('twp-no-posts');
                        $('.top_stories-auto-pagination').text(nomore);
                    } else {
                        $('.top_stories-auto-pagination').removeClass('twp-ajax-loading');
                        $('.top_stories-auto-pagination').text(loadmore);
                    }

                    $('.twp-loaded-content .theme-article-area').each(function(){
                        $(this).addClass(paged + '-twp-article-ajax');
                    });

                    var lodedContent = $('.twp-loaded-content').html();

                    $('.twp-loaded-content').html('');

                    if ($('.article-wraper').hasClass('archive-layout-masonry')) {

                        if ($('.archive-layout-masonry').length > 0) {
                            var content = $(lodedContent);
                            content.hide();
                            grid = $('.archive-layout-masonry');
                            grid.append(content);
                            grid.imagesLoaded(function () {
                                content.show();

                                var winwidth = $(window).width();
                                $(window).resize(function () {
                                    winwidth = $(window).width();
                                });

                                if (winwidth > 990) {
                                    grid.masonry('appended', content).masonry();
                                } else {
                                    grid.masonry('appended', content);
                                }

                            });
                        }

                    } else {

                        $('.content-area .article-wraper').append(lodedContent);

                    }

                    $('.top_stories-auto-pagination').removeClass('twp-ajax-loading');

                    $('.theme-article-area').each(function(){
                        $(this).removeClass(paged + '-twp-article-ajax');
                    });


                });
            }

        });
    }

    $(window).scroll(function () {
        var pageSection = $(".data-bg");
        pageSection.each(function (indx) {

            if ($(this).attr("data-background")) {

                $(this).css("background-image", "url(" + $(this).data("background") + ")");

            }

        });
        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && top_stories_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'top_stories_single_infinity',
                '_wpnonce': top_stories_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid['0'];
                    $('.twp-single-infinity').attr('next-post', newpostid);

                    $('article#post-' + postid + ' ul.wp-block-gallery.columns-1, article#post-' + postid + ' .wp-block-gallery.columns-1 .blocks-gallery-grid, article#post-' + postid + ' .gallery-columns-1').each(function () {
                        $(this).slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            autoplay: true,
                            autoplaySpeed: 8000,
                            infinite: true,
                            nextArrow: '<button type="button" class="slide-btn slide-btn-bg slide-next-icon">'+top_stories_custom.next_svg+'</button>',
                            prevArrow: '<button type="button" class="slide-btn slide-btn-bg slide-prev-icon">'+top_stories_custom.prev_svg+'</button>',
                            dots: false
                        });
                    });

                    $('article').each(function () {

                        if ($('body').hasClass('booster-extension') && $(this).hasClass('after-load-ajax') ) {

                            var cid = $(this).attr('id');
                            $(this).addClass( cid );

                            likedislike(cid);
                            booster_extension_post_reaction(cid);

                        }

                        $(this).removeClass('after-load-ajax');

                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});