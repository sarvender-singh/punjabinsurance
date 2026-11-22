<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_ci(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect & sanitise
    $amount    = clean_ci($_POST['amount']         ?? '');
    $health    = clean_ci($_POST['health']         ?? '');
    $smoker    = clean_ci($_POST['smoker']         ?? '');
    $gender    = clean_ci($_POST['gender']         ?? '');
    $tname     = clean_ci($_POST['tname']          ?? '');
    $email     = clean_ci($_POST['contact_email']  ?? '');
    $phone     = clean_ci($_POST['tphone']         ?? '');
    $birthyear = clean_ci($_POST['birthyear']      ?? '');

    $form_data = compact('amount', 'health', 'smoker', 'gender', 'tname', 'email', 'phone', 'birthyear');

    // ── Validate ──────────────────────────────────────────────────────────────

    // Amount
    if ($amount === '') {
        $errors['amount'] = 'Please select a coverage amount.';
    }

    // Health
    if ($health === '') {
        $errors['health'] = 'Please select your health status.';
    }

    // Smoker
    if ($smoker === '') {
        $errors['smoker'] = 'Please indicate your smoking status.';
    }

    // Gender
    if ($gender === '') {
        $errors['gender'] = 'Please select your gender.';
    }

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

    // Year of Birth — 4-digit year, between 1900 and current year
    $currentYear = (int) date('Y');
    if ($birthyear === '') {
        $errors['birthyear'] = 'Year of birth is required.';
    } elseif (!preg_match('/^\d{4}$/', $birthyear)) {
        $errors['birthyear'] = 'Please enter a valid 4-digit year (e.g. 1985).';
    } elseif ((int)$birthyear < 1900 || (int)$birthyear > $currentYear) {
        $errors['birthyear'] = 'Please enter a year between 1900 and ' . $currentYear . '.';
    }

    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {

$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Critical Illness Insurance - ' . $phone;

        $message = '
        <table>
        <tr><td><strong>Amount : </strong></td><td>' . $amount . '</td></tr>
        <tr><td><strong>Health : </strong></td><td>' . $health . '</td></tr>
        <tr><td><strong>Smoker : </strong></td><td>' . $smoker . '</td></tr>
        <tr><td><strong>Gender : </strong></td><td>' . $gender . '</td></tr>
        <tr><td><strong>Name : </strong></td><td>' . $tname . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
        <tr><td><strong>Year of Birth : </strong></td><td>' . $birthyear . '</td></tr>
        </table>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Bcc: ' . $bcc . "\r\n";
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
$title            = "Critical Illness Insurance in Canada | Toronto & Surrey, BC";
$meta_description = "Critical illness insurance in Toronto & Surrey across Canada covers cancer, heart attack & stroke. Tax-free lump sum payout. Compare Canada's top plans - free quote!";

$footer_cta_heading = "Get Your Free Critical Illness Insurance Quote";
$footer_cta_text    = "Contact us today to compare plans and secure your family's future-no obligation, just expert advice.";

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
                        <li class="active">Critical Illness Insurance</li>
                    </ol>
                </nav>

                <h1 class="hero-heading text-white">
                    Protect Your Finances from
                    <div class="text-accent-300">Life's Unexpected Health Challenges</div>
                </h1>

                <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                    A serious illness can strike anyone, anytime. Critical illness insurance from Punjab Insurance provides a lump-sum payment if you're diagnosed with a covered condition-so you can focus on recovery, not bills.
                </h2>
            </div>
        </div>
    </section>

    <!-- Product image Slider & Quote -->
    <section class="product-quote">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-6">
                <div class="col-span-12 lg:col-span-6">
                    <div class="product-slider">
                        <img src="images/product-main/critical-illness-insurance-main.webp" alt="Critical Illness Insurance">
                    </div>

                    <div class="product-main-info">
                        <h3 class="title">What Is Critical Illness Insurance?</h3>
                        <p class="desc">Critical illness insurance pays you a tax-free lump sum if you're diagnosed with a covered serious illness and survive the waiting period (usually 30 days). This benefit is yours to use however you need-whether it's covering medical bills, paying your mortgage, or supporting your family during recovery.</p>
                        <ul class="features">
                            <li><span class="text-primary-500">Coverage for major illnesses like</span> cancer, heart attack, and stroke</li>
                            <li><span class="text-primary-500">Up to 22 covered conditions with</span> leading Canadian insurers</li>
                            <li><span class="text-primary-500">Helps replace lost income</span> and cover out-of-pocket expenses</li>
                            <li><span class="text-primary-500">Flexible coverage amounts</span> to fit your needs and budget</li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="product-quote-form-wrap shadow-xl">
                        <div id="quoteFormPlaceholder"></div>

                        <div id="inlineFormContainer">
                            <h3 class="product-quote-form-heading">Critical Illness Insurance Quote</h3>

                            <?php if (!empty($errors['_mail'])) : ?>
                            <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;font-size:0.9rem;color:#111827;font-weight:500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <?= htmlspecialchars($errors['_mail']) ?>
                            </div>
                            <?php endif; ?>

                            <form class="product-quote-form" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                <div class="grid grid-cols-12 gap-4">

                                    <!-- Amount -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="amount">Amount <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 21 18" fill="none">
                                                        <path d="M2 18C1.45 18 0.979333 17.8043 0.588 17.413C0.196667 17.0217 0.000666667 16.5507 0 16V5C0 4.71667 0.0960001 4.47933 0.288 4.288C0.48 4.09667 0.717333 4.00067 1 4C1.28267 3.99933 1.52033 4.09533 1.713 4.288C1.90567 4.48067 2.00133 4.718 2 5V16H16C16.2833 16 16.521 16.096 16.713 16.288C16.905 16.48 17.0007 16.7173 17 17C16.9993 17.2827 16.9033 17.5203 16.712 17.713C16.5207 17.9057 16.2833 18.0013 16 18H2ZM6 14C5.45 14 4.97933 13.8043 4.588 13.413C4.19667 13.0217 4.00067 12.5507 4 12V1C4 0.716667 4.096 0.479333 4.288 0.288C4.48 0.0966668 4.71733 0.000666667 5 0H20C20.2833 0 20.521 0.0960001 20.713 0.288C20.905 0.48 21.0007 0.717333 21 1V12C21 12.55 20.8043 13.021 20.413 13.413C20.0217 13.805 19.5507 14.0007 19 14H6ZM6 12H19V2H6V12ZM9 9H11C11.2833 9 11.521 8.904 11.713 8.712C11.905 8.52 12.0007 8.28267 12 8V5C12 4.71667 11.904 4.47933 11.712 4.288C11.52 4.09667 11.2827 4.00067 11 4H9C8.71667 4 8.47933 4.096 8.288 4.288C8.09667 4.48 8.00067 4.71733 8 5V8C8 8.28333 8.096 8.521 8.288 8.713C8.48 8.905 8.71733 9.00067 9 9ZM14 9H16C16.2833 9 16.521 8.904 16.713 8.712C16.905 8.52 17.0007 8.28267 17 8C16.9993 7.71733 16.9033 7.48 16.712 7.288C16.5207 7.096 16.2833 7 16 7H14C13.7167 7 13.4793 7.096 13.288 7.288C13.0967 7.48 13.0007 7.71733 13 8C12.9993 8.28267 13.0953 8.52033 13.288 8.713C13.4807 8.90567 13.718 9.00133 14 9ZM14 6H16C16.2833 6 16.521 5.904 16.713 5.712C16.905 5.52 17.0007 5.28267 17 5C16.9993 4.71733 16.9033 4.48 16.712 4.288C16.5207 4.096 16.2833 4 16 4H14C13.7167 4 13.4793 4.096 13.288 4.288C13.0967 4.48 13.0007 4.71733 13 5C12.9993 5.28267 13.0953 5.52033 13.288 5.713C13.4807 5.90567 13.718 6.00133 14 6Z" fill="#111827"/>
                                                    </svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['amount']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['amount']) ? 'is-valid' : '') ?>"
                                                    name="amount" id="amount" required>
                                                    <option value="">Please choose</option>
                                                    <?php
                                                    $amounts = ['$50,000','$75,000','$100,000','$150,000','$200,000','$250,000','$300,000','$350,000','$400,000','$450,000','$500,000','$600,000','$700,000','$750,000','$800,000','$900,000','$1,000,000','$1,250,000','$1,500,000','$1,750,000','$2,000,000','$2,500,000','$3,000,000','$5,000,000'];
                                                    foreach ($amounts as $a) {
                                                        $sel = ($form_data['amount'] ?? '') === $a ? 'selected' : '';
                                                        echo '<option ' . $sel . '>' . $a . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['amount'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['amount']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Health -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="health">Health <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg fill="#111827" width="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M21,12.812V16A7,7,0,0,1,7,16V14.92A7.006,7.006,0,0,1,1,8V2A1,1,0,0,1,2,1H5A1,1,0,0,1,5,3H3V8A5,5,0,0,0,13,8V3H11a1,1,0,0,1,0-2h3a1,1,0,0,1,1,1V8a7.006,7.006,0,0,1-6,6.92V16a5,5,0,0,0,10,0V12.812a3,3,0,1,1,2,0Z"></path></g></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['health']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['health']) ? 'is-valid' : '') ?>"
                                                    name="health" id="health" required>
                                                    <option value="">Please choose</option>
                                                    <option <?= ($form_data['health'] ?? '') === 'Standard' ? 'selected' : '' ?>>Standard</option>
                                                    <option <?= ($form_data['health'] ?? '') === 'Preferred' ? 'selected' : '' ?>>Preferred</option>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['health'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['health']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Smoker -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="smoker">Are you a smoker? <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="24px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#111827" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#111827" d="M256 576v128h640V576H256zm-32-64h704a32 32 0 0 1 32 32v192a32 32 0 0 1-32 32H224a32 32 0 0 1-32-32V544a32 32 0 0 1 32-32z"></path><path fill="#111827" d="M704 576h64v128h-64zM256 64h64v320h-64zM128 192h64v192h-64zM64 512h64v256H64z"></path></g></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['smoker']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['smoker']) ? 'is-valid' : '') ?>"
                                                    name="smoker" id="smoker" required>
                                                    <option value="">Please choose</option>
                                                    <option <?= ($form_data['smoker'] ?? '') === 'Smoker' ? 'selected' : '' ?>>Smoker</option>
                                                    <option <?= ($form_data['smoker'] ?? '') === 'Non Smoker' ? 'selected' : '' ?>>Non Smoker</option>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['smoker'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['smoker']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="gender">Gender <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M18.5 8.5C18.5 12.0899 15.5899 15 12 15C8.41015 15 5.5 12.0899 5.5 8.5C5.5 4.91015 8.41015 2 12 2C15.5899 2 18.5 4.91015 18.5 8.5Z" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7.5 19H16.5" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 22L12 15" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['gender']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['gender']) ? 'is-valid' : '') ?>"
                                                    name="gender" id="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" <?= ($form_data['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                                    <option value="Female" <?= ($form_data['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['gender'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['gender']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

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

                                    <!-- Year of Birth -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="birthyear">Year of Birth <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none">
                                                        <path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/>
                                                        <path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/>
                                                    </svg>
                                                </span>
                                                <input
                                                    type="text"
                                                    class="input-field <?= isset($errors['birthyear']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['birthyear']) ? 'is-valid' : '') ?>"
                                                    name="birthyear" id="birthyear"
                                                    placeholder="Enter Year of Birth"
                                                    value="<?= htmlspecialchars($form_data['birthyear'] ?? '') ?>"
                                                    maxlength="4"
                                                    required>
                                            </div>
                                            <?php if (isset($errors['birthyear'])) : ?>
                                                <span class="error-msg"><?= htmlspecialchars($errors['birthyear']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-span-12">
                                        <button type="submit" id="ciinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                                            <span>Get Quote</span>
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
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Importance -->
    <section class="product-about bg-brand-linear pb-12 lg:pb-16">
        <div class="container mx-auto px-4">
            <div class="max-w-[1024px] lg:px-8">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title">Why Do You Need Critical Illness Coverage?</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <ul class="blogs-list-items font-semibold mt-4">
                        <li>1 in 3 Canadians will develop life-threatening cancer</li>
                        <li>1 in 2 heart attack victims are under 65</li>
                        <li>50,000 Canadians suffer a stroke each year-most are left with a disability</li>
                        <li>Provincial health plans and group benefits may not cover private nursing, home modifications, or out-of-country treatment</li>
                    </ul>
                    <p>Critical illness insurance helps fill these gaps and provides peace of mind for you and your family.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Benefits -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr">
                <div class="heading-copy">
                    <h2 class="title title-h4">Key Benefits</h2>
                </div>
                <hr>
            </div>
            <div class="section-content">
                <ul class="blogs-list-items">
                    <li>Lump-sum payment on diagnosis of a covered illness</li>
                    <li>Use funds for any purpose: medical care, debt, home care, travel, or daily living</li>
                    <li>Maintain your independence and lifestyle during recovery</li>
                    <li>Access to Best Doctors service with many policies</li>
                    <li>Optional return of premium rider (get your premiums back if no claim is made)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- What's Covered -->
    <section class="bg-primary-50 mt-16 lg:mt-20 py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr">
                <div class="heading-copy">
                    <h2 class="title title-h4">What's Covered?</h2>
                </div>
                <hr>
            </div>
            <div class="section-content">
                <ul class="blogs-list-items">
                    <li>Cancer, heart attack, stroke, MS, ALS, Alzheimer's, Parkinson's, blindness, deafness, loss of speech, coma, severe burns, and more (coverage varies by policy)</li>
                    <li>Some plans cover up to 22 illnesses-ask your advisor for a complete list</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Why Punjab Insurance -->
    <section class="bg-brand-linear py-12 lg:py-16">
        <div class="max-w-[1024px] mx-auto">
            <div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title title-h4">Why Choose Punjab Insurance?</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/shield-user-multicolor-48.svg" alt="shield-user-multicolor"></div>
                            <div class="pointer-card__copy"><h6 class="card-common_heading">Access to Canada's top insurers and competitive quotes</h6></div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/hand-mortgage-multicolor-48.svg" alt="hand-mortgage-multicolor"></div>
                            <div class="pointer-card__copy"><h6 class="card-common_heading">Expert advisors to help you compare options and choose the right coverage</h6></div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/slider-multicolor-48.svg" alt="Transparent advice"></div>
                            <div class="pointer-card__copy"><h6 class="card-common_heading">Transparent advice on the pros and cons of each option</h6></div>
                        </div>
                    </div>
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
                    <h2 class="title title-h4">Frequently Asked Questions about<br>Critical Illness Insurance</h2>
                </div>
                <hr>
            </div>
            <div class="section-content">
                <div class="faq-accordion pb-8">
                    <div class="faq-item">
                        <div class="faq-question">Who should consider critical illness insurance?</div>
                        <div class="faq-answer">Anyone who relies on their income, has dependents, or wants protection from the financial impact of a serious illness.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">How can I use the benefit?</div>
                        <div class="faq-answer">Use it for medical bills, debt, living expenses, travel, or any need during your recovery.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">Can I get my premiums back if I don't claim?</div>
                        <div class="faq-answer">Many policies offer a return of premium option for an extra charge.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">How do I get started?</div>
                        <div class="faq-answer"><a href="get-a-quote.php" class="text-primary-500 underline">Get a free quote</a> or <a href="contact.php" class="text-primary-500 underline">schedule a call</a> with a licensed Punjab Insurance advisor for personalized help.</div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="faq.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto">
                        <span>View all Faq's</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 14" fill="none" class="rotate-35"><g clip-path="url(#clip0_1032_10019)"><path d="M18.7495 7.49939H5.25052C4.83055 7.49939 4.50058 7.16942 4.50058 6.74945C4.50058 6.32949 4.83055 5.99951 5.25052 5.99951H18.7495C19.1694 5.99951 19.4994 6.32949 19.4994 6.74945C19.4994 7.16942 19.1694 7.49939 18.7495 7.49939Z" fill="white"/><path d="M14.9998 12.749C14.9014 12.7502 14.8039 12.7308 14.7135 12.6921C14.6231 12.6533 14.5418 12.5961 14.4748 12.524C14.1748 12.2241 14.1748 11.7591 14.4748 11.4591L19.1994 6.7345L14.4748 2.00987C14.1748 1.70989 14.1748 1.24493 14.4748 0.944953C14.7748 0.644977 15.2397 0.644977 15.5397 0.944953L20.7893 6.19454C21.0893 6.49452 21.0893 6.95948 20.7893 7.25946L15.5397 12.5091C15.3897 12.659 15.1947 12.734 15.0148 12.734L14.9998 12.749Z" fill="white"/></g><defs><clipPath id="clip0_1032_10019"><rect width="24" height="13.4989" fill="white"/></clipPath></defs></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/google-reviews-section.php'; ?>

    <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="fomo-quote">
                <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                Be financially prepared for life-changing health events. Get a lump-sum payout that helps cover treatment, recovery, and daily needs-so you can focus on healing, not costs.
            </div>
        </div>
    </section>

    <?php include 'includes/product-disclaimer.php'; ?>
</main>

<div id="quoteModal" class="modal-container">
    <div class="modal-box">
        <span id="modalClose" class="modal-close">&times;</span>
        <div id="modalFormContainer"></div>
    </div>
</div>
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

    function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function isValidPhone(v) { return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim()); }

    function validateAmount(show) {
        var $f = $('#amount'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select a coverage amount.'); return false; }
        clearError($f); return true;
    }
    function validateHealth(show) {
        var $f = $('#health'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select your health status.'); return false; }
        clearError($f); return true;
    }
    function validateSmoker(show) {
        var $f = $('#smoker'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please indicate your smoking status.'); return false; }
        clearError($f); return true;
    }
    function validateGender(show) {
        var $f = $('#gender'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select your gender.'); return false; }
        clearError($f); return true;
    }
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
    function validateBirthYear(show) {
        var $f = $('#birthyear'), v = $f.val().trim();
        var currentYear = new Date().getFullYear();
        if (!v)                          { if (show) showError($f, 'Year of birth is required.'); return false; }
        if (!/^\d{4}$/.test(v))          { if (show) showError($f, 'Please enter a valid 4-digit year (e.g. 1985).'); return false; }
        if (parseInt(v) < 1900 || parseInt(v) > currentYear) {
            if (show) showError($f, 'Please enter a year between 1900 and ' + currentYear + '.');
            return false;
        }
        clearError($f); return true;
    }

    $('#amount').on('blur change',       function () { validateAmount(true); });
    $('#health').on('blur change',       function () { validateHealth(true); });
    $('#smoker').on('blur change',       function () { validateSmoker(true); });
    $('#gender').on('blur change',       function () { validateGender(true); });
    $('#tname').on('blur',               function () { validateName(true); });
    $('#contact_email').on('blur',       function () { validateEmail(true); });
    $('#tphone').on('blur',              function () { validatePhone(true); });
    $('#birthyear').on('blur',           function () { validateBirthYear(true); });

    $('#tname, #contact_email, #tphone, #birthyear').on('input', function () { resetField($(this)); });

    $('#ciinssubmit').on('click', function (e) {
        e.preventDefault();

        var valid =
            validateAmount(true) &
            validateHealth(true) &
            validateSmoker(true) &
            validateGender(true) &
            validateName(true) &
            validateEmail(true) &
            validatePhone(true) &
            validateBirthYear(true);

        if (!valid) {
            var $first = $('.is-invalid').first();
            if ($first.length) {
                $('html, body').animate({ scrollTop: $first.closest('.input-group').offset().top - 120 }, 380);
                $first.focus();
            }
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true);
        $btn.find('span').text('Submitting…');
        $btn.append('<span class="btn-spinner"></span>');
        $btn.closest('form').submit();
    });
});
</script>