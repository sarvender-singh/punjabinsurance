<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_rp(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname      = clean_rp($_POST['firstname']       ?? '');
    $lastname       = clean_rp($_POST['last_name']        ?? '');
    $dob            = clean_rp($_POST['DOB']              ?? '');
    $monthlyincome  = clean_rp($_POST['monthlyincome']    ?? '');
    $currentnetworth= clean_rp($_POST['currentnetworth']  ?? '');
    $email          = clean_rp($_POST['contact_email']    ?? '');
    $phone          = clean_rp($_POST['sphone']           ?? '');

    $form_data = compact('firstname', 'lastname', 'dob', 'monthlyincome', 'currentnetworth', 'email', 'phone');

    // First Name
    if ($firstname === '') {
        $errors['firstname'] = 'First name is required.';
    } elseif (mb_strlen($firstname) < 2) {
        $errors['firstname'] = 'First name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $firstname)) {
        $errors['firstname'] = 'First name can only contain letters.';
    }

    // Last Name
    if ($lastname === '') {
        $errors['last_name'] = 'Last name is required.';
    } elseif (mb_strlen($lastname) < 2) {
        $errors['last_name'] = 'Last name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $lastname)) {
        $errors['last_name'] = 'Last name can only contain letters.';
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

    // Monthly Income
    if ($monthlyincome === '') {
        $errors['monthlyincome'] = 'Please select a monthly income amount.';
    }

    // Current Networth
    if ($currentnetworth === '') {
        $errors['currentnetworth'] = 'Please select your current networth range.';
    }

    // Email
    if ($email === '') {
        $errors['contact_email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['contact_email'] = 'Please enter a valid email address.';
    }

    // Phone (field name is sphone)
    if ($phone === '') {
        $errors['sphone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{7,15}$/', $phone)) {
        $errors['sphone'] = 'Please enter a valid phone number (7-15 digits).';
    }

    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {
$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Insurance Plus Retirement Plan - ' . $phone;

        $message = '
        <table>
        <tr><td><strong>First Name : </strong></td><td>' . $firstname . '</td></tr>
        <tr><td><strong>Last Name : </strong></td><td>' . $lastname . '</td></tr>
        <tr><td><strong>Date of Birth : </strong></td><td>' . $dob . '</td></tr>
        <tr><td><strong>Monthly Income Required : </strong></td><td>' . $monthlyincome . '</td></tr>
        <tr><td><strong>Current Networth : </strong></td><td>' . $currentnetworth . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
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
$title            = "Insurance Plus Retirement Plan in Canada | Toronto & Surrey, BC";
$meta_description = "Combine life insurance with a retirement plan in Toronto & Surrey across Canada. Guaranteed monthly income for life + protection. Free Canadian quote today!";

$footer_cta_heading = "Ready to Retire Worry-Free?";
$footer_cta_text    = "Contact us today to see how much guaranteed monthly income you could receive-and enjoy your retirement with true peace of mind.";

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
                        <li class="active">Insurance Plus Retirement Plan</li>
                    </ol>
                </nav>
                <h1 class="hero-heading text-white">
                    Retire with Confidence
                    <div class="text-accent-300">Enjoy Guaranteed Monthly Income for Life</div>
                </h1>
                <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                    Turn your savings into a steady, tax-efficient income stream and protect your legacy with a personalized Insurance + Retirement Plan from Punjab Insurance.
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
                        <img src="images/product-main/retirement-savings-graph-and-policy-folder.webp" alt="Retirement savings graph and policy folder">
                    </div>
                    <div class="product-main-info">
                        <h3 class="title">What Is Insurance + Retirement Plan?</h3>
                        <p class="desc">An Insurance + Retirement Plan combines the security of insurance with the power of structured retirement income. Using products like annuities, RRIFs, guaranteed income funds, and insurance-backed solutions, you can transform your savings into reliable, predictable monthly payments that last as long as you do.</p>
                        <ul class="features">
                            <li><span class="text-primary-500">Guaranteed monthly payouts</span> for life or a set period</li>
                            <li><span class="text-primary-500">Protection from market volatility</span> and economic uncertainty</li>
                            <li><span class="text-primary-500">Tax-efficient withdrawals</span> to maximize your retirement income</li>
                            <li><span class="text-primary-500">Options for survivor</span> benefits and legacy planning</li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="product-quote-form-wrap shadow-xl">
                        <div id="quoteFormPlaceholder"></div>
                        <div id="inlineFormContainer">
                            <h3 class="product-quote-form-heading">Retirement Plan Quote</h3>

                            <?php if (!empty($errors['_mail'])) : ?>
                            <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;font-size:0.9rem;color:#111827;font-weight:500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <?= htmlspecialchars($errors['_mail']) ?>
                            </div>
                            <?php endif; ?>

                            <form class="product-quote-form" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                <div class="grid grid-cols-12 gap-4">

                                    <!-- First Name -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="firstname">First Name <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none"><path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['firstname']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['firstname']) ? 'is-valid' : '') ?>"
                                                    name="firstname" id="firstname" placeholder="Enter First Name"
                                                    value="<?= htmlspecialchars($form_data['firstname'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['firstname'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['firstname']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="lastname">Last Name <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none"><path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['last_name']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['last_name']) ? 'is-valid' : '') ?>"
                                                    name="last_name" id="lastname" placeholder="Enter Last Name"
                                                    value="<?= htmlspecialchars($form_data['lastname'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['last_name'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['last_name']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="DOB">Date of Birth <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none">
                                                        <path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/>
                                                        <path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/>
                                                    </svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['DOB']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['DOB']) ? 'is-valid' : '') ?>"
                                                    name="DOB" id="DOB" placeholder="DD/MM/YYYY"
                                                    value="<?= htmlspecialchars($form_data['dob'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['DOB'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['DOB']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Monthly Income -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="monthlyincome">Monthly Income Required <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 21 18" fill="none"><path d="M2 18C1.45 18 0.979333 17.8043 0.588 17.413C0.196667 17.0217 0.000666667 16.5507 0 16V5C0 4.71667 0.0960001 4.47933 0.288 4.288C0.48 4.09667 0.717333 4.00067 1 4C1.28267 3.99933 1.52033 4.09533 1.713 4.288C1.90567 4.48067 2.00133 4.718 2 5V16H16C16.2833 16 16.521 16.096 16.713 16.288C16.905 16.48 17.0007 16.7173 17 17C16.9993 17.2827 16.9033 17.5203 16.712 17.713C16.5207 17.9057 16.2833 18.0013 16 18H2ZM6 14C5.45 14 4.97933 13.8043 4.588 13.413C4.19667 13.0217 4.00067 12.5507 4 12V1C4 0.716667 4.096 0.479333 4.288 0.288C4.48 0.0966668 4.71733 0.000666667 5 0H20C20.2833 0 20.521 0.0960001 20.713 0.288C20.905 0.48 21.0007 0.717333 21 1V12C21 12.55 20.8043 13.021 20.413 13.413C20.0217 13.805 19.5507 14.0007 19 14H6ZM6 12H19V2H6V12Z" fill="#111827"/></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['monthlyincome']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['monthlyincome']) ? 'is-valid' : '') ?>"
                                                    name="monthlyincome" id="monthlyincome" required>
                                                    <?php
                                                    $incomes = ['2000','3000','4000','5000','6000','7000','8000','9000','10000','15000','20000'];
                                                    foreach ($incomes as $inc) {
                                                        $sel = ($form_data['monthlyincome'] ?? '') === $inc ? 'selected' : '';
                                                        echo '<option value="' . $inc . '" ' . $sel . '>' . $inc . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['monthlyincome'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['monthlyincome']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Current Networth -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="currentnetworth">Current Networth <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect x="3" y="6" width="18" height="13" rx="2" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect><path d="M3 10H20.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M7 15H9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['currentnetworth']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['currentnetworth']) ? 'is-valid' : '') ?>"
                                                    name="currentnetworth" id="currentnetworth" required>
                                                    <?php
                                                    $networthOptions = ['500000 - 1 Million','1 Million - 1.5 Million','1.5 Million - 2 Million','2 Million - 2.5 Million','2.5 Million+'];
                                                    foreach ($networthOptions as $nw) {
                                                        $sel = ($form_data['currentnetworth'] ?? '') === $nw ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($nw) . '" ' . $sel . '>' . $nw . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['currentnetworth'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['currentnetworth']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="contact_email">Email <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 16" fill="none"><path d="M2 16C1.45 16 0.979333 15.8043 0.588 15.413C0.196667 15.0217 0.000666667 14.5507 0 14V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196666 1.45067 0.000666667 2 0H18C18.55 0 19.021 0.196 19.413 0.588C19.805 0.98 20.0007 1.45067 20 2V14C20 14.55 19.8043 15.021 19.413 15.413C19.0217 15.805 18.5507 16.0007 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V14V4Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="email"
                                                    class="input-field <?= isset($errors['contact_email']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['contact_email']) ? 'is-valid' : '') ?>"
                                                    name="contact_email" id="contact_email" placeholder="Enter Email Id"
                                                    value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['contact_email'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['contact_email']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Phone Number (note: field name is sphone) -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="sphone">Phone Number <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 18" fill="none"><path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 5.15833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="tel"
                                                    class="input-field <?= isset($errors['sphone']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['sphone']) ? 'is-valid' : '') ?>"
                                                    name="sphone" id="sphone" placeholder="Enter Phone Number"
                                                    value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['sphone'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['sphone']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-span-12">
                                        <button type="submit" id="rpinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
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

    <!-- Benefits -->
    <section class="product-about bg-brand-linear pb-12 lg:pb-16">
        <div class="container max-w-[1140px] mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title">Why Choose a Retirement Income Plan?</h2></div><hr></div>
            <div class="section-content">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/calendar-check-multicolor-48.svg" alt="Certainty"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Certainty</h6><p class="pointer-card__desc">Receive stable, predictable income every month-no market surprises</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/slider-multicolor-48.svg" alt="Flexibility"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Flexibility</h6><p class="pointer-card__desc">Customize when your income starts, how much you receive, and how long it lasts</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/piggy-bank-multicolor-48.svg" alt="Tax Efficiency"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Tax Efficiency</h6><p class="pointer-card__desc">Minimize your tax burden and keep more of your hard-earned savings</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/shield-user-multicolor-48.svg" alt="shield-user-multicolor"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Legacy Protection</h6><p class="pointer-card__desc">Ensure your spouse or loved ones continue to receive income after you're gone</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who Benefits the Most -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr"><div class="heading-copy"><h2 class="title title-h4">Who Benefits Most?</h2></div><hr></div>
            <div class="section-content"><ul class="blogs-list-items">
                <li>Canadians 50+ planning for or entering retirement</li>
                <li>Self-employed professionals and business owners without a company pension</li>
                <li>Retirees looking to supplement CPP, OAS, and RRSPs</li>
                <li>Anyone concerned about outliving their savings</li>
                <li>Women and couples seeking income continuity and spousal protection</li>
                <li>Low-risk investors seeking predictable cash flow</li>
            </ul></div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="bg-primary-50 mt-16 lg:mt-20 py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title">How Does it Work?</h2></div><hr></div>
            <div class="section-content">
                <div class="grid lg:grid-cols-4 gap-6">
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/choices-pointed-multicolor-48.svg" alt="Personalized Consultation"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Personalized Consultation</h6><p class="pointer-card__desc">Our advisors help you clarify your retirement goals and income needs</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/calendar-check-multicolor-48.svg" alt="Custom Plan Design"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Custom Plan Design</h6><p class="pointer-card__desc">We structure your plan using annuities, RRIFs, guaranteed funds, or segregated fund options</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/dollar-bag-multicolor-48.svg" alt="Income Optimization"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Income Optimization</h6><p class="pointer-card__desc">Strategies to maximize government benefits, minimize taxes, and protect against inflation</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/customer-support-multicolor-48.svg" alt="customer-support-icon"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Ongoing Support</h6><p class="pointer-card__desc">Adjust your plan as your needs change, with expert guidance every step of the way</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Solutions -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr"><div class="heading-copy"><h2 class="title title-h4">Additional Solutions We Offer</h2></div><hr></div>
            <div class="section-content"><ul class="blogs-list-items">
                <li><span class="text-gray-900 font-semibold">Life Annuities</span>: Guaranteed income for life, no matter how long you live</li>
                <li><span class="text-gray-900 font-semibold">RRIF to Income Plan Transfers</span>: Convert your RRSP or RRIF into a structured, predictable payout</li>
                <li><span class="text-gray-900 font-semibold">Guaranteed Income Funds</span>: Combine investment growth with protected base income</li>
                <li><span class="text-gray-900 font-semibold">Segregated Fund Payouts</span>: Capital protection plus steady income</li>
                <li><span class="text-gray-900 font-semibold">Legacy & Survivor Benefits</span>: Options for joint-life payouts, guaranteed periods, or refund-of-premium features</li>
            </ul></div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h4 class="subheading">FREQUENTLY ASKED QUESTIONS</h4><h2 class="title title-h4">Frequently Asked Questions about<br>Insurance + Retirement Plan</h2></div><hr></div>
            <div class="section-content">
                <div class="faq-accordion pb-8">
                    <div class="faq-item"><div class="faq-question">What is a retirement income plan?</div><div class="faq-answer">It's a strategy that turns your retirement savings into regular, reliable monthly income using insurance and investment products.</div></div>
                    <div class="faq-item"><div class="faq-question">Is the income taxable?</div><div class="faq-answer">Most monthly payouts are taxable, but our advisors help structure withdrawals to minimize your tax bill.</div></div>
                    <div class="faq-item"><div class="faq-question">Can I protect my spouse or family?</div><div class="faq-answer">Yes! Choose survivor benefits or joint-life options so your loved ones continue to receive income.</div></div>
                    <div class="faq-item"><div class="faq-question">How do I get started?</div><div class="faq-answer"><a href="get-a-quote.php" class="text-primary-500 underline">Get a free quote</a> or <a href="contact.php" class="text-primary-500 underline">schedule a call</a> with a licensed Punjab Insurance advisor for personalized help.</div></div>
                </div>
                <div class="flex justify-center">
                    <a href="faq.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto"><span>View all Faq's</span><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 14" fill="none" class="rotate-35"><g clip-path="url(#clip0_1032_10019)"><path d="M18.7495 7.49939H5.25052C4.83055 7.49939 4.50058 7.16942 4.50058 6.74945C4.50058 6.32949 4.83055 5.99951 5.25052 5.99951H18.7495C19.1694 5.99951 19.4994 6.32949 19.4994 6.74945C19.4994 7.16942 19.1694 7.49939 18.7495 7.49939Z" fill="white"/><path d="M14.9998 12.749C14.9014 12.7502 14.8039 12.7308 14.7135 12.6921C14.6231 12.6533 14.5418 12.5961 14.4748 12.524C14.1748 12.2241 14.1748 11.7591 14.4748 11.4591L19.1994 6.7345L14.4748 2.00987C14.1748 1.70989 14.1748 1.24493 14.4748 0.944953C14.7748 0.644977 15.2397 0.644977 15.5397 0.944953L20.7893 6.19454C21.0893 6.49452 21.0893 6.95948 20.7893 7.25946L15.5397 12.5091C15.3897 12.659 15.1947 12.734 15.0148 12.734L14.9998 12.749Z" fill="white"/></g><defs><clipPath id="clip0_1032_10019"><rect width="24" height="13.4989" fill="white"/></clipPath></defs></svg></a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/google-reviews-section.php'; ?>

    <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="fomo-quote">
                <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                Retire with confidence and enjoy guaranteed monthly income for life. Turn your savings into a steady, tax-efficient income stream while protecting your legacy with a personalized Insurance + Retirement Plan from Punjab Insurance.
            </div>
        </div>
    </section>

    <?php include 'includes/product-disclaimer.php'; ?>
</main>

<div id="quoteModal" class="modal-container"><div class="modal-box"><span id="modalClose" class="modal-close">&times;</span><div id="modalFormContainer"></div></div></div>
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

    function validateFirstName(show) {
        var $f = $('#firstname'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'First name is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'First name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if (show) showError($f, 'First name can only contain letters.'); return false; }
        clearError($f); return true;
    }
    function validateLastName(show) {
        var $f = $('#lastname'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Last name is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Last name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if (show) showError($f, 'Last name can only contain letters.'); return false; }
        clearError($f); return true;
    }
    function validateDOB(show) {
        var $f = $('#DOB'), v = $f.val().trim();
        if (!v)                { if (show) showError($f, 'Date of birth is required.'); return false; }
        if (!isValidDate(v))   { if (show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrPast(v)) { if (show) showError($f, 'Date of birth cannot be in the future.'); return false; }
        clearError($f); return true;
    }
    function validateMonthlyIncome(show) {
        var $f = $('#monthlyincome'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select a monthly income amount.'); return false; }
        clearError($f); return true;
    }
    function validateNetworth(show) {
        var $f = $('#currentnetworth'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select your current networth range.'); return false; }
        clearError($f); return true;
    }
    function validateEmail(show) {
        var $f = $('#contact_email'), v = $f.val().trim();
        if (!v)               { if (show) showError($f, 'Email is required.'); return false; }
        if (!isValidEmail(v)) { if (show) showError($f, 'Please enter a valid email address.'); return false; }
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

    $('#firstname').on('blur',              function () { validateFirstName(true); });
    $('#lastname').on('blur',               function () { validateLastName(true); });
    $('#DOB').on('blur change',             function () { validateDOB(true); });
    $('#monthlyincome').on('blur change',   function () { validateMonthlyIncome(true); });
    $('#currentnetworth').on('blur change', function () { validateNetworth(true); });
    $('#contact_email').on('blur',          function () { validateEmail(true); });
    $('#sphone').on('blur',                 function () { validatePhone(true); });

    $('#firstname, #lastname, #contact_email, #sphone').on('input', function () { resetField($(this)); });

    $('#rpinssubmit').on('click', function (e) {
        e.preventDefault();

        var valid =
            validateFirstName(true) &
            validateLastName(true) &
            validateDOB(true) &
            validateMonthlyIncome(true) &
            validateNetworth(true) &
            validateEmail(true) &
            validatePhone(true);

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
        $btn.find('span').text('Submitting...');
        $btn.append('<span class="btn-spinner"></span>');
        $btn.closest('form').submit();
    });
});
</script>