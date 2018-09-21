/*
 * bootstrap-confirm
 *
 *
 * Copyright (c) 2013 akun
 * Licensed under the MIT license.
 */

(function ($) {

  $.fn.bootstrapConfirm = function () {
    return this.each(function () {
      var options = $.bootstrapConfirm.options;
      var $confirmButton = $(options.modalId + ' [data-confirm="modal"]');
      var $modal = $(options.modalId);
      $(this).click(function() {
        $confirmButton.attr('href', $(this).attr('href'));
        $modal.modal('show');
        return false;
      });

      $confirmButton.click(function() {
        $[options.method]($(this).attr('href'), {}, options.success, 'json')
          .done(function() {})
          .fail(function() {})
          .always(function() {
            $modal.modal('hide');
          });
        return false;
      });
    });
  };

  $.bootstrapConfirm = function (options) {
    options = $.extend({}, $.bootstrapConfirm.options, options);
    return 'bootstrapConfirm.';
  };

  $.bootstrapConfirm.options = {
    modalId: '#confirm',
    method: 'post',
    success: function() {
      // do nothing
    }
  };

  $.expr[':'].bootstrapConfirm = function (elem) {
    return $(elem).text().indexOf('bootstrapConfirm') !== -1;
  };

}(jQuery));
