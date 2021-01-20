(function (window, document, $, ms2WishlistConfig) {
    var ms2Wishlist = ms2Wishlist || {
        _form: null,
    };

    ms2Wishlist.config = {
        formSelector: '.ms2wishlist_form',
        activeFormClass: 'active',
        totalSelector: '.ms2wishlist_link',
        activeTotalClass: 'full',
        totalCountSelector: '.ms2wishlist_count',
        resourcesContainerSelector: '.ms2wishlist_resources',
        resourceUniqueSelectorPrefix: '.ms2wishlist_resource_',
        actionUrl: ms2WishlistConfig.actionUrl,
        actionKey: ms2WishlistConfig.actionKey,
    }

    ms2Wishlist.initialize = function () {
        $(document).on('submit', this.config.formSelector, function (e) {
            e.preventDefault();
            ms2Wishlist._form = $(this);
            let formData = ms2Wishlist._form.serializeArray();
            let action = ms2Wishlist._form.find('[name=' + ms2Wishlist.config.actionKey + ']:visible').val();
            ms2Wishlist.request(action, formData);
        });
    };

    ms2Wishlist.request = function (action, data) {
        data.push({
            name: this.config.actionKey,
            value: action
        });
        $.ajax({
            url: this.actionUrl,
            type: 'POST',
            dataType: 'json',
            data: data,
            beforeSend: function () {
                ms2Wishlist.callbacks[action]['before'].call(ms2Wishlist);
            },
            success: function (response) {
                switch (response.success) {
                    case true:
                        ms2Wishlist.callbacks[action]['success'].call(ms2Wishlist, response);
                        break;
                    default:
                        ms2Wishlist.callbacks[action]['error'].call(ms2Wishlist, response);
                        break;
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                console.error(xhr.responseJSON);
            }
        });
    };

    ms2Wishlist.callbacks = {
        add: {
            before: function () {
            },
            success: function (response) {
                this._form.addClass(this.config.activeFormClass);
                this.updateTotals(response.data.total);
                this.message.success(response.message);
            },
        },
        remove: {
            before: function () {
            },
            success: function (response) {
                this._form.removeClass(this.config.activeFormClass);
                this.updateTotals(response.data.total);
                $(this.config.resourceUniqueSelectorPrefix + response.data.id).remove();
                this.message.info(response.message);
                if (response.data.total <= 0 && $(this.config.resourcesContainerSelector).length > 0) {
                    location.reload();
                }
            },
        },
        clear: {
            before: function () {
            },
            success: function (response) {
                this.updateTotals(response.data.total);
                location.reload();
            },
        },
    };

    ms2Wishlist.updateTotals = function (count) {
        $(this.config.totalCountSelector).html(count);
        if (count > 0) {
            $(this.config.totalSelector).addClass(this.config.activeTotalClass);
        } else {
            $(this.config.totalSelector).removeClass(this.config.activeTotalClass);
        }
    };

    ms2Wishlist.message = {
        success: function (message) {
            alert(message);
        },
        info: function (message) {
            alert(message);
        },
        error: function (message) {
            alert(message);
        },
    };

    $(document).ready(function ($) {
        ms2Wishlist.initialize();
        var html = $('html');
        html.removeClass('no-js');
        if (!html.hasClass('js')) {
            html.addClass('js');
        }
    });

    window.ms2Wishlist = ms2Wishlist;
})(window, document, jQuery, ms2WishlistConfig);
