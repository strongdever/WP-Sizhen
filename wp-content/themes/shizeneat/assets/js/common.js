!(function ($) {
    "use strict";

    let vh = window.innerHeight * 0.01;
    let vw = window.innerWidth * 0.01;
    console.log(window.innerWidth);
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    document.documentElement.style.setProperty('--vw', `${vw}px`);

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    $('.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

    // Toggle .header-scrolled
    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('#header').addClass('header-scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
        }
    });

    if ($(window).scrollTop() > 150) {
        $('#header').addClass('header-scrolled');
    }


    // Smooth scroll for the navigation menu and links with .scrollto classes
    var scrolltoOffset = $('#header').outerHeight() - 1;

    $(document).on('click', '.nav-menu a, .mobile-nav-menu a, .scrollto, .p-service-index a, .link, #toc_container a', function (e) {

        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();

                var scrollto = target.offset().top - scrolltoOffset;

                if ($(this).attr("href") == '#header') {
                    scrollto = 0;
                }

                $('html, body').animate({
                    scrollTop: scrollto
                }, 1000);

                if ($(this).parents('.nav-menu, .mobile-nav-menu').length) {
                    $('.nav-menu .active, .mobile-nav-menu .active').removeClass('active');
                    $(this).closest('li').addClass('active');
                }

                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('.mobile-nav-toggle').toggleClass('toggle-active');
                    $('.mobile-nav-overly').fadeOut();
                }

                return false;
            }
        }
    });

    // Activate smooth scroll on page load with hash links in the url
    $(document).ready(function () {
        if (window.location.hash) {
            var initial_nav = window.location.hash;
            if ($(initial_nav).length) {
                var scrollto = $(initial_nav).offset().top - scrolltoOffset;
                $('html, body').animate({
                    scrollTop: scrollto
                }, 1000);
            }
        }
    });

    // Mobile Navigation
    $('body').prepend('<button type="button" class="mobile-nav-toggle"><span class="toggle-icon"><span></span><span></span><span></span></span></button>');
    $('body').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function (e) {
        $('body').toggleClass('mobile-nav-active');
        $('.mobile-nav-toggle').toggleClass('toggle-active');
        $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav-menu .drop-down > a', function (e) {
        e.preventDefault();
        $(this).next().slideToggle(300);
        $(this).parent().toggleClass('active');
    });

    $(document).click(function (e) {
        var container = $("#mobile-nav, .mobile-nav-toggle");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            if ($('body').hasClass('mobile-nav-active')) {
                $('body').removeClass('mobile-nav-active');
                $('.mobile-nav-toggle').toggleClass('toggle-active');
                $('.mobile-nav-overly').fadeOut();
            }
        }
    });

    // modal

    var $modal = $(".modal");

    $(document).on('click', '[data-toggle="modal"]', function (e) {
        var target = $(this).attr("href") ? $(this).attr("href") : $(this).attr("data-target");
        if (target.length !== 0 && $(document).has(target).length !== 0) {
            e.preventDefault();
            var $selecedModal = $(target);
            $('body').toggleClass('modal-open');
            $selecedModal.show();
            setTimeout(function () {
                $selecedModal.toggleClass('show');
            }, 100);
            return false;
        }
    });

    $(document).click(function (e) {
        var container = $(".modal .modal-content");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            if ($('body').hasClass('modal-open')) {
                $('body').removeClass('modal-open');
                $modal.removeClass('show');
                setTimeout(function () {
                    $modal.hide();
                }, 300);
            }
        }
    });

    $(document).on('click', '.modal .close, [data-dismiss="modal"]', function (e) {
        $('body').removeClass('modal-open');
        $modal.removeClass('show');
        setTimeout(function () {
            $modal.hide();
        }, 300);
    });

    // accordion jquery
    $('.accordion-answer:first').show();
    $('.accordion-question:first').addClass('expanded');

    $(document).on('click', '.accordion-question', function (e) {
        var answer = $(this).next();

        $('.accordion-answer').not(answer).slideUp(400);
        $('.accordion-question').not(this).removeClass('expanded');
        $(this).toggleClass('expanded');
        answer.slideToggle(400);
    });

    // tab
    $(".tabs .tabs-link").click(function (e) {
        e.preventDefault();
        var tabid = $(this).attr("href");
        $(this).parents('.tabs').find('.tab').removeClass("active");
        $(this).parents('.tabs-list').find('.tabs-link').removeClass("active");
        $(this).parents('.tabs').find('.tab').hide();
        $(tabid).fadeIn();
        $(this).addClass("active");
    });

    // Swiper
    var recommendedSwiper = new Swiper(".recommended-swiper", {
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 18,
        centeredSlides: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: {
                spaceBetween: 60,
                centeredSlides: false,
            },
        },
    });

    // Swiper
    var detailThumbsSwiper = new Swiper(".detail-thumbs-swiper", {
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var calendarSwiper = new Swiper(".calendar-swiper", {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 15,
        centeredSlides: false,
        watchSlidesProgress: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 45,
            },
        },
    });

})(jQuery);