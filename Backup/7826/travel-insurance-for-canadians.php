<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_ti(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $medical_cond1 = clean_ti($_POST['medical_cond1'] ?? '');
    $travto        = clean_ti($_POST['travto']         ?? '');
    $departeredate = clean_ti($_POST['departeredate']  ?? '');
    $returndate    = clean_ti($_POST['returndate']     ?? '');
    $ntravellers   = clean_ti($_POST['ntravellers']    ?? '');
    $age           = clean_ti($_POST['age']            ?? '');
    $tname         = clean_ti($_POST['tname']          ?? '');
    $email         = clean_ti($_POST['contact_email']  ?? '');
    $phone         = clean_ti($_POST['tphone']         ?? '');

    $form_data = compact('medical_cond1', 'travto', 'departeredate', 'returndate', 'ntravellers', 'age', 'tname', 'email', 'phone');

    // Travelling To
    if ($travto === '') {
        $errors['travto'] = 'Please enter your destination.';
    } elseif (mb_strlen($travto) < 2) {
        $errors['travto'] = 'Destination must be at least 2 characters.';
    }

    // Date of Departure — required, valid date, must not be in the past
    if ($departeredate === '') {
        $errors['departeredate'] = 'Date of departure is required.';
    } elseif (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $departeredate)) {
        $errors['departeredate'] = 'Please enter a valid date (DD/MM/YYYY).';
    } else {
        $depParts = explode('/', $departeredate);
        $depD = (int) $depParts[0]; $depM = (int) $depParts[1]; $depY = (int) $depParts[2];
        if (!checkdate($depM, $depD, $depY)) {
            $errors['departeredate'] = 'Please enter a valid calendar date (DD/MM/YYYY).';
        } else {
            $depDate = new DateTime($depY . '-' . sprintf('%02d', $depM) . '-' . sprintf('%02d', $depD));
            $today   = new DateTime('today');
            if ($depDate < $today) {
                $errors['departeredate'] = 'Departure date cannot be in the past.';
            }
        }
    }

    // Date of Return — required, valid date, must be after departure
    if ($returndate === '') {
        $errors['returndate'] = 'Date of return is required.';
    } elseif (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $returndate)) {
        $errors['returndate'] = 'Please enter a valid date (DD/MM/YYYY).';
    } else {
        $retParts = explode('/', $returndate);
        $retD = (int) $retParts[0]; $retM = (int) $retParts[1]; $retY = (int) $retParts[2];
        if (!checkdate($retM, $retD, $retY)) {
            $errors['returndate'] = 'Please enter a valid calendar date (DD/MM/YYYY).';
        } else {
            $retDate = new DateTime($retY . '-' . sprintf('%02d', $retM) . '-' . sprintf('%02d', $retD));
            // Cross-check: return must be after departure (only if departure is also valid)
            if (!isset($errors['departeredate']) && isset($depDate) && $retDate <= $depDate) {
                $errors['returndate'] = 'Return date must be after the departure date.';
            }
        }
    }

    // Number of Travellers
    if ($ntravellers === '') {
        $errors['ntravellers'] = 'Please select the number of travellers.';
    }

    // Age of Oldest Traveller
    if ($age === '') {
        $errors['age'] = 'Please enter the age of the oldest traveller.';
    } elseif (!preg_match('/^\d+$/', $age)) {
        $errors['age'] = 'Please enter a valid age (numbers only).';
    } elseif ((int) $age < 1 || (int) $age > 120) {
        $errors['age'] = 'Please enter a valid age between 1 and 120.';
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
        $errors['tphone'] = 'Please enter a valid phone number (7-15 digits).';
    }

    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {
$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Travel Insurance - ' . $phone;

        $message = '
        <table>
        <tr><td><strong>Pre-existing Medical Condition : </strong></td><td>' . $medical_cond1 . '</td></tr>
        <tr><td><strong>Travelling To : </strong></td><td>' . $travto . '</td></tr>
        <tr><td><strong>Date of Departure : </strong></td><td>' . $departeredate . '</td></tr>
        <tr><td><strong>Date of Return : </strong></td><td>' . $returndate . '</td></tr>
        <tr><td><strong>Number of Travellers : </strong></td><td>' . $ntravellers . '</td></tr>
        <tr><td><strong>Age of Oldest Traveller : </strong></td><td>' . $age . '</td></tr>
        <tr><td><strong>Name : </strong></td><td>' . $tname . '</td></tr>
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
$title            = "Travel Insurance in Canada | Toronto & Surrey, BC";
$meta_description = "Travel & visitor insurance for Canadians in Toronto & Surrey across Canada. Emergency medical, trip cancellation & student plans. Compare top insurers - free quote!";
$footer_cta_heading = "Get a Free Travel Insurance Quote-Travel with Peace of Mind";
$footer_cta_text    = "Protect your health, your finances, and your trip-anywhere in the world. Contact Punjab Insurance for expert advice and instant quotes.";

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
                        <li class="active">Travel insurance for Canadians</li>
                    </ol>
                </nav>
                <h1 class="hero-heading text-white">
                    Protect Your Trips
                    <div class="text-accent-300">Comprehensive Travel Insurance for Canadians</div>
                </h1>
                <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                    Travel with confidence anywhere in the world. Punjab Insurance offers affordable, flexible travel insurance plans for Canadians-so you're protected from costly medical emergencies, trip interruptions, and travel mishaps wherever you go.
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
                        <img src="images/product-main/couple-with-luggage-at-airport-travel-insurance.webp" alt="Couple with luggage at airport, travel insurance">
                    </div>
                    <div class="product-main-info">
                        <h3 class="title">Why Do Canadians Need Travel Insurance?</h3>
                        <ul class="features">
                            <li>Provincial health plans don't cover most medical expenses outside Canada</li>
                            <li>Hospitalization, emergency care, and medical evacuation abroad can cost thousands</li>
                            <li>Some countries require proof of insurance for entry or visa approval</li>
                            <li>Travel insurance provides peace of mind and financial protection for you and your loved ones</li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="product-quote-form-wrap shadow-xl">
                        <div id="quoteFormPlaceholder"></div>
                        <div id="inlineFormContainer">
                            <h3 class="product-quote-form-heading">Quote for Travel Insurance for Canadians</h3>

                            <?php if (!empty($errors['_mail'])) : ?>
                            <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;font-size:0.9rem;color:#111827;font-weight:500;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <?= htmlspecialchars($errors['_mail']) ?>
                            </div>
                            <?php endif; ?>

                            <form class="product-quote-form" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                <div class="grid grid-cols-12 gap-4">

                                    <!-- Pre-existing Medical Condition -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="medical_cond1">Pre-existing Medical Condition</label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg fill="#111827" width="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_iconCarrier"><path d="M21,12.812V16A7,7,0,0,1,7,16V14.92A7.006,7.006,0,0,1,1,8V2A1,1,0,0,1,2,1H5A1,1,0,0,1,5,3H3V8A5,5,0,0,0,13,8V3H11a1,1,0,0,1,0-2h3a1,1,0,0,1,1,1V8a7.006,7.006,0,0,1-6,6.92V16a5,5,0,0,0,10,0V12.812a3,3,0,1,1,2,0Z"></path></g></svg>
                                                </span>
                                                <select class="input-field" name="medical_cond1" id="medical_cond1">
                                                    <option value="No" <?= ($form_data['medical_cond1'] ?? 'No') === 'No' ? 'selected' : '' ?>>No</option>
                                                    <option value="Yes" <?= ($form_data['medical_cond1'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Travelling To -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="travto">Travelling To? <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_iconCarrier"><circle cx="12" cy="10" r="3" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M19 9.75C19 15.375 12 21 12 21C12 21 5 15.375 5 9.75C5 6.02208 8.13401 3 12 3C15.866 3 19 6.02208 19 9.75Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['travto']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['travto']) ? 'is-valid' : '') ?>"
                                                    name="travto" id="travto" placeholder="Enter Destination"
                                                    value="<?= htmlspecialchars($form_data['travto'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['travto'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['travto']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Date of Departure -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="departeredate">Date of Departure <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none"><path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/><path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['departeredate']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['departeredate']) ? 'is-valid' : '') ?>"
                                                    name="departeredate" id="departeredate" placeholder="DD/MM/YYYY"
                                                    value="<?= htmlspecialchars($form_data['departeredate'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['departeredate'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['departeredate']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Date of Return -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="returndate">Date of Return <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none"><path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/><path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['returndate']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['returndate']) ? 'is-valid' : '') ?>"
                                                    name="returndate" id="returndate" placeholder="DD/MM/YYYY"
                                                    value="<?= htmlspecialchars($form_data['returndate'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['returndate'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['returndate']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Number of Travellers -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="ntravellers">Number of Travellers <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none"><path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/></svg>
                                                </span>
                                                <select
                                                    class="input-field <?= isset($errors['ntravellers']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['ntravellers']) ? 'is-valid' : '') ?>"
                                                    name="ntravellers" id="ntravellers" required>
                                                    <option value="">Select No. of Travellers</option>
                                                    <?php foreach (range(1, 7) as $n) : ?>
                                                    <option value="<?= $n ?>" <?= ($form_data['ntravellers'] ?? '') === (string)$n ? 'selected' : '' ?>><?= $n ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['ntravellers'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['ntravellers']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Age of Oldest Traveller -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="age">Age of Oldest Traveller <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none"><path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/><path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['age']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['age']) ? 'is-valid' : '') ?>"
                                                    name="age" id="age" placeholder="Enter Age"
                                                    value="<?= htmlspecialchars($form_data['age'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['age'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['age']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="tname">Name <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none"><path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['tname']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['tname']) ? 'is-valid' : '') ?>"
                                                    name="tname" id="tname" placeholder="Enter Name"
                                                    value="<?= htmlspecialchars($form_data['tname'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['tname'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['tname']) ?></span><?php endif; ?>
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

                                    <!-- Phone Number -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="tphone">Phone Number <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 18" fill="none"><path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 5.15833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="#111827"/></svg>
                                                </span>
                                                <input type="tel"
                                                    class="input-field <?= isset($errors['tphone']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['tphone']) ? 'is-valid' : '') ?>"
                                                    name="tphone" id="tphone" placeholder="Enter Phone Number"
                                                    value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['tphone'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['tphone']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-span-12">
                                        <a id="tiinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                                            <span>Get Quote</span>
                                            <img src="images/icons/send-plane.svg" width="14" alt="send-plane">
                                        </a>
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

    <!-- What's Covered -->
    <section class="product-about bg-brand-linear pb-12 lg:pb-16">
        <div class="container max-w-[1024px] mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title">What Does Travel Insurance Cover?</h2></div><hr></div>
            <div class="section-content">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/medical-bill-multicolor-48.svg" alt="Emergency Medical Expenses"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Emergency Medical Expenses</h6><p class="pointer-card__desc">Hospital stays, doctor visits, surgery, diagnostic tests, and prescription drugs</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/doctor-briefcase-multicolor-48.svg" alt="Emergency Medical Evacuation"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Emergency Medical Evacuation</h6><p class="pointer-card__desc">Covers the cost to return you to Canada if medically necessary</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/briefcase-umbrella-multicolor-48.svg" alt="Trip Cancellation & Interruption"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Trip Cancellation & Interruption</h6><p class="pointer-card__desc">Reimburses non-refundable travel costs if your trip is cancelled or cut short due to covered reasons</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/trip-bag-multicolor-48.svg" alt="Lost or Delayed Baggage"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Lost or Delayed Baggage</h6><p class="pointer-card__desc">Compensation for lost, stolen, or delayed luggage</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/flight-globe-multicolor-48.svg" alt="Travel Delay & Missed Connections"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Travel Delay & Missed Connections</h6><p class="pointer-card__desc">Covers extra accommodation and transportation costs due to travel delays</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/dollar-bag-multicolor-48.svg" alt="Accidental Death & Dismemberment"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Accidental Death & Dismemberment</h6><p class="pointer-card__desc">Lump-sum payment in case of severe accident while traveling</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who Should Get -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr"><div class="heading-copy"><h2 class="title title-h4">Who Should Get Travel Insurance?</h2></div><hr></div>
            <div class="section-content"><ul class="blogs-list-items">
                <li>Canadians traveling abroad for vacation, business, or family visits</li>
                <li>Snowbirds spending winter outside Canada</li>
                <li>Students or professionals on international assignments</li>
                <li>Anyone seeking peace of mind while traveling</li>
            </ul></div>
        </div>
    </section>

    <!-- Why Punjab Insurance -->
    <section class="bg-brand-linear mt-16 lg:mt-20 py-12 lg:py-16">
        <div class="max-w-[1140px] mx-auto"><div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title title-h4">Why Choose Punjab Insurance?</h2></div><hr></div>
            <div class="section-content"><div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/dollar-down-multicolor-48.svg" alt=""></div><div class="pointer-card__copy"><h6 class="card-common_heading">Lowest rate comparison from Canada's top visitor insurance providers</h6></div></div>
                <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/users-group-multicolor-48.svg" alt="users-group-multicolor"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Plans for all ages and health conditions, including pre-existing conditions (ask for details)</h6></div></div>
                <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/slider-multicolor-48.svg" alt=""></div><div class="pointer-card__copy"><h6 class="card-common_heading">Flexible coverage options and instant online quotes</h6></div></div>
                <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/customer-support-multicolor-48.svg" alt="customer-support-icon"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Expert advisors to help you choose the right plan for your needs and budget</h6></div></div>
            </div></div>
        </div></div>
    </section>

    <!-- FAQ -->
    <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h4 class="subheading">FREQUENTLY ASKED QUESTIONS</h4><h2 class="title title-h4">Frequently Asked Questions about<br>Travel Insurance for Canadians</h2></div><hr></div>
            <div class="section-content">
                <div class="faq-accordion pb-8">
                    <div class="faq-item"><div class="faq-question">Is travel insurance mandatory for Canadians traveling abroad?</div><div class="faq-answer">Some countries require proof for entry or visa, but it's always strongly recommended for financial protection.</div></div>
                    <div class="faq-item"><div class="faq-question">Does travel insurance cover COVID-19?</div><div class="faq-answer">Many plans now include COVID-19 coverage-ask for the latest options.</div></div>
                    <div class="faq-item"><div class="faq-question">Can I buy travel insurance after I leave Canada?</div><div class="faq-answer">Some plans allow this, but it's best to purchase before departure for full coverage.</div></div>
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
                Travel with confidence wherever your journey takes you. Travel Insurance for Canadians from Punjab Insurance provides affordable, flexible coverage to protect you against unexpected medical emergencies, trip interruptions, and travel disruptions-so you can explore the world knowing you're well protected every step of the way.
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

    // ── Flatpickr for Departure — today or future only ────────────────────────
    var fpDep = flatpickr('#departeredate', {
        dateFormat:    'd/m/Y',
        minDate:       'today',
        allowInput:    true,
        disableMobile: true,
        onChange: function () {
            // When departure changes, update return picker's minDate
            var depVal = $('#departeredate').val().trim();
            if (fpRet && isValidDate(depVal)) {
                var p = depVal.split('/');
                var depDate = new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
                // minDate for return = day after departure
                var minRet = new Date(depDate.getTime() + 86400000);
                fpRet.set('minDate', minRet);
            }
            validateDeparture(true);
            // Re-validate return if already filled
            if ($('#returndate').val().trim()) validateReturn(true);
        }
    });

    // ── Flatpickr for Return — must be after departure ────────────────────────
    var fpRet = flatpickr('#returndate', {
        dateFormat:    'd/m/Y',
        minDate:       'today',
        allowInput:    true,
        disableMobile: true,
        onChange: function () {
            validateReturn(true);
        }
    });

    // ── Error helpers ─────────────────────────────────────────────────────────
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

    // ── Format helpers ────────────────────────────────────────────────────────
    function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function isValidPhone(v) { return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim()); }
    function isValidDate(str) {
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(str)) return false;
        var p = str.split('/');
        var d = parseInt(p[0],10), m = parseInt(p[1],10), y = parseInt(p[2],10);
        if (m < 1 || m > 12 || d < 1 || d > 31 || y < 1900 || y > 2100) return false;
        var dt = new Date(y, m-1, d);
        return dt.getFullYear()===y && dt.getMonth()===m-1 && dt.getDate()===d;
    }
    function parseDate(str) {
        var p = str.split('/');
        return new Date(parseInt(p[2],10), parseInt(p[1],10)-1, parseInt(p[0],10));
    }
    function isTodayOrFuture(str) {
        var dt = parseDate(str);
        var t  = new Date(); t.setHours(0,0,0,0);
        return dt >= t;
    }

    // ── Per-field validators ──────────────────────────────────────────────────
    function validateTravto(show) {
        var $f = $('#travto'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Please enter your destination.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Destination must be at least 2 characters.'); return false; }
        clearError($f); return true;
    }
    function validateDeparture(show) {
        var $f = $('#departeredate'), v = $f.val().trim();
        if (!v)                  { if (show) showError($f, 'Date of departure is required.'); return false; }
        if (!isValidDate(v))     { if (show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        if (!isTodayOrFuture(v)) { if (show) showError($f, 'Departure date cannot be in the past.'); return false; }
        clearError($f); return true;
    }
    function validateReturn(show) {
        var $f  = $('#returndate'), v = $f.val().trim();
        var dep = $('#departeredate').val().trim();
        if (!v)              { if (show) showError($f, 'Date of return is required.'); return false; }
        if (!isValidDate(v)) { if (show) showError($f, 'Please enter a valid date (DD/MM/YYYY).'); return false; }
        // Cross-check: return must be strictly after departure
        if (isValidDate(dep) && parseDate(v) <= parseDate(dep)) {
            if (show) showError($f, 'Return date must be after the departure date.');
            return false;
        }
        clearError($f); return true;
    }
    function validateNtravellers(show) {
        var $f = $('#ntravellers'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select the number of travellers.'); return false; }
        clearError($f); return true;
    }
    function validateAge(show) {
        var $f = $('#age'), v = $f.val().trim();
        if (!v)                        { if (show) showError($f, 'Please enter the age of the oldest traveller.'); return false; }
        if (!/^\d+$/.test(v))          { if (show) showError($f, 'Please enter a valid age (numbers only).'); return false; }
        if (parseInt(v,10) < 1 || parseInt(v,10) > 120) { if (show) showError($f, 'Please enter a valid age between 1 and 120.'); return false; }
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

    // ── Blur / change events ──────────────────────────────────────────────────
    $('#travto').on('blur',               function () { validateTravto(true); });
    $('#departeredate').on('blur change', function () { validateDeparture(true); });
    $('#returndate').on('blur change',    function () { validateReturn(true); });
    $('#ntravellers').on('change',        function () { validateNtravellers(true); });
    $('#age').on('blur',                  function () { validateAge(true); });
    $('#tname').on('blur',                function () { validateName(true); });
    $('#contact_email').on('blur',        function () { validateEmail(true); });
    $('#tphone').on('blur',               function () { validatePhone(true); });

    $('#travto, #age, #tname, #contact_email, #tphone').on('input', function () {
        resetField($(this));
    });

    // ── Submit ────────────────────────────────────────────────────────────────
    $('#tiinssubmit').on('click', function (e) {
        e.preventDefault();

        var valid =
            validateTravto(true)    &
            validateDeparture(true) &
            validateReturn(true)    &
            validateNtravellers(true) &
            validateAge(true)       &
            validateName(true)      &
            validateEmail(true)     &
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