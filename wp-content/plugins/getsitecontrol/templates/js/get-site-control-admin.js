'use strict';

jQuery(document).ready(function() {

    jQuery('[data-form-validate]').submit(function() {
        jQuery(this).find('[data-message]').removeClass('show');

        var errors = {count: 0};
        var nameField  = jQuery(this).find('[type="text"]');
        var emailField  = jQuery(this).find('[type="email"]');
        var passwordField  = jQuery(this).find('[type="password"]');
        var urlField  = jQuery(this).find('[type="url"]');

        if (nameField.length) {
            if ( nameField.val().length == 0 ) {
                nameField.closest('.form-group').addClass('has-error').find('[data-message="required"]').addClass('show');
                errors.count++;
            } else if ( !validateName(nameField.val()) ) {
                nameField.closest('.form-group').addClass('has-error').find('[data-message="name"]').addClass('show');
                errors.count++;
            } else {
                nameField.closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        }

        if (emailField.length) {
            if ( emailField.val().length == 0 ) {
                emailField.closest('.form-group').addClass('has-error').find('[data-message="required"]').addClass('show');
                errors.count++;
            } else if ( !validateEmail(emailField.val()) ) {
                emailField.closest('.form-group').addClass('has-error').find('[data-message="email"]').addClass('show');
                errors.count++;
            } else {
                emailField.closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        }

        if (passwordField.length) {
            if ( passwordField.val().length == 0 ) {
                passwordField.closest('.form-group').addClass('has-error').find('[data-message="required"]').addClass('show');
                errors.count++;
            } else if ( passwordField.val().length < 4 ) {
                passwordField.closest('.form-group').addClass('has-error').find('[data-message="minlength"]').addClass('show');
                errors.count++;
            } else {
                passwordField.closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        }

        if (urlField.length) {
            if ( urlField.val().length == 0 ) {
                urlField.closest('.form-group').addClass('has-error').find('[data-message="required"]').addClass('show');
                errors.count++;
            } else if ( !validateURL(urlField.val()) ) {
                urlField.closest('.form-group').addClass('has-error').find('[data-message="url"]').addClass('show');
                errors.count++;
            } else {
                urlField.closest('.form-group').removeClass('has-error').addClass('has-success');
            }
        }

        return errors.count ? false : true;
    });


    /**
     * Name validator
     *
     * @param name
     * @returns {boolean}
     */
    function validateName(name) {
        var regex = /^[a-zA-Zа-яёА-ЯЁ0-9_\.\s\-]{3,}$/i;
        return regex.test(name);
    }


    /**
     * E-mail validator
     *
     * @param email
     * @returns {boolean}
     */
    function validateEmail(email) {
        var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return regex.test(email);
    }


    /**
     * URL validator
     *
     * @param url
     * @returns {boolean}
     */
    function validateURL(url) {
        var regex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/i;
        return regex.test(url);
    }

    var selectWidget = jQuery('.get-site-control .select-widget-form .select-widget');
    var manageWidgetLink = jQuery('.get-site-control .manage-widget-link');

    function setManageLink() {
        if (selectWidget.length && manageWidgetLink.length) {
            var manageLink = selectWidget.find('option:selected').data('manage');

            if (manageLink) {
                manageWidgetLink.attr('href', manageLink).removeClass('disabled');
            } else {
                manageWidgetLink.attr('href', 'javascript:void(0);').addClass('disabled');
            }
        }
    }

    setManageLink();
    selectWidget.change(function() {
        setManageLink();
        jQuery(this).closest('form').submit();
    });

    manageWidgetLink.click(function() {
        return !jQuery(this).hasClass('disabled');
    });


    var signOutForm = jQuery('.act-gsc-logout-form');
    if (signOutForm.length) {
        signOutForm.submit();
    }
});