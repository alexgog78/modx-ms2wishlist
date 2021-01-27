'use strict';

(function (window, document, $, ms2Wishlist) {
    let _this = ms2Wishlist;

    $.extend(_this, {
        _form: null,
    });

    _this.options = {
        formSelector: '.ms2wishlist_form',
        activeFormClass: 'active',
        totalSelector: '.ms2wishlist_link',
        activeTotalClass: 'full',
        totalCountSelector: '.ms2wishlist_count',
        resourcesContainerSelector: '.ms2wishlist_resources',
        resourceUniqueSelectorPrefix: '.ms2wishlist_resource_',
    };

    _this.initialize = function () {
        $(document).on('submit', this.options.formSelector, function (e) {
            e.preventDefault();
            _this._form = $(this);
            let formData = _this._form.serializeArray();
            let action = _this._form.find('[name=' + _this.actionKey + ']:visible').val();
            _this.request(action, formData);
        });
    };

    _this.request = function (action, data) {
        data.push({
            name: _this.actionKey,
            value: action
        });
        $.ajax({
            url: _this.actionUrl,
            type: 'POST',
            dataType: 'json',
            data: data,
            beforeSend: function () {
                _this.callbacks[action]['before'].call(_this);
            },
            success: function (response) {
                switch (response.success) {
                    case true:
                        _this.callbacks[action]['success'].call(_this, response);
                        break;
                    default:
                        _this.callbacks[action]['error'].call(_this, response);
                        break;
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                console.error(xhr.responseJSON);
            }
        });
    };

    _this.callbacks = {
        add: {
            before: function () {
            },
            success: function (response) {
                _this._form.addClass(_this.options.activeFormClass);
                _this.updateTotals(response.data.total);
                _this.message.success(response.message);
            },
        },
        remove: {
            before: function () {
            },
            success: function (response) {
                _this._form.removeClass(_this.options.activeFormClass);
                _this.updateTotals(response.data.total);
                $(_this.options.resourceUniqueSelectorPrefix + response.data.id).remove();
                _this.message.info(response.message);
                if (response.data.total <= 0 && $(_this.options.resourcesContainerSelector).length > 0) {
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

    _this.updateTotals = function (count) {
        $(_this.options.totalCountSelector).html(count);
        if (count > 0) {
            $(_this.options.totalSelector).addClass(_this.options.activeTotalClass);
        } else {
            $(_this.options.totalSelector).removeClass(_this.options.activeTotalClass);
        }
    };

    _this.message = {
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
        _this.initialize();
        let html = $('html');
        html.removeClass('no-js');
        if (!html.hasClass('js')) {
            html.addClass('js');
        }
    });

    window.ms2Wishlist = _this;
})(window, document, jQuery, ms2Wishlist);
