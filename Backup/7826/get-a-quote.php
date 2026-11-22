    <?php 
        $title = "Get a Quote - Punjab Insurance";
        $meta_description = "Request a personalized insurance quote from Punjab Insurance Inc. to find tailored coverage, compare premiums, and secure your family’s future with confidence.";
		include 'includes/header.php';
    ?>
	
	<!-- Main -->
	<main class="main">
		<!-- Hero -->
        <section class="bg-primary-50 py-12">
			<div class="hero-content">
				<div class="container mx-auto px-4">
					<div class="grid grid-cols-12 items-center gap-0 lg:gap-6">
						<div class="col-span-12 lg:col-span-5">
                            <nav class="breadcrumb mt-0" aria-label="Breadcrumb">
                                <ol>
                                    <li><a href="/">Home</a></li>
                                    <li class="active">Get a Quote</li>
                                </ol>
                            </nav>

                            <h1 class="hero-heading text-gray-900">
                                Get a <span class="text-primary-500">Free Quote</span>
                            </h1>

							<p class="hero-desc text-gray-700 mb-0">
							    Protect what matters most with personalized coverage made simple. Get a fast, no-obligation quote from trusted Canadian insurers - tailored to your needs and budget.
							</p>
						</div>
						<div class="col-span-12 lg:col-span-5 lg:col-start-8 hidden lg:inline-flex justify-end">
                            <img src="images/quote-hero-illustration.webp" alt="..">
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- Geta a Quote Form -->
        <section class="max-w-[1024px] mx-auto mt-16 lg:mt-20 mb-16 md:mb-0">
            <div class="container mx-auto px-4">
                <?php include 'includes/get-quote-form.php'; ?>
            </div>
        </section>
	</main>

    <?php include 'includes/footer.php'; ?>
	
	<style>
.input-field.is-invalid {
    border-color: red !important;
    background: #fff5f5;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
}
.input-field.is-valid {
    border-color: green !important;
    background: #f0fdf4;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.07);
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to   { opacity: 1; transform: translateY(0); }
}
.error-msg {
    color: red;
    font-size: 0.78rem;
    font-weight: 500;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
    animation: fadeIn 0.18s ease;
}
.error-msg::before {
    content: '';
    display: inline-block;
    width: 14px;
    height: 14px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23dc2626'%3E%3Cpath fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z' clip-rule='evenodd'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    flex-shrink: 0;
}
</style>

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
