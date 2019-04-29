
/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */
(function (d) {
    function e(a) { var b = a || window.event, c = [].slice.call(arguments, 1), f = 0, e = 0, g = 0, a = d.event.fix(b); a.type = "mousewheel"; b.wheelDelta && (f = b.wheelDelta / 120); b.detail && (f = -b.detail / 3); g = f; b.axis !== void 0 && b.axis === b.HORIZONTAL_AXIS && (g = 0, e = -1 * f); b.wheelDeltaY !== void 0 && (g = b.wheelDeltaY / 120); b.wheelDeltaX !== void 0 && (e = -1 * b.wheelDeltaX / 120); c.unshift(a, f, e, g); return (d.event.dispatch || d.event.handle).apply(this, c) } var c = ["DOMMouseScroll", "mousewheel"]; if (d.event.fixHooks) for (var h = c.length; h;)d.event.fixHooks[c[--h]] =
        d.event.mouseHooks; d.event.special.mousewheel = { setup: function () { if (this.addEventListener) for (var a = c.length; a;)this.addEventListener(c[--a], e, false); else this.onmousewheel = e }, teardown: function () { if (this.removeEventListener) for (var a = c.length; a;)this.removeEventListener(c[--a], e, false); else this.onmousewheel = null } }; d.fn.extend({ mousewheel: function (a) { return a ? this.bind("mousewheel", a) : this.trigger("mousewheel") }, unmousewheel: function (a) { return this.unbind("mousewheel", a) } })
})(jQuery);
/*!
 * fancyBox - jQuery Plugin
 * version: 2.1.5 (Fri, 14 Jun 2013)
 * @requires jQuery v1.6 or later
 *
 * Examples at http://fancyapps.com/fancybox/
 * License: www.fancyapps.com/fancybox/#license
 *
 * Copyright 2012 Janis Skarnelis - janis@fancyapps.com
 *
 */

(function (window, document, $, undefined) {
    "use strict";

    var H = $("html"),
        W = $(window),
        D = $(document),
        F = $.fancybox = function () {
            F.open.apply(this, arguments);
        },
        IE = navigator.userAgent.match(/msie/i),
        didUpdate = null,
        isTouch = document.createTouch !== undefined,

        isQuery = function (obj) {
            return obj && obj.hasOwnProperty && obj instanceof $;
        },
        isString = function (str) {
            return str && $.type(str) === "string";
        },
        isPercentage = function (str) {
            return isString(str) && str.indexOf('%') > 0;
        },
        isScrollable = function (el) {
            return (el && !(el.style.overflow && el.style.overflow === 'hidden') && ((el.clientWidth && el.scrollWidth > el.clientWidth) || (el.clientHeight && el.scrollHeight > el.clientHeight)));
        },
        getScalar = function (orig, dim) {
            var value = parseInt(orig, 10) || 0;

            if (dim && isPercentage(orig)) {
                value = F.getViewport()[dim] / 100 * value;
            }

            return Math.ceil(value);
        },
        getValue = function (value, dim) {
            return getScalar(value, dim) + 'px';
        };

    $.extend(F, {
        // The current version of fancyBox
        version: '2.1.5',

        defaults: {
            padding: 15,
            margin: 20,

            width: 800,
            height: 600,
            minWidth: 100,
            minHeight: 100,
            maxWidth: 9999,
            maxHeight: 9999,
            pixelRatio: 1, // Set to 2 for retina display support

            autoSize: true,
            autoHeight: false,
            autoWidth: false,

            autoResize: true,
            autoCenter: !isTouch,
            fitToView: true,
            aspectRatio: false,
            topRatio: 0.5,
            leftRatio: 0.5,

            scrolling: 'auto', // 'auto', 'yes' or 'no'
            wrapCSS: '',

            arrows: true,
            closeBtn: true,
            closeClick: false,
            nextClick: false,
            mouseWheel: true,
            autoPlay: false,
            playSpeed: 3000,
            preload: 3,
            modal: false,
            loop: true,

            ajax: {
                dataType: 'html',
                headers: { 'X-fancyBox': true }
            },
            iframe: {
                scrolling: 'auto',
                preload: true
            },
            swf: {
                wmode: 'transparent',
                allowfullscreen: 'true',
                allowscriptaccess: 'always'
            },

            keys: {
                next: {
                    13: 'left', // enter
                    34: 'up',   // page down
                    39: 'left', // right arrow
                    40: 'up'    // down arrow
                },
                prev: {
                    8: 'right',  // backspace
                    33: 'down',   // page up
                    37: 'right',  // left arrow
                    38: 'down'    // up arrow
                },
                close: [27], // escape key
                play: [32], // space - start/stop slideshow
                toggle: [70]  // letter "f" - toggle fullscreen
            },

            direction: {
                next: 'left',
                prev: 'right'
            },

            scrollOutside: true,

            // Override some properties
            index: 0,
            type: null,
            href: null,
            content: null,
            title: null,

            // HTML templates
            tpl: {
                wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image: '<img class="fancybox-image" src="{href}" alt="" />',
                iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (IE ? ' allowtransparency="true"' : '') + '></iframe>',
                error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
            },

            // Properties for each animation type
            // Opening fancyBox
            openEffect: 'fade', // 'elastic', 'fade' or 'none'
            openSpeed: 250,
            openEasing: 'swing',
            openOpacity: true,
            openMethod: 'zoomIn',

            // Closing fancyBox
            closeEffect: 'fade', // 'elastic', 'fade' or 'none'
            closeSpeed: 250,
            closeEasing: 'swing',
            closeOpacity: true,
            closeMethod: 'zoomOut',

            // Changing next gallery item
            nextEffect: 'elastic', // 'elastic', 'fade' or 'none'
            nextSpeed: 250,
            nextEasing: 'swing',
            nextMethod: 'changeIn',

            // Changing previous gallery item
            prevEffect: 'elastic', // 'elastic', 'fade' or 'none'
            prevSpeed: 250,
            prevEasing: 'swing',
            prevMethod: 'changeOut',

            // Enable default helpers
            helpers: {
                overlay: true,
                title: true
            },

            // Callbacks
            onCancel: $.noop, // If canceling
            beforeLoad: $.noop, // Before loading
            afterLoad: $.noop, // After loading
            beforeShow: $.noop, // Before changing in current item
            afterShow: $.noop, // After opening
            beforeChange: $.noop, // Before changing gallery item
            beforeClose: $.noop, // Before closing
            afterClose: $.noop  // After closing
        },

        //Current state
        group: {}, // Selected group
        opts: {}, // Group options
        previous: null,  // Previous element
        coming: null,  // Element being loaded
        current: null,  // Currently loaded element
        isActive: false, // Is activated
        isOpen: false, // Is currently open
        isOpened: false, // Have been fully opened at least once

        wrap: null,
        skin: null,
        outer: null,
        inner: null,

        player: {
            timer: null,
            isActive: false
        },

        // Loaders
        ajaxLoad: null,
        imgPreload: null,

        // Some collections
        transitions: {},
        helpers: {},

		/*
		 *	Static methods
		 */

        open: function (group, opts) {
            if (!group) {
                return;
            }

            if (!$.isPlainObject(opts)) {
                opts = {};
            }

            // Close if already active
            if (false === F.close(true)) {
                return;
            }

            // Normalize group
            if (!$.isArray(group)) {
                group = isQuery(group) ? $(group).get() : [group];
            }

            // Recheck if the type of each element is `object` and set content type (image, ajax, etc)
            $.each(group, function (i, element) {
                var obj = {},
                    href,
                    title,
                    content,
                    type,
                    rez,
                    hrefParts,
                    selector;

                if ($.type(element) === "object") {
                    // Check if is DOM element
                    if (element.nodeType) {
                        element = $(element);
                    }

                    if (isQuery(element)) {
                        obj = {
                            href: element.data('fancybox-href') || element.attr('href'),
                            title: element.data('fancybox-title') || element.attr('title'),
                            isDom: true,
                            element: element
                        };

                        if ($.metadata) {
                            $.extend(true, obj, element.metadata());
                        }

                    } else {
                        obj = element;
                    }
                }

                href = opts.href || obj.href || (isString(element) ? element : null);
                title = opts.title !== undefined ? opts.title : obj.title || '';

                content = opts.content || obj.content;
                type = content ? 'html' : (opts.type || obj.type);

                if (!type && obj.isDom) {
                    type = element.data('fancybox-type');

                    if (!type) {
                        rez = element.prop('class').match(/fancybox\.(\w+)/);
                        type = rez ? rez[1] : null;
                    }
                }

                if (isString(href)) {
                    // Try to guess the content type
                    if (!type) {
                        if (F.isImage(href)) {
                            type = 'image';

                        } else if (F.isSWF(href)) {
                            type = 'swf';

                        } else if (href.charAt(0) === '#') {
                            type = 'inline';

                        } else if (isString(element)) {
                            type = 'html';
                            content = element;
                        }
                    }

                    // Split url into two pieces with source url and content selector, e.g,
                    // "/mypage.html #my_id" will load "/mypage.html" and display element having id "my_id"
                    if (type === 'ajax') {
                        hrefParts = href.split(/\s+/, 2);
                        href = hrefParts.shift();
                        selector = hrefParts.shift();
                    }
                }

                if (!content) {
                    if (type === 'inline') {
                        if (href) {
                            content = $(isString(href) ? href.replace(/.*(?=#[^\s]+$)/, '') : href); //strip for ie7

                        } else if (obj.isDom) {
                            content = element;
                        }

                    } else if (type === 'html') {
                        content = href;

                    } else if (!type && !href && obj.isDom) {
                        type = 'inline';
                        content = element;
                    }
                }

                $.extend(obj, {
                    href: href,
                    type: type,
                    content: content,
                    title: title,
                    selector: selector
                });

                group[i] = obj;
            });

            // Extend the defaults
            F.opts = $.extend(true, {}, F.defaults, opts);

            // All options are merged recursive except keys
            if (opts.keys !== undefined) {
                F.opts.keys = opts.keys ? $.extend({}, F.defaults.keys, opts.keys) : false;
            }

            F.group = group;

            return F._start(F.opts.index);
        },

        // Cancel image loading or abort ajax request
        cancel: function () {
            var coming = F.coming;

            if (!coming || false === F.trigger('onCancel')) {
                return;
            }

            F.hideLoading();

            if (F.ajaxLoad) {
                F.ajaxLoad.abort();
            }

            F.ajaxLoad = null;

            if (F.imgPreload) {
                F.imgPreload.onload = F.imgPreload.onerror = null;
            }

            if (coming.wrap) {
                coming.wrap.stop(true, true).trigger('onReset').remove();
            }

            F.coming = null;

            // If the first item has been canceled, then clear everything
            if (!F.current) {
                F._afterZoomOut(coming);
            }
        },

        // Start closing animation if is open; remove immediately if opening/closing
        close: function (event) {
            F.cancel();

            if (false === F.trigger('beforeClose')) {
                return;
            }

            F.unbindEvents();

            if (!F.isActive) {
                return;
            }

            if (!F.isOpen || event === true) {
                $('.fancybox-wrap').stop(true).trigger('onReset').remove();

                F._afterZoomOut();

            } else {
                F.isOpen = F.isOpened = false;
                F.isClosing = true;

                $('.fancybox-item, .fancybox-nav').remove();

                F.wrap.stop(true, true).removeClass('fancybox-opened');

                F.transitions[F.current.closeMethod]();
            }
        },

        // Manage slideshow:
        //   $.fancybox.play(); - toggle slideshow
        //   $.fancybox.play( true ); - start
        //   $.fancybox.play( false ); - stop
        play: function (action) {
            var clear = function () {
                clearTimeout(F.player.timer);
            },
                set = function () {
                    clear();

                    if (F.current && F.player.isActive) {
                        F.player.timer = setTimeout(F.next, F.current.playSpeed);
                    }
                },
                stop = function () {
                    clear();

                    D.unbind('.player');

                    F.player.isActive = false;

                    F.trigger('onPlayEnd');
                },
                start = function () {
                    if (F.current && (F.current.loop || F.current.index < F.group.length - 1)) {
                        F.player.isActive = true;

                        D.bind({
                            'onCancel.player beforeClose.player': stop,
                            'onUpdate.player': set,
                            'beforeLoad.player': clear
                        });

                        set();

                        F.trigger('onPlayStart');
                    }
                };

            if (action === true || (!F.player.isActive && action !== false)) {
                start();
            } else {
                stop();
            }
        },

        // Navigate to next gallery item
        next: function (direction) {
            var current = F.current;

            if (current) {
                if (!isString(direction)) {
                    direction = current.direction.next;
                }

                F.jumpto(current.index + 1, direction, 'next');
            }
        },

        // Navigate to previous gallery item
        prev: function (direction) {
            var current = F.current;

            if (current) {
                if (!isString(direction)) {
                    direction = current.direction.prev;
                }

                F.jumpto(current.index - 1, direction, 'prev');
            }
        },

        // Navigate to gallery item by index
        jumpto: function (index, direction, router) {
            var current = F.current;

            if (!current) {
                return;
            }

            index = getScalar(index);

            F.direction = direction || current.direction[(index >= current.index ? 'next' : 'prev')];
            F.router = router || 'jumpto';

            if (current.loop) {
                if (index < 0) {
                    index = current.group.length + (index % current.group.length);
                }

                index = index % current.group.length;
            }

            if (current.group[index] !== undefined) {
                F.cancel();

                F._start(index);
            }
        },

        // Center inside viewport and toggle position type to fixed or absolute if needed
        reposition: function (e, onlyAbsolute) {
            var current = F.current,
                wrap = current ? current.wrap : null,
                pos;

            if (wrap) {
                pos = F._getPosition(onlyAbsolute);

                if (e && e.type === 'scroll') {
                    delete pos.position;

                    wrap.stop(true, true).animate(pos, 200);

                } else {
                    wrap.css(pos);

                    current.pos = $.extend({}, current.dim, pos);
                }
            }
        },

        update: function (e) {
            var type = (e && e.type),
                anyway = !type || type === 'orientationchange';

            if (anyway) {
                clearTimeout(didUpdate);

                didUpdate = null;
            }

            if (!F.isOpen || didUpdate) {
                return;
            }

            didUpdate = setTimeout(function () {
                var current = F.current;

                if (!current || F.isClosing) {
                    return;
                }

                F.wrap.removeClass('fancybox-tmp');

                if (anyway || type === 'load' || (type === 'resize' && current.autoResize)) {
                    F._setDimension();
                }

                if (!(type === 'scroll' && current.canShrink)) {
                    F.reposition(e);
                }

                F.trigger('onUpdate');

                didUpdate = null;

            }, (anyway && !isTouch ? 0 : 300));
        },

        // Shrink content to fit inside viewport or restore if resized
        toggle: function (action) {
            if (F.isOpen) {
                F.current.fitToView = $.type(action) === "boolean" ? action : !F.current.fitToView;

                // Help browser to restore document dimensions
                if (isTouch) {
                    F.wrap.removeAttr('style').addClass('fancybox-tmp');

                    F.trigger('onUpdate');
                }

                F.update();
            }
        },

        hideLoading: function () {
            D.unbind('.loading');

            $('#fancybox-loading').remove();
        },

        showLoading: function () {
            var el, viewport;

            F.hideLoading();

            el = $('<div id="fancybox-loading"><div></div></div>').click(F.cancel).appendTo('body');

            // If user will press the escape-button, the request will be canceled
            D.bind('keydown.loading', function (e) {
                if ((e.which || e.keyCode) === 27) {
                    e.preventDefault();

                    F.cancel();
                }
            });

            if (!F.defaults.fixed) {
                viewport = F.getViewport();

                el.css({
                    position: 'absolute',
                    top: (viewport.h * 0.5) + viewport.y,
                    left: (viewport.w * 0.5) + viewport.x
                });
            }
        },

        getViewport: function () {
            var locked = (F.current && F.current.locked) || false,
                rez = {
                    x: W.scrollLeft(),
                    y: W.scrollTop()
                };

            if (locked) {
                rez.w = locked[0].clientWidth;
                rez.h = locked[0].clientHeight;

            } else {
                // See http://bugs.jquery.com/ticket/6724
                rez.w = isTouch && window.innerWidth ? window.innerWidth : W.width();
                rez.h = isTouch && window.innerHeight ? window.innerHeight : W.height();
            }

            return rez;
        },

        // Unbind the keyboard / clicking actions
        unbindEvents: function () {
            if (F.wrap && isQuery(F.wrap)) {
                F.wrap.unbind('.fb');
            }

            D.unbind('.fb');
            W.unbind('.fb');
        },

        bindEvents: function () {
            var current = F.current,
                keys;

            if (!current) {
                return;
            }

            // Changing document height on iOS devices triggers a 'resize' event,
            // that can change document height... repeating infinitely
            W.bind('orientationchange.fb' + (isTouch ? '' : ' resize.fb') + (current.autoCenter && !current.locked ? ' scroll.fb' : ''), F.update);

            keys = current.keys;

            if (keys) {
                D.bind('keydown.fb', function (e) {
                    var code = e.which || e.keyCode,
                        target = e.target || e.srcElement;

                    // Skip esc key if loading, because showLoading will cancel preloading
                    if (code === 27 && F.coming) {
                        return false;
                    }

                    // Ignore key combinations and key events within form elements
                    if (!e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey && !(target && (target.type || $(target).is('[contenteditable]')))) {
                        $.each(keys, function (i, val) {
                            if (current.group.length > 1 && val[code] !== undefined) {
                                F[i](val[code]);

                                e.preventDefault();
                                return false;
                            }

                            if ($.inArray(code, val) > -1) {
                                F[i]();

                                e.preventDefault();
                                return false;
                            }
                        });
                    }
                });
            }

            if ($.fn.mousewheel && current.mouseWheel) {
                F.wrap.bind('mousewheel.fb', function (e, delta, deltaX, deltaY) {
                    var target = e.target || null,
                        parent = $(target),
                        canScroll = false;

                    while (parent.length) {
                        if (canScroll || parent.is('.fancybox-skin') || parent.is('.fancybox-wrap')) {
                            break;
                        }

                        canScroll = isScrollable(parent[0]);
                        parent = $(parent).parent();
                    }

                    if (delta !== 0 && !canScroll) {
                        if (F.group.length > 1 && !current.canShrink) {
                            if (deltaY > 0 || deltaX > 0) {
                                F.prev(deltaY > 0 ? 'down' : 'left');

                            } else if (deltaY < 0 || deltaX < 0) {
                                F.next(deltaY < 0 ? 'up' : 'right');
                            }

                            e.preventDefault();
                        }
                    }
                });
            }
        },

        trigger: function (event, o) {
            var ret, obj = o || F.coming || F.current;

            if (!obj) {
                return;
            }

            if ($.isFunction(obj[event])) {
                ret = obj[event].apply(obj, Array.prototype.slice.call(arguments, 1));
            }

            if (ret === false) {
                return false;
            }

            if (obj.helpers) {
                $.each(obj.helpers, function (helper, opts) {
                    if (opts && F.helpers[helper] && $.isFunction(F.helpers[helper][event])) {
                        F.helpers[helper][event]($.extend(true, {}, F.helpers[helper].defaults, opts), obj);
                    }
                });
            }

            D.trigger(event);
        },

        isImage: function (str) {
            return isString(str) && str.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i);
        },

        isSWF: function (str) {
            return isString(str) && str.match(/\.(swf)((\?|#).*)?$/i);
        },

        _start: function (index) {
            var coming = {},
                obj,
                href,
                type,
                margin,
                padding;

            index = getScalar(index);
            obj = F.group[index] || null;

            if (!obj) {
                return false;
            }

            coming = $.extend(true, {}, F.opts, obj);

            // Convert margin and padding properties to array - top, right, bottom, left
            margin = coming.margin;
            padding = coming.padding;

            if ($.type(margin) === 'number') {
                coming.margin = [margin, margin, margin, margin];
            }

            if ($.type(padding) === 'number') {
                coming.padding = [padding, padding, padding, padding];
            }

            // 'modal' propery is just a shortcut
            if (coming.modal) {
                $.extend(true, coming, {
                    closeBtn: false,
                    closeClick: false,
                    nextClick: false,
                    arrows: false,
                    mouseWheel: false,
                    keys: null,
                    helpers: {
                        overlay: {
                            closeClick: false
                        }
                    }
                });
            }

            // 'autoSize' property is a shortcut, too
            if (coming.autoSize) {
                coming.autoWidth = coming.autoHeight = true;
            }

            if (coming.width === 'auto') {
                coming.autoWidth = true;
            }

            if (coming.height === 'auto') {
                coming.autoHeight = true;
            }

			/*
			 * Add reference to the group, so it`s possible to access from callbacks, example:
			 * afterLoad : function() {
			 *     this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			 * }
			 */

            coming.group = F.group;
            coming.index = index;

            // Give a chance for callback or helpers to update coming item (type, title, etc)
            F.coming = coming;

            if (false === F.trigger('beforeLoad')) {
                F.coming = null;

                return;
            }

            type = coming.type;
            href = coming.href;

            if (!type) {
                F.coming = null;

                //If we can not determine content type then drop silently or display next/prev item if looping through gallery
                if (F.current && F.router && F.router !== 'jumpto') {
                    F.current.index = index;

                    return F[F.router](F.direction);
                }

                return false;
            }

            F.isActive = true;

            if (type === 'image' || type === 'swf') {
                coming.autoHeight = coming.autoWidth = false;
                coming.scrolling = 'visible';
            }

            if (type === 'image') {
                coming.aspectRatio = true;
            }

            if (type === 'iframe' && isTouch) {
                coming.scrolling = 'scroll';
            }

            // Build the neccessary markup
            coming.wrap = $(coming.tpl.wrap).addClass('fancybox-' + (isTouch ? 'mobile' : 'desktop') + ' fancybox-type-' + type + ' fancybox-tmp ' + coming.wrapCSS).appendTo(coming.parent || 'body');

            $.extend(coming, {
                skin: $('.fancybox-skin', coming.wrap),
                outer: $('.fancybox-outer', coming.wrap),
                inner: $('.fancybox-inner', coming.wrap)
            });

            $.each(["Top", "Right", "Bottom", "Left"], function (i, v) {
                coming.skin.css('padding' + v, getValue(coming.padding[i]));
            });

            F.trigger('onReady');

            // Check before try to load; 'inline' and 'html' types need content, others - href
            if (type === 'inline' || type === 'html') {
                if (!coming.content || !coming.content.length) {
                    return F._error('content');
                }

            } else if (!href) {
                return F._error('href');
            }

            if (type === 'image') {
                F._loadImage();

            } else if (type === 'ajax') {
                F._loadAjax();

            } else if (type === 'iframe') {
                F._loadIframe();

            } else {
                F._afterLoad();
            }
        },

        _error: function (type) {
            $.extend(F.coming, {
                type: 'html',
                autoWidth: true,
                autoHeight: true,
                minWidth: 0,
                minHeight: 0,
                scrolling: 'no',
                hasError: type,
                content: F.coming.tpl.error
            });

            F._afterLoad();
        },

        _loadImage: function () {
            // Reset preload image so it is later possible to check "complete" property
            var img = F.imgPreload = new Image();

            img.onload = function () {
                this.onload = this.onerror = null;

                F.coming.width = this.width / F.opts.pixelRatio;
                F.coming.height = this.height / F.opts.pixelRatio;

                F._afterLoad();
            };

            img.onerror = function () {
                this.onload = this.onerror = null;

                F._error('image');
            };

            img.src = F.coming.href;

            if (img.complete !== true) {
                F.showLoading();
            }
        },

        _loadAjax: function () {
            var coming = F.coming;

            F.showLoading();

            F.ajaxLoad = $.ajax($.extend({}, coming.ajax, {
                url: coming.href,
                error: function (jqXHR, textStatus) {
                    if (F.coming && textStatus !== 'abort') {
                        F._error('ajax', jqXHR);

                    } else {
                        F.hideLoading();
                    }
                },
                success: function (data, textStatus) {
                    if (textStatus === 'success') {
                        coming.content = data;

                        F._afterLoad();
                    }
                }
            }));
        },

        _loadIframe: function () {
            var coming = F.coming,
                iframe = $(coming.tpl.iframe.replace(/\{rnd\}/g, new Date().getTime()))
                    .attr('scrolling', isTouch ? 'auto' : coming.iframe.scrolling)
                    .attr('src', coming.href);

            // This helps IE
            $(coming.wrap).bind('onReset', function () {
                try {
                    $(this).find('iframe').hide().attr('src', '//about:blank').end().empty();
                } catch (e) { }
            });

            if (coming.iframe.preload) {
                F.showLoading();

                iframe.one('load', function () {
                    $(this).data('ready', 1);

                    // iOS will lose scrolling if we resize
                    if (!isTouch) {
                        $(this).bind('load.fb', F.update);
                    }

                    // Without this trick:
                    //   - iframe won't scroll on iOS devices
                    //   - IE7 sometimes displays empty iframe
                    $(this).parents('.fancybox-wrap').width('100%').removeClass('fancybox-tmp').show();

                    F._afterLoad();
                });
            }

            coming.content = iframe.appendTo(coming.inner);

            if (!coming.iframe.preload) {
                F._afterLoad();
            }
        },

        _preloadImages: function () {
            var group = F.group,
                current = F.current,
                len = group.length,
                cnt = current.preload ? Math.min(current.preload, len - 1) : 0,
                item,
                i;

            for (i = 1; i <= cnt; i += 1) {
                item = group[(current.index + i) % len];

                if (item.type === 'image' && item.href) {
                    new Image().src = item.href;
                }
            }
        },

        _afterLoad: function () {
            var coming = F.coming,
                previous = F.current,
                placeholder = 'fancybox-placeholder',
                current,
                content,
                type,
                scrolling,
                href,
                embed;

            F.hideLoading();

            if (!coming || F.isActive === false) {
                return;
            }

            if (false === F.trigger('afterLoad', coming, previous)) {
                coming.wrap.stop(true).trigger('onReset').remove();

                F.coming = null;

                return;
            }

            if (previous) {
                F.trigger('beforeChange', previous);

                previous.wrap.stop(true).removeClass('fancybox-opened')
                    .find('.fancybox-item, .fancybox-nav')
                    .remove();
            }

            F.unbindEvents();

            current = coming;
            content = coming.content;
            type = coming.type;
            scrolling = coming.scrolling;

            $.extend(F, {
                wrap: current.wrap,
                skin: current.skin,
                outer: current.outer,
                inner: current.inner,
                current: current,
                previous: previous
            });

            href = current.href;

            switch (type) {
                case 'inline':
                case 'ajax':
                case 'html':
                    if (current.selector) {
                        content = $('<div>').html(content).find(current.selector);

                    } else if (isQuery(content)) {
                        if (!content.data(placeholder)) {
                            content.data(placeholder, $('<div class="' + placeholder + '"></div>').insertAfter(content).hide());
                        }

                        content = content.show().detach();

                        current.wrap.bind('onReset', function () {
                            if ($(this).find(content).length) {
                                content.hide().replaceAll(content.data(placeholder)).data(placeholder, false);
                            }
                        });
                    }
                    break;

                case 'image':
                    content = current.tpl.image.replace('{href}', href);
                    break;

                case 'swf':
                    content = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + href + '"></param>';
                    embed = '';

                    $.each(current.swf, function (name, val) {
                        content += '<param name="' + name + '" value="' + val + '"></param>';
                        embed += ' ' + name + '="' + val + '"';
                    });

                    content += '<embed src="' + href + '" type="application/x-shockwave-flash" width="100%" height="100%"' + embed + '></embed></object>';
                    break;
            }

            if (!(isQuery(content) && content.parent().is(current.inner))) {
                current.inner.append(content);
            }

            // Give a chance for helpers or callbacks to update elements
            F.trigger('beforeShow');

            // Set scrolling before calculating dimensions
            current.inner.css('overflow', scrolling === 'yes' ? 'scroll' : (scrolling === 'no' ? 'hidden' : scrolling));

            // Set initial dimensions and start position
            F._setDimension();

            F.reposition();

            F.isOpen = false;
            F.coming = null;

            F.bindEvents();

            if (!F.isOpened) {
                $('.fancybox-wrap').not(current.wrap).stop(true).trigger('onReset').remove();

            } else if (previous.prevMethod) {
                F.transitions[previous.prevMethod]();
            }

            F.transitions[F.isOpened ? current.nextMethod : current.openMethod]();

            F._preloadImages();
        },

        _setDimension: function () {
            var viewport = F.getViewport(),
                steps = 0,
                canShrink = false,
                canExpand = false,
                wrap = F.wrap,
                skin = F.skin,
                inner = F.inner,
                current = F.current,
                width = current.width,
                height = current.height,
                minWidth = current.minWidth,
                minHeight = current.minHeight,
                maxWidth = current.maxWidth,
                maxHeight = current.maxHeight,
                scrolling = current.scrolling,
                scrollOut = current.scrollOutside ? current.scrollbarWidth : 0,
                margin = current.margin,
                wMargin = getScalar(margin[1] + margin[3]),
                hMargin = getScalar(margin[0] + margin[2]),
                wPadding,
                hPadding,
                wSpace,
                hSpace,
                origWidth,
                origHeight,
                origMaxWidth,
                origMaxHeight,
                ratio,
                width_,
                height_,
                maxWidth_,
                maxHeight_,
                iframe,
                body;

            // Reset dimensions so we could re-check actual size
            wrap.add(skin).add(inner).width('auto').height('auto').removeClass('fancybox-tmp');

            wPadding = getScalar(skin.outerWidth(true) - skin.width());
            hPadding = getScalar(skin.outerHeight(true) - skin.height());

            // Any space between content and viewport (margin, padding, border, title)
            wSpace = wMargin + wPadding;
            hSpace = hMargin + hPadding;

            origWidth = isPercentage(width) ? (viewport.w - wSpace) * getScalar(width) / 100 : width;
            origHeight = isPercentage(height) ? (viewport.h - hSpace) * getScalar(height) / 100 : height;

            if (current.type === 'iframe') {
                iframe = current.content;

                if (current.autoHeight && iframe.data('ready') === 1) {
                    try {
                        if (iframe[0].contentWindow.document.location) {
                            inner.width(origWidth).height(9999);

                            body = iframe.contents().find('body');

                            if (scrollOut) {
                                body.css('overflow-x', 'hidden');
                            }

                            origHeight = body.outerHeight(true);
                        }

                    } catch (e) { }
                }

            } else if (current.autoWidth || current.autoHeight) {
                inner.addClass('fancybox-tmp');

                // Set width or height in case we need to calculate only one dimension
                if (!current.autoWidth) {
                    inner.width(origWidth);
                }

                if (!current.autoHeight) {
                    inner.height(origHeight);
                }

                if (current.autoWidth) {
                    origWidth = inner.width();
                }

                if (current.autoHeight) {
                    origHeight = inner.height();
                }

                inner.removeClass('fancybox-tmp');
            }

            width = getScalar(origWidth);
            height = getScalar(origHeight);

            ratio = origWidth / origHeight;

            // Calculations for the content
            minWidth = getScalar(isPercentage(minWidth) ? getScalar(minWidth, 'w') - wSpace : minWidth);
            maxWidth = getScalar(isPercentage(maxWidth) ? getScalar(maxWidth, 'w') - wSpace : maxWidth);

            minHeight = getScalar(isPercentage(minHeight) ? getScalar(minHeight, 'h') - hSpace : minHeight);
            maxHeight = getScalar(isPercentage(maxHeight) ? getScalar(maxHeight, 'h') - hSpace : maxHeight);

            // These will be used to determine if wrap can fit in the viewport
            origMaxWidth = maxWidth;
            origMaxHeight = maxHeight;

            if (current.fitToView) {
                maxWidth = Math.min(viewport.w - wSpace, maxWidth);
                maxHeight = Math.min(viewport.h - hSpace, maxHeight);
            }

            maxWidth_ = viewport.w - wMargin;
            maxHeight_ = viewport.h - hMargin;

            if (current.aspectRatio) {
                if (width > maxWidth) {
                    width = maxWidth;
                    height = getScalar(width / ratio);
                }

                if (height > maxHeight) {
                    height = maxHeight;
                    width = getScalar(height * ratio);
                }

                if (width < minWidth) {
                    width = minWidth;
                    height = getScalar(width / ratio);
                }

                if (height < minHeight) {
                    height = minHeight;
                    width = getScalar(height * ratio);
                }

            } else {
                width = Math.max(minWidth, Math.min(width, maxWidth));

                if (current.autoHeight && current.type !== 'iframe') {
                    inner.width(width);

                    height = inner.height();
                }

                height = Math.max(minHeight, Math.min(height, maxHeight));
            }

            // Try to fit inside viewport (including the title)
            if (current.fitToView) {
                inner.width(width).height(height);

                wrap.width(width + wPadding);

                // Real wrap dimensions
                width_ = wrap.width();
                height_ = wrap.height();

                if (current.aspectRatio) {
                    while ((width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight) {
                        if (steps++ > 19) {
                            break;
                        }

                        height = Math.max(minHeight, Math.min(maxHeight, height - 10));
                        width = getScalar(height * ratio);

                        if (width < minWidth) {
                            width = minWidth;
                            height = getScalar(width / ratio);
                        }

                        if (width > maxWidth) {
                            width = maxWidth;
                            height = getScalar(width / ratio);
                        }

                        inner.width(width).height(height);

                        wrap.width(width + wPadding);

                        width_ = wrap.width();
                        height_ = wrap.height();
                    }

                } else {
                    width = Math.max(minWidth, Math.min(width, width - (width_ - maxWidth_)));
                    height = Math.max(minHeight, Math.min(height, height - (height_ - maxHeight_)));
                }
            }

            if (scrollOut && scrolling === 'auto' && height < origHeight && (width + wPadding + scrollOut) < maxWidth_) {
                width += scrollOut;
            }

            inner.width(width).height(height);

            wrap.width(width + wPadding);

            width_ = wrap.width();
            height_ = wrap.height();

            canShrink = (width_ > maxWidth_ || height_ > maxHeight_) && width > minWidth && height > minHeight;
            canExpand = current.aspectRatio ? (width < origMaxWidth && height < origMaxHeight && width < origWidth && height < origHeight) : ((width < origMaxWidth || height < origMaxHeight) && (width < origWidth || height < origHeight));

            $.extend(current, {
                dim: {
                    width: getValue(width_),
                    height: getValue(height_)
                },
                origWidth: origWidth,
                origHeight: origHeight,
                canShrink: canShrink,
                canExpand: canExpand,
                wPadding: wPadding,
                hPadding: hPadding,
                wrapSpace: height_ - skin.outerHeight(true),
                skinSpace: skin.height() - height
            });

            if (!iframe && current.autoHeight && height > minHeight && height < maxHeight && !canExpand) {
                inner.height('auto');
            }
        },

        _getPosition: function (onlyAbsolute) {
            var current = F.current,
                viewport = F.getViewport(),
                margin = current.margin,
                width = F.wrap.width() + margin[1] + margin[3],
                height = F.wrap.height() + margin[0] + margin[2],
                rez = {
                    position: 'absolute',
                    top: margin[0],
                    left: margin[3]
                };

            if (current.autoCenter && current.fixed && !onlyAbsolute && height <= viewport.h && width <= viewport.w) {
                rez.position = 'fixed';

            } else if (!current.locked) {
                rez.top += viewport.y;
                rez.left += viewport.x;
            }

            rez.top = getValue(Math.max(rez.top, rez.top + ((viewport.h - height) * current.topRatio)));
            rez.left = getValue(Math.max(rez.left, rez.left + ((viewport.w - width) * current.leftRatio)));

            return rez;
        },

        _afterZoomIn: function () {
            var current = F.current;

            if (!current) {
                return;
            }

            F.isOpen = F.isOpened = true;

            F.wrap.css('overflow', 'visible').addClass('fancybox-opened');

            F.update();

            // Assign a click event
            if (current.closeClick || (current.nextClick && F.group.length > 1)) {
                F.inner.css('cursor', 'pointer').bind('click.fb', function (e) {
                    if (!$(e.target).is('a') && !$(e.target).parent().is('a')) {
                        e.preventDefault();

                        F[current.closeClick ? 'close' : 'next']();
                    }
                });
            }

            // Create a close button
            if (current.closeBtn) {
                $(current.tpl.closeBtn).appendTo(F.skin).bind('click.fb', function (e) {
                    e.preventDefault();

                    F.close();
                });
            }

            // Create navigation arrows
            if (current.arrows && F.group.length > 1) {
                if (current.loop || current.index > 0) {
                    $(current.tpl.prev).appendTo(F.outer).bind('click.fb', F.prev);
                }

                if (current.loop || current.index < F.group.length - 1) {
                    $(current.tpl.next).appendTo(F.outer).bind('click.fb', F.next);
                }
            }

            F.trigger('afterShow');

            // Stop the slideshow if this is the last item
            if (!current.loop && current.index === current.group.length - 1) {
                F.play(false);

            } else if (F.opts.autoPlay && !F.player.isActive) {
                F.opts.autoPlay = false;

                F.play();
            }
        },

        _afterZoomOut: function (obj) {
            obj = obj || F.current;

            $('.fancybox-wrap').trigger('onReset').remove();

            $.extend(F, {
                group: {},
                opts: {},
                router: false,
                current: null,
                isActive: false,
                isOpened: false,
                isOpen: false,
                isClosing: false,
                wrap: null,
                skin: null,
                outer: null,
                inner: null
            });

            F.trigger('afterClose', obj);
        }
    });

	/*
	 *	Default transitions
	 */

    F.transitions = {
        getOrigPosition: function () {
            var current = F.current,
                element = current.element,
                orig = current.orig,
                pos = {},
                width = 50,
                height = 50,
                hPadding = current.hPadding,
                wPadding = current.wPadding,
                viewport = F.getViewport();

            if (!orig && current.isDom && element.is(':visible')) {
                orig = element.find('img:first');

                if (!orig.length) {
                    orig = element;
                }
            }

            if (isQuery(orig)) {
                pos = orig.offset();

                if (orig.is('img')) {
                    width = orig.outerWidth();
                    height = orig.outerHeight();
                }

            } else {
                pos.top = viewport.y + (viewport.h - height) * current.topRatio;
                pos.left = viewport.x + (viewport.w - width) * current.leftRatio;
            }

            if (F.wrap.css('position') === 'fixed' || current.locked) {
                pos.top -= viewport.y;
                pos.left -= viewport.x;
            }

            pos = {
                top: getValue(pos.top - hPadding * current.topRatio),
                left: getValue(pos.left - wPadding * current.leftRatio),
                width: getValue(width + wPadding),
                height: getValue(height + hPadding)
            };

            return pos;
        },

        step: function (now, fx) {
            var ratio,
                padding,
                value,
                prop = fx.prop,
                current = F.current,
                wrapSpace = current.wrapSpace,
                skinSpace = current.skinSpace;

            if (prop === 'width' || prop === 'height') {
                ratio = fx.end === fx.start ? 1 : (now - fx.start) / (fx.end - fx.start);

                if (F.isClosing) {
                    ratio = 1 - ratio;
                }

                padding = prop === 'width' ? current.wPadding : current.hPadding;
                value = now - padding;

                F.skin[prop](getScalar(prop === 'width' ? value : value - (wrapSpace * ratio)));
                F.inner[prop](getScalar(prop === 'width' ? value : value - (wrapSpace * ratio) - (skinSpace * ratio)));
            }
        },

        zoomIn: function () {
            var current = F.current,
                startPos = current.pos,
                effect = current.openEffect,
                elastic = effect === 'elastic',
                endPos = $.extend({ opacity: 1 }, startPos);

            // Remove "position" property that breaks older IE
            delete endPos.position;

            if (elastic) {
                startPos = this.getOrigPosition();

                if (current.openOpacity) {
                    startPos.opacity = 0.1;
                }

            } else if (effect === 'fade') {
                startPos.opacity = 0.1;
            }

            F.wrap.css(startPos).animate(endPos, {
                duration: effect === 'none' ? 0 : current.openSpeed,
                easing: current.openEasing,
                step: elastic ? this.step : null,
                complete: F._afterZoomIn
            });
        },

        zoomOut: function () {
            var current = F.current,
                effect = current.closeEffect,
                elastic = effect === 'elastic',
                endPos = { opacity: 0.1 };

            if (elastic) {
                endPos = this.getOrigPosition();

                if (current.closeOpacity) {
                    endPos.opacity = 0.1;
                }
            }

            F.wrap.animate(endPos, {
                duration: effect === 'none' ? 0 : current.closeSpeed,
                easing: current.closeEasing,
                step: elastic ? this.step : null,
                complete: F._afterZoomOut
            });
        },

        changeIn: function () {
            var current = F.current,
                effect = current.nextEffect,
                startPos = current.pos,
                endPos = { opacity: 1 },
                direction = F.direction,
                distance = 200,
                field;

            startPos.opacity = 0.1;

            if (effect === 'elastic') {
                field = direction === 'down' || direction === 'up' ? 'top' : 'left';

                if (direction === 'down' || direction === 'right') {
                    startPos[field] = getValue(getScalar(startPos[field]) - distance);
                    endPos[field] = '+=' + distance + 'px';

                } else {
                    startPos[field] = getValue(getScalar(startPos[field]) + distance);
                    endPos[field] = '-=' + distance + 'px';
                }
            }

            // Workaround for http://bugs.jquery.com/ticket/12273
            if (effect === 'none') {
                F._afterZoomIn();

            } else {
                F.wrap.css(startPos).animate(endPos, {
                    duration: current.nextSpeed,
                    easing: current.nextEasing,
                    complete: F._afterZoomIn
                });
            }
        },

        changeOut: function () {
            var previous = F.previous,
                effect = previous.prevEffect,
                endPos = { opacity: 0.1 },
                direction = F.direction,
                distance = 200;

            if (effect === 'elastic') {
                endPos[direction === 'down' || direction === 'up' ? 'top' : 'left'] = (direction === 'up' || direction === 'left' ? '-' : '+') + '=' + distance + 'px';
            }

            previous.wrap.animate(endPos, {
                duration: effect === 'none' ? 0 : previous.prevSpeed,
                easing: previous.prevEasing,
                complete: function () {
                    $(this).trigger('onReset').remove();
                }
            });
        }
    };

	/*
	 *	Overlay helper
	 */

    F.helpers.overlay = {
        defaults: {
            closeClick: true,      // if true, fancyBox will be closed when user clicks on the overlay
            speedOut: 200,       // duration of fadeOut animation
            showEarly: true,      // indicates if should be opened immediately or wait until the content is ready
            css: {},        // custom CSS properties
            locked: !isTouch,  // if true, the content will be locked into overlay
            fixed: true       // if false, the overlay CSS position property will not be set to "fixed"
        },

        overlay: null,      // current handle
        fixed: false,     // indicates if the overlay has position "fixed"
        el: $('html'), // element that contains "the lock"

        // Public methods
        create: function (opts) {
            opts = $.extend({}, this.defaults, opts);

            if (this.overlay) {
                this.close();
            }

            this.overlay = $('<div class="fancybox-overlay"></div>').appendTo(F.coming ? F.coming.parent : opts.parent);
            this.fixed = false;

            if (opts.fixed && F.defaults.fixed) {
                this.overlay.addClass('fancybox-overlay-fixed');

                this.fixed = true;
            }
        },

        open: function (opts) {
            var that = this;

            opts = $.extend({}, this.defaults, opts);

            if (this.overlay) {
                this.overlay.unbind('.overlay').width('auto').height('auto');

            } else {
                this.create(opts);
            }

            if (!this.fixed) {
                W.bind('resize.overlay', $.proxy(this.update, this));

                this.update();
            }

            if (opts.closeClick) {
                this.overlay.bind('click.overlay', function (e) {
                    if ($(e.target).hasClass('fancybox-overlay')) {
                        if (F.isActive) {
                            F.close();
                        } else {
                            that.close();
                        }

                        return false;
                    }
                });
            }

            this.overlay.css(opts.css).show();
        },

        close: function () {
            var scrollV, scrollH;

            W.unbind('resize.overlay');

            if (this.el.hasClass('fancybox-lock')) {
                $('.fancybox-margin').removeClass('fancybox-margin');

                scrollV = W.scrollTop();
                scrollH = W.scrollLeft();

                this.el.removeClass('fancybox-lock');

                W.scrollTop(scrollV).scrollLeft(scrollH);
            }

            $('.fancybox-overlay').remove().hide();

            $.extend(this, {
                overlay: null,
                fixed: false
            });
        },

        // Private, callbacks

        update: function () {
            var width = '100%', offsetWidth;

            // Reset width/height so it will not mess
            this.overlay.width(width).height('100%');

            // jQuery does not return reliable result for IE
            if (IE) {
                offsetWidth = Math.max(document.documentElement.offsetWidth, document.body.offsetWidth);

                if (D.width() > offsetWidth) {
                    width = D.width();
                }

            } else if (D.width() > W.width()) {
                width = D.width();
            }

            this.overlay.width(width).height(D.height());
        },

        // This is where we can manipulate DOM, because later it would cause iframes to reload
        onReady: function (opts, obj) {
            var overlay = this.overlay;

            $('.fancybox-overlay').stop(true, true);

            if (!overlay) {
                this.create(opts);
            }

            if (opts.locked && this.fixed && obj.fixed) {
                if (!overlay) {
                    this.margin = D.height() > W.height() ? $('html').css('margin-right').replace("px", "") : false;
                }

                obj.locked = this.overlay.append(obj.wrap);
                obj.fixed = false;
            }

            if (opts.showEarly === true) {
                this.beforeShow.apply(this, arguments);
            }
        },

        beforeShow: function (opts, obj) {
            var scrollV, scrollH;

            if (obj.locked) {
                if (this.margin !== false) {
                    $('*').filter(function () {
                        return ($(this).css('position') === 'fixed' && !$(this).hasClass("fancybox-overlay") && !$(this).hasClass("fancybox-wrap"));
                    }).addClass('fancybox-margin');

                    this.el.addClass('fancybox-margin');
                }

                scrollV = W.scrollTop();
                scrollH = W.scrollLeft();

                this.el.addClass('fancybox-lock');

                W.scrollTop(scrollV).scrollLeft(scrollH);
            }

            this.open(opts);
        },

        onUpdate: function () {
            if (!this.fixed) {
                this.update();
            }
        },

        afterClose: function (opts) {
            // Remove overlay if exists and fancyBox is not opening
            // (e.g., it is not being open using afterClose callback)
            //if (this.overlay && !F.isActive) {
            if (this.overlay && !F.coming) {
                this.overlay.fadeOut(opts.speedOut, $.proxy(this.close, this));
            }
        }
    };

	/*
	 *	Title helper
	 */

    F.helpers.title = {
        defaults: {
            type: 'float', // 'float', 'inside', 'outside' or 'over',
            position: 'bottom' // 'top' or 'bottom'
        },

        beforeShow: function (opts) {
            var current = F.current,
                text = current.title,
                type = opts.type,
                title,
                target;

            if ($.isFunction(text)) {
                text = text.call(current.element, current);
            }

            if (!isString(text) || $.trim(text) === '') {
                return;
            }

            title = $('<div class="fancybox-title fancybox-title-' + type + '-wrap">' + text + '</div>');

            switch (type) {
                case 'inside':
                    target = F.skin;
                    break;

                case 'outside':
                    target = F.wrap;
                    break;

                case 'over':
                    target = F.inner;
                    break;

                default: // 'float'
                    target = F.skin;

                    title.appendTo('body');

                    if (IE) {
                        title.width(title.width());
                    }

                    title.wrapInner('<span class="child"></span>');

                    //Increase bottom margin so this title will also fit into viewport
                    F.current.margin[2] += Math.abs(getScalar(title.css('margin-bottom')));
                    break;
            }

            title[(opts.position === 'top' ? 'prependTo' : 'appendTo')](target);
        }
    };

    // jQuery plugin initialization
    $.fn.fancybox = function (options) {
        var index,
            that = $(this),
            selector = this.selector || '',
            run = function (e) {
                var what = $(this).blur(), idx = index, relType, relVal;

                if (!(e.ctrlKey || e.altKey || e.shiftKey || e.metaKey) && !what.is('.fancybox-wrap')) {
                    relType = options.groupAttr || 'data-fancybox-group';
                    relVal = what.attr(relType);

                    if (!relVal) {
                        relType = 'rel';
                        relVal = what.get(0)[relType];
                    }

                    if (relVal && relVal !== '' && relVal !== 'nofollow') {
                        what = selector.length ? $(selector) : that;
                        what = what.filter('[' + relType + '="' + relVal + '"]');
                        idx = what.index(this);
                    }

                    options.index = idx;

                    // Stop an event from bubbling if everything is fine
                    if (F.open(what, options) !== false) {
                        e.preventDefault();
                    }
                }
            };

        options = options || {};
        index = options.index || 0;

        if (!selector || options.live === false) {
            that.unbind('click.fb-start').bind('click.fb-start', run);

        } else {
            D.undelegate(selector, 'click.fb-start').delegate(selector + ":not('.fancybox-item, .fancybox-nav')", 'click.fb-start', run);
        }

        this.filter('[data-fancybox-start=1]').trigger('click');

        return this;
    };

    // Tests that need a body at doc ready
    D.ready(function () {
        var w1, w2;

        if ($.scrollbarWidth === undefined) {
            // http://benalman.com/projects/jquery-misc-plugins/#scrollbarwidth
            $.scrollbarWidth = function () {
                var parent = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body'),
                    child = parent.children(),
                    width = child.innerWidth() - child.height(99).innerWidth();

                parent.remove();

                return width;
            };
        }

        if ($.support.fixedPosition === undefined) {
            $.support.fixedPosition = (function () {
                var elem = $('<div style="position:fixed;top:20px;"></div>').appendTo('body'),
                    fixed = (elem[0].offsetTop === 20 || elem[0].offsetTop === 15);

                elem.remove();

                return fixed;
            }());
        }

        $.extend(F.defaults, {
            scrollbarWidth: $.scrollbarWidth(),
            fixed: $.support.fixedPosition,
            parent: $('body')
        });

        //Get real width of page scroll-bar
        w1 = $(window).width();

        H.addClass('fancybox-lock-test');

        w2 = $(window).width();

        H.removeClass('fancybox-lock-test');

        $("<style type='text/css'>.fancybox-margin{margin-right:" + (w2 - w1) + "px;}</style>").appendTo("head");
    });

}(window, document, jQuery));


$(document).ready(function () {

    jQuery("a[class*=lightbox]").each(function (index, link) {
        if (link.href.split('#')[0] == (window.location.origin + window.location.pathname)) {
            link.href = "#" + link.href.split('#')[1];
        }
    });


});
!function (e) { "use strict"; var t = { i18n: { ru: { months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"], dayOfWeek: ["Вск", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"] }, en: { months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], dayOfWeek: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"] }, de: { months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"], dayOfWeek: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"] }, nl: { months: ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"], dayOfWeek: ["zo", "ma", "di", "wo", "do", "vr", "za"] }, tr: { months: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], dayOfWeek: ["Paz", "Pts", "Sal", "Çar", "Per", "Cum", "Cts"] }, fr: { months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"], dayOfWeek: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"] }, es: { months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], dayOfWeek: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"] }, th: { months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"], dayOfWeek: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."] }, pl: { months: ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"], dayOfWeek: ["nd", "pn", "wt", "śr", "cz", "pt", "sb"] }, pt: { months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"], dayOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"] }, ch: { months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayOfWeek: ["日", "一", "二", "三", "四", "五", "六"] }, se: { months: ["Januari", "Februari", "Mars", "April", "Maj", "Juni", "Juli", "Augusti", "September", "Oktober", "November", "December"], dayOfWeek: ["Sön", "Mån", "Tis", "Ons", "Tor", "Fre", "Lör"] }, kr: { months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"], dayOfWeek: ["일", "월", "화", "수", "목", "금", "토"] }, it: { months: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"], dayOfWeek: ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"] }, da: { months: ["January", "Februar", "Marts", "April", "Maj", "Juni", "July", "August", "September", "Oktober", "November", "December"], dayOfWeek: ["Søn", "Man", "Tir", "ons", "Tor", "Fre", "lør"] }, ja: { months: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"], dayOfWeek: ["日", "月", "火", "水", "木", "金", "土"] }, vi: { months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"], dayOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"] } }, value: "", lang: "en", format: "Y/m/d H:i", formatTime: "H:i", formatDate: "Y/m/d", startDate: !1, step: 60, closeOnDateSelect: !1, closeOnWithoutClick: !0, timepicker: !0, datepicker: !0, minDate: !1, maxDate: !1, minTime: !1, maxTime: !1, allowTimes: [], opened: !1, initTime: !0, inline: !1, onSelectDate: function () { }, onSelectTime: function () { }, onChangeMonth: function () { }, onChangeDateTime: function () { }, onShow: function () { }, onClose: function () { }, onGenerate: function () { }, withoutCopyright: !0, inverseButton: !1, hours12: !1, next: "xdsoft_next", prev: "xdsoft_prev", dayOfWeekStart: 0, timeHeightInTimePicker: 25, timepickerScrollbar: !0, todayButton: !0, defaultSelect: !0, scrollMonth: !0, scrollTime: !0, scrollInput: !0, lazyInit: !1, mask: !1, validateOnBlur: !0, allowBlank: !0, yearStart: 1950, yearEnd: 2050, style: "", id: "", roundTime: "round", className: "", weekends: [], yearOffset: 0 }; Array.prototype.indexOf || (Array.prototype.indexOf = function (e, t) { for (var n = t || 0, a = this.length; a > n; n++)if (this[n] === e) return n; return -1 }), e.fn.xdsoftScroller = function (t) { return this.each(function () { var n = e(this); if (!e(this).hasClass("xdsoft_scroller_box")) { var a = function (e) { var t = { x: 0, y: 0 }; if ("touchstart" == e.type || "touchmove" == e.type || "touchend" == e.type || "touchcancel" == e.type) { var n = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0]; t.x = n.pageX, t.y = n.pageY } else ("mousedown" == e.type || "mouseup" == e.type || "mousemove" == e.type || "mouseover" == e.type || "mouseout" == e.type || "mouseenter" == e.type || "mouseleave" == e.type) && (t.x = e.pageX, t.y = e.pageY); return t }, r = 0, o = n.children().eq(0), s = n[0].clientHeight, i = o[0].offsetHeight, d = e('<div class="xdsoft_scrollbar"></div>'), u = e('<div class="xdsoft_scroller"></div>'), c = 100, l = !1; d.append(u), n.addClass("xdsoft_scroller_box").append(d), u.on("mousedown.xdsoft_scroller", function (a) { s || n.trigger("resize_scroll.xdsoft_scroller", [t]); var o = a.pageY, i = parseInt(u.css("margin-top")), l = d[0].offsetHeight; e(document.body).addClass("xdsoft_noselect"), e([document.body, window]).on("mouseup.xdsoft_scroller", function f() { e([document.body, window]).off("mouseup.xdsoft_scroller", f).off("mousemove.xdsoft_scroller", r).removeClass("xdsoft_noselect") }), e(document.body).on("mousemove.xdsoft_scroller", r = function (e) { var t = e.pageY - o + i; 0 > t && (t = 0), t + u[0].offsetHeight > l && (t = l - u[0].offsetHeight), n.trigger("scroll_element.xdsoft_scroller", [c ? t / c : 0]) }) }), n.on("scroll_element.xdsoft_scroller", function (e, t) { s || n.trigger("resize_scroll.xdsoft_scroller", [t, !0]), t = t > 1 ? 1 : 0 > t || isNaN(t) ? 0 : t, u.css("margin-top", c * t), o.css("marginTop", -parseInt((i - s) * t)) }).on("resize_scroll.xdsoft_scroller", function (e, t, a) { s = n[0].clientHeight, i = o[0].offsetHeight; var r = s / i, l = r * d[0].offsetHeight; r > 1 ? u.hide() : (u.show(), u.css("height", parseInt(l > 10 ? l : 10)), c = d[0].offsetHeight - u[0].offsetHeight, a !== !0 && n.trigger("scroll_element.xdsoft_scroller", [t ? t : Math.abs(parseInt(o.css("marginTop"))) / (i - s)])) }), n.mousewheel && n.mousewheel(function (e, t, a, r) { var d = Math.abs(parseInt(o.css("marginTop"))); return n.trigger("scroll_element.xdsoft_scroller", [(d - 20 * t) / (i - s)]), e.stopPropagation(), !1 }), n.on("touchstart", function (e) { l = a(e) }), n.on("touchmove", function (e) { if (l) { var t = a(e), r = Math.abs(parseInt(o.css("marginTop"))); n.trigger("scroll_element.xdsoft_scroller", [(r - (t.y - l.y)) / (i - s)]), e.stopPropagation(), e.preventDefault() } }), n.on("touchend touchcancel", function (e) { l = !1 }) } n.trigger("resize_scroll.xdsoft_scroller", [t]) }) }, e.fn.datetimepicker = function (n) { var a = 48, r = 57, o = 96, s = 105, i = 17, d = 46, u = 13, c = 27, l = 8, f = 37, m = 38, h = 39, g = 40, p = 9, x = 116, v = 65, y = 67, D = 86, T = 90, w = 89, b = !1, _ = e.isPlainObject(n) || !n ? e.extend(!0, {}, t, n) : e.extend({}, t), M = 0, k = function (e) { e.on("open.xdsoft focusin.xdsoft mousedown.xdsoft", function t(n) { e.is(":disabled") || e.is(":hidden") || !e.is(":visible") || e.data("xdsoft_datetimepicker") || (clearTimeout(M), M = setTimeout(function () { e.data("xdsoft_datetimepicker") || S(e), e.off("open.xdsoft focusin.xdsoft mousedown.xdsoft", t).trigger("open.xdsoft") }, 100)) }) }, S = function (t) { function n() { var e = _.value ? _.value : t && t.val && t.val() ? t.val() : ""; return e && W.isValidDate(e = Date.parseDate(e, _.format)) ? M.data("changed", !0) : e = "", e || _.startDate === !1 || (e = W.strToDateTime(_.startDate)), e ? e : 0 } var M = e("<div " + (_.id ? 'id="' + _.id + '"' : "") + " " + (_.style ? 'style="' + _.style + '"' : "") + ' class="xdsoft_datetimepicker xdsoft_noselect ' + _.className + '"></div>'), k = e('<div class="xdsoft_copyright"><a target="_blank" href="http://xdsoft.net/jqplugins/datetimepicker/">xdsoft.net</a></div>'), S = e('<div class="xdsoft_datepicker active"></div>'), O = e('<div class="xdsoft_mounthpicker"><button type="button" class="xdsoft_prev"></button><button type="button" class="xdsoft_today_button"></button><div class="xdsoft_label xdsoft_month"><span></span></div><div class="xdsoft_label xdsoft_year"><span></span></div><button type="button" class="xdsoft_next"></button></div>'), F = e('<div class="xdsoft_calendar"></div>'), I = e('<div class="xdsoft_timepicker active"><button type="button" class="xdsoft_prev"></button><div class="xdsoft_time_box"></div><button type="button" class="xdsoft_next"></button></div>'), C = I.find(".xdsoft_time_box").eq(0), H = e('<div class="xdsoft_time_variant"></div>'), Y = e('<div class="xdsoft_scrollbar"></div>'), P = (e('<div class="xdsoft_scroller"></div>'), e('<div class="xdsoft_select xdsoft_monthselect"><div></div></div>')), A = e('<div class="xdsoft_select xdsoft_yearselect"><div></div></div>'); O.find(".xdsoft_month span").after(P), O.find(".xdsoft_year span").after(A), O.find(".xdsoft_month,.xdsoft_year").on("mousedown.xdsoft", function (t) { O.find(".xdsoft_select").hide(); var n = e(this).find(".xdsoft_select").eq(0), a = 0, r = 0; W.currentTime && (a = W.currentTime[e(this).hasClass("xdsoft_month") ? "getMonth" : "getFullYear"]()), n.show(); for (var o = n.find("div.xdsoft_option"), s = 0; s < o.length && o.eq(s).data("value") != a; s++)r += o[0].offsetHeight; return n.xdsoftScroller(r / (n.children()[0].offsetHeight - n[0].clientHeight)), t.stopPropagation(), !1 }), O.find(".xdsoft_select").xdsoftScroller().on("mousedown.xdsoft", function (e) { e.stopPropagation(), e.preventDefault() }).on("mousedown.xdsoft", ".xdsoft_option", function (t) { W && W.currentTime && W.currentTime[e(this).parent().parent().hasClass("xdsoft_monthselect") ? "setMonth" : "setFullYear"](e(this).data("value")), e(this).parent().parent().hide(), M.trigger("xchange.xdsoft"), _.onChangeMonth && _.onChangeMonth.call && _.onChangeMonth.call(M, W.currentTime, M.data("input")) }), M.setOptions = function (n) { if (_ = e.extend(!0, {}, _, n), n.allowTimes && e.isArray(n.allowTimes) && n.allowTimes.length && (_.allowTimes = e.extend(!0, [], n.allowTimes)), n.weekends && e.isArray(n.weekends) && n.weekends.length && (_.weekends = e.extend(!0, [], n.weekends)), !_.open && !_.opened || _.inline || t.trigger("open.xdsoft"), _.inline && (M.addClass("xdsoft_inline"), t.after(M).hide(), M.trigger("afterOpen.xdsoft")), _.inverseButton && (_.next = "xdsoft_prev", _.prev = "xdsoft_next"), _.datepicker ? S.addClass("active") : S.removeClass("active"), _.timepicker ? I.addClass("active") : I.removeClass("active"), _.value && (t && t.val && t.val(_.value), W.setCurrentTime(_.value)), isNaN(_.dayOfWeekStart) || parseInt(_.dayOfWeekStart) < 0 || parseInt(_.dayOfWeekStart) > 6 ? _.dayOfWeekStart = 0 : _.dayOfWeekStart = parseInt(_.dayOfWeekStart), _.timepickerScrollbar || Y.hide(), _.minDate && /^-(.*)$/.test(_.minDate) && (_.minDate = W.strToDateTime(_.minDate).dateFormat(_.formatDate)), _.maxDate && /^\+(.*)$/.test(_.maxDate) && (_.maxDate = W.strToDateTime(_.maxDate).dateFormat(_.formatDate)), O.find(".xdsoft_today_button").css("visibility", _.todayButton ? "visible" : "hidden"), _.mask) { var k = function (e) { try { if (document.selection && document.selection.createRange) { var t = document.selection.createRange(); return t.getBookmark().charCodeAt(2) - 2 } if (e.setSelectionRange) return e.selectionStart } catch (n) { return 0 } }, F = function (e, t) { var e = "string" == typeof e || e instanceof String ? document.getElementById(e) : e; if (!e) return !1; if (e.createTextRange) { var n = e.createTextRange(); return n.collapse(!0), n.moveEnd(t), n.moveStart(t), n.select(), !0 } return e.setSelectionRange ? (e.setSelectionRange(t, t), !0) : !1 }, C = function (e, t) { var n = e.replace(/([\[\]\/\{\}\(\)\-\.\+]{1})/g, "\\$1").replace(/_/g, "{digit+}").replace(/([0-9]{1})/g, "{digit$1}").replace(/\{digit([0-9]{1})\}/g, "[0-$1_]{1}").replace(/\{digit[\+]\}/g, "[0-9_]{1}"); return RegExp(n).test(t) }; switch (t.off("keydown.xdsoft"), !0) { case _.mask === !0: _.mask = _.format.replace(/Y/g, "9999").replace(/F/g, "9999").replace(/m/g, "19").replace(/d/g, "39").replace(/H/g, "29").replace(/i/g, "59").replace(/s/g, "59"); case "string" == e.type(_.mask): C(_.mask, t.val()) || t.val(_.mask.replace(/[0-9]/g, "_")), t.on("keydown.xdsoft", function (n) { var M = this.value, S = n.which; switch (!0) { case S >= a && r >= S || S >= o && s >= S || S == l || S == d: var O = k(this), I = S != l && S != d ? String.fromCharCode(S >= o && s >= S ? S - a : S) : "_"; for (S != l && S != d || !O || (O-- , I = "_"); /[^0-9_]/.test(_.mask.substr(O, 1)) && O < _.mask.length && O > 0;)O += S == l || S == d ? -1 : 1; if (M = M.substr(0, O) + I + M.substr(O + 1), "" == e.trim(M)) M = _.mask.replace(/[0-9]/g, "_"); else if (O == _.mask.length) break; for (O += S == l || S == d ? 0 : 1; /[^0-9_]/.test(_.mask.substr(O, 1)) && O < _.mask.length && O > 0;)O += S == l || S == d ? -1 : 1; C(_.mask, M) ? (this.value = M, F(this, O)) : "" == e.trim(M) ? this.value = _.mask.replace(/[0-9]/g, "_") : t.trigger("error_input.xdsoft"); break; case !!~[v, y, D, T, w].indexOf(S) && b: case !!~[c, m, g, f, h, x, i, p, u].indexOf(S): return !0 }return n.preventDefault(), !1 }) } } _.validateOnBlur && t.off("blur.xdsoft").on("blur.xdsoft", function () { _.allowBlank && !e.trim(e(this).val()).length ? (e(this).val(null), M.data("xdsoft_datetime").empty()) : Date.parseDate(e(this).val(), _.format) ? M.data("xdsoft_datetime").setCurrentTime(e(this).val()) : (e(this).val(W.now().dateFormat(_.format)), M.data("xdsoft_datetime").setCurrentTime(e(this).val())), M.trigger("changedatetime.xdsoft") }), _.dayOfWeekStartPrev = 0 == _.dayOfWeekStart ? 6 : _.dayOfWeekStart - 1, M.trigger("xchange.xdsoft") }, M.data("options", _).on("mousedown.xdsoft", function (e) { return e.stopPropagation(), e.preventDefault(), A.hide(), P.hide(), !1 }); var N = I.find(".xdsoft_time_box"); N.append(H), N.xdsoftScroller(), M.on("afterOpen.xdsoft", function () { N.xdsoftScroller() }), M.append(S).append(I), _.withoutCopyright !== !0 && M.append(k), S.append(O).append(F), e("body").append(M); var W = new function () { var e = this; e.now = function () { var e = new Date; return _.yearOffset && e.setFullYear(e.getFullYear() + _.yearOffset), e }, e.currentTime = this.now(), e.isValidDate = function (e) { return "[object Date]" !== Object.prototype.toString.call(e) ? !1 : !isNaN(e.getTime()) }, e.setCurrentTime = function (t) { e.currentTime = "string" == typeof t ? e.strToDateTime(t) : e.isValidDate(t) ? t : e.now(), M.trigger("xchange.xdsoft") }, e.empty = function () { e.currentTime = null }, e.getCurrentTime = function (t) { return e.currentTime }, e.nextMonth = function () { var t = e.currentTime.getMonth() + 1; return 12 == t && (e.currentTime.setFullYear(e.currentTime.getFullYear() + 1), t = 0), e.currentTime.setDate(Math.min(Date.daysInMonth[t], e.currentTime.getDate())), e.currentTime.setMonth(t), _.onChangeMonth && _.onChangeMonth.call && _.onChangeMonth.call(M, W.currentTime, M.data("input")), M.trigger("xchange.xdsoft"), t }, e.prevMonth = function () { var t = e.currentTime.getMonth() - 1; return -1 == t && (e.currentTime.setFullYear(e.currentTime.getFullYear() - 1), t = 11), e.currentTime.setDate(Math.min(Date.daysInMonth[t], e.currentTime.getDate())), e.currentTime.setMonth(t), _.onChangeMonth && _.onChangeMonth.call && _.onChangeMonth.call(M, W.currentTime, M.data("input")), M.trigger("xchange.xdsoft"), t }, e.strToDateTime = function (t) { var n, a, r = []; return (r = /^(\+|\-)(.*)$/.exec(t)) && (r[2] = Date.parseDate(r[2], _.formatDate)) ? (n = r[2].getTime() - 1 * r[2].getTimezoneOffset() * 6e4, a = new Date(W.now().getTime() + parseInt(r[1] + "1") * n)) : a = t ? Date.parseDate(t, _.format) : e.now(), e.isValidDate(a) || (a = e.now()), a }, e.strtodate = function (t) { var n = t ? Date.parseDate(t, _.formatDate) : e.now(); return e.isValidDate(n) || (n = e.now()), n }, e.strtotime = function (t) { var n = t ? Date.parseDate(t, _.formatTime) : e.now(); return e.isValidDate(n) || (n = e.now()), n }, e.str = function () { return e.currentTime.dateFormat(_.format) } }; O.find(".xdsoft_today_button").on("mousedown.xdsoft", function () { M.data("changed", !0), W.setCurrentTime(0), M.trigger("afterOpen.xdsoft") }).on("dblclick.xdsoft", function () { t.val(W.str()), M.trigger("close.xdsoft") }), O.find(".xdsoft_prev,.xdsoft_next").on("mousedown.xdsoft", function () { var t = e(this), n = 0, a = !1; !function r(e) { W.currentTime.getMonth(); t.hasClass(_.next) ? W.nextMonth() : t.hasClass(_.prev) && W.prevMonth(), !a && (n = setTimeout(r, e ? e : 100)) }(500), e([document.body, window]).on("mouseup.xdsoft", function o() { clearTimeout(n), a = !0, e([document.body, window]).off("mouseup.xdsoft", o) }) }), I.find(".xdsoft_prev,.xdsoft_next").on("mousedown.xdsoft", function () { var t = e(this), n = 0, a = !1, r = 110; !function o(e) { var s = C[0].clientHeight, i = H[0].offsetHeight, d = Math.abs(parseInt(H.css("marginTop"))); t.hasClass(_.next) && i - s - _.timeHeightInTimePicker >= d ? H.css("marginTop", "-" + (d + _.timeHeightInTimePicker) + "px") : t.hasClass(_.prev) && d - _.timeHeightInTimePicker >= 0 && H.css("marginTop", "-" + (d - _.timeHeightInTimePicker) + "px"), C.trigger("scroll_element.xdsoft_scroller", [Math.abs(parseInt(H.css("marginTop")) / (i - s))]), r = r > 10 ? 10 : r - 10, !a && (n = setTimeout(o, e ? e : r)) }(500), e([document.body, window]).on("mouseup.xdsoft", function s() { clearTimeout(n), a = !0, e([document.body, window]).off("mouseup.xdsoft", s) }) }); var z = 0; M.on("xchange.xdsoft", function (t) { clearTimeout(z), z = setTimeout(function () { for (var t = "", n = new Date(W.currentTime.getFullYear(), W.currentTime.getMonth(), 1, 12, 0, 0), a = 0, r = W.now(); n.getDay() != _.dayOfWeekStart;)n.setDate(n.getDate() - 1); t += "<table><thead><tr>"; for (var o = 0; 7 > o; o++)t += "<th>" + _.i18n[_.lang].dayOfWeek[o + _.dayOfWeekStart > 6 ? 0 : o + _.dayOfWeekStart] + "</th>"; t += "</tr></thead>", t += "<tbody><tr>"; var s = !1, i = !1; _.maxDate !== !1 && (s = W.strtodate(_.maxDate), s = new Date(s.getFullYear(), s.getMonth(), s.getDate(), 23, 59, 59, 999)), _.minDate !== !1 && (i = W.strtodate(_.minDate), i = new Date(i.getFullYear(), i.getMonth(), i.getDate())); for (var d, u, c, l = []; a < W.currentTime.getDaysInMonth() || n.getDay() != _.dayOfWeekStart || W.currentTime.getMonth() == n.getMonth();)l = [], a++ , d = n.getDate(), u = n.getFullYear(), c = n.getMonth(), l.push("xdsoft_date"), (s !== !1 && n > s || i !== !1 && i > n) && l.push("xdsoft_disabled"), W.currentTime.getMonth() != c && l.push("xdsoft_other_month"), (_.defaultSelect || M.data("changed")) && W.currentTime.dateFormat("d.m.Y") == n.dateFormat("d.m.Y") && l.push("xdsoft_current"), r.dateFormat("d.m.Y") == n.dateFormat("d.m.Y") && l.push("xdsoft_today"), (0 == n.getDay() || 6 == n.getDay() || ~_.weekends.indexOf(n.dateFormat("d.m.Y"))) && l.push("xdsoft_weekend"), _.beforeShowDay && "function" == typeof _.beforeShowDay && l.push(_.beforeShowDay(n)), t += '<td data-date="' + d + '" data-month="' + c + '" data-year="' + u + '" class="xdsoft_date xdsoft_day_of_week' + n.getDay() + " " + l.join(" ") + '"><div>' + d + "</div></td>", n.getDay() == _.dayOfWeekStartPrev && (t += "</tr>"), n.setDate(d + 1); t += "</tbody></table>", F.html(t), O.find(".xdsoft_label span").eq(0).text(_.i18n[_.lang].months[W.currentTime.getMonth()]), O.find(".xdsoft_label span").eq(1).text(W.currentTime.getFullYear()); var f = "", m = "", c = "", h = function (e, t) { var n = W.now(); n.setHours(e), e = parseInt(n.getHours()), n.setMinutes(t), t = parseInt(n.getMinutes()), l = [], (_.maxTime !== !1 && W.strtotime(_.maxTime).getTime() < n.getTime() || _.minTime !== !1 && W.strtotime(_.minTime).getTime() > n.getTime()) && l.push("xdsoft_disabled"), (_.initTime || _.defaultSelect || M.data("changed")) && parseInt(W.currentTime.getHours()) == parseInt(e) && (_.step > 59 || Math[_.roundTime](W.currentTime.getMinutes() / _.step) * _.step == parseInt(t)) && (_.defaultSelect || M.data("changed") ? l.push("xdsoft_current") : _.initTime && l.push("xdsoft_init_time")), parseInt(r.getHours()) == parseInt(e) && parseInt(r.getMinutes()) == parseInt(t) && l.push("xdsoft_today"), f += '<div class="xdsoft_time ' + l.join(" ") + '" data-hour="' + e + '" data-minute="' + t + '">' + n.dateFormat(_.formatTime) + "</div>" }; if (_.allowTimes && e.isArray(_.allowTimes) && _.allowTimes.length) for (var a = 0; a < _.allowTimes.length; a++)m = W.strtotime(_.allowTimes[a]).getHours(), c = W.strtotime(_.allowTimes[a]).getMinutes(), h(m, c); else for (var a = 0, o = 0; a < (_.hours12 ? 12 : 24); a++)for (o = 0; 60 > o; o += _.step)m = (10 > a ? "0" : "") + a, c = (10 > o ? "0" : "") + o, h(m, c); H.html(f); var g = "", a = 0; for (a = parseInt(_.yearStart, 10) + _.yearOffset; a <= parseInt(_.yearEnd, 10) + _.yearOffset; a++)g += '<div class="xdsoft_option ' + (W.currentTime.getFullYear() == a ? "xdsoft_current" : "") + '" data-value="' + a + '">' + a + "</div>"; for (A.children().eq(0).html(g), a = 0, g = ""; 11 >= a; a++)g += '<div class="xdsoft_option ' + (W.currentTime.getMonth() == a ? "xdsoft_current" : "") + '" data-value="' + a + '">' + _.i18n[_.lang].months[a] + "</div>"; P.children().eq(0).html(g), e(this).trigger("generate.xdsoft") }, 10), t.stopPropagation() }).on("afterOpen.xdsoft", function () { if (_.timepicker) { var e; if (H.find(".xdsoft_current").length ? e = ".xdsoft_current" : H.find(".xdsoft_init_time").length && (e = ".xdsoft_init_time"), e) { var t = C[0].clientHeight, n = H[0].offsetHeight, a = H.find(e).index() * _.timeHeightInTimePicker + 1; a > n - t && (a = n - t), H.css("marginTop", "-" + parseInt(a) + "px"), C.trigger("scroll_element.xdsoft_scroller", [parseInt(a) / (n - t)]) } } }); var J = 0; F.on("click.xdsoft", "td", function (n) { n.stopPropagation(), J++; var a = e(this), r = W.currentTime; return a.hasClass("xdsoft_disabled") ? !1 : (r.setDate(a.data("date")), r.setMonth(a.data("month")), r.setFullYear(a.data("year")), M.trigger("select.xdsoft", [r]), t.val(W.str()), (J > 1 || _.closeOnDateSelect === !0 || 0 === _.closeOnDateSelect && !_.timepicker) && !_.inline && M.trigger("close.xdsoft"), _.onSelectDate && _.onSelectDate.call && _.onSelectDate.call(M, W.currentTime, M.data("input")), M.data("changed", !0), M.trigger("xchange.xdsoft"), M.trigger("changedatetime.xdsoft"), void setTimeout(function () { J = 0 }, 200)) }), H.on("click.xdsoft", "div", function (t) { t.stopPropagation(); var n = e(this), a = W.currentTime; return n.hasClass("xdsoft_disabled") ? !1 : (a.setHours(n.data("hour")), a.setMinutes(n.data("minute")), M.trigger("select.xdsoft", [a]), M.data("input").val(W.str()), !_.inline && M.trigger("close.xdsoft"), _.onSelectTime && _.onSelectTime.call && _.onSelectTime.call(M, W.currentTime, M.data("input")), M.data("changed", !0), M.trigger("xchange.xdsoft"), void M.trigger("changedatetime.xdsoft")) }), M.mousewheel && S.mousewheel(function (e, t, n, a) { return _.scrollMonth ? (0 > t ? W.nextMonth() : W.prevMonth(), !1) : !0 }), M.mousewheel && C.unmousewheel().mousewheel(function (e, t, n, a) { if (!_.scrollTime) return !0; var r = C[0].clientHeight, o = H[0].offsetHeight, s = Math.abs(parseInt(H.css("marginTop"))), i = !0; return 0 > t && o - r - _.timeHeightInTimePicker >= s ? (H.css("marginTop", "-" + (s + _.timeHeightInTimePicker) + "px"), i = !1) : t > 0 && s - _.timeHeightInTimePicker >= 0 && (H.css("marginTop", "-" + (s - _.timeHeightInTimePicker) + "px"), i = !1), C.trigger("scroll_element.xdsoft_scroller", [Math.abs(parseInt(H.css("marginTop")) / (o - r))]), e.stopPropagation(), i }), M.on("changedatetime.xdsoft", function () { if (_.onChangeDateTime && _.onChangeDateTime.call) { var e = M.data("input"); _.onChangeDateTime.call(M, W.currentTime, e), e.trigger("change") } }).on("generate.xdsoft", function () { _.onGenerate && _.onGenerate.call && _.onGenerate.call(M, W.currentTime, M.data("input")) }); var j = 0; t.mousewheel && t.mousewheel(function (e, n, a, r) { return _.scrollInput ? !_.datepicker && _.timepicker ? (j = H.find(".xdsoft_current").length ? H.find(".xdsoft_current").eq(0).index() : 0, j + n >= 0 && j + n < H.children().length && (j += n), H.children().eq(j).length && H.children().eq(j).trigger("mousedown"), !1) : _.datepicker && !_.timepicker ? (S.trigger(e, [n, a, r]), t.val && t.val(W.str()), M.trigger("changedatetime.xdsoft"), !1) : void 0 : !0 }); var L = function () { var t = M.data("input").offset(), n = t.top + M.data("input")[0].offsetHeight - 1, a = t.left; n + M[0].offsetHeight > e(window).height() + e(window).scrollTop() && (n = t.top - M[0].offsetHeight + 1), 0 > n && (n = 0), a + M[0].offsetWidth > e(window).width() && (a = t.left - M[0].offsetWidth + M.data("input")[0].offsetWidth), M.css({ left: a, top: n }) }; M.on("open.xdsoft", function () { var t = !0; _.onShow && _.onShow.call && (t = _.onShow.call(M, W.currentTime, M.data("input"))), t !== !1 && (M.show(), M.trigger("afterOpen.xdsoft"), L(), e(window).off("resize.xdsoft", L).on("resize.xdsoft", L), _.closeOnWithoutClick && e([document.body, window]).on("mousedown.xdsoft", function n() { M.trigger("close.xdsoft"), e([document.body, window]).off("mousedown.xdsoft", n) })) }).on("close.xdsoft", function (e) { var t = !0; _.onClose && _.onClose.call && (t = _.onClose.call(M, W.currentTime, M.data("input"))), t === !1 || _.opened || _.inline || M.hide(), e.stopPropagation() }).data("input", t); var E = 0; M.data("xdsoft_datetime", W), M.setOptions(_), W.setCurrentTime(n()), M.trigger("afterOpen.xdsoft"), t.data("xdsoft_datetimepicker", M).on("open.xdsoft focusin.xdsoft mousedown.xdsoft", function (e) { t.is(":disabled") || t.is(":hidden") || !t.is(":visible") || (clearTimeout(E), E = setTimeout(function () { t.is(":disabled") || t.is(":hidden") || !t.is(":visible") || (W.setCurrentTime(n()), M.trigger("open.xdsoft")) }, 100)) }).on("keydown.xdsoft", function (t) { var n = (this.value, t.which); switch (!0) { case !!~[u].indexOf(n): var a = e("input:visible,textarea:visible"); return M.trigger("close.xdsoft"), a.eq(a.index(this) + 1).focus(), !1; case !!~[p].indexOf(n): return M.trigger("close.xdsoft"), !0 } }) }, O = function (t) { var n = t.data("xdsoft_datetimepicker"); n && (n.data("xdsoft_datetime", null), n.remove(), t.data("xdsoft_datetimepicker", null).off("open.xdsoft focusin.xdsoft focusout.xdsoft mousedown.xdsoft blur.xdsoft keydown.xdsoft"), e(window).off("resize.xdsoft"), e([window, document.body]).off("mousedown.xdsoft"), t.unmousewheel && t.unmousewheel()) }; return e(document).off("keydown.xdsoftctrl keyup.xdsoftctrl").on("keydown.xdsoftctrl", function (e) { e.keyCode == i && (b = !0) }).on("keyup.xdsoftctrl", function (e) { e.keyCode == i && (b = !1) }), this.each(function () { var t; if (t = e(this).data("xdsoft_datetimepicker")) { if ("string" === e.type(n)) switch (n) { case "show": e(this).select().focus(), t.trigger("open.xdsoft"); break; case "hide": t.trigger("close.xdsoft"); break; case "destroy": O(e(this)); break; case "reset": this.value = this.defaultValue, this.value && t.data("xdsoft_datetime").isValidDate(Date.parseDate(this.value, _.format)) || t.data("changed", !1), t.data("xdsoft_datetime").setCurrentTime(this.value) } else t.setOptions(n); return 0 } "string" !== e.type(n) && (!_.lazyInit || _.open || _.inline ? S(e(this)) : k(e(this))) }) } }(jQuery), Date.parseFunctions = { count: 0 }, Date.parseRegexes = [], Date.formatFunctions = { count: 0 }, Date.prototype.dateFormat = function (e) { if ("unixtime" == e) return parseInt(this.getTime() / 1e3); null == Date.formatFunctions[e] && Date.createNewFormat(e); var t = Date.formatFunctions[e]; return this[t]() }, Date.createNewFormat = function (format) { var funcName = "format" + Date.formatFunctions.count++; Date.formatFunctions[format] = funcName; for (var code = "Date.prototype." + funcName + " = function() {return ", special = !1, ch = "", i = 0; i < format.length; ++i)ch = format.charAt(i), special || "\\" != ch ? special ? (special = !1, code += "'" + String.escape(ch) + "' + ") : code += Date.getFormatCode(ch) : special = !0; eval(code.substring(0, code.length - 3) + ";}") }, Date.getFormatCode = function (e) { switch (e) { case "d": return "String.leftPad(this.getDate(), 2, '0') + "; case "D": return "Date.dayNames[this.getDay()].substring(0, 3) + "; case "j": return "this.getDate() + "; case "l": return "Date.dayNames[this.getDay()] + "; case "S": return "this.getSuffix() + "; case "w": return "this.getDay() + "; case "z": return "this.getDayOfYear() + "; case "W": return "this.getWeekOfYear() + "; case "F": return "Date.monthNames[this.getMonth()] + "; case "m": return "String.leftPad(this.getMonth() + 1, 2, '0') + "; case "M": return "Date.monthNames[this.getMonth()].substring(0, 3) + "; case "n": return "(this.getMonth() + 1) + "; case "t": return "this.getDaysInMonth() + "; case "L": return "(this.isLeapYear() ? 1 : 0) + "; case "Y": return "this.getFullYear() + "; case "y": return "('' + this.getFullYear()).substring(2, 4) + "; case "a": return "(this.getHours() < 12 ? 'am' : 'pm') + "; case "A": return "(this.getHours() < 12 ? 'AM' : 'PM') + "; case "g": return "((this.getHours() %12) ? this.getHours() % 12 : 12) + "; case "G": return "this.getHours() + "; case "h": return "String.leftPad((this.getHours() %12) ? this.getHours() % 12 : 12, 2, '0') + "; case "H": return "String.leftPad(this.getHours(), 2, '0') + "; case "i": return "String.leftPad(this.getMinutes(), 2, '0') + "; case "s": return "String.leftPad(this.getSeconds(), 2, '0') + "; case "O": return "this.getGMTOffset() + "; case "T": return "this.getTimezone() + "; case "Z": return "(this.getTimezoneOffset() * -60) + "; default: return "'" + String.escape(e) + "' + " } }, Date.parseDate = function (e, t) { if ("unixtime" == t) return new Date(isNaN(parseInt(e)) ? 0 : 1e3 * parseInt(e)); null == Date.parseFunctions[t] && Date.createParser(t); var n = Date.parseFunctions[t]; return Date[n](e) }, Date.createParser = function (format) { var funcName = "parse" + Date.parseFunctions.count++, regexNum = Date.parseRegexes.length, currentGroup = 1; Date.parseFunctions[format] = funcName; for (var code = "Date." + funcName + " = function(input) {\nvar y = -1, m = -1, d = -1, h = -1, i = -1, s = -1, z = -1;\nvar d = new Date();\ny = d.getFullYear();\nm = d.getMonth();\nd = d.getDate();\nvar results = input.match(Date.parseRegexes[" + regexNum + "]);\nif (results && results.length > 0) {", regex = "", special = !1, ch = "", i = 0; i < format.length; ++i)ch = format.charAt(i), special || "\\" != ch ? special ? (special = !1, regex += String.escape(ch)) : (obj = Date.formatCodeToRegex(ch, currentGroup), currentGroup += obj.g, regex += obj.s, obj.g && obj.c && (code += obj.c)) : special = !0; code += "if (y > 0 && z > 0){\nvar doyDate = new Date(y,0);\ndoyDate.setDate(z);\nm = doyDate.getMonth();\nd = doyDate.getDate();\n}", code += "if (y > 0 && m >= 0 && d > 0 && h >= 0 && i >= 0 && s >= 0)\n{return new Date(y, m, d, h, i, s);}\nelse if (y > 0 && m >= 0 && d > 0 && h >= 0 && i >= 0)\n{return new Date(y, m, d, h, i);}\nelse if (y > 0 && m >= 0 && d > 0 && h >= 0)\n{return new Date(y, m, d, h);}\nelse if (y > 0 && m >= 0 && d > 0)\n{return new Date(y, m, d);}\nelse if (y > 0 && m >= 0)\n{return new Date(y, m);}\nelse if (y > 0)\n{return new Date(y);}\n}return null;}", Date.parseRegexes[regexNum] = new RegExp("^" + regex + "$"), eval(code) }, Date.formatCodeToRegex = function (e, t) { switch (e) { case "D": return { g: 0, c: null, s: "(?:Sun|Mon|Tue|Wed|Thu|Fri|Sat)" }; case "j": case "d": return { g: 1, c: "d = parseInt(results[" + t + "], 10);\n", s: "(\\d{1,2})" }; case "l": return { g: 0, c: null, s: "(?:" + Date.dayNames.join("|") + ")" }; case "S": return { g: 0, c: null, s: "(?:st|nd|rd|th)" }; case "w": return { g: 0, c: null, s: "\\d" }; case "z": return { g: 1, c: "z = parseInt(results[" + t + "], 10);\n", s: "(\\d{1,3})" }; case "W": return { g: 0, c: null, s: "(?:\\d{2})" }; case "F": return { g: 1, c: "m = parseInt(Date.monthNumbers[results[" + t + "].substring(0, 3)], 10);\n", s: "(" + Date.monthNames.join("|") + ")" }; case "M": return { g: 1, c: "m = parseInt(Date.monthNumbers[results[" + t + "]], 10);\n", s: "(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)" }; case "n": case "m": return { g: 1, c: "m = parseInt(results[" + t + "], 10) - 1;\n", s: "(\\d{1,2})" }; case "t": return { g: 0, c: null, s: "\\d{1,2}" }; case "L": return { g: 0, c: null, s: "(?:1|0)" }; case "Y": return { g: 1, c: "y = parseInt(results[" + t + "], 10);\n", s: "(\\d{4})" }; case "y": return { g: 1, c: "var ty = parseInt(results[" + t + "], 10);\ny = ty > Date.y2kYear ? 1900 + ty : 2000 + ty;\n", s: "(\\d{1,2})" }; case "a": return { g: 1, c: "if (results[" + t + "] == 'am') {\nif (h == 12) { h = 0; }\n} else { if (h < 12) { h += 12; }}", s: "(am|pm)" }; case "A": return { g: 1, c: "if (results[" + t + "] == 'AM') {\nif (h == 12) { h = 0; }\n} else { if (h < 12) { h += 12; }}", s: "(AM|PM)" }; case "g": case "G": case "h": case "H": return { g: 1, c: "h = parseInt(results[" + t + "], 10);\n", s: "(\\d{1,2})" }; case "i": return { g: 1, c: "i = parseInt(results[" + t + "], 10);\n", s: "(\\d{2})" }; case "s": return { g: 1, c: "s = parseInt(results[" + t + "], 10);\n", s: "(\\d{2})" }; case "O": return { g: 0, c: null, s: "[+-]\\d{4}" }; case "T": return { g: 0, c: null, s: "[A-Z]{3}" }; case "Z": return { g: 0, c: null, s: "[+-]\\d{1,5}" }; default: return { g: 0, c: null, s: String.escape(e) } } }, Date.prototype.getTimezone = function () { return this.toString().replace(/^.*? ([A-Z]{3}) [0-9]{4}.*$/, "$1").replace(/^.*?\(([A-Z])[a-z]+ ([A-Z])[a-z]+ ([A-Z])[a-z]+\)$/, "$1$2$3") }, Date.prototype.getGMTOffset = function () { return (this.getTimezoneOffset() > 0 ? "-" : "+") + String.leftPad(Math.floor(Math.abs(this.getTimezoneOffset()) / 60), 2, "0") + String.leftPad(Math.abs(this.getTimezoneOffset()) % 60, 2, "0") }, Date.prototype.getDayOfYear = function () { var e = 0; Date.daysInMonth[1] = this.isLeapYear() ? 29 : 28; for (var t = 0; t < this.getMonth(); ++t)e += Date.daysInMonth[t]; return e + this.getDate() }, Date.prototype.getWeekOfYear = function () { var e = this.getDayOfYear() + (4 - this.getDay()), t = new Date(this.getFullYear(), 0, 1), n = 7 - t.getDay() + 4; return String.leftPad(Math.ceil((e - n) / 7) + 1, 2, "0") }, Date.prototype.isLeapYear = function () { var e = this.getFullYear(); return 0 == (3 & e) && (e % 100 || e % 400 == 0 && e) }, Date.prototype.getFirstDayOfMonth = function () { var e = (this.getDay() - (this.getDate() - 1)) % 7; return 0 > e ? e + 7 : e }, Date.prototype.getLastDayOfMonth = function () { var e = (this.getDay() + (Date.daysInMonth[this.getMonth()] - this.getDate())) % 7; return 0 > e ? e + 7 : e }, Date.prototype.getDaysInMonth = function () { return Date.daysInMonth[1] = this.isLeapYear() ? 29 : 28, Date.daysInMonth[this.getMonth()] }, Date.prototype.getSuffix = function () { switch (this.getDate()) { case 1: case 21: case 31: return "st"; case 2: case 22: return "nd"; case 3: case 23: return "rd"; default: return "th" } }, String.escape = function (e) { return e.replace(/('|\\)/g, "\\$1") }, String.leftPad = function (e, t, n) { var a = new String(e); for (null == n && (n = " "); a.length < t;)a = n + a; return a }, Date.daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31], Date.monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], Date.dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], Date.y2kYear = 50, Date.monthNumbers = {
    Jan: 0, Feb: 1,
    Mar: 2, Apr: 3, May: 4, Jun: 5, Jul: 6, Aug: 7, Sep: 8, Oct: 9, Nov: 10, Dec: 11
}, Date.patterns = { ISO8601LongPattern: "Y-m-d H:i:s", ISO8601ShortPattern: "Y-m-d", ShortDatePattern: "n/j/Y", LongDatePattern: "l, F d, Y", FullDateTimePattern: "l, F d, Y g:i:s A", MonthDayPattern: "F d", ShortTimePattern: "g:i A", LongTimePattern: "g:i:s A", SortableDateTimePattern: "Y-m-d\\TH:i:s", UniversalSortableDateTimePattern: "Y-m-d H:i:sO", YearMonthPattern: "F, Y" }, function (e) { "function" == typeof define && define.amd ? define(["jquery.flot.min"], e) : "object" == typeof exports ? module.exports = e : e(jQuery) }(function (e) { function t(t) { var r, o = t || window.event, s = [].slice.call(arguments, 1), i = 0, d = 0, u = 0, c = 0, l = 0; return t = e.event.fix(o), t.type = "mousewheel", o.wheelDelta && (i = o.wheelDelta), o.detail && (i = -1 * o.detail), o.deltaY && (u = -1 * o.deltaY, i = u), o.deltaX && (d = o.deltaX, i = -1 * d), void 0 !== o.wheelDeltaY && (u = o.wheelDeltaY), void 0 !== o.wheelDeltaX && (d = -1 * o.wheelDeltaX), c = Math.abs(i), (!n || n > c) && (n = c), l = Math.max(Math.abs(u), Math.abs(d)), (!a || a > l) && (a = l), r = i > 0 ? "floor" : "ceil", i = Math[r](i / n), d = Math[r](d / a), u = Math[r](u / a), s.unshift(t, i, d, u), (e.event.dispatch || e.event.handle).apply(this, s) } var n, a, r = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"], o = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"]; if (e.event.fixHooks) for (var s = r.length; s;)e.event.fixHooks[r[--s]] = e.event.mouseHooks; e.event.special.mousewheel = { setup: function () { if (this.addEventListener) for (var e = o.length; e;)this.addEventListener(o[--e], t, !1); else this.onmousewheel = t }, teardown: function () { if (this.removeEventListener) for (var e = o.length; e;)this.removeEventListener(o[--e], t, !1); else this.onmousewheel = null } }, e.fn.extend({ mousewheel: function (e) { return e ? this.bind("mousewheel", e) : this.trigger("mousewheel") }, unmousewheel: function (e) { return this.unbind("mousewheel", e) } }) });
function _toConsumableArray(e) { if (Array.isArray(e)) { for (var t = 0, i = Array(e.length); t < e.length; t++)i[t] = e[t]; return i } return Array.from(e) } var _slice = Array.prototype.slice; !function (e, t) { "object" == typeof exports && "undefined" != typeof module ? module.exports = t(require("jquery")) : "function" == typeof define && define.amd ? define(["jquery"], t) : e.parsley = t(e.jQuery) }(this, function (e) {
    "use strict"; function t(e, t) { return e.parsleyAdaptedCallback || (e.parsleyAdaptedCallback = function () { var i = Array.prototype.slice.call(arguments, 0); i.unshift(this), e.apply(t || O, i) }), e.parsleyAdaptedCallback } function i(e) { return 0 === e.lastIndexOf(D, 0) ? e.substr(D.length) : e } var n = 1, r = {}, s = { attr: function (e, t, i) { var n, r, s, a = new RegExp("^" + t, "i"); if ("undefined" == typeof i) i = {}; else for (n in i) i.hasOwnProperty(n) && delete i[n]; if ("undefined" == typeof e || "undefined" == typeof e[0]) return i; for (s = e[0].attributes, n = s.length; n--;)r = s[n], r && r.specified && a.test(r.name) && (i[this.camelize(r.name.slice(t.length))] = this.deserializeValue(r.value)); return i }, checkAttr: function (e, t, i) { return e.is("[" + t + i + "]") }, setAttr: function (e, t, i, n) { e[0].setAttribute(this.dasherize(t + i), String(n)) }, generateID: function () { return "" + n++ }, deserializeValue: function (t) { var i; try { return t ? "true" == t || ("false" == t ? !1 : "null" == t ? null : isNaN(i = Number(t)) ? /^[\[\{]/.test(t) ? e.parseJSON(t) : t : i) : t } catch (n) { return t } }, camelize: function (e) { return e.replace(/-+(.)?/g, function (e, t) { return t ? t.toUpperCase() : "" }) }, dasherize: function (e) { return e.replace(/::/g, "/").replace(/([A-Z]+)([A-Z][a-z])/g, "$1_$2").replace(/([a-z\d])([A-Z])/g, "$1_$2").replace(/_/g, "-").toLowerCase() }, warn: function () { var e; window.console && "function" == typeof window.console.warn && (e = window.console).warn.apply(e, arguments) }, warnOnce: function (e) { r[e] || (r[e] = !0, this.warn.apply(this, arguments)) }, _resetWarnings: function () { r = {} }, trimString: function (e) { return e.replace(/^\s+|\s+$/g, "") }, objectCreate: Object.create || function () { var e = function () { }; return function (t) { if (arguments.length > 1) throw Error("Second argument not supported"); if ("object" != typeof t) throw TypeError("Argument must be an object"); e.prototype = t; var i = new e; return e.prototype = null, i } }() }, a = s, o = { namespace: "data-parsley-", inputs: "input, textarea, select", excluded: "input[type=button], input[type=submit], input[type=reset], input[type=hidden]", priorityEnabled: !0, multiple: null, group: null, uiEnabled: !0, validationThreshold: 3, focus: "first", trigger: !1, errorClass: "parsley-error", successClass: "parsley-success", classHandler: function (e) { }, errorsContainer: function (e) { }, errorsWrapper: '<ul class="parsley-errors-list"></ul>', errorTemplate: "<li></li>" }, l = function () { }; l.prototype = { asyncSupport: !0, actualizeOptions: function () { return a.attr(this.$element, this.options.namespace, this.domOptions), this.parent && this.parent.actualizeOptions && this.parent.actualizeOptions(), this }, _resetOptions: function (e) { this.domOptions = a.objectCreate(this.parent.options), this.options = a.objectCreate(this.domOptions); for (var t in e) e.hasOwnProperty(t) && (this.options[t] = e[t]); this.actualizeOptions() }, _listeners: null, on: function (e, t) { this._listeners = this._listeners || {}; var i = this._listeners[e] = this._listeners[e] || []; return i.push(t), this }, subscribe: function (t, i) { e.listenTo(this, t.toLowerCase(), i) }, off: function (e, t) { var i = this._listeners && this._listeners[e]; if (i) if (t) for (var n = i.length; n--;)i[n] === t && i.splice(n, 1); else delete this._listeners[e]; return this }, unsubscribe: function (t, i) { e.unsubscribeTo(this, t.toLowerCase()) }, trigger: function (e, t, i) { t = t || this; var n, r = this._listeners && this._listeners[e]; if (r) for (var s = r.length; s--;)if (n = r[s].call(t, t, i), n === !1) return n; return this.parent ? this.parent.trigger(e, t, i) : !0 }, reset: function () { if ("ParsleyForm" !== this.__class__) return this._trigger("reset"); for (var e = 0; e < this.fields.length; e++)this.fields[e]._trigger("reset"); this._trigger("reset") }, destroy: function () { if ("ParsleyForm" !== this.__class__) return this.$element.removeData("Parsley"), this.$element.removeData("ParsleyFieldMultiple"), void this._trigger("destroy"); for (var e = 0; e < this.fields.length; e++)this.fields[e].destroy(); this.$element.removeData("Parsley"), this._trigger("destroy") }, asyncIsValid: function (e, t) { return a.warnOnce("asyncIsValid is deprecated; please use whenValid instead"), this.whenValid({ group: e, force: t }) }, _findRelated: function () { return this.options.multiple ? this.parent.$element.find("[" + this.options.namespace + 'multiple="' + this.options.multiple + '"]') : this.$element } }; var u = { string: function (e) { return e }, integer: function (e) { if (isNaN(e)) throw 'Requirement is not an integer: "' + e + '"'; return parseInt(e, 10) }, number: function (e) { if (isNaN(e)) throw 'Requirement is not a number: "' + e + '"'; return parseFloat(e) }, reference: function (t) { var i = e(t); if (0 === i.length) throw 'No such reference: "' + t + '"'; return i }, "boolean": function (e) { return "false" !== e }, object: function (e) { return a.deserializeValue(e) }, regexp: function (e) { var t = ""; return /^\/.*\/(?:[gimy]*)$/.test(e) ? (t = e.replace(/.*\/([gimy]*)$/, "$1"), e = e.replace(new RegExp("^/(.*?)/" + t + "$"), "$1")) : e = "^" + e + "$", new RegExp(e, t) } }, d = function (e, t) { var i = e.match(/^\s*\[(.*)\]\s*$/); if (!i) throw 'Requirement is not an array: "' + e + '"'; var n = i[1].split(",").map(a.trimString); if (n.length !== t) throw "Requirement has " + n.length + " values when " + t + " are needed"; return n }, h = function (e, t) { var i = u[e || "string"]; if (!i) throw 'Unknown requirement specification: "' + e + '"'; return i(t) }, p = function (e, t, i) { var n = null, r = {}; for (var s in e) if (s) { var a = i(s); "string" == typeof a && (a = h(e[s], a)), r[s] = a } else n = h(e[s], t); return [n, r] }, f = function (t) { e.extend(!0, this, t) }; f.prototype = { validate: function (t, i) { if (this.fn) return arguments.length > 3 && (i = [].slice.call(arguments, 1, -1)), this.fn.call(this, t, i); if (e.isArray(t)) { if (!this.validateMultiple) throw "Validator `" + this.name + "` does not handle multiple values"; return this.validateMultiple.apply(this, arguments) } if (this.validateNumber) return isNaN(t) ? !1 : (arguments[0] = parseFloat(arguments[0]), this.validateNumber.apply(this, arguments)); if (this.validateString) return this.validateString.apply(this, arguments); throw "Validator `" + this.name + "` only handles multiple values" }, parseRequirements: function (t, i) { if ("string" != typeof t) return e.isArray(t) ? t : [t]; var n = this.requirementType; if (e.isArray(n)) { for (var r = d(t, n.length), s = 0; s < r.length; s++)r[s] = h(n[s], r[s]); return r } return e.isPlainObject(n) ? p(n, t, i) : [h(n, t)] }, requirementType: "string", priority: 2 }; var c = function (e, t) { this.__class__ = "ParsleyValidatorRegistry", this.locale = "en", this.init(e || {}, t || {}) }, m = { email: /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i, number: /^-?(\d*\.)?\d+(e[-+]?\d+)?$/i, integer: /^-?\d+$/, digits: /^\d+$/, alphanum: /^\w+$/i, url: new RegExp("^(?:(?:https?|ftp)://)?(?:\\S+(?::\\S*)?@)?(?:(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,})))(?::\\d{2,5})?(?:/\\S*)?$", "i") }; m.range = m.number; var g = function (e) { var t = ("" + e).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/); return t ? Math.max(0, (t[1] ? t[1].length : 0) - (t[2] ? +t[2] : 0)) : 0 }; c.prototype = { init: function (t, i) { this.catalog = i, this.validators = e.extend({}, this.validators); for (var n in t) this.addValidator(n, t[n].fn, t[n].priority); window.Parsley.trigger("parsley:validator:init") }, setLocale: function (e) { if ("undefined" == typeof this.catalog[e]) throw new Error(e + " is not available in the catalog"); return this.locale = e, this }, addCatalog: function (e, t, i) { return "object" == typeof t && (this.catalog[e] = t), !0 === i ? this.setLocale(e) : this }, addMessage: function (e, t, i) { return "undefined" == typeof this.catalog[e] && (this.catalog[e] = {}), this.catalog[e][t] = i, this }, addMessages: function (e, t) { for (var i in t) this.addMessage(e, i, t[i]); return this }, addValidator: function (e, t, i) { if (this.validators[e]) a.warn('Validator "' + e + '" is already defined.'); else if (o.hasOwnProperty(e)) return void a.warn('"' + e + '" is a restricted keyword and is not a valid validator name.'); return this._setValidator.apply(this, arguments) }, updateValidator: function (e, t, i) { return this.validators[e] ? this._setValidator(this, arguments) : (a.warn('Validator "' + e + '" is not already defined.'), this.addValidator.apply(this, arguments)) }, removeValidator: function (e) { return this.validators[e] || a.warn('Validator "' + e + '" is not defined.'), delete this.validators[e], this }, _setValidator: function (e, t, i) { "object" != typeof t && (t = { fn: t, priority: i }), t.validate || (t = new f(t)), this.validators[e] = t; for (var n in t.messages || {}) this.addMessage(n, e, t.messages[n]); return this }, getErrorMessage: function (e) { var t; if ("type" === e.name) { var i = this.catalog[this.locale][e.name] || {}; t = i[e.requirements] } else t = this.formatMessage(this.catalog[this.locale][e.name], e.requirements); return t || this.catalog[this.locale].defaultMessage || this.catalog.en.defaultMessage }, formatMessage: function (e, t) { if ("object" == typeof t) { for (var i in t) e = this.formatMessage(e, t[i]); return e } return "string" == typeof e ? e.replace(/%s/i, t) : "" }, validators: { notblank: { validateString: function (e) { return /\S/.test(e) }, priority: 2 }, required: { validateMultiple: function (e) { return e.length > 0 }, validateString: function (e) { return /\S/.test(e) }, priority: 512 }, type: { validateString: function (e, t) { var i = arguments.length <= 2 || void 0 === arguments[2] ? {} : arguments[2], n = i.step, r = void 0 === n ? "1" : n, s = i.base, a = void 0 === s ? 0 : s, o = m[t]; if (!o) throw new Error("validator type `" + t + "` is not supported"); if (!o.test(e)) return !1; if ("number" === t && !/^any$/i.test(r || "")) { var l = Number(e), u = Math.pow(10, Math.max(g(r), g(a))); if ((l * u - a * u) % (r * u) != 0) return !1 } return !0 }, requirementType: { "": "string", step: "string", base: "number" }, priority: 256 }, pattern: { validateString: function (e, t) { return t.test(e) }, requirementType: "regexp", priority: 64 }, minlength: { validateString: function (e, t) { return e.length >= t }, requirementType: "integer", priority: 30 }, maxlength: { validateString: function (e, t) { return e.length <= t }, requirementType: "integer", priority: 30 }, length: { validateString: function (e, t, i) { return e.length >= t && e.length <= i }, requirementType: ["integer", "integer"], priority: 30 }, mincheck: { validateMultiple: function (e, t) { return e.length >= t }, requirementType: "integer", priority: 30 }, maxcheck: { validateMultiple: function (e, t) { return e.length <= t }, requirementType: "integer", priority: 30 }, check: { validateMultiple: function (e, t, i) { return e.length >= t && e.length <= i }, requirementType: ["integer", "integer"], priority: 30 }, min: { validateNumber: function (e, t) { return e >= t }, requirementType: "number", priority: 30 }, max: { validateNumber: function (e, t) { return t >= e }, requirementType: "number", priority: 30 }, range: { validateNumber: function (e, t, i) { return e >= t && i >= e }, requirementType: ["number", "number"], priority: 30 }, equalto: { validateString: function (t, i) { var n = e(i); return n.length ? t === n.val() : t === i }, priority: 256 } } }; var y = function (e) { this.__class__ = "ParsleyUI" }; y.prototype = { listen: function () { var e = this; return window.Parsley.on("form:init", function (t) { e.setupForm(t) }).on("field:init", function (t) { e.setupField(t) }).on("field:validated", function (t) { e.reflow(t) }).on("form:validated", function (t) { e.focus(t) }).on("field:reset", function (t) { e.reset(t) }).on("form:destroy", function (t) { e.destroy(t) }).on("field:destroy", function (t) { e.destroy(t) }), this }, reflow: function (e) { if ("undefined" != typeof e._ui && !1 !== e._ui.active) { var t = this._diff(e.validationResult, e._ui.lastValidationResult); e._ui.lastValidationResult = e.validationResult, this.manageStatusClass(e), this.manageErrorsMessages(e, t), this.actualizeTriggers(e), (t.kept.length || t.added.length) && !0 !== e._ui.failedOnce && this.manageFailingFieldTrigger(e) } }, getErrorsMessages: function (e) { if (!0 === e.validationResult) return []; for (var t = [], i = 0; i < e.validationResult.length; i++)t.push(e.validationResult[i].errorMessage || this._getErrorMessage(e, e.validationResult[i].assert)); return t }, manageStatusClass: function (e) { e.hasConstraints() && e.needsValidation() && !0 === e.validationResult ? this._successClass(e) : e.validationResult.length > 0 ? this._errorClass(e) : this._resetClass(e) }, manageErrorsMessages: function (t, i) { if ("undefined" == typeof t.options.errorsMessagesDisabled) { if ("undefined" != typeof t.options.errorMessage) return i.added.length || i.kept.length ? (this._insertErrorWrapper(t), 0 === t._ui.$errorsWrapper.find(".parsley-custom-error-message").length && t._ui.$errorsWrapper.append(e(t.options.errorTemplate).addClass("parsley-custom-error-message")), t._ui.$errorsWrapper.addClass("filled").find(".parsley-custom-error-message").html(t.options.errorMessage)) : t._ui.$errorsWrapper.removeClass("filled").find(".parsley-custom-error-message").remove(); for (var n = 0; n < i.removed.length; n++)this.removeError(t, i.removed[n].assert.name, !0); for (n = 0; n < i.added.length; n++)this.addError(t, i.added[n].assert.name, i.added[n].errorMessage, i.added[n].assert, !0); for (n = 0; n < i.kept.length; n++)this.updateError(t, i.kept[n].assert.name, i.kept[n].errorMessage, i.kept[n].assert, !0) } }, addError: function (t, i, n, r, s) { this._insertErrorWrapper(t), t._ui.$errorsWrapper.addClass("filled").append(e(t.options.errorTemplate).addClass("parsley-" + i).html(n || this._getErrorMessage(t, r))), !0 !== s && this._errorClass(t) }, updateError: function (e, t, i, n, r) { e._ui.$errorsWrapper.addClass("filled").find(".parsley-" + t).html(i || this._getErrorMessage(e, n)), !0 !== r && this._errorClass(e) }, removeError: function (e, t, i) { e._ui.$errorsWrapper.removeClass("filled").find(".parsley-" + t).remove(), !0 !== i && this.manageStatusClass(e) }, focus: function (e) { if (e._focusedField = null, !0 === e.validationResult || "none" === e.options.focus) return null; for (var t = 0; t < e.fields.length; t++) { var i = e.fields[t]; if (!0 !== i.validationResult && i.validationResult.length > 0 && "undefined" == typeof i.options.noFocus && (e._focusedField = i.$element, "first" === e.options.focus)) break } return null === e._focusedField ? null : e._focusedField.focus() }, _getErrorMessage: function (e, t) { var i = t.name + "Message"; return "undefined" != typeof e.options[i] ? window.Parsley.formatMessage(e.options[i], t.requirements) : window.Parsley.getErrorMessage(t) }, _diff: function (e, t, i) { for (var n = [], r = [], s = 0; s < e.length; s++) { for (var a = !1, o = 0; o < t.length; o++)if (e[s].assert.name === t[o].assert.name) { a = !0; break } a ? r.push(e[s]) : n.push(e[s]) } return { kept: r, added: n, removed: i ? [] : this._diff(t, e, !0).added } }, setupForm: function (e) { e.$element.on("submit.Parsley", function (t) { e.onSubmitValidate(t) }), e.$element.on("click.Parsley", 'input[type="submit"], button[type="submit"]', function (t) { e.onSubmitButton(t) }), !1 !== e.options.uiEnabled && e.$element.attr("novalidate", "") }, setupField: function (t) { var i = { active: !1 }; !1 !== t.options.uiEnabled && (i.active = !0, t.$element.attr(t.options.namespace + "id", t.__id__), i.$errorClassHandler = this._manageClassHandler(t), i.errorsWrapperId = "parsley-id-" + (t.options.multiple ? "multiple-" + t.options.multiple : t.__id__), i.$errorsWrapper = e(t.options.errorsWrapper).attr("id", i.errorsWrapperId), i.lastValidationResult = [], i.validationInformationVisible = !1, t._ui = i, this.actualizeTriggers(t)) }, _manageClassHandler: function (t) { if ("string" == typeof t.options.classHandler && e(t.options.classHandler).length) return e(t.options.classHandler); var i = t.options.classHandler(t); return "undefined" != typeof i && i.length ? i : !t.options.multiple || t.$element.is("select") ? t.$element : t.$element.parent() }, _insertErrorWrapper: function (t) { var i; if (0 !== t._ui.$errorsWrapper.parent().length) return t._ui.$errorsWrapper.parent(); if ("string" == typeof t.options.errorsContainer) { if (e(t.options.errorsContainer).length) return e(t.options.errorsContainer).append(t._ui.$errorsWrapper); a.warn("The errors container `" + t.options.errorsContainer + "` does not exist in DOM") } else "function" == typeof t.options.errorsContainer && (i = t.options.errorsContainer(t)); if ("undefined" != typeof i && i.length) return i.append(t._ui.$errorsWrapper); var n = t.$element; return t.options.multiple && (n = n.parent()), n.after(t._ui.$errorsWrapper) }, actualizeTriggers: function (e) { var t = this, i = e._findRelated(); if (i.off(".Parsley"), !1 !== e.options.trigger) { var n = e.options.trigger.replace(/^\s+/g, "").replace(/\s+$/g, ""); "" !== n && i.on(n.split(" ").join(".Parsley ") + ".Parsley", function (i) { t.eventValidate(e, i) }) } }, eventValidate: function (e, t) { /key/.test(t.type) && !e._ui.validationInformationVisible && e.getValue().length <= e.options.validationThreshold || e.validate() }, manageFailingFieldTrigger: function (t) { return t._ui.failedOnce = !0, t.options.multiple && t._findRelated().each(function () { /change/i.test(e(this).parsley().options.trigger || "") || e(this).on("change.ParsleyFailedOnce", function () { t.validate() }) }), t.$element.is("select") && !/change/i.test(t.options.trigger || "") ? t.$element.on("change.ParsleyFailedOnce", function () { t.validate() }) : /keyup/i.test(t.options.trigger || "") ? void 0 : t.$element.on("keyup.ParsleyFailedOnce", function () { t.validate() }) }, reset: function (e) { this.actualizeTriggers(e), e.$element.off(".ParsleyFailedOnce"), "undefined" != typeof e._ui && "ParsleyForm" !== e.__class__ && (e._ui.$errorsWrapper.removeClass("filled").children().remove(), this._resetClass(e), e._ui.lastValidationResult = [], e._ui.validationInformationVisible = !1, e._ui.failedOnce = !1) }, destroy: function (e) { this.reset(e), "ParsleyForm" !== e.__class__ && ("undefined" != typeof e._ui && e._ui.$errorsWrapper.remove(), delete e._ui) }, _successClass: function (e) { e._ui.validationInformationVisible = !0, e._ui.$errorClassHandler.removeClass(e.options.errorClass).addClass(e.options.successClass) }, _errorClass: function (e) { e._ui.validationInformationVisible = !0, e._ui.$errorClassHandler.removeClass(e.options.successClass).addClass(e.options.errorClass) }, _resetClass: function (e) { e._ui.$errorClassHandler.removeClass(e.options.successClass).removeClass(e.options.errorClass) } }; var v = function (t, i, n) { this.__class__ = "ParsleyForm", this.__id__ = a.generateID(), this.$element = e(t), this.domOptions = i, this.options = n, this.parent = window.Parsley, this.fields = [], this.validationResult = null }, _ = { pending: null, resolved: !0, rejected: !1 }; v.prototype = { onSubmitValidate: function (e) { var t = this; if (!0 !== e.parsley) return this._$submitSource = this._$submitSource || this.$element.find('input[type="submit"], button[type="submit"]').first(), this._$submitSource.is("[formnovalidate]") ? void (this._$submitSource = null) : (e.stopImmediatePropagation(), e.preventDefault(), this.whenValidate({ event: e }).done(function () { t._submit() }).always(function () { t._$submitSource = null }), this) }, onSubmitButton: function (t) { this._$submitSource = e(t.target) }, _submit: function () { !1 !== this._trigger("submit") && (this.$element.find(".parsley_synthetic_submit_button").remove(), this._$submitSource && e('<input class="parsley_synthetic_submit_button" type="hidden">').attr("name", this._$submitSource.attr("name")).attr("value", this._$submitSource.attr("value")).appendTo(this.$element), this.$element.trigger(e.extend(e.Event("submit"), { parsley: !0 }))) }, validate: function (t) { if (arguments.length >= 1 && !e.isPlainObject(t)) { a.warnOnce("Calling validate on a parsley form without passing arguments as an object is deprecated."); var i = _slice.call(arguments), n = i[0], r = i[1], s = i[2]; t = { group: n, force: r, event: s } } return _[this.whenValidate(t).state()] }, whenValidate: function () { var t = this, i = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0], n = i.group, r = i.force, s = i.event; this.submitEvent = s, s && (this.submitEvent.preventDefault = function () { a.warnOnce("Using `this.submitEvent.preventDefault()` is deprecated; instead, call `this.validationResult = false`"), t.validationResult = !1 }), this.validationResult = !0, this._trigger("validate"), this._refreshFields(); var o = this._withoutReactualizingFormOptions(function () { return e.map(t.fields, function (e) { return e.whenValidate({ force: r, group: n }) }) }), l = function () { var i = e.Deferred(); return !1 === t.validationResult && i.reject(), i.resolve().promise() }; return e.when.apply(e, _toConsumableArray(o)).done(function () { t._trigger("success") }).fail(function () { t.validationResult = !1, t._trigger("error") }).always(function () { t._trigger("validated") }).pipe(l, l) }, isValid: function (t) { if (arguments.length >= 1 && !e.isPlainObject(t)) { a.warnOnce("Calling isValid on a parsley form without passing arguments as an object is deprecated."); var i = _slice.call(arguments), n = i[0], r = i[1]; t = { group: n, force: r } } return _[this.whenValid(t).state()] }, whenValid: function () { var t = this, i = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0], n = i.group, r = i.force; this._refreshFields(); var s = this._withoutReactualizingFormOptions(function () { return e.map(t.fields, function (e) { return e.whenValid({ group: n, force: r }) }) }); return e.when.apply(e, _toConsumableArray(s)) }, _refreshFields: function () { return this.actualizeOptions()._bindFields() }, _bindFields: function () { var t = this, i = this.fields; return this.fields = [], this.fieldsMappedById = {}, this._withoutReactualizingFormOptions(function () { t.$element.find(t.options.inputs).not(t.options.excluded).each(function (e, i) { var n = new window.Parsley.Factory(i, {}, t); "ParsleyField" !== n.__class__ && "ParsleyFieldMultiple" !== n.__class__ || !0 === n.options.excluded || "undefined" == typeof t.fieldsMappedById[n.__class__ + "-" + n.__id__] && (t.fieldsMappedById[n.__class__ + "-" + n.__id__] = n, t.fields.push(n)) }), e(i).not(t.fields).each(function (e, t) { t._trigger("reset") }) }), this }, _withoutReactualizingFormOptions: function (e) { var t = this.actualizeOptions; this.actualizeOptions = function () { return this }; var i = e(); return this.actualizeOptions = t, i }, _trigger: function (e) { return this.trigger("form:" + e) } }; var w = function (t, i, n, r, s) { if (!/ParsleyField/.test(t.__class__)) throw new Error("ParsleyField or ParsleyFieldMultiple instance expected"); var a = window.Parsley._validatorRegistry.validators[i], o = new f(a); e.extend(this, { validator: o, name: i, requirements: n, priority: r || t.options[i + "Priority"] || o.priority, isDomConstraint: !0 === s }), this._parseRequirements(t.options) }, b = function (e) { var t = e[0].toUpperCase(); return t + e.slice(1) }; w.prototype = { validate: function (e, t) { var i = this.requirementList.slice(0); return i.unshift(e), i.push(t), this.validator.validate.apply(this.validator, i) }, _parseRequirements: function (e) { var t = this; this.requirementList = this.validator.parseRequirements(this.requirements, function (i) { return e[t.name + b(i)] }) } }; var F = function (t, i, n, r) { this.__class__ = "ParsleyField", this.__id__ = a.generateID(), this.$element = e(t), "undefined" != typeof r && (this.parent = r), this.options = n, this.domOptions = i, this.constraints = [], this.constraintsByName = {}, this.validationResult = [], this._bindConstraints() }, $ = { pending: null, resolved: !0, rejected: !1 }; F.prototype = { validate: function (t) { arguments.length >= 1 && !e.isPlainObject(t) && (a.warnOnce("Calling validate on a parsley field without passing arguments as an object is deprecated."), t = { options: t }); var i = this.whenValidate(t); if (!i) return !0; switch (i.state()) { case "pending": return null; case "resolved": return !0; case "rejected": return this.validationResult } }, whenValidate: function () { var e = this, t = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0], i = t.force, n = t.group; return this.refreshConstraints(), !n || this._isInGroup(n) ? (this.value = this.getValue(), this._trigger("validate"), this.whenValid({ force: i, value: this.value, _refreshed: !0 }).done(function () { e._trigger("success") }).fail(function () { e._trigger("error") }).always(function () { e._trigger("validated") })) : void 0 }, hasConstraints: function () { return 0 !== this.constraints.length }, needsValidation: function (e) { return "undefined" == typeof e && (e = this.getValue()), e.length || this._isRequired() || "undefined" != typeof this.options.validateIfEmpty ? !0 : !1 }, _isInGroup: function (t) { return e.isArray(this.options.group) ? -1 !== e.inArray(t, this.options.group) : this.options.group === t }, isValid: function (t) { if (arguments.length >= 1 && !e.isPlainObject(t)) { a.warnOnce("Calling isValid on a parsley field without passing arguments as an object is deprecated."); var i = _slice.call(arguments), n = i[0], r = i[1]; t = { force: n, value: r } } var s = this.whenValid(t); return s ? $[s.state()] : !0 }, whenValid: function () { var t = this, i = arguments.length <= 0 || void 0 === arguments[0] ? {} : arguments[0], n = i.force, r = void 0 === n ? !1 : n, s = i.value, a = i.group, o = i._refreshed; if (o || this.refreshConstraints(), !a || this._isInGroup(a)) { if (this.validationResult = !0, !this.hasConstraints()) return e.when(); if (("undefined" == typeof s || null === s) && (s = this.getValue()), !this.needsValidation(s) && !0 !== r) return e.when(); var l = this._getGroupedConstraints(), u = []; return e.each(l, function (i, n) { var r = e.when.apply(e, _toConsumableArray(e.map(n, function (e) { return t._validateConstraint(s, e) }))); return u.push(r), "rejected" === r.state() ? !1 : void 0 }), e.when.apply(e, u) } }, _validateConstraint: function (t, i) { var n = this, r = i.validate(t, this); return !1 === r && (r = e.Deferred().reject()), e.when(r).fail(function (e) { !0 === n.validationResult && (n.validationResult = []), n.validationResult.push({ assert: i, errorMessage: "string" == typeof e && e }) }) }, getValue: function () { var e; return e = "function" == typeof this.options.value ? this.options.value(this) : "undefined" != typeof this.options.value ? this.options.value : this.$element.val(), "undefined" == typeof e || null === e ? "" : this._handleWhitespace(e) }, refreshConstraints: function () { return this.actualizeOptions()._bindConstraints() }, addConstraint: function (e, t, i, n) { if (window.Parsley._validatorRegistry.validators[e]) { var r = new w(this, e, t, i, n); "undefined" !== this.constraintsByName[r.name] && this.removeConstraint(r.name), this.constraints.push(r), this.constraintsByName[r.name] = r } return this }, removeConstraint: function (e) { for (var t = 0; t < this.constraints.length; t++)if (e === this.constraints[t].name) { this.constraints.splice(t, 1); break } return delete this.constraintsByName[e], this }, updateConstraint: function (e, t, i) { return this.removeConstraint(e).addConstraint(e, t, i) }, _bindConstraints: function () { for (var e = [], t = {}, i = 0; i < this.constraints.length; i++)!1 === this.constraints[i].isDomConstraint && (e.push(this.constraints[i]), t[this.constraints[i].name] = this.constraints[i]); this.constraints = e, this.constraintsByName = t; for (var n in this.options) this.addConstraint(n, this.options[n], void 0, !0); return this._bindHtml5Constraints() }, _bindHtml5Constraints: function () { (this.$element.hasClass("required") || this.$element.attr("required")) && this.addConstraint("required", !0, void 0, !0), "string" == typeof this.$element.attr("pattern") && this.addConstraint("pattern", this.$element.attr("pattern"), void 0, !0), "undefined" != typeof this.$element.attr("min") && "undefined" != typeof this.$element.attr("max") ? this.addConstraint("range", [this.$element.attr("min"), this.$element.attr("max")], void 0, !0) : "undefined" != typeof this.$element.attr("min") ? this.addConstraint("min", this.$element.attr("min"), void 0, !0) : "undefined" != typeof this.$element.attr("max") && this.addConstraint("max", this.$element.attr("max"), void 0, !0), "undefined" != typeof this.$element.attr("minlength") && "undefined" != typeof this.$element.attr("maxlength") ? this.addConstraint("length", [this.$element.attr("minlength"), this.$element.attr("maxlength")], void 0, !0) : "undefined" != typeof this.$element.attr("minlength") ? this.addConstraint("minlength", this.$element.attr("minlength"), void 0, !0) : "undefined" != typeof this.$element.attr("maxlength") && this.addConstraint("maxlength", this.$element.attr("maxlength"), void 0, !0); var e = this.$element.attr("type"); return "undefined" == typeof e ? this : "number" === e ? this.addConstraint("type", ["number", { step: this.$element.attr("step"), base: this.$element.attr("min") || this.$element.attr("value") }], void 0, !0) : /^(email|url|range)$/i.test(e) ? this.addConstraint("type", e, void 0, !0) : this }, _isRequired: function () { return "undefined" == typeof this.constraintsByName.required ? !1 : !1 !== this.constraintsByName.required.requirements }, _trigger: function (e) { return this.trigger("field:" + e) }, _handleWhitespace: function (e) { return !0 === this.options.trimValue && a.warnOnce('data-parsley-trim-value="true" is deprecated, please use data-parsley-whitespace="trim"'), "squish" === this.options.whitespace && (e = e.replace(/\s{2,}/g, " ")), ("trim" === this.options.whitespace || "squish" === this.options.whitespace || !0 === this.options.trimValue) && (e = a.trimString(e)), e }, _getGroupedConstraints: function () { if (!1 === this.options.priorityEnabled) return [this.constraints]; for (var e = [], t = {}, i = 0; i < this.constraints.length; i++) { var n = this.constraints[i].priority; t[n] || e.push(t[n] = []), t[n].push(this.constraints[i]) } return e.sort(function (e, t) { return t[0].priority - e[0].priority }), e } }; var C = F, P = function () { this.__class__ = "ParsleyFieldMultiple" }; P.prototype = { addElement: function (e) { return this.$elements.push(e), this }, refreshConstraints: function () { var t; if (this.constraints = [], this.$element.is("select")) return this.actualizeOptions()._bindConstraints(), this; for (var i = 0; i < this.$elements.length; i++)if (e("html").has(this.$elements[i]).length) { t = this.$elements[i].data("ParsleyFieldMultiple").refreshConstraints().constraints; for (var n = 0; n < t.length; n++)this.addConstraint(t[n].name, t[n].requirements, t[n].priority, t[n].isDomConstraint) } else this.$elements.splice(i, 1); return this }, getValue: function () { if ("function" == typeof this.options.value) value = this.options.value(this); else if ("undefined" != typeof this.options.value) return this.options.value; if (this.$element.is("input[type=radio]")) return this._findRelated().filter(":checked").val() || ""; if (this.$element.is("input[type=checkbox]")) { var t = []; return this._findRelated().filter(":checked").each(function () { t.push(e(this).val()) }), t } return this.$element.is("select") && null === this.$element.val() ? [] : this.$element.val() }, _init: function () { return this.$elements = [this.$element], this } }; var x = function (t, i, n) { this.$element = e(t); var r = this.$element.data("Parsley"); if (r) return "undefined" != typeof n && r.parent === window.Parsley && (r.parent = n, r._resetOptions(r.options)), r; if (!this.$element.length) throw new Error("You must bind Parsley on an existing element."); if ("undefined" != typeof n && "ParsleyForm" !== n.__class__) throw new Error("Parent instance must be a ParsleyForm instance"); return this.parent = n || window.Parsley, this.init(i) }; x.prototype = {
        init: function (e) { return this.__class__ = "Parsley", this.__version__ = "@@version", this.__id__ = a.generateID(), this._resetOptions(e), this.$element.is("form") || a.checkAttr(this.$element, this.options.namespace, "validate") && !this.$element.is(this.options.inputs) ? this.bind("parsleyForm") : this.isMultiple() ? this.handleMultiple() : this.bind("parsleyField") }, isMultiple: function () { return this.$element.is("input[type=radio], input[type=checkbox]") || this.$element.is("select") && "undefined" != typeof this.$element.attr("multiple") }, handleMultiple: function () {
            var t, i, n = this; if (this.options.multiple || ("undefined" != typeof this.$element.attr("name") && this.$element.attr("name").length ? this.options.multiple = t = this.$element.attr("name") : "undefined" != typeof this.$element.attr("id") && this.$element.attr("id").length && (this.options.multiple = this.$element.attr("id"))), this.$element.is("select") && "undefined" != typeof this.$element.attr("multiple")) return this.options.multiple = this.options.multiple || this.__id__, this.bind("parsleyFieldMultiple"); if (!this.options.multiple) return a.warn("To be bound by Parsley, a radio, a checkbox and a multiple select input must have either a name or a multiple option.", this.$element), this; this.options.multiple = this.options.multiple.replace(/(:|\.|\[|\]|\{|\}|\$)/g, ""), "undefined" != typeof t && e('input[name="' + t + '"]').each(function (t, i) { e(i).is("input[type=radio], input[type=checkbox]") && e(i).attr(n.options.namespace + "multiple", n.options.multiple) }); for (var r = this._findRelated(), s = 0; s < r.length; s++)if (i = e(r.get(s)).data("Parsley"), "undefined" != typeof i) {
                this.$element.data("ParsleyFieldMultiple") || i.addElement(this.$element);
                break
            } return this.bind("parsleyField", !0), i || this.bind("parsleyFieldMultiple")
        }, bind: function (t, i) { var n; switch (t) { case "parsleyForm": n = e.extend(new v(this.$element, this.domOptions, this.options), window.ParsleyExtend)._bindFields(); break; case "parsleyField": n = e.extend(new C(this.$element, this.domOptions, this.options, this.parent), window.ParsleyExtend); break; case "parsleyFieldMultiple": n = e.extend(new C(this.$element, this.domOptions, this.options, this.parent), new P, window.ParsleyExtend)._init(); break; default: throw new Error(t + "is not a supported Parsley type") }return this.options.multiple && a.setAttr(this.$element, this.options.namespace, "multiple", this.options.multiple), "undefined" != typeof i ? (this.$element.data("ParsleyFieldMultiple", n), n) : (this.$element.data("Parsley", n), n._trigger("init"), n) }
    }; var V = e.fn.jquery.split("."); if (parseInt(V[0]) <= 1 && parseInt(V[1]) < 8) throw "The loaded version of jQuery is too old. Please upgrade to 1.8.x or better."; V.forEach || a.warn("Parsley requires ES5 to run properly. Please include https://github.com/es-shims/es5-shim"); var E = e.extend(new l, { $element: e(document), actualizeOptions: null, _resetOptions: null, Factory: x, version: "@@version" }); e.extend(C.prototype, l.prototype), e.extend(v.prototype, l.prototype), e.extend(x.prototype, l.prototype), e.fn.parsley = e.fn.psly = function (t) { if (this.length > 1) { var i = []; return this.each(function () { i.push(e(this).parsley(t)) }), i } return e(this).length ? new x(this, t) : void a.warn("You must bind Parsley on an existing element.") }, "undefined" == typeof window.ParsleyExtend && (window.ParsleyExtend = {}), E.options = e.extend(a.objectCreate(o), window.ParsleyConfig), window.ParsleyConfig = E.options, window.Parsley = window.psly = E, window.ParsleyUtils = a; var M = window.Parsley._validatorRegistry = new c(window.ParsleyConfig.validators, window.ParsleyConfig.i18n); window.ParsleyValidator = {}, e.each("setLocale addCatalog addMessage addMessages getErrorMessage formatMessage addValidator updateValidator removeValidator".split(" "), function (t, i) { window.Parsley[i] = e.proxy(M, i), window.ParsleyValidator[i] = function () { var e; return a.warnOnce("Accessing the method '" + i + "' through ParsleyValidator is deprecated. Simply call 'window.Parsley." + i + "(...)'"), (e = window.Parsley)[i].apply(e, arguments) } }), window.ParsleyUI = "function" == typeof window.ParsleyConfig.ParsleyUI ? (new window.ParsleyConfig.ParsleyUI).listen() : (new y).listen(), !1 !== window.ParsleyConfig.autoBind && e(function () { e("[data-parsley-validate]").length && e("[data-parsley-validate]").parsley() }); var O = e({}), R = function () { a.warnOnce("Parsley's pubsub module is deprecated; use the 'on' and 'off' methods on parsley instances or window.Parsley") }, D = "parsley:"; e.listen = function (e, n) { var r; if (R(), "object" == typeof arguments[1] && "function" == typeof arguments[2] && (r = arguments[1], n = arguments[2]), "function" != typeof n) throw new Error("Wrong parameters"); window.Parsley.on(i(e), t(n, r)) }, e.listenTo = function (e, n, r) { if (R(), !(e instanceof C || e instanceof v)) throw new Error("Must give Parsley instance"); if ("string" != typeof n || "function" != typeof r) throw new Error("Wrong parameters"); e.on(i(n), t(r)) }, e.unsubscribe = function (e, t) { if (R(), "string" != typeof e || "function" != typeof t) throw new Error("Wrong arguments"); window.Parsley.off(i(e), t.parsleyAdaptedCallback) }, e.unsubscribeTo = function (e, t) { if (R(), !(e instanceof C || e instanceof v)) throw new Error("Must give Parsley instance"); e.off(i(t)) }, e.unsubscribeAll = function (t) { R(), window.Parsley.off(i(t)), e("form,input,textarea,select").each(function () { var n = e(this).data("Parsley"); n && n.off(i(t)) }) }, e.emit = function (e, t) { var n; R(); var r = t instanceof C || t instanceof v, s = Array.prototype.slice.call(arguments, r ? 2 : 1); s.unshift(i(e)), r || (t = window.Parsley), (n = t).trigger.apply(n, _toConsumableArray(s)) }; e.extend(!0, E, { asyncValidators: { "default": { fn: function (e) { return e.status >= 200 && e.status < 300 }, url: !1 }, reverse: { fn: function (e) { return e.status < 200 || e.status >= 300 }, url: !1 } }, addAsyncValidator: function (e, t, i, n) { return E.asyncValidators[e] = { fn: t, url: i || !1, options: n || {} }, this } }), E.addValidator("remote", { requirementType: { "": "string", validator: "string", reverse: "boolean", options: "object" }, validateString: function (t, i, n, r) { var s, a, o = {}, l = n.validator || (!0 === n.reverse ? "reverse" : "default"); if ("undefined" == typeof E.asyncValidators[l]) throw new Error("Calling an undefined async validator: `" + l + "`"); i = E.asyncValidators[l].url || i, i.indexOf("{value}") > -1 ? i = i.replace("{value}", encodeURIComponent(t)) : o[r.$element.attr("name") || r.$element.attr("id")] = t; var u = e.extend(!0, n.options || {}, E.asyncValidators[l].options); s = e.extend(!0, {}, { url: i, data: o, type: "GET" }, u), r.trigger("field:ajaxoptions", r, s), a = e.param(s), "undefined" == typeof E._remoteCache && (E._remoteCache = {}); var d = E._remoteCache[a] = E._remoteCache[a] || e.ajax(s), h = function () { var t = E.asyncValidators[l].fn.call(r, d, i, n); return t || (t = e.Deferred().reject()), e.when(t) }; return d.then(h, h) }, priority: -1 }), E.on("form:submit", function () { E._remoteCache = {} }), window.ParsleyExtend.addAsyncValidator = function () { return ParsleyUtils.warnOnce("Accessing the method `addAsyncValidator` through an instance is deprecated. Simply call `Parsley.addAsyncValidator(...)`"), E.addAsyncValidator.apply(E, arguments) }, E.addMessages("en", { defaultMessage: "This value seems to be invalid.", type: { email: "This value should be a valid email.", url: "This value should be a valid url.", number: "This value should be a valid number.", integer: "This value should be a valid integer.", digits: "This value should be digits.", alphanum: "This value should be alphanumeric." }, notblank: "This value should not be blank.", required: "This value is required.", pattern: "This value seems to be invalid.", min: "This value should be greater than or equal to %s.", max: "This value should be lower than or equal to %s.", range: "This value should be between %s and %s.", minlength: "This value is too short. It should have %s characters or more.", maxlength: "This value is too long. It should have %s characters or fewer.", length: "This value length is invalid. It should be between %s and %s characters long.", mincheck: "You must select at least %s choices.", maxcheck: "You must select %s choices or fewer.", check: "You must select between %s and %s choices.", equalto: "This value should be the same." }), E.setLocale("en"); var q = E; return q
});
jQuery(document).ready(function (e) { function a(e, a) { l(e, a), e.find(a.container).first().show() } function n(a, n) { if (n.tabs) { var i = e("<ul />", { "class": n.tabMenuClassName }).insertBefore(a.children(n.container).filter(":first")); a.children(n.container).each(function (t, r) { var l = e("<li/>").html(e(this).children(n.header).html()).addClass(0 == t ? n.tabMenuActiveClassName : "").addClass("item" + t).on("click keypress", { container: a.children(n.container), fieldset: e(r) }, function () { var i = e(this), t = i.parent().children().index(i); s(a, n, i, t) }); n.tabIndex && l.prop("tabindex", t), i.append(l) }) } } function i(a, n) { n.navigation && a.children(n.container).each(function (i) { var t = e("<div />").addClass("powermail_fieldwrap").addClass("powermail_tab_navigation").appendTo(e(this)); i > 0 && t.append(c(a, n)), i < a.children(n.container).length - 1 && t.append(o(a, n)) }) } function t(a, n) { e.fn.parsley && "data-parsley-validate" === a.data("parsley-validate") && a.parsley().subscribe("parsley:field:validated", function () { b(a, n), h(a, n) }) } function r(a, n) { n.openTabOnError && e.listen("parsley:field:error", function () { setTimeout(function () { a.find("." + n.tabMenuClassName + " > .parsley-error:first").click() }, 50) }) } function s(a, n, i, t) { $activeTab = m(a, n), $activeTab.removeClass(n.tabMenuActiveClassName), i.addClass(n.tabMenuActiveClassName), l(a, n), e(".powermail_fieldset", a).slice(t, t + 1).show() } function l(e, a) { e.children(a.container).hide() } function c(a, n) { return e("<a />").prop("href", "#").addClass("powermail_tab_navigation_previous").html("<").click(function (e) { e.preventDefault(), u(a, n) }) } function o(a, n) { return e("<a />").prop("href", "#").addClass("powermail_tab_navigation_next").html(">").click(function (e) { e.preventDefault(), d(a, n) }) } function d(e, a) { var n = p(e, a); $activeTab = m(e, a), $activeTab.removeClass(a.tabMenuActiveClassName).next().addClass(a.tabMenuActiveClassName), f(e, a, n + 1) } function u(e, a) { var n = p(e, a); $activeTab = m(e, a), $activeTab.removeClass(a.tabMenuActiveClassName).prev().addClass(a.tabMenuActiveClassName), f(e, a, n - 1) } function f(e, a, n) { l(e, a), e.find(".powermail_fieldset").slice(n, n + 1).show() } function p(e, a) { var n = v(e, a), i = n.index(m(e, a)); return parseInt(i) } function v(e, a) { return e.find("." + a.tabMenuClassName + " > li") } function m(e, a) { var n = v(e, a); return n.filter("." + a.tabMenuActiveClassName) } function b(e, a) { var n = v(e, a); n.removeClass("parsley-error") } function h(a, n) { a.parsley().isValid() || a.find(".parsley-error").each(function () { var i = a.find(".powermail_fieldset").index(e(this).closest(".powermail_fieldset")), t = v(a, n), r = t.slice(i, i + 1); r.addClass("parsley-error") }) } e.fn.powermailTabs = function (e) { "use strict"; var s = jQuery(this); e = jQuery.extend({ container: "fieldset", header: "legend", tabs: !0, navigation: !0, openTabOnError: !0, tabIndex: !0, tabMenuClassName: "powermail_tabmenu", tabMenuActiveClassName: "act" }, e), a(s, e), n(s, e), i(s, e), t(s, e), r(s, e) } });
function PowermailForm(e) { "use strict"; this.initialize = function () { a(), t(), i(), r(), o(), n(), s(), l() }; var a = function () { e.fn.powermailTabs && e(".powermail_morestep").each(function () { e(this).powermailTabs() }) }, t = function () { e("form[data-powermail-ajax]").length && p() }, i = function () { e(".powermail_fieldwrap_location input").length && navigator.geolocation && navigator.geolocation.getCurrentPosition(function (a) { var t = a.coords.latitude, i = a.coords.longitude, r = x() + "/index.php?eID=powermailEidGetLocation"; jQuery.ajax({ url: r, data: "lat=" + t + "&lng=" + i, cache: !1, beforeSend: function () { e("body").css("cursor", "wait") }, complete: function () { e("body").css("cursor", "default") }, success: function (a) { a && e(".powermail_fieldwrap_location input").val(a) } }) }) }, r = function () { e.fn.datetimepicker && e(".powermail_date").each(function () { var a = e(this); if ("date" === a.prop("type") || "datetime-local" === a.prop("type") || "time" === a.prop("type")) { if (!a.data("datepicker-force")) { if (e(this).data("date-value")) { var t = w(e(this).data("date-value"), e(this).data("datepicker-format"), a.prop("type")); null !== t && e(this).val(t) } return } a.prop("type", "text") } var i = !0, r = !0; "date" === a.data("datepicker-settings") ? r = !1 : "time" === a.data("datepicker-settings") && (i = !1), a.datetimepicker({ format: a.data("datepicker-format"), timepicker: r, datepicker: i, lang: "en", i18n: { en: { months: a.data("datepicker-months").split(","), dayOfWeek: a.data("datepicker-days").split(",") } } }) }) }, o = function () { e(".powermail_all_type_password.powermail_all_value").html("********") }, n = function () { e.fn.parsley && e(".powermail_reset").on("click", "", function () { e('form[data-parsley-validate="data-parsley-validate"]').parsley().reset() }) }, l = function () { window.Parsley && (_(), g()) }, p = function () { var a, t = !1; e(document).on("submit", "form[data-powermail-ajax]", function (i) { var r = e(this); r.data("powermail-ajax-uri") && (a = r.data("powermail-ajax-uri")); var o = r.data("powermail-form"); t || (e.ajax({ type: "POST", url: r.prop("action"), data: new FormData(r.get(0)), contentType: !1, processData: !1, beforeSend: function () { e(".powermail_submit", r).parent().append(h()), e(".powermail_confirmation_submit, .powermail_confirmation_form", r).closest(".powermail_confirmation").append(h()) }, complete: function () { e(".powermail_fieldwrap_submit", r).find(".powermail_progressbar").remove(), s() }, success: function (i) { var n = e('*[data-powermail-form="' + o + '"]:first', i); n.length ? (e('*[data-powermail-form="' + o + '"]:first').closest(".tx-powermail").html(n), e.fn.powermailTabs && e(".powermail_morestep").powermailTabs(), e.fn.parsley && e('form[data-parsley-validate="data-parsley-validate"]').parsley(), f()) : (a ? window.location = a : r.submit(), t = !0) } }), i.preventDefault()) }) }, s = function () { e(".powermail_fieldwrap_file_inner").find(".deleteAllFiles").each(function () { d(e(this).closest(".powermail_fieldwrap_file_inner").find('input[type="file"]')) }), e(".deleteAllFiles").click(function () { c(e(this).closest(".powermail_fieldwrap_file_inner").children('input[type="hidden"]')), e(this).closest("ul").fadeOut(function () { e(this).remove() }) }) }, d = function (e) { e.prop("disabled", "disabled").addClass("hide").prop("type", "hidden") }, c = function (e) { e.prop("disabled", !1).removeClass("hide").prop("type", "file") }, f = function () { e("img.powermail_captchaimage").each(function () { var a = u(e(this).prop("src")); e(this).prop("src", a + "?hash=" + m(5)) }) }, u = function (e) { var a = e.split("?"); return a[0] }, m = function (e) { for (var a = "", t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", i = 0; e > i; i++)a += t.charAt(Math.floor(Math.random() * t.length)); return a }, w = function (e, a, t) { var i = Date.parseDate(e, a); if (null === i) return null; var r = new Date(i), o = r.getFullYear() + "-"; o += ("0" + (r.getMonth() + 1)).slice(-2) + "-", o += ("0" + r.getDate()).slice(-2); var n = ("0" + r.getHours()).slice(-2) + ":" + ("0" + r.getMinutes()).slice(-2), l = o + "T" + n; return "date" === t ? o : "datetime-local" === t ? l : "time" === t ? n : null }, h = function () { return e("<div />").addClass("powermail_progressbar").html(e("<div />").addClass("powermail_progress").html(e("<div />").addClass("powermail_progess_inner"))) }, v = function (e) { for (var a = e.get(0), t = 0, i = 0; i < a.files.length; i++) { var r = a.files[i]; r.size > t && (t = r.size) } return parseInt(t) }, _ = function () { window.Parsley.addValidator("powermailfilesize", function (a, t) { if (-1 !== t.indexOf(",")) { var i = t.split(","), r = parseInt(i[0]), o = e('*[name="tx_powermail_pi1[field][' + i[1] + '][]"]'); if (o.length && v(o) > r) return !1 } return !0 }, 32).addMessage("en", "powermailfilesize", "Error") }, g = function () { window.Parsley.addValidator("powermailfileextensions", function (a, t) { var i = e('*[name="tx_powermail_pi1[field][' + t + '][]"]'); return i.length ? y(b(a), i.prop("accept")) : !0 }, 32).addMessage("en", "powermailfileextensions", "Error") }, y = function (e, a) { return -1 !== a.indexOf("." + e) }, b = function (e) { return e.split(".").pop() }, x = function () { var a; return a = e("base").length > 0 ? jQuery("base").prop("href") : "https:" != window.location.protocol ? "http://" + window.location.hostname : "https://" + window.location.hostname } } jQuery(document).ready(function (e) { "use strict"; var a = new window.PowermailForm(e); a.initialize() });
jQuery(document).ready(function ($) {

    $('img.svg').each(function () {
        var $img = $(this),
            imgID = $img.attr('id'),
            imgClass = $img.attr('class'),
            imgURL = $img.attr('src');
        $.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = $(data).find('svg');
            // Add replaced image’s ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image’s classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            // Replace image with new SVG
            $img.replaceWith($svg);
        });
    });

    var message = "";
    var acceptText = "";
    var policyText = "";
    var link = "";

    var ok = "";
    var nook = "";

    message = "Zur statistischen Analyse unserer Seitennutzung, zeichnen wir anonymisiert Daten auf und legen einen Cookie auf Ihrem Rechner ab.";
    acceptText = "Ich bin einverstanden";
    policyText = "Datenschutzhinweise";
    link = "/de/fusszeile/datenschutz.html";
    ok = "Akzeptieren";
    nook = "Ablehnen"

    if ($("html").attr("lang") == "en" || $("html").attr("lang") == "zh" || $("html").attr("lang") == "jp") {
        message = "This website uses cookies to ensure you get the best experience on our website.";
        acceptText = "Accept";
        policyText = "Privacy policy";
        link = "/en/footer-navigation/privacy-policy.html";
        ok = "Accept";
        nook = "Decline"
    }


    // $("footer").after("<div id='cookie-hinweis-container'><span>" + message + "</span><div class='cookiebtns'><a id='cookieagree'>" + ok + "</a><a id='cookienoagree'>" + nook + "</a><a href='" + link + "'>" + policyText + "</a></div></span></div>");

    var cookieheight = $("#cookie-hinweis-container").outerHeight();
    // $("footer").css("margin-bottom", cookieheight + "px")




    $("#cookieagree").on("click", function () {
        $.cookie("cookieagree", "true", { path: '/', domain: 'bafang-e.com', expires: 999 });
        $("#cookie-hinweis-container").remove();
        $("footer").css("margin-bottom", "0px")
        //$("body").css("margin-bottom", "0px");
    });

    $("#cookienoagree").on("click", function () {
        $.cookie("cookienoagree", "true", { path: '/', domain: 'bafang-e.com', expires: 999 });
        $("#cookie-hinweis-container").remove();
        $("footer").css("margin-bottom", "0px")
        //$("body").css("margin-bottom", "0px");
    });


    if ($.cookie("cookienoagree")) {
        $("#cookie-hinweis-container").remove();
        $("footer").css("margin-bottom", "0px")
    }

    if ($.cookie("cookieagree")) {
        $("#cookie-hinweis-container").remove();
        $("footer").css("margin-bottom", "0px")
    }





    $('#search_click').click(function () {
        $(this).closest('form').submit();
    });
});

jQuery(window).load(function () {

    /*if($('.productdetail').length > 0) {
          $('.productslider').bxSlider({
        pagerCustom: '#bx-pager',
        nextText: '',
        prevText: ''
      });
    }*/

    menu();
    mobilemenu();
    accrdions();
    gallery();

});

jQuery(window).bind("resize", function () {

    menu();

    if ($("#cookie-hinweis-container").length > 0) {
        var cookieheight = $("#cookie-hinweis-container").outerHeight();
        $("footer").css("margin-bottom", cookieheight + "px")
    }
    if (jQuery('.gallery').length > 0) {
        galleryResizeImage();
    }
});

function mobilemenu() {

    $('.mobilemenu').click(function () {

        if ($(this).hasClass('close')) {

            $('.ym-hlist').show();
            $(this).removeClass('close').addClass('open');
            return false;
        } else if ($(this).hasClass('open')) {

            $('.ym-hlist').hide();
            $(this).removeClass('open').addClass('close');
            return false;
        }


    });

    $('.languagemobile').click(function () {

        var ulheigth = $('.ym-tlist').children('.top-nav').children('.lang').children('ul').height() - 2,
            width = $(window).width(),
            ulposition = '';

        console.log($(this).hasClass('close'));

        if ($(this).hasClass('close')) {

            $('.ym-tlist').children('.top-nav').children('.lang').find('ul').show();
            if ($(window).width() <= 480) {
                ulposition = ($('.ym-tlist').children('.top-nav').children('.lang').children('ul').offset().left) - 47;
            } else {
                ulposition = ($('.ym-tlist').children('.top-nav').children('.lang').children('ul').offset().left) - 65;
            }
            $('.ym-tlist').children('.top-nav').children('.lang').find('ul').css({ 'left': -(ulposition), 'width': width });

            if ($('#fullslider').length > 0) {
                $('#fullslider').css({ 'margin-top': ulheigth });
            } else {
                $('#breadcrumb').css({ 'margin-top': ulheigth });
            }
            $(this).removeClass('close').addClass('open');
            return false;
        } else if ($(this).hasClass('open')) {

            $('.ym-tlist').children('.top-nav').children('.lang').find('ul').removeAttr('style').hide();
            if ($('#fullslider').length > 0) {
                $('#fullslider').css({ 'margin-top': '0' });
            } else {
                $('#breadcrumb').css({ 'margin-top': '0' });
            }
            $(this).removeClass('open').addClass('close');
            return false;
        }


    });

    $('.searchmobile').click(function () {

        var ulheigth = $('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').height(),
            width = $(window).width(),
            ulposition = '';

        if ($(this).hasClass('close')) {

            $('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').show();
            if ($(window).width() <= 480) {
                ulposition = ($('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').offset().left) - 89;
            } else {
                ulposition = ($('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').offset().left) - 119;
            }
            $('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').css({ 'left': -(ulposition), 'width': width });

            if ($('#fullslider').length > 0) {
                $('#fullslider').css({ 'margin-top': ulheigth });
            } else {
                $('#breadcrumb').css({ 'margin-top': ulheigth });
            }

            $(this).removeClass('close').addClass('open');
            return false;
        } else if ($(this).hasClass('open')) {

            $('.ym-tlist').children('.top-nav').children('li').find('.searchcontent').removeAttr('style').hide();
            if ($('#fullslider').length > 0) {
                $('#fullslider').css({ 'margin-top': '0' });
            } else {
                $('#breadcrumb').css({ 'margin-top': '0' });
            }
            $(this).removeClass('open').addClass('close');
            return false;
        }


    });
}

function menu() {

    var logowidth = $('header').find('.top-left').find('.logo').width(),
        topmenuwidth = $('header').find('.top-right').width(),
        menuwidht = $('header').find('nav').width(),
        windowwidth = $('header').find('.ym-wrapper').width(),
        em = '';

    if ($(window).width() < 840) {

        em = Math.ceil(windowwidth - logowidth - menuwidht);

        $('header').find('.top-right').css({ 'width': em - 30 });

        if ($('nav > .ym-hlist').children('ul').children('li.inquiry').length == 0 && $('.ym-tlist').children('.top-nav').children('li.inquiry').length > 0) {
            $('nav > .ym-hlist').children('ul').prepend($('.ym-tlist').children('.top-nav').children('li.inquiry'));
        }
        if ($('nav > .ym-hlist').children('ul').children('li.login').length == 0 && $('.ym-tlist').children('.top-nav').children('li.login').length > 0) {
            $('nav > .ym-hlist').children('ul').children('li.inquiry').after($('.ym-tlist').children('.top-nav').children('li.login'));
        }

        $('.ym-tlist').children('.top-nav').children('li.search').children('i').addClass('searchmobile');
        $('.ym-tlist').children('.top-nav').children('li.lang').find('.language').addClass('languagemobile');

        $('.list').accordion({
            header: '.header',
            animated: 'easeslide',
            speed: 50,
            animate: 50,
            heightStyle: 'content',
            active: false,
            collapsible: true,
            navigation: true,
            // icons: { "header": "papicon_plus", "activeHeader": "papicon_minus" },
        });

        $('.productdetailspecs').accordion({
            header: 'h3',
            animated: 'easeslide',
            speed: 50,
            animate: 50,
            heightStyle: 'content',
            active: false,
            collapsible: true,
            navigation: true,
            // icons: { "header": "papicon_plus", "activeHeader": "papicon_minus" },
        });

        $('footer').find('.footer-left').find('li:first-child').hide();

        /* Menü  für Smartphone */

        $('.ym-hlist').hide();

        var ul = $('.ym-qlist, .ym-hlist, .ym-fbox');

        if (ul.length) {

            ul.each(function (i, items_list) {

                $(items_list).find('li').each(function (j, li) {

                    var subul = $(li).children('ul');

                    // $(li).children('a').children('i').remove();

                    if ($(li).children('a').children('i').length == 0) {
                        $(li).children('a').prepend('<i class="papicon_right menuicon"></i>');
                    }

                    if (subul.length > 0) {

                        var header = $(li).children('a');

                        $(li).accordion({
                            header: header,
                            animated: 'easeslide',
                            speed: 50,
                            animate: 50,
                            heightStyle: 'content',
                            active: false,
                            collapsible: true,
                            navigation: true,
                            // icons: { "header": "papicon_plus", "activeHeader": "papicon_minus" },

                        });

                        var headeracc = $(li).children('a').hasClass('ui-accordion-header');

                        if (headeracc == true) {
                            $(li).children('a').children('i').remove();
                        }
                    }
                });
            });
        }
        var liwidth = 0;

        $('#breadcrumbcontent').children('ul').find('li').each(function (j, li) {

            liwidth += parseFloat(Math.ceil($(li).width() + 20));
        });

        $('#breadcrumbcontent').children('ul').css({ 'width': liwidth });

        breadcrumbslide();

    } else {

        $('.ym-tlist').children('.top-nav').children('li.lang').find('ul').removeAttr('style');
        $('.ym-tlist').children('.top-nav').children('li.lang').find('.language').removeClass('languagemobile');
        $('.language').unbind("click", function () { });

        $('.ym-tlist').children('.top-nav').children('li.search').find('.searchcontent').removeAttr('style');
        $('.ym-tlist').children('.top-nav').children('li.search').children('i').removeClass('searchmobile');

        $('header').find('.top-right').css({ 'width': 'auto' });

        var list = $('.list').children('div').hasClass('ui-accordion-header');

        if (list == true) {
            $('.list').accordion('destroy');
        }

        if ($('.productdetailspecs').children('div').children('h3').hasClass('ui-accordion-header') == true) {
            $('.productdetailspecs').accordion('destroy');
        }

        $('.ym-hlist > ul').children('li').hover(function () {

            $(this).find('ul').show();

        }, function () {
            $(this).find('ul').hide();
        });

        $('footer').find('.footer-left').find('li:first-child').show();

        var ul = $('.ym-hlist, .ym-fbox');

        if (ul.length) {

            ul.each(function (i, items_list) {

                $(items_list).find('li').each(function (j, li) {

                    $(li).children('a').children('i.menuicon').remove();

                    var subul = $(li).children('ul');

                    if (subul.length > 0) {

                        var header = $(li).children('a').hasClass('ui-accordion-header');

                        if (header == true) {
                            $(li).accordion('destroy');
                        }
                    }
                });
            });

            ul.show();

            //console.log($('.ym-tlist').children('.top-nav').children('li').hasClass('inquiry'));
            if ($('.ym-tlist').children('.top-nav').children('li.inquiry').length == 0 && $('nav > .ym-hlist').children('ul').children('li.inquiry').length > 0) {
                $('.ym-tlist').children('.top-nav').children('li:first-child').after($('nav > .ym-hlist').children('ul').children('li.inquiry'));
            }
            if ($('.ym-tlist').children('.top-nav').children('li.login').length == 0 && $('nav > .ym-hlist').children('ul').children('li.login').length > 0) {
                $('.ym-tlist').children('.top-nav').children('li.inquiry').after($('nav > .ym-hlist').children('ul').children('li.login'));
            }

        }

        if ($('#breadcrumbcontent').children('ul').hasClass('touchswipe') == true) {
            $('#breadcrumbcontent').children('ul').swipe('destroy');
            $('#breadcrumbcontent').children('ul').removeAttr('style');
            $('#breadcrumbcontent').children('ul').removeClass('touchswipe');
        }

        $('#breadcrumbcontent').children('ul').find('li').each(function (j, li) {

            liwidth += parseFloat(Math.ceil($(li).width() + 20));
        });

        $('#breadcrumbcontent').children('ul').css({ 'width': liwidth });
    }
}

function accrdions() {

    $('.faqaccordion').accordion({
        header: 'h5',
        animated: 'easeslide',
        speed: 50,
        animate: 50,
        heightStyle: 'content',
        active: false,
        collapsible: true,
        navigation: true,
        // icons: { "header": "papicon_plus", "activeHeader": "papicon_minus" },
    });
    $('.accordion').accordion({
        header: 'h3',
        animated: 'easeslide',
        speed: 50,
        animate: 50,
        heightStyle: 'content',
        active: false,
        collapsible: true,
        navigation: true,
        // icons: { "header": "papicon_plus", "activeHeader": "papicon_minus" },
    });
}

function gallery() {
    if (jQuery('.gallery').length > 0) {

        jQuery('.gallery .csc-textpic-imagecolumn').bxSlider({
            //pagerCustom: '#bx-pager',
            nextText: '',
            prevText: '',
            minSlides: 1,
            maxSlides: 3,
            slideWidth: 320,
            slideMargin: 10
        });

        galleryResizeImage();
    }
}

function galleryResizeImage() {
    $('.gallery figure').each(function () {
        if ($(this).children('a').height() < $(this).height()) {
            $(this).find('img').height($(this).height());
            $(this).children('a').css('display', 'inline-block');
        } else if ($(this).children('a').width() < $(this).width()) {
            $(this).find('img').width($(this).width());
            $(this).children('a').css('display', 'inline-block');
        }

    });
}



function breadcrumbslide() {

    var IMG_WIDTH = 120;
    var currentImg = 0;
    var maxImages = $('#breadcrumbcontent').children('ul').children('li').size();
    var speed = 500;
    var imgs = $('#breadcrumbcontent').children('ul');


    /**
     * Catch each phase of the swipe.
     * move : we drag the div
     * cancel : we animate back to where we were
     * end : we animate to the next image
     */
    var swipeStatus = function (event, phase, direction, distance) {
        //If we are moving before swipe, and we are going L or R in X mode, or U or D in Y mode then drag.

        //console.log(phase);
        if (phase == "move" && (direction == "left" || direction == "right")) {
            var duration = 0;
            if (direction == "left") {
                scrollImages((IMG_WIDTH * currentImg) + distance, duration);
            } else if (direction == "right") {
                scrollImages((IMG_WIDTH * currentImg) - distance, duration);
            }
        } else if (phase == "cancel") {
            scrollImages(IMG_WIDTH * currentImg, speed);
        } else if (phase == "end") {
            if (direction == "right") {
                previousImage();
            } else if (direction == "left") {
                nextImage();
            }
        }
    }
    var previousImage = function () {
        currentImg = Math.max(currentImg - 1, 0);
        scrollImages(IMG_WIDTH * currentImg, speed);
    }
    var nextImage = function () {
        currentImg = Math.min(currentImg + 1, maxImages - 1);
        scrollImages(IMG_WIDTH * currentImg, speed);
    }
	/**
	* Manually update the position of the imgs on drag
	*/
    function scrollImages(distance, duration) {

        imgs.css("transition-duration", (duration / 1000).toFixed(1) + "s");
        //inverse the number we set in the css
        var value = (distance < 0 ? "" : "-") + Math.abs(distance).toString();
        imgs.css("transform", "translate(" + value + "px,0)");
    }

    var swipeOptions = {
        triggerOnTouchEnd: true,
        swipeStatus: swipeStatus,
        allowPageScroll: "vertical",
        threshold: 0
    };

    if ($('#breadcrumbcontent').length > 0) {
        imgs.swipe(swipeOptions);
        imgs.addClass('touchswipe');
    }
}

$("#bookmarkpopup a").on('click', function () {
    $("#bookmarkpopup").remove();
})

$(document).on("click", '.popclosejs', function () {
    $(document).find("#bookmarkpopup").remove();
});
jQuery(document).ready(function () {
    jQuery('a[class*=lightbox],a[rel*=lightbox]').fancybox({
        'padding': 15,
        'margin': 20,
        'width': 800,
        'height': 600,
        'minWidth': 100,
        'minHeight': 100,
        'maxWidth': 9999,
        'maxHeight': 9999,
        'autoSize': true,
        'fitToView': true,
        'aspectRatio': false,
        'topRatio': 0.5,
        'fixed': false,
        'scrolling': 'auto',
        'wrapCSS': '',
        'arrows': true,
        'closeBtn': true,
        'closeClick': false,
        'nextClick': false,
        'mouseWheel': true,
        'loop': true,
        'modal': false,
        'autoPlay': false,
        'playSpeed': 3000,
        'index': 0,
        'type': null,
        'href': null,
        'content': null,
        'openEffect': 'fade',
        'closeEffect': 'fade',
        'nextEffect': 'fade',
        'prevEffect': 'fade',
        'openSpeed': 300,
        'closeSpeed': 300,
        'nextSpeed': 300,
        'prevSpeed': 300,
        'openEasing': 'swing',
        'closeEasing': 'swing',
        'nextEasing': 'swing',
        'prevEasing': 'swing',
        'openOpacity': true,
        'closeOpacity': true,
        'openMethod': 'zoomIn',
        'closeMethod': 'zoomOut',
        'nextMethod': 'changeIn',
        'prevMethod': 'changeOut',
        'groupAttr': 'data-fancybox-group',
        'beforeShow': function (opts) {
            this.title = (jQuery(this.group[this.index]).attr('title') != undefined ? jQuery(this.group[this.index]).attr('title') : jQuery(this.group[this.index]).find('img').attr('title'));
        }
    });
});