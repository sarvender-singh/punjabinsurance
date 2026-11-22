<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_di(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect & sanitise
    $tname         = clean_di($_POST['tname']          ?? '');
    $email         = clean_di($_POST['contact_email']  ?? '');
    $phone         = clean_di($_POST['tphone']         ?? '');
    $smoker        = clean_di($_POST['smoker']         ?? '');
    $gender        = clean_di($_POST['gender']         ?? '');
    $profession    = clean_di($_POST['profession']     ?? '');
    $income        = clean_di($_POST['income']         ?? '');
    $otherquestion = clean_di($_POST['otherquestion']  ?? '');

    $form_data = compact('tname', 'email', 'phone', 'smoker', 'gender', 'profession', 'income', 'otherquestion');

    // ── Validate ──────────────────────────────────────────────────────────────

    if ($tname === '') {
        $errors['tname'] = 'Name is required.';
    } elseif (mb_strlen($tname) < 2) {
        $errors['tname'] = 'Name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $tname)) {
        $errors['tname'] = 'Name can only contain letters.';
    }

    if ($email === '') {
        $errors['contact_email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['contact_email'] = 'Please enter a valid email address.';
    }

    if ($phone === '') {
        $errors['tphone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{7,15}$/', $phone)) {
        $errors['tphone'] = 'Please enter a valid phone number (7–15 digits).';
    }

    if ($smoker === '') {
        $errors['smoker'] = 'Please indicate your smoking status.';
    }

    if ($gender === '') {
        $errors['gender'] = 'Please select your gender.';
    }

    if ($profession === '') {
        $errors['profession'] = 'Profession is required.';
    } elseif (mb_strlen($profession) < 2) {
        $errors['profession'] = 'Please enter a valid profession.';
    }

    if ($income === '') {
        $errors['income'] = 'Gross income is required.';
    } elseif (!preg_match('/^[\d\s\$\,\.\+\-]+$/', $income)) {
        $errors['income'] = 'Please enter a valid income amount.';
    }

    if ($otherquestion === '') {
        $errors['otherquestion'] = 'Please enter your question or type N/A if none.';
    } elseif (mb_strlen($otherquestion) < 2) {
        $errors['otherquestion'] = 'Please enter at least 2 characters.';
    }

    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {
$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Disability Insurance - ' . $phone;

        $message = '
        <table>
        <tr><td><strong>Name : </strong></td><td>' . $tname . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
        <tr><td><strong>Smoker : </strong></td><td>' . $smoker . '</td></tr>
        <tr><td><strong>Gender : </strong></td><td>' . $gender . '</td></tr>
        <tr><td><strong>Profession : </strong></td><td>' . $profession . '</td></tr>
        <tr><td><strong>Gross Income : </strong></td><td>' . $income . '</td></tr>
        <tr><td><strong>Other Question : </strong></td><td>' . nl2br($otherquestion) . '</td></tr>
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
$title            = "Disability Insurance in Canada | Toronto & Surrey, BC";
$meta_description = "Disability insurance in Toronto & Surrey across Canada replaces your income if illness or injury stops you working. Short & long-term plans. Free Canada quote today!";

$footer_cta_heading = "Get a Free Disability Insurance Quote";
$footer_cta_text    = "Contact us today to compare plans and secure your income-no obligation, just expert guidance.";

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
                        <li class="active">Disability Insurance</li>
                    </ol>
                </nav>

                <h1 class="hero-heading text-white">
                    Protect Your Income and
                    <div class="text-accent-300">Your Lifestyle-If You Can't Work</div>
                </h1>

                <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                    Disability insurance from Punjab Insurance ensures you have a steady income if injury or illness keeps you from working. Safeguard your financial security and maintain your standard of living, no matter what life brings.
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
                        <img src="images/product-main/disability-insurance-main.webp" alt="Disability Insurance">
                    </div>

                    <div class="product-main-info">
                        <h3 class="title">What Is Disability Insurance?</h3>
                        <p class="desc">Disability insurance (also called income protection insurance or loss of income benefit) provides you with a portion of your income if you become disabled and can't work due to illness or injury. It helps cover your bills, mortgage, and daily expenses while you recover.</p>
                        <ul class="features">
                            <li><span class="text-primary-500">Replaces lost income</span> if you're unable to work</li>
                            <li><span class="text-primary-500">Covers both short-term and</span> long-term disabilities</li>
                            <li><span class="text-primary-500">Flexible coverage amounts</span> and benefit periods</li>
                            <li><span class="text-primary-500">Peace of mind for</span> you and your family</li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="product-quote-form-wrap shadow-xl">
                        <div id="quoteFormPlaceholder"></div>

                        <div id="inlineFormContainer">
                            <h3 class="product-quote-form-heading">Free Quote Online for Disability Insurance Canada</h3>

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

                                    <!-- Name -->
                                    <div class="col-span-12">
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
                                    <div class="col-span-12 lg:col-span-6">
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

                                    <!-- Smoker -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="smoker">Are you a smoker? <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="24px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#111827" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#111827" d="M256 576v128h640V576H256zm-32-64h704a32 32 0 0 1 32 32v192a32 32 0 0 1-32 32H224a32 32 0 0 1-32-32V544a32 32 0 0 1 32-32z"></path><path fill="#111827" d="M704 576h64v128h-64zM256 64h64v320h-64zM128 192h64v192h-64zM64 512h64v256H64z"></path></g></svg>
                                                </span>
                                                <select class="input-field <?= isset($errors['smoker']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['smoker']) ? 'is-valid' : '') ?>"
                                                    name="smoker" id="smoker" required>
                                                    <option value="">Please choose</option>
                                                    <option <?= ($form_data['smoker'] ?? '') === 'Smoker' ? 'selected' : '' ?>>Smoker</option>
                                                    <option <?= ($form_data['smoker'] ?? '') === 'Non Smoker' ? 'selected' : '' ?>>Non Smoker</option>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['smoker'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['smoker']) ?></span><?php endif; ?>
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
                                                <select class="input-field <?= isset($errors['gender']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['gender']) ? 'is-valid' : '') ?>"
                                                    name="gender" id="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" <?= ($form_data['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                                    <option value="Female" <?= ($form_data['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                                </select>
                                            </div>
                                            <?php if (isset($errors['gender'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['gender']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Profession -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="profession">Profession <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M16 7V6.2C16 5.0799 16 4.51984 15.782 4.09202C15.5903 3.71569 15.2843 3.40973 14.908 3.21799C14.4802 3 13.9201 3 12.8 3H11.2C10.0799 3 9.51984 3 9.09202 3.21799C8.71569 3.40973 8.40973 3.71569 8.21799 4.09202C8 4.51984 8 5.0799 8 6.2V7M9 15V12M15 15V12M3.02721 10.0263C3.38776 10.3719 7.28572 14 12 14C16.7143 14 20.6122 10.3719 20.9728 10.0263M3.02721 10.0263C3 10.493 3 11.0665 3 11.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V11.8C21 11.0665 21 10.493 20.9728 10.0263M3.02721 10.0263C3.06233 9.4241 3.14276 8.99959 3.32698 8.63803C3.6146 8.07354 4.07354 7.6146 4.63803 7.32698C5.27976 7 6.11984 7 7.8 7H16.2C17.8802 7 18.7202 7 19.362 7.32698C19.9265 7.6146 20.3854 8.07354 20.673 8.63803C20.8572 8.99959 20.9377 9.4241 20.9728 10.0263" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['profession']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['profession']) ? 'is-valid' : '') ?>"
                                                    name="profession" id="profession" placeholder="Enter Profession"
                                                    value="<?= htmlspecialchars($form_data['profession'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['profession'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['profession']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Gross Income -->
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="input-group">
                                            <label class="input-label" for="income">Gross Income <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon">
                                                    <svg width="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M6 8H4M6 16H4M6 12H3M7 4.51555C8.4301 3.55827 10.1499 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C10.1499 21 8.4301 20.4417 7 19.4845M14 9.49991C13.5 9.37589 12.6851 9.37133 12 9.37589M12 9.37589C11.7709 9.37742 11.9094 9.36768 11.6 9.37589C10.7926 9.40108 10.0016 9.73666 10 10.6874C9.99825 11.7002 11 11.9999 12 11.9999C13 11.9999 14 12.2311 14 13.3124C14 14.125 13.1925 14.4811 12.1861 14.599C12.1216 14.599 12.0597 14.5991 12 14.5994M12 9.37589L12 8M12 14.5994C11.3198 14.6022 10.9193 14.6148 10 14.4999M12 14.5994L12 16" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                </span>
                                                <input type="text"
                                                    class="input-field <?= isset($errors['income']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['income']) ? 'is-valid' : '') ?>"
                                                    name="income" id="income" placeholder="Enter Gross Income"
                                                    value="<?= htmlspecialchars($form_data['income'] ?? '') ?>" required>
                                            </div>
                                            <?php if (isset($errors['income'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['income']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Any Other Question -->
                                    <div class="col-span-12">
                                        <div class="input-group">
                                            <label class="input-label" for="otherquestion">Any other question? <span>*</span></label>
                                            <div class="input-wrapper">
                                                <span class="input-icon textarea-icon">
                                                    <svg height="16px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#000000"><g><path style="fill:#111827;" d="M396.138,85.295c-13.172-25.037-33.795-45.898-59.342-61.03C311.26,9.2,280.435,0.001,246.98,0.001 c-41.238-0.102-75.5,10.642-101.359,25.521c-25.962,14.826-37.156,32.088-37.156,32.088c-4.363,3.786-6.824,9.294-6.721,15.056 c0.118,5.77,2.775,11.186,7.273,14.784l35.933,28.78c7.324,5.864,17.806,5.644,24.875-0.518c0,0,4.414-7.978,18.247-15.88 c13.91-7.85,31.945-14.173,58.908-14.258c23.517-0.051,44.022,8.725,58.016,20.717c6.952,5.941,12.145,12.594,15.328,18.68 c3.208,6.136,4.379,11.5,4.363,15.574c-0.068,13.766-2.742,22.77-6.603,30.442c-2.945,5.729-6.789,10.813-11.738,15.744 c-7.384,7.384-17.398,14.207-28.634,20.479c-11.245,6.348-23.365,11.932-35.612,18.68c-13.978,7.74-28.77,18.858-39.701,35.544 c-5.449,8.249-9.71,17.686-12.416,27.641c-2.742,9.964-3.98,20.412-3.98,31.071c0,11.372,0,20.708,0,20.708 c0,10.719,8.69,19.41,19.41,19.41h46.762c10.719,0,19.41-8.691,19.41-19.41c0,0,0-9.336,0-20.708c0-4.107,0.467-6.755,0.917-8.436 c0.773-2.512,1.206-3.14,2.47-4.668c1.29-1.452,3.895-3.674,8.698-6.331c7.019-3.946,18.298-9.276,31.07-16.176 c19.121-10.456,42.367-24.646,61.972-48.062c9.752-11.686,18.374-25.758,24.323-41.968c6.001-16.21,9.242-34.431,9.226-53.96 C410.243,120.761,404.879,101.971,396.138,85.295z"/><path style="fill:#111827;" d="M228.809,406.44c-29.152,0-52.788,23.644-52.788,52.788c0,29.136,23.637,52.772,52.788,52.772 c29.136,0,52.763-23.636,52.763-52.772C281.572,430.084,257.945,406.44,228.809,406.44z"/></g></svg>
                                                </span>
                                                <textarea
                                                    class="input-field <?= isset($errors['otherquestion']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['otherquestion']) ? 'is-valid' : '') ?>"
                                                    name="otherquestion" id="otherquestion"
                                                    placeholder="Please enter if you have any other question"
                                                    required><?= htmlspecialchars($form_data['otherquestion'] ?? '') ?></textarea>
                                            </div>
                                            <?php if (isset($errors['otherquestion'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['otherquestion']) ?></span><?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-span-12">
                                        <button type="submit" id="diinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
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

    <!-- Product Types -->
    <section class="product-about bg-brand-linear pb-12 lg:pb-16">
        <div class="container max-w-[1024px] mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title">Types of Disability Insurance Plans</h2></div><hr></div>
            <div class="section-content">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                    <div class="pointer-card hp-services-card">
                        <div class="pointer-card__icon hp-services-card__icon"><img src="images/icons/padlock-duotone-48.svg" alt="Non-Cancellable"></div>
                        <div class="pointer-card__copy"><h6 class="card-common_heading">Non-Cancellable</h6><p class="pointer-card__desc">Can't be cancelled by the insurer or have premiums increased-most stable option</p></div>
                    </div>
                    <div class="pointer-card hp-services-card">
                        <div class="pointer-card__icon hp-services-card__icon"><img src="images/icons/calendar-refresh-duotone-48.svg" alt="Guaranteed Renewable"></div>
                        <div class="pointer-card__copy"><h6 class="card-common_heading">Guaranteed Renewable</h6><p class="pointer-card__desc">Can't be cancelled, but premiums can be increased on a class basis</p></div>
                    </div>
                    <div class="pointer-card hp-services-card">
                        <div class="pointer-card__icon hp-services-card__icon"><img src="images/icons/calendar-refresh-duotone-48.svg" alt="Conditionally Renewable"></div>
                        <div class="pointer-card__copy"><h6 class="card-common_heading">Conditionally Renewable</h6><p class="pointer-card__desc">Premiums can be adjusted and policy cancelled on a class basis; easier to qualify for</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h2 class="title">How Does Disability Insurance Work?</h2></div><hr></div>
            <div class="section-content">
                <div class="grid lg:grid-cols-4 gap-6">
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/choices-pointed-multicolor-48.svg" alt="Choose your coverage"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Choose your coverage</h6><p class="pointer-card__desc">Select the benefit amount and how long benefits will be paid.</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/calendar-lock-multicolor-48.svg" alt="Elimination Period"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Elimination Period</h6><p class="pointer-card__desc">Decide how long you wait before benefits begin (e.g., 30, 60, 90 days).</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/calendar-check-multicolor-48.svg" alt="Benefit Period"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Benefit Period</h6><p class="pointer-card__desc">Choose how long benefits last (e.g., 2 years, 5 years, or up to age 65).</p></div></div>
                    <div class="pointer-card process-card"><div class="pointer-card__icon"><img src="images/icons/dollar-bag-multicolor-48.svg" alt="Receive payments"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Receive payments</h6><p class="pointer-card__desc">If you're unable to work due to a covered disability, you'll receive regular payments.</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Need -->
    <section class="bg-primary-50 mt-16 lg:mt-20 py-12 lg:py-16">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr"><div class="heading-copy"><h2 class="title title-h4">Why Do You Need Disability Insurance?</h2></div><hr></div>
            <div class="section-content">
                <ul class="blogs-list-items">
                    <li>The risk of becoming disabled during your working years is higher than most people think</li>
                    <li>Your income supports your entire lifestyle-protecting it is essential</li>
                    <li>Without coverage, even a short-term disability could lead to financial hardship</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Who Should Consider -->
    <section class="mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading left-hr"><div class="heading-copy"><h2 class="title title-h4">Who Should Consider Disability Insurance?</h2></div><hr></div>
            <div class="section-content">
                <ul class="blogs-list-items">
                    <li>Self-employed professionals</li>
                    <li>Small business owners</li>
                    <li>Contractors and freelancers</li>
                    <li>Employees with or without group benefits</li>
                    <li>Anyone who relies on their income to support themselves or their family</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Why Punjab Insurance -->
    <section class="bg-brand-linear mt-16 lg:mt-20 py-12 lg:py-16">
        <div class="max-w-[1024px] mx-auto">
            <div class="container mx-auto px-4">
                <div class="section-heading center"><div class="heading-copy"><h2 class="title title-h4">Why Choose Punjab Insurance?</h2></div><hr></div>
                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                        <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/shield-user-multicolor-48.svg" alt="shield-user-multicolor"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Access to Canada's top insurers and competitive quotes</h6></div></div>
                        <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/hand-mortgage-multicolor-48.svg" alt="hand-mortgage-multicolor"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Expert advisors to help you compare options and choose the right coverage</h6></div></div>
                        <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/slider-multicolor-48.svg" alt="Transparent advice"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Transparent advice on the pros and cons of each option</h6></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading center"><div class="heading-copy"><h4 class="subheading">FREQUENTLY ASKED QUESTIONS</h4><h2 class="title title-h4">Frequently Asked Questions about<br>Disability Insurance</h2></div><hr></div>
            <div class="section-content">
                <div class="faq-accordion pb-8">
                    <div class="faq-item"><div class="faq-question">How much of my income can I protect?</div><div class="faq-answer">Most plans cover 60-85% of your gross income, subject to policy limits.</div></div>
                    <div class="faq-item"><div class="faq-question">What's the difference between elimination and benefit periods?</div><div class="faq-answer">Elimination period is the wait before benefits start; benefit period is how long payments last.</div></div>
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
                Safeguard your income if illness or injury stops you from working. Disability insurance provides dependable monthly support, helping you cover essential expenses and protect your family's financial stability while you focus on recovery.
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
    function validateProfession(show) {
        var $f = $('#profession'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Profession is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Please enter a valid profession.'); return false; }
        clearError($f); return true;
    }
    function validateIncome(show) {
        var $f = $('#income'), v = $f.val().trim();
        if (!v) { if (show) showError($f, 'Gross income is required.'); return false; }
        if (!/^[\d\s\$\,\.\+\-]+$/.test(v)) { if (show) showError($f, 'Please enter a valid income amount.'); return false; }
        clearError($f); return true;
    }
    function validateOtherQuestion(show) {
        var $f = $('#otherquestion'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Please enter your question or type N/A if none.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Please enter at least 2 characters.'); return false; }
        clearError($f); return true;
    }

    $('#tname').on('blur',           function () { validateName(true); });
    $('#contact_email').on('blur',   function () { validateEmail(true); });
    $('#tphone').on('blur',          function () { validatePhone(true); });
    $('#smoker').on('blur change',   function () { validateSmoker(true); });
    $('#gender').on('blur change',   function () { validateGender(true); });
    $('#profession').on('blur',      function () { validateProfession(true); });
    $('#income').on('blur',          function () { validateIncome(true); });
    $('#otherquestion').on('blur',   function () { validateOtherQuestion(true); });

    $('#tname, #contact_email, #tphone, #profession, #income, #otherquestion').on('input', function () { resetField($(this)); });

    $('#diinssubmit').on('click', function (e) {
        e.preventDefault();

        var valid =
            validateName(true) &
            validateEmail(true) &
            validatePhone(true) &
            validateSmoker(true) &
            validateGender(true) &
            validateProfession(true) &
            validateIncome(true) &
            validateOtherQuestion(true);

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