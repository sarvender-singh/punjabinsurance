<script>
$(document).ready(function () {

    // ── Flatpickr for DOB ────────────────────────────────────────────────────
    flatpickr('#DOB', {
        dateFormat: 'd/m/Y',
        maxDate: 'today',
        allowInput: true,
        disableMobile: true
    });
    // ── Insurance Type → Product Type dynamic options ────────────────────────
    var productOptions = {
        '0': [
            { v: '0',  l: '1 Year Term' },
            { v: '1',  l: '5 Year Term' },
            { v: '2',  l: '10 Year Term' },
            { v: '3',  l: '15 Year Term' },
            { v: '4',  l: '20 Year Term' },
            { v: '5',  l: '25 Year Term' },
            { v: '6',  l: '30 Year Term' },
            { v: '7',  l: '35 Year Term' },
            { v: '8',  l: '40 Year Term' },
            { v: '9',  l: 'Level Term to 65' },
            { v: '10', l: 'Level Term to 70' },
            { v: '11', l: 'Level Term to 75' },
            { v: '12', l: 'Special Term' },
            { v: '13', l: 'All Products' }
        ],
        '3': [
            { v: '0',  l: 'Life Pay' },
            { v: '1',  l: 'Pay to 65' },
            { v: '2',  l: '25 to Pay' },
            { v: '3',  l: '20 to Pay' },
            { v: '4',  l: '15 to Pay' },
            { v: '5',  l: 'Quick Pay' },
            { v: '6',  l: 'Adjustable Life Pay' },
            { v: '7',  l: 'Adjustable Pay to 65' },
            { v: '8',  l: 'Adjustable 10-20 Pay' },
            { v: '9',  l: 'Unique Whole Life' },
            { v: '10', l: 'All Products' }
        ],
        '6': [
            { v: '0',  l: '10 Year Term' },
            { v: '1',  l: '11-14 Year Term' },
            { v: '2',  l: '15 Year Term' },
            { v: '3',  l: '16-19 Year Term' },
            { v: '4',  l: '20 Year Term' },
            { v: '5',  l: '21-24 Year Term' },
            { v: '6',  l: '25 Year Term' },
            { v: '7',  l: '26-29 Year Term' },
            { v: '8',  l: '30 Year Term' },
            { v: '9',  l: '31-34 Year Term' },
            { v: '10', l: '35 Year Term' },
            { v: '11', l: '36-39 Year Term' },
            { v: '12', l: '40 Year Term' },
            { v: '13', l: 'All Products' }
        ]
    };

    function rebuildProductType(instype) {
        var $pi = $('#pi');
        var opts = productOptions[instype] || [];
        $pi.empty().append('<option value="">Please choose</option>');
        $.each(opts, function (i, o) {
            $pi.append($('<option></option>').val(o.v).text(o.l));
        });
        resetField($pi);
    }

    $('#instype').on('change', function () {
        rebuildProductType($.trim($(this).val()));
        validateInsType(true);
    });
    // ── Helpers ──────────────────────────────────────────────────────────────
    function showError($field, message) {
        $field.removeClass('is-valid').addClass('is-invalid');
        var $group = $field.closest('.input-group');
        $group.find('.error-msg').remove();
        $group.append('<span class="error-msg">' + message + '</span>');
    }

    function clearError($field) {
        $field.removeClass('is-invalid').addClass('is-valid');
        $field.closest('.input-group').find('.error-msg').remove();
    }

    function resetField($field) {
        $field.removeClass('is-invalid is-valid');
        $field.closest('.input-group').find('.error-msg').remove();
    }

    // ── Validators ───────────────────────────────────────────────────────────
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

    function isTodayOrPast(str) {
        var p   = str.split('/');
        var dt  = new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
        var t   = new Date(); t.setHours(0,0,0,0);
        return dt <= t;
    }

    // ── Per-field validators ─────────────────────────────────────────────────
    function validateInsType(show) {
        var $f = $('#instype'), v = $f.val();
        if (!v) { if(show) showError($f, 'Please select an insurance type.'); return false; }
        clearError($f); return true;
    }

    function validateProductType(show) {
        var $f = $('#pi'), v = $f.val();
        if (v === '' || v === null) { if(show) showError($f, 'Please select a product type.'); return false; }
        clearError($f); return true;
    }

    function validateFaceAmount(show) {
        var $f = $('#faceamount'), v = $f.val();
        if (!v) { if(show) showError($f, 'Please select a face amount.'); return false; }
        clearError($f); return true;
    }

    function validateSmoker(show) {
        var $f = $('#smoker'), v = $f.val();
        if (!v) { if(show) showError($f, 'Please indicate your smoking status.'); return false; }
        clearError($f); return true;
    }

    function validateGender(show) {
        var $f = $('#gender'), v = $f.val();
        if (!v) { if(show) showError($f, 'Please select your gender.'); return false; }
        clearError($f); return true;
    }

    function validateFirstName(show) {
        var $f = $('#firstname'), v = $f.val().trim();
        if (!v)           { if(show) showError($f, 'First name is required.'); return false; }
        if (v.length < 2) { if(show) showError($f, 'First name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if(show) showError($f, 'First name can only contain letters.'); return false; }
        clearError($f); return true;
    }

    function validateLastName(show) {
        var $f = $('#lastname'), v = $f.val().trim();
        if (!v)           { if(show) showError($f, 'Last name is required.'); return false; }
        if (v.length < 2) { if(show) showError($f, 'Last name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if(show) showError($f, 'Last name can only contain letters.'); return false; }
        clearError($f); return true;
    }

    function validateEmail(show) {
        var $f = $('#contact_email'), v = $f.val().trim();
        if (!v)               { if(show) showError($f, 'Email is required.'); return false; }
        if (!isValidEmail(v)) { if(show) showError($f, 'Please enter a valid email address.'); return false; }
        clearError($f); return true;
    }

    function validatePhone(show) {
    var $f = $('#sphone'), v = $f.val().trim();
    
    // Only accepts: 4165551234 or 416-555-1234
    var canadianPhone = /^\d{10}$|^\d{3}-\d{3}-\d{4}$/;
    
    if (!v)                     { if(show) showError($f, 'Phone number is required.'); return false; }
    if (!canadianPhone.test(v)) { if(show) showError($f, 'Please enter a valid phone number (e.g. 4165551234 or 416-555-1234).'); return false; }
    
    clearError($f); return true;
}

    function validateDOB(show) {
        var $f = $('#DOB'), v = $f.val().trim();
        if (!v)                { if(show) showError($f, 'Date of birth is required.'); return false; }
        if (!isValidDate(v))   { if(show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrPast(v)) { if(show) showError($f, 'Date of birth cannot be in the future.'); return false; }

        // Age must be between 18 and 85
        var p   = v.split('/');
        var dob = new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) age--;
        if (age < 18) { if(show) showError($f, 'Applicant must be at least 18 years old.'); return false; }
        if (age > 85) { if(show) showError($f, 'Applicant must be 85 years old or younger.'); return false; }

        clearError($f); return true;
    }

    function validateProvince(show) {
        var $f = $('#province'), v = $f.val();
        if (v === '' || v === null) { if(show) showError($f, 'Please select your province.'); return false; }
        clearError($f); return true;
    }

    // paymentmode has a default selected so no validation needed,
    // but included for completeness
    function validatePaymentMode(show) {
        var $f = $('#paymentmode'), v = $f.val();
        if (v === '' || v === null) { if(show) showError($f, 'Please select a payment mode.'); return false; }
        clearError($f); return true;
    }

    // ── Blur (real-time) events ──────────────────────────────────────────────
    $('#instype').on('blur change',      function(){ validateInsType(true); });
    $('#pi').on('blur change',           function(){ validateProductType(true); });
    $('#faceamount').on('blur change',   function(){ validateFaceAmount(true); });
    $('#smoker').on('blur change',       function(){ validateSmoker(true); });
    $('#gender').on('blur change',       function(){ validateGender(true); });
    $('#firstname').on('blur',           function(){ validateFirstName(true); });
    $('#lastname').on('blur',            function(){ validateLastName(true); });
    $('#contact_email').on('blur',       function(){ validateEmail(true); });
    $('#sphone').on('blur',              function(){ validatePhone(true); });
    $('#DOB').on('blur change',          function(){ validateDOB(true); });
    $('#province').on('blur change',     function(){ validateProvince(true); });

    // Clear error while typing (text inputs only)
    $('#firstname, #lastname, #contact_email, #sphone').on('input', function(){
        resetField($(this));
    });

    // ── Submit ───────────────────────────────────────────────────────────────
    $('#lifeinssubmit').on('click', function (e) {
        e.preventDefault();

        var valid =
            validateInsType(true) &
            validateProductType(true) &
            validateFaceAmount(true) &
            validateSmoker(true) &
            validateGender(true) &
            validateFirstName(true) &
            validateLastName(true) &
            validateEmail(true) &
            validatePhone(true) &
            validateDOB(true) &
            validateProvince(true) &
            validatePaymentMode(true);

        if (!valid) {
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

        // Show loading state then submit
        var $btn = $('#lifeinssubmit');
        $btn.prop('disabled', true);
        $btn.find('span').text('Submitting…');
        $btn.append('<span class="btn-spinner"></span>');

        // Submit the form
        $btn.closest('form').submit();
    });

});
</script>
