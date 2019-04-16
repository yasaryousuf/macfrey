
/**
* jquery.matchHeight.js v0.5.2
* http://brm.io/jquery-match-height/
* License: MIT
*/

(function ($) {

    $.fn.matchHeight = function (byRow) {

        // handle matchHeight('remove')
        if (byRow === 'remove') {
            var that = this;

            // remove fixed height from all selected elements
            this.css('height', '');

            // remove selected elements from all groups
            $.each($.fn.matchHeight._groups, function (key, group) {
                group.elements = group.elements.not(that);
            });

            // TODO: cleanup empty groups

            return this;
        }

        if (this.length <= 1)
            return this;

        // byRow default to true
        byRow = (typeof byRow !== 'undefined') ? byRow : true;

        // keep track of this group so we can re-apply later on load and resize events
        $.fn.matchHeight._groups.push({
            elements: this,
            byRow: byRow
        });

        // match each element's height to the tallest element in the selection
        $.fn.matchHeight._apply(this, byRow);

        return this;
    };

    $.fn.matchHeight._apply = function (elements, byRow) {
        var $elements = $(elements),
            rows = [$elements];

        // get rows if using byRow, otherwise assume one row
        if (byRow) {

            // must first force an arbitrary equal height so floating elements break evenly
            $elements.css({
                'display': 'block',
                'padding-top': '0',
                'padding-bottom': '0',
                'border-top-width': '0',
                'border-bottom-width': '0',
                'height': '100px'
            });

            // get the array of rows (based on element top position)
            rows = _rows($elements);

            // revert the temporary forced style
            $elements.css({
                'display': '',
                'padding-top': '',
                'padding-bottom': '',
                'border-top-width': '',
                'border-bottom-width': '',
                'height': ''
            });
        }

        $.each(rows, function (key, row) {
            var $row = $(row),
                maxHeight = 0;

            // ensure elements are visible to prevent 0 height
            var hiddenParents = $row.parents().add($row).filter(':hidden');
            hiddenParents.css({ 'display': 'block' });

            // iterate the row and find the max height
            $row.each(function () {
                var $that = $(this);

                // ensure we get the correct actual height (and not a previously set height value)
                $that.css({ 'display': 'block', 'height': '' });

                // find the max height (including padding, but not margin)
                if ($that.outerHeight(false) > maxHeight)
                    maxHeight = $that.outerHeight(false);

                // revert display block
                $that.css({ 'display': '' });
            });

            // revert display block
            hiddenParents.css({ 'display': '' });

            // iterate the row and apply the height to all elements
            $row.each(function () {
                var $that = $(this),
                    verticalPadding = 0;

                // handle padding and border correctly (required when not using border-box)
                if ($that.css('box-sizing') !== 'border-box') {
                    verticalPadding += _parse($that.css('border-top-width')) + _parse($that.css('border-bottom-width'));
                    verticalPadding += _parse($that.css('padding-top')) + _parse($that.css('padding-bottom'));
                }

                // set the height (accounting for padding and border)
                $that.css('height', maxHeight - verticalPadding);
            });
        });

        return this;
    };

    /*
    *  _applyDataApi will apply matchHeight to all elements with a data-match-height attribute
    */

    $.fn.matchHeight._applyDataApi = function () {
        var groups = {};

        // generate groups by their groupId set by elements using data-match-height
        $('[data-match-height], [data-mh]').each(function () {
            var $this = $(this),
                groupId = $this.attr('data-match-height');
            if (groupId in groups) {
                groups[groupId] = groups[groupId].add($this);
            } else {
                groups[groupId] = $this;
            }
        });

        // apply matchHeight to each group
        $.each(groups, function () {
            this.matchHeight(true);
        });
    };

    /* 
    *  _update function will re-apply matchHeight to all groups with the correct options
    */

    $.fn.matchHeight._groups = [];
    $.fn.matchHeight._throttle = 80;

    var previousResizeWidth = -1,
        updateTimeout = -1;

    $.fn.matchHeight._update = function (event) {
        // prevent update if fired from a resize event 
        // where the viewport width hasn't actually changed
        // fixes an event looping bug in IE8
        if (event && event.type === 'resize') {
            var windowWidth = $(window).width();
            if (windowWidth === previousResizeWidth)
                return;
            previousResizeWidth = windowWidth;
        }

        // throttle updates
        if (updateTimeout === -1) {
            updateTimeout = setTimeout(function () {

                $.each($.fn.matchHeight._groups, function () {
                    $.fn.matchHeight._apply(this.elements, this.byRow);
                });

                updateTimeout = -1;

            }, $.fn.matchHeight._throttle);
        }
    };

    /* 
    *  bind events
    */

    // apply on DOM ready event
    $($.fn.matchHeight._applyDataApi);

    // update heights on load and resize events
    $(window).bind('load resize orientationchange', $.fn.matchHeight._update);

    /*
    *  rows utility function
    *  returns array of jQuery selections representing each row 
    *  (as displayed after float wrapping applied by browser)
    */

    var _rows = function (elements) {
        var tolerance = 1,
            $elements = $(elements),
            lastTop = null,
            rows = [];

        // group elements by their top position
        $elements.each(function () {
            var $that = $(this),
                top = $that.offset().top - _parse($that.css('margin-top')),
                lastRow = rows.length > 0 ? rows[rows.length - 1] : null;

            if (lastRow === null) {
                // first item on the row, so just push it
                rows.push($that);
            } else {
                // if the row top is the same, add to the row group
                if (Math.floor(Math.abs(lastTop - top)) <= tolerance) {
                    rows[rows.length - 1] = lastRow.add($that);
                } else {
                    // otherwise start a new row group
                    rows.push($that);
                }
            }

            // keep track of the last row top
            lastTop = top;
        });

        return rows;
    };

    var _parse = function (value) {
        // parse value and convert NaN to 0
        return parseFloat(value) || 0;
    };

})(jQuery);

function slideWidth() {

    var containerWidth = jQuery('#topproducts-slider .ym-wrapper').width();
    var slideWidth = containerWidth / 3;

    if (containerWidth < 580 || jQuery('#topproducts-slider li').length == 1) {
        slideWidth = containerWidth;
    } else if (containerWidth < 900 || jQuery('#topproducts-slider li').length == 2) {
        slideWidth = containerWidth / 2;
    }

    return slideWidth;
}

jQuery(window).load(function () {

    //force equal heights only for desktop version
    if ($(window).width() > 840) {
        jQuery('.equalheights').matchHeight(false);
    }


    jQuery('#topproducts-slider').show();

    jQuery('#topproducts-slider ul').bxSlider({
        minSlides: 1,
        maxSlides: 3,
        slideWidth: slideWidth(),
        adaptiveHeight: false,
        slideMargin: 0,
        speed: 800,
        nextText: '',
        prevText: '',
        touchEnabled: true,
        adaptiveHeight: false,
        auto: false,
        infiniteLoop: false,
        hideControlOnEnd: true,
        onSliderLoad: function () {

        }
    });

    if (jQuery('#topproducts-slider li').length > 1) {
        jQuery('.equaltopproductpictureheights').matchHeight(false);
        jQuery('.equaltopproductmetadataheights').matchHeight(false);
        jQuery('.equaltopproductheights').matchHeight(false);
    }
});

jQuery(document).ready(function () {

    //jQuery('#filter').insertBefore(jQuery('main'));

    // getInquiries();

    jQuery("a.preventdefault").click(function (ev) {
        ev.preventDefault();
    });

    jQuery('form.filter select').bind('change', function () {
        jQuery('.loading').show();
        jQuery("form.filter").submit();
    });



});
function number_format(number, decimals, dec_point, thousands_sep) {
    //  discuss at: http://phpjs.org/functions/number_format/
    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: davook
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Theriault
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Michael White (http://getsprink.com)
    // bugfixed by: Benjamin Lupton
    // bugfixed by: Allan Jensen (http://www.winternet.no)
    // bugfixed by: Howard Yeend
    // bugfixed by: Diogo Resende
    // bugfixed by: Rival
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    //  revised by: Luke Smith (http://lucassmith.name)
    //    input by: Kheang Hok Chin (http://www.distantia.ca/)
    //    input by: Jay Klehr
    //    input by: Amir Habibi (http://www.residence-mixte.com/)
    //    input by: Amirouche
    //   example 1: number_format(1234.56);
    //   returns 1: '1,235'
    //   example 2: number_format(1234.56, 2, ',', ' ');
    //   returns 2: '1 234,56'
    //   example 3: number_format(1234.5678, 2, '.', '');
    //   returns 3: '1234.57'
    //   example 4: number_format(67, 2, ',', '.');
    //   returns 4: '67,00'
    //   example 5: number_format(1000);
    //   returns 5: '1,000'
    //   example 6: number_format(67.311, 2);
    //   returns 6: '67.31'
    //   example 7: number_format(1000.55, 1);
    //   returns 7: '1,000.6'
    //   example 8: number_format(67000, 5, ',', '.');
    //   returns 8: '67.000,00000'
    //   example 9: number_format(0.9, 0);
    //   returns 9: '1'
    //  example 10: number_format('1.20', 2);
    //  returns 10: '1.20'
    //  example 11: number_format('1.20', 4);
    //  returns 11: '1.2000'
    //  example 12: number_format('1.2000', 3);
    //  returns 12: '1.200'
    //  example 13: number_format('1 000,50', 2, '.', ' ');
    //  returns 13: '100 050.00'
    //  example 14: number_format(1e-8, 8, '.', '');
    //  returns 14: '0.00000001'

    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
        .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

function str_replace(search, replace, subject, count) {
    //  discuss at: http://phpjs.org/functions/str_replace/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Gabriel Paderni
    // improved by: Philip Peterson
    // improved by: Simon Willison (http://simonwillison.net)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Onno Marsman
    // improved by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // bugfixed by: Anton Ongson
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Oleg Eremeev
    //    input by: Onno Marsman
    //    input by: Brett Zamir (http://brett-zamir.me)
    //    input by: Oleg Eremeev
    //        note: The count parameter must be passed as a string in order
    //        note: to find a global variable in which the result will be given
    //   example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    //   returns 1: 'Kevin.van.Zonneveld'
    //   example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    //   returns 2: 'hemmo, mars'

    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,
        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = Object.prototype.toString.call(r) === '[object Array]',
        sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp)
                .split(f[j])
                .join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

function round(value, precision, mode) {
    //  discuss at: http://phpjs.org/functions/round/
    // original by: Philip Peterson
    //  revised by: Onno Marsman
    //  revised by: T.Wild
    //  revised by: Rafał Kukawski (http://blog.kukawski.pl/)
    //    input by: Greenseed
    //    input by: meo
    //    input by: William
    //    input by: Josep Sanz (http://www.ws3.es/)
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //        note: Great work. Ideas for improvement:
    //        note: - code more compliant with developer guidelines
    //        note: - for implementing PHP constant arguments look at
    //        note: the pathinfo() function, it offers the greatest
    //        note: flexibility & compatibility possible
    //   example 1: round(1241757, -3);
    //   returns 1: 1242000
    //   example 2: round(3.6);
    //   returns 2: 4
    //   example 3: round(2.835, 2);
    //   returns 3: 2.84
    //   example 4: round(1.1749999999999, 2);
    //   returns 4: 1.17
    //   example 5: round(58551.799999999996, 2);
    //   returns 5: 58551.8

    var m, f, isHalf, sgn; // helper variables
    // making sure precision is integer
    precision |= 0;
    m = Math.pow(10, precision);
    value *= m;
    // sign of the number
    sgn = (value > 0) | -(value < 0);
    isHalf = value % 1 === 0.5 * sgn;
    f = Math.floor(value);

    if (isHalf) {
        switch (mode) {
            case 'PHP_ROUND_HALF_DOWN':
                // rounds .5 toward zero
                value = f + (sgn < 0);
                break;
            case 'PHP_ROUND_HALF_EVEN':
                // rouds .5 towards the next even integer
                value = f + (f % 2 * sgn);
                break;
            case 'PHP_ROUND_HALF_ODD':
                // rounds .5 towards the next odd integer
                value = f + !(f % 2);
                break;
            default:
                // rounds .5 away from zero
                value = f + (sgn > 0);
        }
    }

    return (isHalf ? value : Math.round(value)) / m;
}

//parse param and convert to valid data
function sanitizeParams(param) {
    param = str_replace(',', '.', param);
    param = parseFloat(param);

    if (isNaN(param)) {
        param = 0;
    }

    return param;
}

function calcSpokeLength(spokecount, rimdiameter, hubdiameter, hubcentricdivergence, spokeholediameteronhub, spokearrangement) {

    spokecount = sanitizeParams(spokecount.val());
    rimdiameter = sanitizeParams(rimdiameter.val());
    hubdiameter = sanitizeParams(hubdiameter.val());
    hubcentricdivergence = sanitizeParams(hubcentricdivergence.val());
    spokeholediameteronhub = sanitizeParams(spokeholediameteronhub.val());
    spokearrangement = sanitizeParams(spokearrangement.val());

    //var spokelength = (spokecount + rimdiameter + hubdiameter + hubcentricdivergence + spokeholediameteronhub + spokearrangement);

    var spokelength = Math.sqrt(Math.pow(((hubdiameter / 2) * Math.sin((2 * Math.PI * spokearrangement) / (spokecount / 2))), 2) + Math.pow(((rimdiameter / 2) - ((hubdiameter / 2) * Math.cos((2 * Math.PI * spokearrangement) / (spokecount / 2)))), 2) + Math.pow(hubcentricdivergence, 2)) - (spokeholediameteronhub / 2);

    return number_format(round(spokelength, 2), 2, '.', '');
}

function calcVehicleSpeed(rotationSpeed, diameter) {

    rotationSpeed = sanitizeParams(rotationSpeed.val());
    diameter = sanitizeParams(diameter.val());

    var vehicleSpeed = (60 * diameter * rotationSpeed * 3.14 * 25.4) / (1000 * 1000);

    return number_format(round(vehicleSpeed, 2), 2, '.', '');
}

function calcRotationSpeed(vehicleSpeed, diameter) {

    vehicleSpeed = sanitizeParams(vehicleSpeed.val());
    diameter = sanitizeParams(diameter.val());

    var rotationSpeed = (vehicleSpeed * 1000 * 1000) / (diameter * 25.4 * 60 * 3.14);

    return number_format(round(rotationSpeed, 2), 2, '.', '');
} 