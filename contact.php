<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_ct(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fullname = clean_ct($_POST['fullName'] ?? '');
    $email    = clean_ct($_POST['email']    ?? '');
    $phone    = clean_ct($_POST['phone']    ?? '');
    $message  = clean_ct($_POST['message']  ?? '');

    $form_data = compact('fullname', 'email', 'phone', 'message');

    // Full Name
    if ($fullname === '') {
        $errors['fullName'] = 'Full name is required.';
    } elseif (mb_strlen($fullname) < 2) {
        $errors['fullName'] = 'Full name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $fullname)) {
        $errors['fullName'] = 'Full name can only contain letters.';
    }

    // Email
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Phone
    if ($phone === '') {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]{7,15}$/', $phone)) {
        $errors['phone'] = 'Please enter a valid phone number (7-15 digits).';
    }

    // Message — optional but if filled must be at least 5 chars
    if ($message !== '' && mb_strlen($message) < 5) {
        $errors['message'] = 'Message must be at least 5 characters.';
    }

    // ── Send email if no errors ───────────────────────────────────────────────
    if (empty($errors)) {
$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Contact Us - ' . $phone;

        $message_row = $message !== '' ? '<tr><td><strong>Message : </strong></td><td>' . nl2br($message) . '</td></tr>' : '';

        $mail_body = '
        <table>
        <tr><td><strong>Full Name : </strong></td><td>' . $fullname . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
        ' . $message_row . '
        </table>';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'Bcc: ' . $bcc . "\r\n";
        $headers .= 'From: ' . $from_name . ' <' . $noreplyemail . '>' . "\r\nReply-to: " . $email;

        if (mail($to_email, $subject, $mail_body, $headers, '-f ' . $noreplyemail)) {
            header('Location: thankyou.php');
            exit;
        } else {
            $errors['_mail'] = 'Sorry, there was a problem sending your message. Please try again or call us directly.';
        }
    }
}

// ── Page meta ─────────────────────────────────────────────────────────────────
$title            = "Contact Punjab Insurance Toronto & Surrey, BC";
$meta_description = "Contact Punjab Insurance offices in Toronto (Etobicoke), Surrey BC, Brampton & across Canada. Call 1-888-978-6522 for free insurance quotes today.";

include 'includes/header.php';
?>

<!-- Main -->
<main class="main">
    <!-- Hero -->
    <section class="bg-primary-50 py-12">
        <div class="hero-content">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-16 gap-y-9 lg:gap-y-0">
                    <div class="col-span-12 lg:col-span-6">
                        <nav class="breadcrumb mt-0" aria-label="Breadcrumb">
                            <ol>
                                <li><a href="/">Home</a></li>
                                <li class="active">Contact Us</li>
                            </ol>
                        </nav>
                        <h1 class="hero-heading text-primary-900">
                            <span class="text-primary-500">Contact Punjab Insurance</span> Offices at 11 different Locations
                        </h1>
                        <p class="hero-desc text-gray-700 mb-0">
                            Punjab Insurance is at your services 24 hours for 365 days. We have our offices in different provinces of Canada. If you can't get in touch through our local number, give us a call on Toll Free number. Otherwise just <a href="tel:+18889786522" class="text-primary-500 underline">Click Here</a> and we will call you.
                        </p>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="grid xl:grid-cols-2 gap-6 mb-6">
                            <div class="text-body-lg font-bold">
                                <p class="mb-2">Mail Us</p>
                                <a href="mailto:admin@punjabinsurance.ca" class="text-primary-500 underline">admin@punjabinsurance.ca</a>
                            </div>
                            <div class="text-body-lg font-bold">
                                <p class="mb-2">Call Us</p>
                                <a href="tel:+18889786522" class="text-primary-500 underline">1-888-978-6522</a>
                            </div>
                        </div>
                        <div class="grid">
                            <p class="text-body-lg font-bold mb-2">Follow Us</p>
                            <ul class="footer-social-links">
                                <li><a href="https://www.facebook.com/PunjabInsurance.ca/" title="facebook" target="_blank"><img src="images/icons/icon-facebook.svg"></a></li>
                                <li><a href="https://x.com/punjabinsurance" title="X" target="_blank"><img src="images/icons/icon-x.svg"></a></li>
                                <li><a href="https://www.linkedin.com/404/" title="linkedin" target="_blank"><img src="images/icons/icon-linkedin.svg"></a></li>
                                <li><a href="https://in.pinterest.com/punjabinsurance/" title="pinterest" target="_blank"><img src="images/icons/Icon-pinterest.svg"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="max-w-[1024px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">

            <?php if (!empty($errors['_mail'])) : ?>
            <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:24px;font-size:0.9rem;color:#111827;font-weight:500;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <?= htmlspecialchars($errors['_mail']) ?>
            </div>
            <?php endif; ?>

            <form id="contactForm" method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                <div class="grid grid-cols-12 gap-6">

                    <!-- Full Name -->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="input-group">
                            <label class="input-label" for="fullName">Full Name <span>*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="currentColor"/></svg>
                                </span>
                                <input type="text" id="fullName" name="fullName" class="input-field pl-10 <?= isset($errors['fullName']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['fullName']) ? 'is-valid' : '') ?>"
                                    placeholder="Enter Full Name"
                                    value="<?= htmlspecialchars($form_data['fullname'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['fullName'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['fullName']) ?></span><?php endif; ?>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="input-group">
                            <label class="input-label" for="email">Email <span>*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none"><path d="M2 16C1.45 16 0.979333 15.8043 0.588 15.413C0.196667 15.0217 0.000666667 14.5507 0 14V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196666 1.45067 0.000666667 2 0H18C18.55 0 19.021 0.196 19.413 0.588C19.805 0.98 20.0007 1.45067 20 2V14C20 14.55 19.8043 15.021 19.413 15.413C19.0217 15.805 18.5507 16.0007 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V14V4Z" fill="currentColor"/></svg>
                                </span>
                                <input type="email" id="email" name="email" class="input-field pl-10 <?= isset($errors['email']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['email']) ? 'is-valid' : '') ?>"
                                    placeholder="Enter Email Id"
                                    value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['email'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-span-12 lg:col-span-4">
                        <div class="input-group">
                            <label class="input-label" for="phone">Phone Number <span>*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 15.5833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="currentColor"/></svg>
                                </span>
                                <input type="tel" id="phone" name="phone" class="input-field pl-10 <?= isset($errors['phone']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['phone']) ? 'is-valid' : '') ?>"
                                    placeholder="Enter Phone Number"
                                    value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" required>
                            </div>
                            <?php if (isset($errors['phone'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['phone']) ?></span><?php endif; ?>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="col-span-12">
                        <div class="input-group">
                            <label class="input-label" for="message">Message</label>
                            <div class="input-wrapper">
                                <textarea id="message" name="message" rows="4"
                                    class="input-field <?= isset($errors['message']) ? 'is-invalid' : (!empty($form_data) && $form_data['message'] !== '' && !isset($errors['message']) ? 'is-valid' : '') ?>"
                                    placeholder="Write your message..."><?= htmlspecialchars($form_data['message'] ?? '') ?></textarea>
                            </div>
                            <?php if (isset($errors['message'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['message']) ?></span><?php endif; ?>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-span-12">
                        <button type="submit" id="contactSubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                            <span>Submit</span>
                            <img src="images/icons/send-plane.svg" width="14" alt="send-plane">
                        </button>
                    </div>

                </div>
            </form>

            <?php if (!empty($errors) && !isset($errors['_mail'])) : ?>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                var el = document.getElementById('contactForm');
                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
            </script>
            <?php endif; ?>

        </div>
    </section>

    <!-- Office Locations -->
    <section class="mt-16 lg:mt-20 mb-16 md:mb-0">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-0 xl:gap-6 mb-6">
                <div class="col-span-12 xl:col-span-9">
                    <div class="location-card">
                        <img src="images/office/head-office.webp" alt="Punjab Insurance Head Office" title="Punjab Insurance Head Office">
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-3">
                    <div class="location-card-head-office">
                        <div class="office-building-icon"><img src="images/icons/office-building.svg"></div>
                        <div class="ho-title-chip">Head Office: Toronto</div>
                        <h6 class="ho-company">Punjab Insurance Inc.</h6>
                        <div class="ho-contact">
                            <div>
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M9.14844 7.48828C8.58844 7.48828 8.14844 7.93828 8.14844 8.48828C8.14844 9.03828 8.59844 9.48828 9.14844 9.48828C9.69844 9.48828 10.1484 9.03828 10.1484 8.48828C10.1484 7.93828 9.69844 7.48828 9.14844 7.48828Z" fill="#111827"></path><path d="M21.46 5.04C20.62 3.09 18.77 2 16.19 2H7.81C4.6 2 2 4.6 2 7.81V16.19C2 18.77 3.09 20.62 5.04 21.46C5.23 21.54 5.45 21.49 5.59 21.35L21.35 5.59C21.5 5.44 21.55 5.22 21.46 5.04ZM10.53 12.24C10.14 12.62 9.63 12.8 9.12 12.8C8.61 12.8 8.1 12.61 7.71 12.24C6.69 11.28 5.57 9.75 6 7.93C6.38 6.28 7.84 5.54 9.12 5.54C10.4 5.54 11.86 6.28 12.24 7.94C12.66 9.75 11.54 11.28 10.53 12.24Z" fill="#111827"></path><path d="M19.4689 20.5295C19.6889 20.7495 19.6589 21.1095 19.3889 21.2595C18.5089 21.7495 17.4389 21.9995 16.1889 21.9995H7.80892C7.51892 21.9995 7.39892 21.6595 7.59892 21.4595L13.6389 15.4195C13.8389 15.2195 14.1489 15.2195 14.3489 15.4195L19.4689 20.5295Z" fill="#111827"></path><path d="M22.0017 7.80892V16.1889C22.0017 17.4389 21.7517 18.5189 21.2617 19.3889C21.1117 19.6589 20.7517 19.6789 20.5317 19.4689L15.4117 14.3489C15.2117 14.1489 15.2117 13.8389 15.4117 13.6389L21.4517 7.59892C21.6617 7.39892 22.0017 7.51892 22.0017 7.80892Z" fill="#111827"></path></g></svg>
                                <p><a href="https://maps.app.goo.gl/SeA9eoxCoR3Er1yL8" target="_blank">7003 Steeles Ave.W Unit 10, Etobicoke, Ontario M9W 0A2</a></p>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M19.95 21C17.8667 21 15.8083 20.546 13.775 19.638C11.7417 18.73 9.89167 17.4423 8.225 15.775C6.55833 14.1077 5.271 12.2577 4.363 10.225C3.455 8.19233 3.00067 6.134 3 4.05C3 3.75 3.1 3.5 3.3 3.3C3.5 3.1 3.75 3 4.05 3H8.1C8.33333 3 8.54167 3.07933 8.725 3.238C8.90833 3.39667 9.01667 3.584 9.05 3.8L9.7 7.3C9.73333 7.56667 9.725 7.79167 9.675 7.975C9.625 8.15833 9.53333 8.31667 9.4 8.45L6.975 10.9C7.30833 11.5167 7.704 12.1123 8.162 12.687C8.62 13.2617 9.12433 13.816 9.675 14.35C10.1917 14.8667 10.7333 15.346 11.3 15.788C11.8667 16.23 12.4667 16.634 13.1 17L15.45 14.65C15.6 14.5 15.796 14.3877 16.038 14.313C16.28 14.2383 16.5173 14.2173 16.75 14.25L20.2 14.95C20.4333 15.0167 20.625 15.1377 20.775 15.313C20.925 15.4883 21 15.684 21 15.9V19.95C21 20.25 20.9 20.5 20.7 20.7C20.5 20.9 20.25 21 19.95 21Z" fill="#111827"/></svg>
                                <p>Ph: <a href="tel:+18889786522">1-888-978-6522</a></p>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M8 20V4H18V9H19C19.8333 9 20.5417 9.29167 21.125 9.875C21.7083 10.4583 22 11.1667 22 12V20H8ZM4.5 21C5.2 21 5.79167 20.7583 6.275 20.275C6.75833 19.7917 7 19.2 7 18.5V10.5C7 9.8 6.75833 9.20833 6.275 8.725C5.79167 8.24167 5.2 8 4.5 8C3.8 8 3.20833 8.24167 2.725 8.725C2.24167 9.20833 2 9.8 2 10.5V18.5C2 19.2 2.24167 19.7917 2.725 20.275C3.20833 20.7583 3.8 21 4.5 21ZM10 9H16V6H10V9ZM16 14C16.2833 14 16.521 13.904 16.713 13.712C16.905 13.52 17.0007 13.2827 17 13C16.9993 12.7173 16.9033 12.48 16.712 12.288C16.5207 12.096 16.2833 12 16 12C15.7167 12 15.4793 12.096 15.288 12.288C15.0967 12.48 15.0007 12.7173 15 13C14.9993 13.2827 15.0953 13.5203 15.288 13.713C15.4807 13.9057 15.718 14.0013 16 14ZM19 14C19.2833 14 19.521 13.904 19.713 13.712C19.905 13.52 20.0007 13.2827 20 13C19.9993 12.7173 19.9033 12.48 19.712 12.288C19.5207 12.096 19.2833 12 19 12C18.7167 12 18.4793 12.096 18.288 12.288C18.0967 12.48 18.0007 12.7173 18 13C17.9993 13.2827 18.0953 13.5203 18.288 13.713C18.4807 13.9057 18.718 14.0013 19 14ZM16 17C16.2833 17 16.521 16.904 16.713 16.712C16.905 16.52 17.0007 16.2827 17 16C16.9993 15.7173 16.9033 15.48 16.712 15.288C16.5207 15.096 16.2833 15 16 15C15.7167 15 15.4793 15.096 15.288 15.288C15.0967 15.48 15.0007 15.7173 15 16C14.9993 16.2827 15.0953 16.5203 15.288 16.713C15.4807 16.9057 15.718 17.0013 16 17ZM19 17C19.2833 17 19.521 16.904 19.713 16.712C19.905 16.52 20.0007 16.2827 20 16C19.9993 15.7173 19.9033 15.48 19.712 15.288C19.5207 15.096 19.2833 15 19 15C18.7167 15 18.4793 15.096 18.288 15.288C18.0967 15.48 18.0007 15.7173 18 16C17.9993 16.2827 18.0953 16.5203 18.288 16.713C18.4807 16.9057 18.718 17.0013 19 17ZM10 17H14V12H10V17Z" fill="#1A1A1A"/></svg>
                                <p>Fax: <a href="tel:+18882793270">1-888-279-3270</a></p>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"><path d="M22 7.53503V17C22 17.7652 21.7077 18.5015 21.1827 19.0583C20.6578 19.615 19.9399 19.9501 19.176 19.995L19 20H5C4.23479 20.0001 3.49849 19.7077 2.94174 19.1828C2.38499 18.6578 2.04989 17.9399 2.005 17.176L2 17V7.53503L11.445 13.832L11.561 13.898C11.6977 13.9648 11.8478 13.9995 12 13.9995C12.1522 13.9995 12.3023 13.9648 12.439 13.898L12.555 13.832L22 7.53503Z" fill="#1A1A1A"/><path d="M19.0003 4C20.0803 4 21.0273 4.57 21.5553 5.427L12.0003 11.797L2.44531 5.427C2.6961 5.01982 3.0406 4.6785 3.45008 4.43149C3.85957 4.18448 4.32217 4.03894 4.79931 4.007L5.00031 4H19.0003Z" fill="#1A1A1A"/></svg>
                                <p>Email: <a href="mailto:admin@punjabinsurance.ca">admin@punjabinsurance.ca</a></p>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/SeA9eoxCoR3Er1yL8" target="_blank" class="btn btn-sm btn-outline-primary mt-6">Get Directions</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/surrey-office.webp" alt="Punjab Insurance Surrey office" title="Punjab Insurance Surrey Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Surrey</h5><p class="office-address">Payal Business Centre, 301-8128 128th Street, Surrey, BC V3W 1R1</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/HGiZT5JN5YKZ3HcE9" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
				<!--
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/brampton-north-west-office.webp" alt="Punjab Insurance Brampton North West Office" title="Punjab Insurance Brampton North West Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Brampton North West</h5><p class="office-address">Unit 109 - 5 Brisdale Dr Brampton, ON L7A 0S9</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/YrNtNqUvq79FoyHS6" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>-->
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/brampton-office.webp" alt="Punjab Insurance Brampton Office" title="Punjab Insurance Brampton Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Brampton</h5><p class="office-address">50 Sunny Meadow Blvd Unit 106, Brampton, ON L6R 0Y7</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/BoxQrLZZcvqtCiU49" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/calgary-office.webp" alt="Punjab Insurance Calgary Office" title="Punjab Insurance Calgary Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Calgary</h5><p class="office-address">303 - 7 Westwinds Cres. NE, Calgary AB T3J 5H2</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/McbpU48D6RBXGEsFA" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/surrey-v3s-office.webp" alt="Punjab Insurance Surrey Office" title="Punjab Insurance Surrey Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Surrey</h5><p class="office-address">#103, 15300 68 ave Surrey, BC V3S 2B9</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/yw9NcdJz4e8CobF8A" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/kitchener-office.webp" alt="Punjab Insurance Kitchener Office" title="Punjab Insurance Kitchener Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Kitchener</h5><p class="office-address"><strong>Huron Crossing Plaza</strong><br>Unit# 224 - Second Floor, Building #2, 1415 Huron Road, Kitchener - Ontario</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/Q29xVwygZy2RpgiNA" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/abbotsford-office.webp" alt="Punjab Insurance Abbotsford Office" title="Punjab Insurance Abbotsford Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Abbotsford</h5><p class="office-address">#148 - 32050 Cedar Lane, Abbotsford, BC V2T 0L4</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/XpDsKUAF2mSnZLcD7" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/edmonton-office.webp" alt="Punjab Insurance Edmonton Office" title="Punjab Insurance Edmonton Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Edmonton</h5><p class="office-address">9130 34A Ave NW Edmonton, AB T6E 5P4</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/9t5Aa8tPxUkLmgXHA" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/montreal-office.webp" alt="Punjab Insurance Montreal Office" title="Punjab Insurance Montreal Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Montreal</h5><p class="office-address">4513 Boul. Des Sources, Montreal, Québec H8Y 3C2</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/xJvxY7eHzqqdNWbC8" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/calgary-5102-office.webp" alt="Punjab Insurance Calgary Office" title="Punjab Insurance Calgary Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Calgary</h5><p class="office-address">Unit 5102 4310 104 Ave NE Calgary AB</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/cvpHa9JWJqM8jCgi9" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/calgary-jacksonport-office.webp" alt="Punjab Insurance Calgary Jacksonport Office" title="Punjab Insurance Calgary Jacksonport Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Calgary</h5><p class="office-address"><strong>Jacksonport Professional Centre</strong><br>3730 108 Ave NE #1129 Calgary AB T3N 1V9</p><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul><a href="https://maps.app.goo.gl/gJTuWoHm6gKvtN3M8" target="_blank" class="btn mt-2">Get Directions</a></div></div></div></div>
				<!--
                <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3"><div class="location-card"><img src="images/office/placeholder-office.webp" alt="Punjab Insurance Nova Scotia Office" title="Punjab Insurance Nova Scotia Office"><div class="location-card-copy"><div class="location-card-content"><h5 class="office-location">Nova Scotia</h5><ul class="office-contact"><li>Ph: <a href="tel:+18889786522">1-888-978-6522</a></li></ul></div></div></div></div>-->
            </div>
        </div>
    </section>
</main>

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

    function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function isValidPhone(v) { return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim()); }

    // ── Per-field validators ──────────────────────────────────────────────────
    function validateFullName(show) {
        var $f = $('#fullName'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Full name is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Full name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if (show) showError($f, 'Full name can only contain letters.'); return false; }
        clearError($f); return true;
    }
    function validateEmail(show) {
        var $f = $('#email'), v = $f.val().trim();
        if (!v)               { if (show) showError($f, 'Email is required.'); return false; }
        if (!isValidEmail(v)) { if (show) showError($f, 'Please enter a valid email address.'); return false; }
        clearError($f); return true;
    }

	function validatePhone(show) {
    var $f = $('#phone'), v = $f.val().trim();
    
    // Only accepts: 4165551234 or 416-555-1234
    var canadianPhone = /^\d{10}$|^\d{3}-\d{3}-\d{4}$/;
    
    if (!v)                     { if(show) showError($f, 'Phone number is required.'); return false; }
    if (!canadianPhone.test(v)) { if(show) showError($f, 'Please enter a valid phone number (e.g. 4165551234 or 416-555-1234).'); return false; }
    
    clearError($f); return true;
}
    function validateMessage(show) {
        var $f = $('#message'), v = $f.val().trim();
        // Optional — only validate if not empty
        if (v !== '' && v.length < 5) {
            if (show) showError($f, 'Message must be at least 5 characters.');
            return false;
        }
        if (v !== '') clearError($f);
        else resetField($f);
        return true;
    }

    // ── Blur / input events ───────────────────────────────────────────────────
    $('#fullName').on('blur',  function () { validateFullName(true); });
    $('#email').on('blur',     function () { validateEmail(true); });
    $('#phone').on('blur',     function () { validatePhone(true); });
    $('#message').on('blur',   function () { validateMessage(true); });

    $('#fullName, #email, #phone').on('input', function () { resetField($(this)); });
    $('#message').on('input', function () {
        if ($(this).val().trim() === '') resetField($(this));
        else validateMessage(false);
    });

    // ── Form submit ───────────────────────────────────────────────────────────
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        var valid =
            validateFullName(true) &
            validateEmail(true)    &
            validatePhone(true)    &
            validateMessage(true);

        if (!valid) {
            var $first = $('.is-invalid').first();
            if ($first.length) {
                $('html, body').animate({ scrollTop: $first.closest('.input-group').offset().top - 120 }, 380);
                $first.focus();
            }
            return;
        }

        var $btn = $('#contactSubmit');
        $btn.prop('disabled', true);
        $btn.find('span').text('Submitting...');
        $btn.append('<span class="btn-spinner"></span>');
        this.submit();
    });

});
</script>