(($) => {
    /**
     * Create the Phoundation main class
     */
    class Phoundation {
        static setDefaults(opt = Phoundation.options) {
            Phoundation.options = $.extend({}, Phoundation.options, opt);
        };
    }


    /**
     * Processes the HTML sections in a Phoundation response
     *
     * @param html
     */
    Phoundation.processHtml = function (html): void
    {
        // Process HTML modifications
        if (typeof html != "object") {
            // Invalid response!
            throw "Received invalid Phoundation response json.html, should be object";
        }

        // Process each section
        html.forEach(function(section, id): void {
            switch (section.method) {
                case "replace":
                    // Replace the selector with the new HTML
                    $(section.selector).replaceWith(section.html);
                    break;

                case "append":
                    // Append the specified HTML to the content of the selector
                    $(section.selector).append(section.html);
                    break;

                case "prepend":
                    // Append the specified HTML to the content of the selector
                    $(section.selector).prepend(section.html);
                    break;

                default:
                    throw 'Unknown method "' + section.method + '" in HTML section "' + id + '" in Phoundation reply';
            }
        });
    }


    /**
     * Processes the flash messages in a Phoundation response
     *
     * @param messages
     */
    Phoundation.processFlash = function (messages): void
    {
        // Process HTML modifications
        if (typeof messages != "object") {
            // Invalid response!
            throw "Received invalid Phoundation response json.messages, should be object";
        }

        messages.forEach(function(section, id): void {
            $(document).Toasts("create", section);
        });
    }


    /**
     * Set Phoundation options
     *
     * @type {{ajaxSleep: number}}
     */
    Phoundation.options = {
        ajaxSleep: 100
    };

    const old_ajax = $.ajax;


    /**
     * Add $.filterPhoundation() method to jQuery
     */
    $.filterPhoundation = function (response): string {
        let json;

        try {
            json = JSON.parse(response);

        } catch (e) {
            return response;
        }

        // We got JSON, yay! Is it Phundation JSON tho?
        if (typeof json.phoundation == 'undefined') {
            // Not Phoundation response, just pass it through
            return response;
        }

        // We can safely assume this is a Phoundation response
        console.log('Got Phoundation response "' + json.response + '"')

        // Process response codes
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
                // Whoopsie! Just continue
        }

        // Process flash and HTML sections
        if (json.flash) {
            Phoundation.processFlash(json.flash);
        }

        if (json.html) {
            Phoundation.processHtml(json.html);
        }

        // Ensure we have data in the response
        if (json.data == undefined) {
            json.data = {};
        }

        return JSON.stringify(json.data);
    }


    /**
     * Add support for jQuery ajax request sleep
     *
     * @param url
     * @param options
     * @returns {*}
     */
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


/**
 * Ensure that jQuery pre-processes all Phoundation responses using $.filterPhoundation()
 */
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
