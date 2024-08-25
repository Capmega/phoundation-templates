(($) => {
    class Phoundation {
        static setDefaults(opt = Phoundation.options) {
            Phoundation.options = $.extend({}, Phoundation.options, opt);
        }
    }

    Phoundation.options = {
        ajaxSleep: 100
    };

    const old_ajax = $.ajax;

    $.filterPhoundation = function (response) {
        try {
            json = JSON.parse(response);

        } catch (e) {
            return response;
        }

        // We got JSON, yay! Is it Phundation JSON tho?
        if (json.phoundation == undefined) {
            // Not Phoundation response, just pass it through
            return response;
        }

        // We can safely assume this is a Phoundation response
        console.log('Got Phoundation response "' + json.response + '"')

        switch (json.response) {
            case 'ok':
                // All fine!
                break;

            case 'redirect':
                window.location.href(json.location);
                break;

            case 'signin':
                window.location.replace(json.location);
                break;

            case 'reload':
                window.location.reload(json.clearCache);
                break;

            case 'error':
                // Whoopsie!
        }

        if (json.flash) {
            // Process flash messages
        }

        if (json.html) {
            // Process HTML modifications
            if (typeof json.html != "object") {
                // Invalid response!
                throw "Received invalid Phoundation response json.html, should be object";
            }

            json.html.forEach(function(section, id) {
                switch (section.method) {
                    case "replace":
                        $(section.selector).replaceWith(section.html);
                        break;

                    case "append":
                        throw 'Method "' + section.method + '" in HTML section "' + id + '" in Phoundation reply is under construction';

                    default:
                        throw 'Unknown method "' + section.method + '" in HTML section "' + id + '" in Phoundation reply';
                }
            });
        }

        if (json.data == undefined) {
            json.data = {};
        }

        return JSON.stringify(json.data);
    }

    $.ajax = function (url, options) {
        // Execute the ajax call
        const ajaxResult = old_ajax(url, options);

        // Shift arguments
        if (typeof url === "object" && typeof options === "undefined") {
            options = url;
        }

        let ajaxSleep = options.ajaxSleep || Phoundation.options.ajaxSleep;

        if (!Number.isInteger(ajaxSleep)) {
            throw new Error('Phoundation "ajaxSleep" options must be a number');
        }

        if (ajaxSleep < 0) {
            throw new Error('Phoundation "ajaxSleep" options must be greater or equal to 0');
        }

        let ajaxSleepId = null;

        ajaxResult.sleep = function (fn) {
            if (typeof fn === "function") ajaxSleepId = setTimeout(fn, ajaxSleep);
            return this;
        };

        return ajaxResult.always(() => {
            if (ajaxSleepId !== null) {
                clearTimeout(ajaxSleepId);
                ajaxSleepId = null;
            }
        });
    };

    console.log("Phoundation jQuery extension setup");
    window.Phoundation = Phoundation;

})(jQuery);

$(function() {
    $.ajaxSetup({
        dataFilter: function (response) {
            $.filterPhoundation(response);
        },
        dataType: "json",
        cache: false
    });

    console.log("Phoundation jQuery extension initialized");
});
