<script>
$(document).ready(function () {

    // ─── Flatpickr date pickers ──────────────────────────────────────────────────
    var today = new Date();
    today.setHours(0, 0, 0, 0);

    /*flatpickr('#departeredate', {
        dateFormat: 'd/m/Y',
        minDate: 'today',
        allowInput: true,
        disableMobile: true
    });

    flatpickr('#dateofbirth1', {
        dateFormat: 'd/m/Y',
        maxDate: 'today',
        allowInput: true,
        disableMobile: true
    });

    flatpickr('#dateofbirth2', {
        dateFormat: 'd/m/Y',
        maxDate: 'today',
        allowInput: true,
        disableMobile: true
    });*/

    // ─── Helper: show error ──────────────────────────────────────────────────────
    function showError($field, message) {
        $field.removeClass('is-valid').addClass('is-invalid');
        var $group = $field.closest('.input-group');
        $group.find('.error-msg').remove();
        $group.append('<span class="error-msg">' + message + '</span>');
    }

    // ─── Helper: clear error / mark valid ───────────────────────────────────────
    function clearError($field) {
        $field.removeClass('is-invalid').addClass('is-valid');
        $field.closest('.input-group').find('.error-msg').remove();
    }

    // ─── Helper: reset field (no state) ─────────────────────────────────────────
    function resetField($field) {
        $field.removeClass('is-invalid is-valid');
        $field.closest('.input-group').find('.error-msg').remove();
    }

    // ─── Validators ─────────────────────────────────────────────────────────────
    function isValidEmail(v) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    }

    function isValidPhone(v) {
        return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim());
    }

    function isValidDate(str) {
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(str)) return false;
        var p = str.split('/');
        var d = parseInt(p[0], 10), m = parseInt(p[1], 10), y = parseInt(p[2], 10);
        if (m < 1 || m > 12 || d < 1 || d > 31 || y < 1900 || y > 2100) return false;
        var dt = new Date(y, m - 1, d);
        return dt.getFullYear() === y && dt.getMonth() === m - 1 && dt.getDate() === d;
    }

    function isTodayOrFuture(str) {
        var p = str.split('/');
        var dt = new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
        var t  = new Date(); t.setHours(0,0,0,0);
        return dt >= t;
    }

    function isTodayOrPast(str) {
        var p = str.split('/');
        var dt = new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
        var t  = new Date(); t.setHours(0,0,0,0);
        return dt <= t;
    }

    // ─── Per-field validators returning true = valid ─────────────────────────────
    function validateName(show) {
        var $f = $('#tname'), v = $f.val().trim();
        if (!v)          { if(show) showError($f, 'Name is required.'); return false; }
        if (v.length < 2){ if(show) showError($f, 'Name must be at least 2 characters.'); return false; }
        clearError($f); return true;
    }

    function validateEmail(show) {
        var $f = $('#contact_email'), v = $f.val().trim();
        if (!v)               { if(show) showError($f, 'Email is required.'); return false; }
        if (!isValidEmail(v)) { if(show) showError($f, 'Please enter a valid email address.'); return false; }
        clearError($f); return true;
    }


	function validatePhone(show) {
    var $f = $('#tphone'), v = $f.val().trim();
    
    // Only accepts: 4165551234 or 416-555-1234
    var canadianPhone = /^\d{10}$|^\d{3}-\d{3}-\d{4}$/;
    
    if (!v)                     { if(show) showError($f, 'Phone number is required.'); return false; }
    if (!canadianPhone.test(v)) { if(show) showError($f, 'Please enter a valid phone number (e.g. 4165551234 or 416-555-1234).'); return false; }
    
    clearError($f); return true;
}

    function validateStartDate(show) {
        var $f = $('#departeredate'), v = $f.val().trim();
        if (!v)                    { if(show) showError($f, 'Start date of coverage is required.'); return false; }
        if (!isValidDate(v))       { if(show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrFuture(v))   { if(show) showError($f, 'Start date must be today or a future date.'); return false; }
        clearError($f); return true;
    }

    function validateDestination(show) {
        var $f = $('#primary_destination'), v = $f.val();
        if (!v) { if(show) showError($f, 'Please select a primary destination.'); return false; }
        clearError($f); return true;
    }

    function validateDOB1(show) {
        var $f = $('#dateofbirth1'), v = $f.val().trim();
        if (!v)                  { if(show) showError($f, 'Date of birth is required.'); return false; }
        if (!isValidDate(v))     { if(show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrPast(v))   { if(show) showError($f, 'Date of birth cannot be in the future.'); return false; }
        clearError($f); return true;
    }

    function validateDOB2(show) {
        if (!$('.traveller-2').is(':visible')) return true;
        var $f = $('#dateofbirth2'), v = $f.val().trim();
        if (!v)                  { if(show) showError($f, 'Date of birth for traveller 2 is required.'); return false; }
        if (!isValidDate(v))     { if(show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrPast(v))   { if(show) showError($f, 'Date of birth cannot be in the future.'); return false; }
        clearError($f); return true;
    }

    // ─── Real-time blur validation ───────────────────────────────────────────────
    $('#tname').on('blur',               function(){ validateName(true); });
    $('#contact_email').on('blur',       function(){ validateEmail(true); });
    $('#tphone').on('blur',              function(){ validatePhone(true); });
    $('#departeredate').on('blur change',function(){ validateStartDate(true); });
    $('#primary_destination').on('blur change', function(){ validateDestination(true); });
    $('#dateofbirth1').on('blur change', function(){ validateDOB1(true); });
    $('#dateofbirth2').on('blur change', function(){ validateDOB2(true); });

    // Clear error on input (for text fields)
    $('#tname, #contact_email, #tphone').on('input', function(){
        resetField($(this));
    });

    // ─── Show/hide traveller 2 fields ───────────────────────────────────────────
    $('#ntravellers').on('change', function () {
        if ($(this).val() === '2') {
            $('.traveller-2').show();
            $('#dateofbirth2').attr('required', true);
        } else {
            $('.traveller-2').hide();
            $('#dateofbirth2').removeAttr('required');
            resetField($('#dateofbirth2'));
            resetField($('#medical_cond2'));
        }
    });

    // ─── Form submit ─────────────────────────────────────────────────────────────
    $('.product-quote-form').on('submit', function (e) {

        var valid =
            validateName(true) &
            validateEmail(true) &
            validatePhone(true) &
            validateStartDate(true) &
            validateDestination(true) &
            validateDOB1(true) &
            validateDOB2(true);

        if (!valid) {
            e.preventDefault();

            // Scroll to first error
            var $first = $('.is-invalid').first();
            if ($first.length) {
                $('html, body').animate({
                    scrollTop: $first.closest('.input-group').offset().top - 120
                }, 380);
                $first.focus();
            }
            return;
        }

        // Show loading state
        var $btn = $('#submitBtn');
        $btn.prop('disabled', true);
        $('#btnText').text('Submitting…');
        $btn.append('<span class="btn-spinner"></span>');
    });

});
</script>