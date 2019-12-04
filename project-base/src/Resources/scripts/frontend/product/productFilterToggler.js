(function ($) {

    Shopsys = window.Shopsys || {};
    Shopsys.productFilterToggler = Shopsys.productFilterToggler || {};

    Shopsys.productFilterToggler.init = function () {
        $('.js-filter-opener').click(function () {
            $(this).toggleClass('active');
            $('.js-product-filter').toggleClass('active');
        });

        Shopsys.productFilterToggler.hideHiddenByDefaultParameters();
        Shopsys.productFilterToggler.showHideParameters();
    };

    Shopsys.productFilterToggler.showHideParameters = function () {
        $('.js-product-filter-toggle-arrow').on('click', function () {
            Shopsys.productFilterToggler.showHideParameter($(this).closest('.js-product-filter-parameter'));
        });
    };

    Shopsys.productFilterToggler.hideHiddenByDefaultParameters = function () {
        $('.js-close-parameter').each(function () {
            var parameterValuesCheckedCount = $(this).find('input[type="checkbox"]:checked').length;

            if (parameterValuesCheckedCount === 0) {
                Shopsys.productFilterToggler.showHideParameter($(this));
            }
        });
    };

    Shopsys.productFilterToggler.showHideParameter = function ($parameterContainer) {
        var $productFilterParameterLabel = $parameterContainer.find('.js-product-filter-parameter-label');
        $productFilterParameterLabel.toggleClass('active');

        var parameterFilterFormId = $parameterContainer.data('parameter-filter-form-id');

        if ($productFilterParameterLabel.hasClass('active')) {
            $parameterContainer.find('#' + parameterFilterFormId).slideDown('fast');
        } else {
            $parameterContainer.find('#' + parameterFilterFormId).slideUp('fast');
        }
    };

    $(document).ready(function () {
        Shopsys.productFilterToggler.init();
    });
})(jQuery);
