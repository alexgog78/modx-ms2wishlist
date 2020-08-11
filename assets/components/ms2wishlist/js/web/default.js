(function (window, document, $, ms2WishlistConfig) {
    'use strict';

    class ms2Wishlist {
        formSelector = '.ms2wishlist_form';
        activeFormClass = 'active';
        totalSelector = '.ms2wishlist_total';
        activeTotalClass = 'active';
        totalCountSelector = '.ms2wishlist_total_count';
        actionName;
        actionUrl;
        _form;

        constructor(config) {
            for (var index in config) {
                this[index] = config[index];
            }
        }
        initialize() {
            var _this = this;
            $(document).on('submit', this.formSelector, function (e) {
                e.preventDefault();
                _this._form = $(this);
                let formData = _this._form.serializeArray();
                let action = _this._form.find('[name=' + _this.actionName + ']').val();
                _this.request(action, formData);
            });
        }
        request = function(action, data) {
            data.push({
                name: this.actionName,
                value: action
            });
            var _this = this;
            $.ajax({
                url: this.actionUrl,
                type: 'POST',
                dataType: 'json',
                data: data,
                beforeSend: function () {
                    _this.callbacks.before();
                },
                success: function (response) {
                    switch (response.success) {
                        case true:
                            _this.callbacks.success.call(_this, response);
                            break;
                        default:
                            _this.callbacks.error.call(_this, response);
                            break;
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    console.error(xhr.responseJSON);
                }
            });
        }

        callbacks = {
            before: function () {

            },
            success: function (response) {
                switch (response.data.action) {
                    case 'add':
                        this._form.find('[name=' + this.actionName + ']').addClass(this.activeFormClass);
                        break;
                    case 'remove':
                        this._form.find('[name=' + this.actionName + ']').removeClass(this.activeFormClass);
                        break;
                }
                $(this.totalCountSelector).html(response.data.total);
                if (response.data.total > 0) {
                    $(this.totalSelector).addClass(this.activeTotalClass);
                }  else {
                    $(this.totalSelector).removeClass(this.activeTotalClass);
                }
                this.message.success(response.message);
            },
            error: function (response) {
                this.message.error(response.message);
            },
        }

        message = {
            success: function (message) {
                alert(message);
            },
            error: function (message) {
                alert(message);
            }
        }
    }
    window.ms2Wishlist = ms2Wishlist;
})(window, document, jQuery, ms2WishlistConfig);
