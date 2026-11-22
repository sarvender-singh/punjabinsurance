<?php 
	 include 'includes/emailconfig.php'; 
 
// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];
 
// ── Helper ────────────────────────────────────────────────────────────────────
function clean(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}
 
// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    // Collect & sanitise
    $tname     = clean($_POST['tname']         ?? '');
    $email     = clean($_POST['contact_email'] ?? '');
    $phone     = clean($_POST['tphone']        ?? '');
    $dob       = clean($_POST['DOB']           ?? '');
    $extrainfo = clean($_POST['extrainfo']     ?? '');
 
    $form_data = compact('tname', 'email', 'phone', 'dob', 'extrainfo');
 
    // ── Validate ──────────────────────────────────────────────────────────────
 
    // Name
    if ($tname === '') {
        $errors['tname'] = 'Name is required.';
    } elseif (mb_strlen($tname) < 2) {
        $errors['tname'] = 'Name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $tname)) {
        $errors['tname'] = 'Name can only contain letters.';
    }
 
    // Email
    if ($email === '') {
        $errors['contact_email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['contact_email'] = 'Please enter a valid email address.';
    }
 
    // Phone
    if ($phone === '') {
        $errors['tphone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{7,15}$/', $phone)) {
        $errors['tphone'] = 'Please enter a valid phone number (7–15 digits).';
    }
 
    // Date of Birth
    if ($dob === '') {
        $errors['DOB'] = 'Date of birth is required.';
    } elseif (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dob)) {
        $errors['DOB'] = 'Please enter a valid date (DD/MM/YYYY).';
    } else {
        $dobParts = explode('/', $dob);
        $d = (int) $dobParts[0];
        $m = (int) $dobParts[1];
        $y = (int) $dobParts[2];
        if (!checkdate($m, $d, $y)) {
            $errors['DOB'] = 'Please enter a valid calendar date (DD/MM/YYYY).';
        } else {
            $dobDate = new DateTime($y . '-' . sprintf('%02d', $m) . '-' . sprintf('%02d', $d));
            $today   = new DateTime('today');
            if ($dobDate > $today) {
                $errors['DOB'] = 'Date of birth cannot be in the future.';
            }
        }
    }
 
    // Extra Information
    if ($extrainfo === '') {
        $errors['extrainfo'] = 'Please provide extra information for an accurate quote.';
    } elseif (mb_strlen($extrainfo) < 5) {
        $errors['extrainfo'] = 'Please enter at least 5 characters.';
    }
 
    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {
 $digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Term Life Insurance - ' . $phone;
 
        $message = '
        <table>
        <tr><td><strong>Name : </strong></td><td>' . $tname . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
        <tr><td><strong>Date of Birth : </strong></td><td>' . $dob . '</td></tr>
        <tr><td><strong>Extra Information : </strong></td><td>' . nl2br($extrainfo) . '</td></tr>
        </table>';
 
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Bcc: ' . $bcc . '' . "\r\n";
        $headers .= 'From: ' . $from_name . ' <' . $noreplyemail . '>' . "\r\nReply-to: " . $email;
 
        if (mail($to_email, $subject, $message, $headers, '-f ' . $noreplyemail)) {
            header('Location: thankyou.php');
            exit;
        } else {
            $errors['_mail'] = 'Sorry, there was a problem sending your enquiry. Please try again or call us directly.';
        }
    }
}
// ── Page meta ─────────────────────────────────────────────────────────────────

        $title = "Term Life Insurance in Canada | Punjab Insurance Inc.";
        $meta_description = "Best term life insurance canada plans with flexible coverage & budget-friendly premiums. Protect your loved ones with reliable, future-ready financial security.";

        // Footer CTA overrides
        $footer_cta_heading = "Ready to Protect Your Family?";
        $footer_cta_text = "Contact us today for a free, no-obligation quote and expert guidance. Punjab Insurance makes it easy to compare plans and secure your family's future.";

        include 'includes/header.php';
    ?>

  


	<!-- Main -->
	<main class="main">
		<!-- Hero -->
		<section class="hero-with-bg-image hero-overlay py-12 lg:pb-32 text-left lg:text-center product-hero-bg">
			<div class="hero-content max-w-[1024px] mx-auto">
				<div class="container mx-auto px-4">
                    <nav class="breadcrumb light mt-0 flex justify-start lg:justify-center" aria-label="Breadcrumb">
                        <ol>
                            <li><a href="/">Home</a></li>
                            <li class="active">Term Life Insurance</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Flexible, Affordable
                        <div class="text-accent-300">Protection for Every Stage of Life</div>
                    </h1>

                    <h2 class="hero-subheading text-white lg:mb-6">
                        Get peace of mind with term life insurance-affordable, customizable, and designed to protect your loved ones when it matters most.
                    </h2>

					<p class="hero-desc text-white mb-0 lg:mb-9">
					    Punjab Insurance has been helping Canadian families with term life insurance for over 25 years. We compare multiple Canadian insurers to find coverage that fits your budget and needs.
					</p>
				</div>
			</div>
		</section>

        <!-- Product image Slider & Quote -->
		<section class="product-quote">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-6">
					<div class="col-span-12 lg:col-span-6">
                        <div class="product-slider">
                            <img src="images/product-main/sikh-family-walking-on-lakeside-beach.webp" alt="Sikh family walking on lakeside beach">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">What Is Term Life Insurance?</h3>
                            <p class="desc">Term life insurance provides coverage for a fixed period-usually 10, 20, or 30 years. If the policyholder passes away during the term, their beneficiaries receive a generally tax-free lump sum (under current Canadian tax rules). If the policy expires before a claim, coverage ends, though many plans offer renewal or conversion to permanent insurance.</p>
                            <ul class="features">
                                <li><span class="text-primary-500">Simple, transparent</span> Coverage</li>
                                <li><span class="text-primary-500">Low premiums</span> for high protection</li>
                                <li>Ideal for <span class="text-primary-500">families, mortgages, and income</span> replacement</li>
                            </ul>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="product-quote-form-wrap shadow-xl">
                            <div id="quoteFormPlaceholder"></div>

                            <div id="inlineFormContainer">
							    <h3 class="product-quote-form-heading">Term Life Insurance</h3>
                                <?php if (!empty($errors['_mail'])) : ?>
                            <!-- ── MAIL ERROR BANNER ────────────────────── -->
                            <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;font-size:0.9rem;color:#111827;font-weight:500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <?= htmlspecialchars($errors['_mail']) ?>
                            </div>
                            <?php endif; ?>

                            <!-- ── FORM ────────────────────────────────── -->
                            <form class="product-quote-form" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                <div class="grid grid-cols-12 gap-4">

                                    <!-- Name -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="tname">Name <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none">
                                                        <path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/>
                                                    </svg>
                                                </span>
                                                <input
                                                    type="text"
                                                    class="input-field <?= isset($errors['tname']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['tname']) ? 'is-valid' : '') ?>"
                                                    name="tname" id="tname"
                                                    placeholder="Enter Name"
                                                    value="<?= htmlspecialchars($form_data['tname'] ?? '') ?>"
                                                    required>
                                            </div>
                                            <?php if (isset($errors['tname'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['tname']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="contact_email">Email <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 16" fill="none">
                                                        <path d="M2 16C1.45 16 0.979333 15.8043 0.588 15.413C0.196667 15.0217 0.000666667 14.5507 0 14V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196666 1.45067 0.000666667 2 0H18C18.55 0 19.021 0.196 19.413 0.588C19.805 0.98 20.0007 1.45067 20 2V14C20 14.55 19.8043 15.021 19.413 15.413C19.0217 15.805 18.5507 16.0007 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V14V4Z" fill="#111827"/>
                                                    </svg>
                                                </span>
                                                <input
                                                    type="email"
                                                    class="input-field <?= isset($errors['contact_email']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['contact_email']) ? 'is-valid' : '') ?>"
                                                    name="contact_email" id="contact_email"
                                                    placeholder="Enter Email Id"
                                                    value="<?= htmlspecialchars($form_data['email'] ?? '') ?>"
                                                    required>
                                            </div>
                                            <?php if (isset($errors['contact_email'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['contact_email']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="tphone">Phone Number <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 18" fill="none">
                                                        <path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 5.15833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="#111827"/>
                                                    </svg>
                                                </span>
                                                <input
                                                    type="tel"
                                                    class="input-field <?= isset($errors['tphone']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['tphone']) ? 'is-valid' : '') ?>"
                                                    name="tphone" id="tphone"
                                                    placeholder="Enter Phone Number"
                                                    value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>"
                                                    required>
                                            </div>
                                            <?php if (isset($errors['tphone'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['tphone']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="DOB">Date of Birth <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none">
                                                        <path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/>
                                                        <path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/>
                                                        <path d="M13.5 12.75C13.5 12.9489 13.421 13.1397 13.2803 13.2803C13.1397 13.421 12.9489 13.5 12.75 13.5C12.5511 13.5 12.3603 13.421 12.2197 13.2803C12.079 13.1397 12 12.9489 12 12.75C12 12.5511 12.079 12.3603 12.2197 12.2197C12.3603 12.079 12.5511 12 12.75 12C12.9489 12 13.1397 12.079 13.2803 12.2197C13.421 12.3603 13.5 12.5511 13.5 12.75ZM13.5 9.75C13.5 9.94891 13.421 10.1397 13.2803 10.2803C13.1397 10.421 12.9489 10.5 12.75 10.5C12.5511 10.5 12.3603 10.421 12.2197 10.2803C12.079 10.1397 12 9.94891 12 9.75C12 9.55109 12.079 9.36032 12.2197 9.21967C12.3603 9.07902 12.5511 9 12.75 9C12.9489 9 13.1397 9.07902 13.2803 9.21967C13.421 9.36032 13.5 9.55109 13.5 9.75ZM9.75 12.75C9.75 12.9489 9.67098 13.1397 9.53033 13.2803C9.38968 13.421 9.19891 13.5 9 13.5C8.80109 13.5 8.61032 13.421 8.46967 13.2803C8.32902 13.1397 8.25 12.9489 8.25 12.75C8.25 12.5511 8.32902 12.3603 8.46967 12.2197C8.61032 12.079 8.80109 12 9 12C9.19891 12 9.38968 12.079 9.53033 12.2197C9.67098 12.3603 9.75 12.5511 9.75 12.75ZM9.75 9.75C9.75 9.94891 9.67098 10.1397 9.53033 10.2803C9.38968 10.421 9.19891 10.5 9 10.5C8.80109 10.5 8.61032 10.421 8.46967 10.2803C8.32902 10.1397 8.25 9.94891 8.25 9.75C8.25 9.55109 8.32902 9.36032 8.46967 9.21967C8.61032 9.07902 8.80109 9 9 9C9.19891 9 9.38968 9.07902 9.53033 9.21967C9.67098 9.36032 9.75 9.55109 9.75 9.75ZM6 12.75C6 12.9489 5.92098 13.1397 5.78033 13.2803C5.63968 13.421 5.44891 13.5 5.25 13.5C5.05109 13.5 4.86032 13.421 4.71967 13.2803C4.57902 13.1397 4.5 12.9489 4.5 12.75C4.5 12.5511 4.57902 12.3603 4.71967 12.2197C4.86032 12.079 5.05109 12 5.25 12C5.44891 12 5.63968 12.079 5.78033 12.2197C5.92098 12.3603 6 12.5511 6 12.75ZM6 9.75C6 9.94891 5.92098 10.1397 5.78033 10.2803C5.63968 10.421 5.44891 10.5 5.25 10.5C5.05109 10.5 4.86032 10.421 4.71967 10.2803C4.57902 10.1397 4.5 9.94891 4.5 9.75C4.5 9.55109 4.57902 9.36032 4.71967 9.21967C4.86032 9.07902 5.05109 9 5.25 9C5.44891 9 5.63968 9.07902 5.78033 9.21967C5.92098 9.36032 6 9.55109 6 9.75Z" fill="#374151"/>
                                                    </svg>
                                                </span>
                                                <input
                                                    type="text"
                                                    class="input-field <?= isset($errors['DOB']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['DOB']) ? 'is-valid' : '') ?>"
                                                    name="DOB" id="DOB"
                                                    placeholder="DD/MM/YYYY"
                                                    value="<?= htmlspecialchars($form_data['dob'] ?? '') ?>"
                                                    required>
                                            </div>
                                            <?php if (isset($errors['DOB'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['DOB']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Extra Information -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="extrainfo">Extra Information for Correct Insurance Quote <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon textarea-icon">
                                                    <svg height="16px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#000000">
                                                        <g><path style="fill:#111827;" d="M396.138,85.295c-13.172-25.037-33.795-45.898-59.342-61.03C311.26,9.2,280.435,0.001,246.98,0.001 c-41.238-0.102-75.5,10.642-101.359,25.521c-25.962,14.826-37.156,32.088-37.156,32.088c-4.363,3.786-6.824,9.294-6.721,15.056 c0.118,5.77,2.775,11.186,7.273,14.784l35.933,28.78c7.324,5.864,17.806,5.644,24.875-0.518c0,0,4.414-7.978,18.247-15.88 c13.91-7.85,31.945-14.173,58.908-14.258c23.517-0.051,44.022,8.725,58.016,20.717c6.952,5.941,12.145,12.594,15.328,18.68 c3.208,6.136,4.379,11.5,4.363,15.574c-0.068,13.766-2.742,22.77-6.603,30.442c-2.945,5.729-6.789,10.813-11.738,15.744 c-7.384,7.384-17.398,14.207-28.634,20.479c-11.245,6.348-23.365,11.932-35.612,18.68c-13.978,7.74-28.77,18.858-39.701,35.544 c-5.449,8.249-9.71,17.686-12.416,27.641c-2.742,9.964-3.98,20.412-3.98,31.071c0,11.372,0,20.708,0,20.708 c0,10.719,8.69,19.41,19.41,19.41h46.762c10.719,0,19.41-8.691,19.41-19.41c0,0,0-9.336,0-20.708c0-4.107,0.467-6.755,0.917-8.436 c0.773-2.512,1.206-3.14,2.47-4.668c1.29-1.452,3.895-3.674,8.698-6.331c7.019-3.946,18.298-9.276,31.07-16.176 c19.121-10.456,42.367-24.646,61.972-48.062c9.752-11.686,18.374-25.758,24.323-41.968c6.001-16.21,9.242-34.431,9.226-53.96 C410.243,120.761,404.879,101.971,396.138,85.295z"/><path style="fill:#111827;" d="M228.809,406.44c-29.152,0-52.788,23.644-52.788,52.788c0,29.136,23.637,52.772,52.788,52.772 c29.136,0,52.763-23.636,52.763-52.772C281.572,430.084,257.945,406.44,228.809,406.44z"/></g>
                                                    </svg>
                                                </span>
                                                <textarea
                                                    class="input-field <?= isset($errors['extrainfo']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['extrainfo']) ? 'is-valid' : '') ?>"
                                                    name="extrainfo" id="extrainfo"
                                                    placeholder="Please Enter Extra Info if there is any. List of Medicines"
                                                    required><?= htmlspecialchars($form_data['extrainfo'] ?? '') ?></textarea>
                                            </div>
                                            <?php if (isset($errors['extrainfo'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['extrainfo']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-span-12">
                                        <button type="submit" id="lifeinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                                            <span>Submit</span>
                                            <img src="images/icons/send-plane.svg" width="14" alt="send-plane">
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <?php if (!empty($errors) && !isset($errors['_mail'])) : ?>
                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var el = document.querySelector('.product-quote-form-wrap');
                                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            });
                            </script>
                            <?php endif; ?></div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- Product Types -->
		<section class="product-about bg-brand-linear pb-12 lg:pb-16">
			<div class="container max-w-[1024px] mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title">Types of Term Life Insurance</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-check-duotone-48.svg" alt="Icon representing Standard Term life insurance with fixed coverage period">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Standard Term</h6>
                                <p class="pointer-card__desc">Fixed coverage for 10, 20, or 30 years</p>
                            </div>
                        </div>
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-refresh-duotone-48.svg" alt="Icon representing Annual Renewable Term life insurance with yearly renewable coverage">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Annual Renewable Term</h6>
                                <p class="pointer-card__desc">Year-by-year protection, renewable each year</p>
                            </div>
                        </div>
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-decrease-duotone-48.svg" alt="Icon representing Decreasing Term life insurance where coverage reduces over time">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Decreasing Term</h6>
                                <p class="pointer-card__desc">Coverage amount decreases over time (often used for mortgages)</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- Benefits -->
		<section class="max-w-[1024px] mx-auto mt-16 lg:mt-20">
			<div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title">Why Choose Term Life Insurance?</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/piggy-bank-multicolor-48.svg" alt="Icon representing affordability with lower premiums for term life insurance">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Affordability</h6>
                                <p class="pointer-card__desc">Lower premiums compared to permanent insurance</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/choose-options-multicolor-48.svg" alt="Icon representing flexibility to choose term and coverage amount for term life insurance">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Flexibility</h6>
                                <p class="pointer-card__desc">Choose the term and coverage amount that fits your needs.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/family-multicolor-48.svg" alt="Icon representing family protection to replace lost income and cover debts">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Family Protection</h6>
                                <p class="pointer-card__desc">Replace lost income, cover debts, and safeguard your family's.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/mortgage-loan-multicolor-48.svg" alt="Icon representing mortgage and loan coverage aligned with insurance term">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Mortgage & Loan Coverage</h6>
                                <p class="pointer-card__desc">Match your coverage term to your mortgage or other major debts.</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- How Does it Work -->
		<section class="bg-primary-50 mt-16 lg:mt-20 py-12 lg:py-16">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">How Does Term Life Insurance Work?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        You pay regular premiums for the term you choose. If you pass away during this period, your beneficiaries receive the full benefit. There is no cash value-term life is designed for straightforward, cost-effective protection.
                    </div>
                </div>
            </div>
		</section>

        <!-- How Much Cost -->
        <section class="mt-16 lg:mt-20">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">How Much Does Term Life Insurance Cost?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        Premiums vary by age, health, coverage amount, and term. Get a personalized quote from a Punjab Insurance advisor for accurate pricing.
                    </div>
                </div>
            </div>
		</section>

        <!-- What Does -->
        <section class="mt-16 lg:mt-20">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">What Does Term Life Insurance Cover?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        <ul class="blogs-list-items mt-4">
                            <li>Provides a death benefit for most causes of death, subject to policy terms, conditions, and exclusions</li>
                            <li>Financial support for dependents</li>
                            <li>Mortgage payoff, education costs, daily living expenses</li>
                            <li>Optional riders: accidental death, disability, critical illness</li>
                        </ul>
                    </div>
                </div>
            </div>
		</section>

        <!-- FAQ -->
        <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h4 class="subheading">FREQUENTLY ASKED QUESTIONS</h4>
                        <h2 class="title title-h4">Frequently Asked Questions about<br>Term Life Insurance</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="faq-accordion pb-8">
                        <div class="faq-item">
                            <div class="faq-question">How much coverage do I need?</div>
                            <div class="faq-answer">
                                Consider your family's living expenses, debts, future goals, and income replacement needs. Our advisors can help you calculate the right amount.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Does term life insurance cover accidental death?</div>
                            <div class="faq-answer">
                                Yes, the death benefit is paid for most causes, including accidents. Some plans offer extra accidental death riders for additional protection.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Does term life insurance cover disability?</div>
                            <div class="faq-answer">
                                Standard term life does not, but you can add riders for disability or critical illness coverage.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Can I renew or convert my policy?</div>
                            <div class="faq-answer">
                                Many term policies allow you to renew at the end of the term or convert to permanent insurance without a medical exam.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">What happens if my policy expires?</div>
                            <div class="faq-answer">
                                Coverage ends, but you can often renew or convert. It's wise to review your needs before your term ends.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">How are premiums calculated?</div>
                            <div class="faq-answer">
                                Age, health, coverage amount, term length, gender, and smoking status all affect your rates. Annual payment is usually the most cost-effective.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">How do I get started?</div>
                            <div class="faq-answer">
                                <a href="get-a-quote.php" class="text-primary-500 underline">Get a free quote</a> or <a href="contact.php" class="text-primary-500 underline">schedule a call</a> with a licensed Punjab Insurance advisor for personalized help.
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="faq.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto">
                            <span>View all Faq's</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 14" fill="none" class="rotate-35">
                                <g clip-path="url(#clip0_1032_10019)">
                                    <path d="M18.7495 7.49939H5.25052C4.83055 7.49939 4.50058 7.16942 4.50058 6.74945C4.50058 6.32949 4.83055 5.99951 5.25052 5.99951H18.7495C19.1694 5.99951 19.4994 6.32949 19.4994 6.74945C19.4994 7.16942 19.1694 7.49939 18.7495 7.49939Z" fill="white"/>
                                    <path d="M14.9998 12.749C14.9014 12.7502 14.8039 12.7308 14.7135 12.6921C14.6231 12.6533 14.5418 12.5961 14.4748 12.524C14.1748 12.2241 14.1748 11.7591 14.4748 11.4591L19.1994 6.7345L14.4748 2.00987C14.1748 1.70989 14.1748 1.24493 14.4748 0.944953C14.7748 0.644977 15.2397 0.644977 15.5397 0.944953L20.7893 6.19454C21.0893 6.49452 21.0893 6.95948 20.7893 7.25946L15.5397 12.5091C15.3897 12.659 15.1947 12.734 15.0148 12.734L14.9998 12.749Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1032_10019">
                                        <rect width="24" height="13.4989" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

		<?php include 'includes/google-reviews-section.php'; ?>

        <!-- Fomo Quote -->
        <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="fomo-quote">
                    <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                    Protect your family's future with affordable term life coverage. Get high-value protection for a defined period, ensuring your loved ones stay financially secure during life's most important years. Smart choices today create stability for tomorrow.
                </div>
            </div>
        </section>

        <?php include 'includes/product-disclaimer.php'; ?>
	</main>

    <!-- Get a Quote Modal -->
    <div id="quoteModal" class="modal-container">
        <div class="modal-box">
            <span id="modalClose" class="modal-close">&times;</span>
            <div id="modalFormContainer"></div>
        </div>
    </div>

    <!-- Floating Get a Quote Button -->
    <button id="quote-float-btn" class="flex lg:hidden">Get a Quote</button>

    <?php include 'includes/footer.php'; ?>
	
	
	
	<style>
.input-field.is-invalid { border-color: red !important; background: #fff5f5; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }
.input-field.is-valid   { border-color: green !important; background: #f0fdf4; box-shadow: 0 0 0 3px rgba(22,163,74,0.07); }
.error-msg { color: red; font-size: 0.78rem; font-weight: 500; margin-top: 4px; display: flex; align-items: center; gap: 4px; animation: fadeIn 0.18s ease; }
.error-msg::before { content: ''; display: inline-block; width: 14px; height: 14px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23dc2626'%3E%3Cpath fill-rule='evenodd' d='M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z' clip-rule='evenodd'/%3E%3C/svg%3E"); background-size: contain; background-repeat: no-repeat; flex-shrink: 0; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
$(document).ready(function () {

    // ── Flatpickr for DOB ─────────────────────────────────────────────────────
    flatpickr('#DOB', {
        dateFormat: 'd/m/Y',
        maxDate: 'today',
        allowInput: true,
        disableMobile: true
    });

    // ── Helpers ───────────────────────────────────────────────────────────────
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

    // ── Validators ────────────────────────────────────────────────────────────
    function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function isValidPhone(v) { return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim()); }

    function isValidDate(str) {
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(str)) return false;
        var p = str.split('/');
        var d = parseInt(p[0],10), m = parseInt(p[1],10), y = parseInt(p[2],10);
        if (m < 1 || m > 12 || d < 1 || d > 31 || y < 1900 || y > 2100) return false;
        var dt = new Date(y, m - 1, d);
        return dt.getFullYear() === y && dt.getMonth() === m - 1 && dt.getDate() === d;
    }

    function isTodayOrPast(str) {
        var p = str.split('/');
        var dt = new Date(parseInt(p[2],10), parseInt(p[1],10) - 1, parseInt(p[0],10));
        var t = new Date(); t.setHours(0,0,0,0);
        return dt <= t;
    }

    // ── Per-field validators ──────────────────────────────────────────────────
    function validateName(show) {
        var $f = $('#tname'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Name is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if (show) showError($f, 'Name can only contain letters.'); return false; }
        clearError($f); return true;
    }

    function validateEmail(show) {
        var $f = $('#contact_email'), v = $f.val().trim();
        if (!v)               { if (show) showError($f, 'Email is required.'); return false; }
        if (!isValidEmail(v)) { if (show) showError($f, 'Please enter a valid email address.'); return false; }
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

    function validateDOB(show) {
        var $f = $('#DOB'), v = $f.val().trim();
        if (!v)                { if (show) showError($f, 'Date of birth is required.'); return false; }
        if (!isValidDate(v))   { if (show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrPast(v)) { if (show) showError($f, 'Date of birth cannot be in the future.'); return false; }
        clearError($f); return true;
    }

    function validateExtraInfo(show) {
        var $f = $('#extrainfo'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Please provide extra information for an accurate quote.'); return false; }
        if (v.length < 5) { if (show) showError($f, 'Please enter at least 5 characters.'); return false; }
        clearError($f); return true;
    }

    // ── Blur / real-time events ───────────────────────────────────────────────
    $('#tname').on('blur',         function () { validateName(true); });
    $('#contact_email').on('blur', function () { validateEmail(true); });
    $('#tphone').on('blur',        function () { validatePhone(true); });
    $('#DOB').on('blur change',    function () { validateDOB(true); });
    $('#extrainfo').on('blur',     function () { validateExtraInfo(true); });

    $('#tname, #contact_email, #tphone, #extrainfo').on('input', function () {
        resetField($(this));
    });

    // ── Submit ────────────────────────────────────────────────────────────────
    $('#lifeinssubmit').on('click', function (e) {
        e.preventDefault();
 
        var valid =
            validateName(true) &
            validateEmail(true) &
            validatePhone(true) &
            validateDOB(true) &
            validateExtraInfo(true);
 
        if (!valid) {
            var $first = $('.is-invalid').first();
            if ($first.length) {
                $('html, body').animate({ scrollTop: $first.closest('.input-group').offset().top - 120 }, 380);
                $first.focus();
            }
            return;
        }
 
        // All good — show loading state then explicitly submit the form
        var $btn = $(this);
        $btn.prop('disabled', true);
        $btn.find('span').text('Submitting…');
        $btn.append('<span class="btn-spinner"></span>');
 
        $btn.closest('form').submit();
    });

});
</script>