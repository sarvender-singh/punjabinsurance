$(document).ready(function () {

    /* ============================================================
       ========== 1. NAVBAR SCROLL / SEARCH BOX / AUTOCOMPLETE =====
       ============================================================ */

    // Fixed navbar on scroll
    let lastScrollTop = 0;

    $(window).on('scroll', function () {
        let currentScroll = $(this).scrollTop();

        if (currentScroll > lastScrollTop && currentScroll > 200) {
            // SCROLL DOWN → Hide elements
            $('.navbar').addClass('fixed-navbar');
            $('#whatsapp-float').addClass('hide-whatsapp');
            $('#quote-float-btn').addClass('hide-quote');
            $('#sidebarToggle').addClass('hide-blogsidebar');
        } else {
            // SCROLL UP → Show elements
            $('.navbar').removeClass('fixed-navbar');
            $('#whatsapp-float').removeClass('hide-whatsapp');
            $('#quote-float-btn').removeClass('hide-quote');
            $('#sidebarToggle').removeClass('hide-blogsidebar');
        }

        lastScrollTop = currentScroll;
    });


    // Toggle search input
    $('#searchToggle').click(function () {
        $('#searchBoxWrap').toggleClass('active');
        if ($('#searchBoxWrap').hasClass('active')) $('#searchBox').focus();
    });

    // Search suggestions list
    const suggestions = [
        "Suggestion 1", "Suggestion 2", "Suggestion 3",
        "Suggestion 4", "Suggestion 5", "Suggestion 6", "Suggestion 7"
    ];

    $('#searchBox').on('input', function () {
        const query = $(this).val().toLowerCase();
        const filtered = suggestions.filter(item => item.toLowerCase().includes(query));
        const $list = $('#searchSuggestions');

        $list.empty();

        if (query && filtered.length > 0) {
            filtered.forEach(item => $list.append(`<li>${item}</li>`));
            $list.show();
        } else {
            $list.hide();
        }
    });

    // Select suggestion
    $(document).on('click', '#searchSuggestions li', function () {
        $('#searchBox').val($(this).text());
        $('#searchSuggestions').hide();
    });

    // Hide suggestions on outside click
    $(document).click(function (e) {
        if (!$(e.target).closest('#searchBox, #searchToggle, #searchSuggestions').length) {
            $('#searchSuggestions').hide();
        }
    });

    /* ============================================================
       ================= 2. MEGA MENU HANDLING =====================
       ============================================================ */

    function setMegaMenuDisplay() {
        if (window.innerWidth >= 1024) {
            $('.mega-menu').each(function () {
                if (!$(this).hasClass('active')) {
                    $(this).css('display', 'none');
                }
            });
        } else {
            $('.mega-menu').css('display', '');
        }
    }

    setMegaMenuDisplay();

    $(window).on('resize', function () {
        setMegaMenuDisplay();
    });

    // Toggle mega menu
    $('.mega-toggle').on('click', function (e) {
        const menuId = $(this).data('menu');
        const $menu = $('#' + menuId);
        const $overlay = $('.body-overlay');

        e.preventDefault(); // prevent link click

        if (window.innerWidth >= 1024) {
            // DESKTOP - hide other menus
            $('.mega-menu').not($menu).hide();
            $menu.toggle(); // toggle visibility
            $overlay.toggleClass('active', $menu.is(':visible'));
        } else {
            // MOBILE - toggle only clicked menu
            $menu.toggle(); // show/hide the clicked menu
            $overlay.toggleClass('active', $('.mega-menu:visible').length > 0);
        }
    });


    // Mega menu hover content logic
    $('.mega-menu').each(function () {
        const $menu = $(this);

        $menu.find('.mega-nav li').on('mouseenter', function () {
            const target = $(this).data('target');

            if (target) {
                $menu.find('.content-section').addClass('hidden');
                $menu.find('#content-' + target).removeClass('hidden');

                $menu.find('.mega-nav li').removeClass('active');
                $(this).addClass('active');
            } else {
                const activeTarget = $menu.find('.mega-nav li.active').data('target');
                if (activeTarget) {
                    $menu.find('.content-section').addClass('hidden');
                    $menu.find('#content-' + activeTarget).removeClass('hidden');
                }
            }
        });
    });

    // Mobile main menu toggle
    $('#menu-toggle').on('click', function () {
        $('.navlist-wrap').toggleClass('active');
        $('.body-overlay').toggleClass('active');
        $('body').toggleClass('overlay-active');
        $('.header, .topbar').css('position', 'static');
    });

    // Overlay close
    $('.body-overlay, .navlist-close').on('click', function () {
        $('.mega-menu').hide();
        $('.navlist-wrap').removeClass('active');
        $('.body-overlay').removeClass('active');
        $('body').removeClass('overlay-active');
    });


    /* ============================================================
       ================= 3. TYPING EFFECT ==========================
       ============================================================ */

    if ($('#headings').length > 0 && $('#typing').length > 0) {

        function decodeHTML(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }

        var headings = $('#headings > div').map(function () {
            return decodeHTML($(this).html());
        }).get();

        var currentHeading = 0;

        function typeHTML(html, callback) {
            var container = $('#typing');
            container.html('');
            var i = 0;

            function typeChar() {
                if (i < html.length) {
                    if (html[i] === '<') {
                        var tagEnd = html.indexOf('>', i);
                        container.append(html.slice(i, tagEnd + 1));
                        i = tagEnd + 1;
                    } else {
                        container.append(html[i]);
                        i++;
                    }
                    setTimeout(typeChar, 100);
                } else {
                    if (callback) setTimeout(callback, 1000);
                }
            }

            typeChar();
        }

        function typeNextHeading() {
            typeHTML(headings[currentHeading], function () {
                currentHeading = (currentHeading + 1) % headings.length;
                typeNextHeading();
            });
        }

        typeNextHeading();
    }


    /* ============================================================
       ================= 4. CAROUSELS (Owl Carousel) ===============
       ============================================================ */

    // MPP Carousel
    if ($('#mpp-carousel').length > 0) {
        var mpp_owl = $('#mpp-carousel');
        mpp_owl.owlCarousel({
            loop: true,
            dots: false,
            responsive: {
                0: { items: 1.2, margin: 16 },
                640: { items: 2.2, margin: 16 },
                1024: { items: 3.2, margin: 24 },
                1280: { items: 4.2, margin: 24 }
            }
        });
        $('#customMppNavNext').click(() => mpp_owl.trigger('next.owl.carousel'));
        $('#customMppNavPrev').click(() => mpp_owl.trigger('prev.owl.carousel'));
    }

    // Google Reviews Carousel
    if ($('#g-reviews-carousel').length > 0) {
        var greview_owl = $('#g-reviews-carousel');
        greview_owl.owlCarousel({
            loop: true,
            margin: 24,
            dots: false,
            responsive: {
                0: { items: 1.2, margin: 16 },
                640: { items: 2.2, margin: 16 },
                1024: { items: 3.2, margin: 24 },
                1280: { items: 3.2, margin: 24 }
            }
        });
        $('#customgReviewsNavNext').click(() => greview_owl.trigger('next.owl.carousel'));
        $('#customgReviewsNavPrev').click(() => greview_owl.trigger('prev.owl.carousel'));
    }

    // Blogs Carousel
    if ($('#blogs-carousel').length > 0) {
        var blogs_owl = $('#blogs-carousel');
        blogs_owl.owlCarousel({
            loop: true,
            margin: 24,
            dots: false,
            responsive: {
                0: { items: 1.2, margin: 16 },
                640: { items: 2.2, margin: 16 },
                1024: { items: 3.2, margin: 24 },
                1280: { items: 3.2, margin: 24 }
            }
        });
        $('#customBlogsNavNext').click(() => blogs_owl.trigger('next.owl.carousel'));
        $('#customBlogsNavPrev').click(() => blogs_owl.trigger('prev.owl.carousel'));
    }

    // Mega Menu Blogs Carousel
    if ($('.meganav-blogs-carousel').length > 0) {
        $('.meganav-blogs-carousel').owlCarousel({
            loop: true,
            margin: 12,
            dots: false,
            responsive: {
                0: { items: 1.2 },
                1024: { items: 2.2 }
            }
        });
    }

    // Product hero carousel
    if ($('#product-carousel').length > 0) {
        var phc_owl = $('#product-carousel');
        phc_owl.owlCarousel({
            loop: true,
            items: 1,
            dots: false
        });
        $('#customPrdctHeroNavNext').click(() => phc_owl.trigger('next.owl.carousel'));
        $('#customPrdctHeroNavPrev').click(() => phc_owl.trigger('prev.owl.carousel'));
    }

    // Blogs hero carousel
    if ($('#blogs-hero-carousel').length > 0) {
        var blogs_hero_owl = $('#blogs-hero-carousel');
        blogs_hero_owl.owlCarousel({
            loop: true, 
            items: 1,
            dots: false,
            mouseDrag: false,
            touchDrag: false,
            pullDrag: false,
            autoplay: true,
            autoplayTimeout: 2000,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn'
        });
        $('#customBlogsHeroNavNext').click(() => blogs_hero_owl.trigger('next.owl.carousel'));
        $('#customBlogsHeroNavPrev').click(() => blogs_hero_owl.trigger('prev.owl.carousel'));
    }

    /* ============================================================
       ================= 5. FAQ ACCORDION ==========================
       ============================================================ */

    if ($('.faq-item').length > 0) {
        $('.faq-item').click(function () {
            const $item = $(this);
            const $answer = $item.find('.faq-answer');
            const isActive = $item.hasClass('active');

            $('.faq-item').removeClass('active');
            $('.faq-answer').slideUp();

            if (!isActive) {
                $item.addClass('active');
                $answer.slideDown();
            }
        });
    }

    /* ============================================================
       ============ 6. LOAD MORE (BLOG ITEMS) ======================
       ============================================================ */

    if ($('.loadmore-wrapper').length > 0) {
        $('.loadmore-wrapper').each(function () {
            let wrapper = $(this);
            let items = wrapper.find('.blog-item');
            let btn = wrapper.find('.loadmore-btn');
            let loader = wrapper.find('.loader');
            let showCount = 12;

            items.hide().slice(0, showCount).show();

            btn.on('click', function () {
                btn.hide();
                loader.show();

                setTimeout(function () {
                    let hidden = items.filter(':hidden');
                    hidden.slice(0, showCount).slideDown();
                    loader.hide();

                    if (hidden.length <= showCount) {
                        btn.fadeOut();
                    } else {
                        btn.show();
                    }

                }, 800);
            });
        });
    }

    /* ============================================================
       ============ 7. RECENT POSTS TITLE TRUNCATE ====================
       ============================================================ */
    if ($('.rpwwt-post-title').length > 0) {
        $('.rpwwt-post-title').each(function () {
            let maxLength = 35; 
            let text = $(this).text().trim();

            if (text.length > maxLength) {
                $(this).text(text.substring(0, maxLength) + '...');
            }
        });
    }

    /* ============================================================
       ============ 8. CAREER GALLERY CAROUSELS ====================
       ============================================================ */

   if ($('#career-gallery-carousel_1').length > 0) {
        $('#career-gallery-carousel_1').owlCarousel({
            loop: true,
            margin: 6,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplaySpeed: 6000,
            smartSpeed: 6000,
            slideTransition: 'linear',
            autoplayHoverPause: false,
            responsive: {
                0: { items: 1.2 },
                640: { items: 2.2 },
                1024: { items: 3.2 },
                1280: { items: 4.2 }
            }
        });
    }

    if ($('#career-gallery-carousel_2').length > 0) {
        $('#career-gallery-carousel_2').owlCarousel({
            loop: true,
            margin: 6,
            dots: false,
            center: true,
            rtl: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplaySpeed: 6000,
            smartSpeed: 6000,
            slideTransition: 'linear',
            autoplayHoverPause: false,
            responsive: {
                0: { items: 1.2 },
                640: { items: 2.2 },
                1024: { items: 3.2 },
                1280: { items: 4.2 }
            }
        });
    }

    /* ============================================================
       ============ 9. MODALS ====================
       ============================================================ */

    // --------------------
    // GENERIC MODAL FUNCTIONS
    // --------------------

    // Open modal
    function openModal(modalId) {
        $('.body-overlay').addClass('active overlay-z');
        $('body').addClass('overlay-active');
        $(modalId).addClass('active');
    }

    // Close modal
    function closeModal(modalId) {
        const $modal = $(modalId);
        $modal.removeClass('active');
        $('.body-overlay').removeClass('active overlay-z');
        $('body').removeClass('overlay-active');

        // Stop any YouTube videos inside modal
        $modal.find('iframe').attr('src', '');
    }

    // --------------------
    // OPEN MODAL HANDLERS
    // --------------------
    $('#quote-float-btn').on('click', function () {
        openModal('#quoteModal');
    });

    $('.job-apply-btn').on('click', function () {
        openModal('#jobModal');
    });

    // YouTube video thumbnails
    $('.commercial-video-thumb').on('click', function(e) {
        e.preventDefault();

        let videoId = $(this).data('video-id'); // YouTube ID
        let videoTitle = $(this).data('title'); // Video title

        if (!videoId) return;

        let embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;

        // Set iframe src
        $('#youtubeFrame').attr('src', embedUrl);

        // Set video title
        $('#videoModal .product-quote-form-heading').text(videoTitle);

        // Open modal
        openModal('#videoModal');
    });

    // --------------------
    // CLOSE MODAL HANDLERS
    // --------------------
    $('#modalClose').on('click', function () {
        closeModal('#quoteModal, #jobModal, #videoModal');
    });

    // $('#jobModalClose').on('click', function () {
    //     closeModal('#jobModal');
    // });

    // $('#videoModalClose').on('click', function () {
    //     closeModal('#videoModal');
    // });

    // Close any active modal on overlay click
    $('.body-overlay').on('click', function () {
        $('.modal-container.active').each(function () {
            closeModal('#' + $(this).attr('id'));
        });
    });

    // Prevent clicks inside modal content from closing it
    $('.modal-container .commercial-video-wrapper, .modal-container .modal-content').on('click', function (e) {
        e.stopPropagation();
    });



    /* ============================================================
       ============ 10. BLOG SIDEBAR SLIDE IN LEFT ====================
       ============================================================ */
    // Blog Sidebar Slide-in on Mobile
    $('#sidebarToggle').on('click', function () {
        $('#blogSidebar').addClass('active');
        $('.body-overlay').addClass('active');
        $('body').addClass('overlay-active');
        $('.body-overlay').addClass('active overlay-z');
    });

    // Clicking overlay closes sidebar
    $('.body-overlay').on('click', function () {
        $('#blogSidebar').removeClass('active');
        $('body').removeClass('overlay-active');
        $('.body-overlay').removeClass('active overlay-z');
    });

    /* ============================================================
       ============ 11. NAVLIST & SIDEBAR LOAD AFTER FOOTER =======
       ============================================================ */
    // Generic function to handle relocation of any element
    function handleRelocation(elementSelector) {

        var $el = $(elementSelector);
        var originalPlace = $el.parent();
        var originalIndex = $el.index();

        function relocate() {
            if ($(window).width() <= 1023) {

                // Move AFTER footer if not already moved
                if (!$el.next().is('footer') && !$('footer').next().is(elementSelector)) {
                    $el.insertAfter('footer');
                }

            } else {

                // Move back to original location (desktop)
                if (!$el.parent().is(originalPlace)) {

                    if (originalIndex === 0) {
                        $el.prependTo(originalPlace);
                    } else {
                        $el.appendTo(originalPlace);
                    }
                }
            }
        }

        relocate(); // Run on load
        $(window).on('resize', relocate); // Run on resize
    }


    // Call the function for each element you want to relocate
    handleRelocation('.navlist-wrap');
    handleRelocation('#blogSidebar');

    /* ============================================================
       ============ 12.FLATPICKER INITIALIZATION FOR GET A QUOTE FORM  =======
       ============================================================ */
    flatpickr("#dob", {
        dateFormat: "d/m/Y",
        maxDate: "today",
        altInput: true,
        altFormat: "d M Y",
        disableMobile: "true", // force custom UI even on mobile
    });

    /* ============================================================
       ========== 13. PHOTO GALLERY =====
       ============================================================ */
    
    // Initialize all galleries
    $(".gallery").each(function () {
        const galleryID = $(this).attr("id");

        lightGallery(document.getElementById(galleryID), {
            selector: ".hidden-images a",
            thumbnail: true,
            zoom: true
        });
    });

    // First image click → open gallery
    $(".open-gallery").on("click", function () {
        const gallerySelector = $(this).data("gallery");
        $(gallerySelector).find(".hidden-images a").first()[0].click();
    });



     /* ============================================================
       ========== 14. SCROLL SPY TO SIDEBAR =====
       ============================================================ */
    $(window).on("scroll", function () {
        var scrollPos = $(window).scrollTop();

        $(".sidebar-links-list li").each(function () {
            var link = $(this).find("a");
            var target = $(link.attr("href"));

            if (target.length) {
                if (
                    target.offset().top <= scrollPos + 100 &&
                    target.offset().top + target.outerHeight() > scrollPos + 100
                ) {
                    $(".sidebar-links-list li").removeClass("active");
                    $(this).addClass("active");
                }
            }
        });
    });


}); // END DOCUMENT READY