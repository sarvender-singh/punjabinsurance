
<?php

include 'includes/emailconfig.php';

// ── Initialise ────────────────────────────────────────────────────────────────
$errors    = [];
$form_data = [];

// ── Helper ────────────────────────────────────────────────────────────────────
function clean_ca(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

// ── Process POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect & sanitise text fields
    $full_name      = clean_ca($_POST['full_name']      ?? '');
    $email          = clean_ca($_POST['email']          ?? '');
    $phone          = clean_ca($_POST['phone']          ?? '');
    $currentCity    = clean_ca($_POST['currentCity']    ?? '');
    $totalExperience= clean_ca($_POST['totalExperience']?? '');
    $job_title      = clean_ca($_POST['job_title']      ?? '');
    $whyShouldHire  = clean_ca($_POST['whyShouldHire']  ?? '');

    $form_data = compact('full_name','email','phone','currentCity','totalExperience','job_title','whyShouldHire');

    // ── Validate text fields ──────────────────────────────────────────────────

    // Full Name
    if ($full_name === '') {
        $errors['full_name'] = 'Full name is required.';
    } elseif (mb_strlen($full_name) < 2) {
        $errors['full_name'] = 'Full name must be at least 2 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s\-']+$/u", $full_name)) {
        $errors['full_name'] = 'Name can only contain letters.';
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
        $errors['phone'] = 'Please enter a valid phone number (7–15 digits).';
    }

    // Current City
    if ($currentCity === '') {
        $errors['currentCity'] = 'Current city is required.';
    } elseif (mb_strlen($currentCity) < 2) {
        $errors['currentCity'] = 'Please enter a valid city name.';
    }

    // Experience
    $validExp = ['Fresher', '1-2 years', '2-5 years', '5+ years'];
    if ($totalExperience === '') {
        $errors['totalExperience'] = 'Please select your experience level.';
    } elseif (!in_array($totalExperience, $validExp)) {
        $errors['totalExperience'] = 'Please select a valid experience option.';
    }

    // Why should we hire you
    if ($whyShouldHire === '') {
        $errors['whyShouldHire'] = 'Please tell us why we should hire you.';
    } elseif (mb_strlen($whyShouldHire) < 10) {
        $errors['whyShouldHire'] = 'Please enter at least 10 characters.';
    }

    // ── Validate file upload ──────────────────────────────────────────────────
    $resume_data     = '';
    $resume_name     = '';
    $resume_type     = '';
    $has_resume      = false;

    if (empty($_FILES['resume']['name'])) {
        $errors['resume'] = 'Please upload your resume.';
    } elseif ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
        $errors['resume'] = 'File upload failed. Please try again.';
    } else {
        $allowed_types = ['application/pdf', 'application/msword',
                          'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $allowed_exts  = ['pdf', 'doc', 'docx'];
        $file_ext      = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
        $file_size     = $_FILES['resume']['size'];
        $file_type     = mime_content_type($_FILES['resume']['tmp_name']);

        if (!in_array($file_ext, $allowed_exts)) {
            $errors['resume'] = 'Only PDF, DOC, and DOCX files are allowed.';
        } elseif ($file_size > 5 * 1024 * 1024) { // 5 MB max
            $errors['resume'] = 'File size must not exceed 5 MB.';
        } else {
            $resume_data = base64_encode(file_get_contents($_FILES['resume']['tmp_name']));
            $resume_name = basename($_FILES['resume']['name']);
            $resume_type = $file_type;
            $has_resume  = true;
        }
    }

    // ── Send email with attachment if no errors ───────────────────────────────
    if (empty($errors)) {
$digits = preg_replace('/\D/', '', $phone);
    if (strlen($digits) === 10) {
        $phone = substr($digits, 0, 3) . '-' . substr($digits, 3, 3) . '-' . substr($digits, 6, 4);
    }
        $subject = 'Job Application - ' . ($job_title !== '' ? $job_title . ' - ' : '') . $phone;

        $html_body = '
        <table>
        <tr><td><strong>Job Applied For : </strong></td><td>' . ($job_title !== '' ? $job_title : 'Not specified') . '</td></tr>
        <tr><td><strong>Full Name : </strong></td><td>' . $full_name . '</td></tr>
        <tr><td><strong>Email : </strong></td><td>' . $email . '</td></tr>
        <tr><td><strong>Phone : </strong></td><td>' . $phone . '</td></tr>
        <tr><td><strong>Current City : </strong></td><td>' . $currentCity . '</td></tr>
        <tr><td><strong>Total Experience : </strong></td><td>' . $totalExperience . '</td></tr>
        <tr><td><strong>Why Should We Hire : </strong></td><td>' . nl2br($whyShouldHire) . '</td></tr>
        <tr><td><strong>Resume : </strong></td><td>' . ($has_resume ? $resume_name . ' (attached)' : 'Not provided') . '</td></tr>
        </table>';

        // ── Build multipart MIME email with attachment ─────────────────────────
        $boundary = '----=_Part_' . md5(uniqid(rand(), true));

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"' . "\r\n";
        $headers .= 'Bcc: ' . $bcc . "\r\n";
        $headers .= 'From: ' . $from_name . ' <' . $noreplyemail . '>' . "\r\nReply-to: " . $email;

        // Part 1 — HTML body
        $message  = '--' . $boundary . "\r\n";
        $message .= 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";
        $message .= 'Content-Transfer-Encoding: 7bit' . "\r\n\r\n";
        $message .= $html_body . "\r\n\r\n";

        // Part 2 — Resume attachment (if provided)
        if ($has_resume) {
            $message .= '--' . $boundary . "\r\n";
            $message .= 'Content-Type: ' . $resume_type . '; name="' . $resume_name . '"' . "\r\n";
            $message .= 'Content-Transfer-Encoding: base64' . "\r\n";
            $message .= 'Content-Disposition: attachment; filename="' . $resume_name . '"' . "\r\n\r\n";
            $message .= chunk_split($resume_data) . "\r\n";
        }

        $message .= '--' . $boundary . '--';

        if (mail($to_email, $subject, $message, $headers, '-f ' . $noreplyemail)) {
            header('Location: thankyou.php');
            exit;
        } else {
            $errors['_mail'] = 'Sorry, there was a problem sending your application. Please try again or contact us directly.';
        }
    }
}

// ── Page meta ─────────────────────────────────────────────────────────────────
$title            = "Become an Agent | Punjab Insurance Inc.";
$meta_description = "Join us and build your future with Punjab Insurance Inc.. Discover exciting insurance career opportunities, professional growth, and a supportive team success.";

include 'includes/header.php';
?>

<!-- Main -->
<main class="main">
    <!-- Hero -->
    <section class="hero-with-bg-image hero-overlay pt-12 pb-24 lg:pb-32 text-left lg:text-center" style="background-image: url('images/careers-hero-bg.webp');">
        <div class="hero-content">
            <div class="container mx-auto px-4">
                <nav class="breadcrumb light mt-0 flex justify-start lg:justify-center" aria-label="Breadcrumb">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="active">Careers</li>
                    </ol>
                </nav>
                <h1 class="hero-heading text-white">
                    <div class="text-accent-300">Pass the HLLQP Exam</div> and Join our Team
                </h1>
                <p class="hero-desc text-white mb-0">
                    We help in taking and completing the Harmonized Life License Qualification Program (HLLQP)
                </p>
            </div>
        </div>
        <div class="join-us-badge">
            <img src="images/joinpunjabinsurance.webp">
        </div>
    </section>

    <!-- Intro -->
    <section class="bg-brand-linear pt-24 lg:pt-28">
        <div class="container max-w-[960px] mx-auto px-4">
            <div class="section-heading center">
                <div class="heading-copy">
                    <h2 class="title">Be your own boss. Start your career with us and<br>shape your own success story</h2>
                </div>
                <hr>
            </div>
            <div class="section-content flex flex-col justify-center">
                <p class="text-body-base font-medium text-center mb-8">
                    At our company, we believe in empowering individuals to take charge of their future. This is more than just a job - it's an opportunity to build real skills, unlock your potential, and grow at your own pace. We provide the support, training, and environment you need to thrive, while giving you the freedom to create a career path that reflects your ambitions. Whether you're starting out or looking for a fresh challenge, your journey towards independence and achievement begins here.
                </p>
                <a href="#exploreJobs" class="btn btn-lg btn-filled-primary mx-auto">Explore Roles</a>
            </div>
        </div>

        <div class="careers-gallery mt-16">
            <div class="owl-carousel mb-1.5" id="career-gallery-carousel_1">
                <img src="images/photo-gallery/diwali-celebrations-in-bc-office/1_8_image.webp">
                <img src="images/photo-gallery/diwali-celebrations-in-bc-office/1_10_image.webp">
                <img src="images/photo-gallery/diwali-celebrations-in-bc-office/1_17_image.webp">
                <img src="images/photo-gallery/diwali-celebrations-in-bc-office/1_18_image.webp">
                <img src="images/photo-gallery/ontario-team/2_19_image.webp">
                <img src="images/photo-gallery/ontario-team/2_25_image.webp">
                <img src="images/photo-gallery/grand-opening-kitchener/4_37_image.webp">
                <img src="images/photo-gallery/grand-opening-kitchener/4_38_image.webp">
            </div>
            <div class="owl-carousel" id="career-gallery-carousel_2">
                <img src="images/photo-gallery/grand-opening-kitchener/4_39_image.webp">
                <img src="images/photo-gallery/grand-opening-kitchener/4_40_image.webp">
                <img src="images/photo-gallery/grand-opening-kitchener/4_42_image.webp">
                <img src="images/photo-gallery/new-year-2020-awards/5_48_image.webp">
                <img src="images/photo-gallery/new-year-2020-awards/5_84_image.webp">
                <img src="images/photo-gallery/new-year-2020-awards/5_92_image.webp">
                <img src="images/photo-gallery/new-year-2020-awards/5_94_image.webp">
                <img src="images/photo-gallery/bc-team/6_1_image.webp">
            </div>
        </div>
    </section>

    <!-- Why Join Us -->
    <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
        <div class="container mx-auto px-4">
            <div class="section-heading center">
                <div class="heading-copy">
                    <h4 class="subheading">WHY JOIN US</h4>
                    <h2 class="title">Your Career Map is in Your Hands</h2>
                </div>
                <hr>
                <p class="text-body-base font-medium text-gray-900">At Punjab Insurance Inc., we don't just provide insurance-we provide peace of mind, financial security, and opportunities for growth. Our people are at the heart of our success, and we're always looking for passionate, ambitious, and driven individuals to join our team.</p>
            </div>
            <div class="section-content">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/canada-flag-multicolor-48.svg" alt="Canada Wide Offices"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Canada Wide Offices</h6><p class="pointer-card__desc">Accessible locations supporting clients nationwide efficiently.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/money-bag-multicolor-48.svg" alt="Earn attractive commissions"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Earn attractive commissions</h6><p class="pointer-card__desc">Competitive payouts designed to maximize your earnings.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/health-insurance-document-multicolor-48.svg" alt="Health Care Expertise"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Health Care Expertise</h6><p class="pointer-card__desc">Strong industry knowledge ensuring accurate, reliable guidance.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/thumbs-up-multicolor-48.svg" alt="Outstanding Service Level"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Outstanding Service Level</h6><p class="pointer-card__desc">Consistently exceptional support for every client interaction.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/shield-check-multicolor-48.svg" alt="Trusted by Clients"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Trusted by Clients</h6><p class="pointer-card__desc">Proven credibility built through years of dependable service.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/award-badge-multicolor-48.svg" alt="Best hands-on training"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Best hands-on training</h6><p class="pointer-card__desc">Proven credibility built through years of dependable service.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/flexible-timing-multicolor-48.svg" alt="Offers flexibility and freedom"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Offers flexibility and freedom</h6><p class="pointer-card__desc">Work structure tailored to your lifestyle and goals.</p></div></div>
                    <div class="pointer-card values-card"><div class="pointer-card__icon"><img src="images/icons/customer-support-person-multicolor-48.svg" alt="Full-time support available"></div><div class="pointer-card__copy"><h6 class="card-common_heading">Full-time support available</h6><p class="pointer-card__desc">Dedicated assistance whenever you need professional help.</p></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore Jobs -->
    <section class="explore-jobs-section mt-16 lg:mt-20 py-12 lg:py-16" id="exploreJobs">
        <div class="container max-w-[1080px] mx-auto px-4">
            <div class="section-heading center">
                <div class="heading-copy"><h2 class="title text-white">Explore Jobs</h2></div>
                <hr class="bg-white">
            </div>
            <div class="section-content">
                <div class="jobs-list">
                    <div class="job-item"><div><h5 class="job-title">Sales and Business Development Associate</h5><p class="job-location">SURREY-FULL TIME</p></div><button class="job-apply-btn" data-job="Sales and Business Development Associate - Surrey">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Claims & Operations</h5><p class="job-location">BRAMPTON-FULL TIME</p></div><button class="job-apply-btn" data-job="Claims & Operations - Brampton">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Underwriting & Risk</h5><p class="job-location">CALGARY-FULL TIME</p></div><button class="job-apply-btn" data-job="Underwriting & Risk - Calgary">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Customer Support & Service</h5><p class="job-location">SURREY-FULL TIME</p></div><button class="job-apply-btn" data-job="Customer Support & Service - Surrey">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Technical & Digital</h5><p class="job-location">KITCHENER-FULL TIME</p></div><button class="job-apply-btn" data-job="Technical & Digital - Kitchener">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Specialist Roles</h5><p class="job-location">ABBOTSFORD-FULL TIME</p></div><button class="job-apply-btn" data-job="Specialist Roles - Abbotsford">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Sales and Business Development Associate</h5><p class="job-location">EDMONTON-FULL TIME</p></div><button class="job-apply-btn" data-job="Sales and Business Development Associate - Edmonton">Apply Now</button></div>
                    <div class="job-item"><div><h5 class="job-title">Sales and Business Development Associate</h5><p class="job-location">MONTREAL-FULL TIME</p></div><button class="job-apply-btn" data-job="Sales and Business Development Associate - Montreal">Apply Now</button></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fomo Quote -->
    <section class="max-w-[800px] mx-auto mt-16 lg:mt-20 mb-16 lg:mb-0">
        <div class="container mx-auto px-4">
            <div class="fomo-quote">
                <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                At Punjab Insurance Inc. we believe in empowering talent to shape the future of insurance. Grow, innovate, and make an impact every day. Join us and be part of a team that values ambition, integrity, and excellence.
            </div>
        </div>
    </section>
</main>

<!-- Job Application Modal -->
<div id="jobModal" class="modal-container">
    <div class="modal-box">
        <span id="modalClose" class="modal-close">&times;</span>
        <h3 class="product-quote-form-heading mb-8">Apply for <span id="modalJobTitle">this Job</span></h3>

        <?php if (!empty($errors['_mail'])) : ?>
        <div style="background:#fff5f5;border:1px solid #dc2626;border-radius:8px;padding:14px 16px;display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;font-size:0.9rem;color:#111827;font-weight:500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="#dc2626" style="flex-shrink:0;margin-top:1px">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <?= htmlspecialchars($errors['_mail']) ?>
        </div>
        <?php endif; ?>

        <form id="jobApplicationForm" class="product-quote-form" method="POST"
              action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"
              enctype="multipart/form-data" novalidate>

            <div class="grid grid-cols-12 gap-4 lg:gap-6">

                <!-- Hidden job title -->
                <input type="hidden" name="job_title" id="job_title" value="<?= htmlspecialchars($form_data['job_title'] ?? '') ?>">

                <!-- Full Name -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="fullName">Full Name <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="text" id="fullName" name="full_name" placeholder="Enter Full Name"
                                   class="input-field <?= isset($errors['full_name']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['full_name']) ? 'is-valid' : '') ?>"
                                   value="<?= htmlspecialchars($form_data['full_name'] ?? '') ?>" required>
                        </div>
                        <?php if (isset($errors['full_name'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['full_name']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="email">Email <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="Enter Email Id"
                                   class="input-field <?= isset($errors['email']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['email']) ? 'is-valid' : '') ?>"
                                   value="<?= htmlspecialchars($form_data['email'] ?? '') ?>" required>
                        </div>
                        <?php if (isset($errors['email'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="phone">Phone Number <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number"
                                   class="input-field <?= isset($errors['phone']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['phone']) ? 'is-valid' : '') ?>"
                                   value="<?= htmlspecialchars($form_data['phone'] ?? '') ?>" required>
                        </div>
                        <?php if (isset($errors['phone'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['phone']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Current City -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="currentCity">Current City <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="text" id="currentCity" name="currentCity" placeholder="Enter Current City"
                                   class="input-field <?= isset($errors['currentCity']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['currentCity']) ? 'is-valid' : '') ?>"
                                   value="<?= htmlspecialchars($form_data['currentCity'] ?? '') ?>" required>
                        </div>
                        <?php if (isset($errors['currentCity'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['currentCity']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Experience -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="totalExperience">Total Experience <span>*</span></label>
                        <div class="input-wrapper">
                            <select class="input-field <?= isset($errors['totalExperience']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['totalExperience']) ? 'is-valid' : '') ?>"
                                    id="totalExperience" name="totalExperience" required>
                                <option value="">Select Experience</option>
                                <option value="Fresher"    <?= ($form_data['totalExperience'] ?? '') === 'Fresher'    ? 'selected' : '' ?>>Fresher</option>
                                <option value="1-2 years"  <?= ($form_data['totalExperience'] ?? '') === '1-2 years'  ? 'selected' : '' ?>>1-2 years</option>
                                <option value="2-5 years"  <?= ($form_data['totalExperience'] ?? '') === '2-5 years'  ? 'selected' : '' ?>>2-5 years</option>
                                <option value="5+ years"   <?= ($form_data['totalExperience'] ?? '') === '5+ years'   ? 'selected' : '' ?>>5+ years</option>
                            </select>
                        </div>
                        <?php if (isset($errors['totalExperience'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['totalExperience']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Resume Upload -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="input-group">
                        <label class="input-label" for="uploadResume">Upload Resume (PDF or DOC) <span>*</span></label>
                        <div class="input-wrapper">
                            <input type="file" name="resume" id="uploadResume"
                                   class="input-field <?= isset($errors['resume']) ? 'is-invalid' : '' ?>"
                                   accept=".pdf,.doc,.docx">
                        </div>
                        <?php if (isset($errors['resume'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['resume']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Why Should We Hire -->
                <div class="col-span-12">
                    <div class="input-group">
                        <label class="input-label" for="whyShouldHire">Why should we hire you? <span>*</span></label>
                        <div class="input-wrapper">
                            <textarea id="whyShouldHire" name="whyShouldHire" rows="4"
                                      placeholder="Write your message..."
                                      class="input-field <?= isset($errors['whyShouldHire']) ? 'is-invalid' : (!empty($form_data) && !isset($errors['whyShouldHire']) ? 'is-valid' : '') ?>"><?= htmlspecialchars($form_data['whyShouldHire'] ?? '') ?></textarea>
                        </div>
                        <?php if (isset($errors['whyShouldHire'])) : ?><span class="error-msg"><?= htmlspecialchars($errors['whyShouldHire']) ?></span><?php endif; ?>
                    </div>
                </div>

                <!-- Submit -->
                <div class="col-span-12">
                    <button type="submit" id="cainssubmit" class="btn btn-lg btn-filled-primary w-full">
                        <span>Submit Application</span>
                        <img src="images/icons/send-plane.svg" width="14" alt="send-plane">
                    </button>
                </div>

            </div>
        </form>

        <?php if (!empty($errors) && !isset($errors['_mail'])) : ?>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('jobModal');
            if (modal) {
                modal.style.display = 'flex';
                var el = document.getElementById('jobApplicationForm');
                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
        </script>
        <?php endif; ?>

    </div>
</div>

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

    // ── Modal open/close ──────────────────────────────────────────────────────
    $('.job-apply-btn').on('click', function () {
        var jobTitle = $(this).data('job') || '';
        $('#job_title').val(jobTitle);
        $('#modalJobTitle').text(jobTitle || 'this Job');
        $('#jobModal').fadeIn(200);
        $('body').css('overflow', 'hidden');
    });

    $('#modalClose').on('click', function () {
        $('#jobModal').fadeOut(200);
        $('body').css('overflow', '');
    });

    $('#jobModal').on('click', function (e) {
        if ($(e.target).is('#jobModal')) {
            $('#jobModal').fadeOut(200);
            $('body').css('overflow', '');
        }
    });

    // ── Error helpers ─────────────────────────────────────────────────────────
    function showError($f, msg) {
        $f.removeClass('is-valid').addClass('is-invalid');
        $f.closest('.input-group').find('.error-msg').remove();
        $f.closest('.input-group').append('<span class="error-msg">' + msg + '</span>');
    }
    function clearError($f) {
        $f.removeClass('is-invalid').addClass('is-valid');
        $f.closest('.input-group').find('.error-msg').remove();
    }
    function resetField($f) {
        $f.removeClass('is-invalid is-valid');
        $f.closest('.input-group').find('.error-msg').remove();
    }

    function isValidEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function isValidPhone(v) { return /^[\d\s\-\+\(\)]{7,15}$/.test(v.trim()); }

    // ── Per-field validators ──────────────────────────────────────────────────
    function validateFullName(show) {
        var $f = $('#fullName'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Full name is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Name must be at least 2 characters.'); return false; }
        if (!/^[a-zA-Z\s\-']+$/.test(v)) { if (show) showError($f, 'Name can only contain letters.'); return false; }
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
    function validateCity(show) {
        var $f = $('#currentCity'), v = $f.val().trim();
        if (!v)           { if (show) showError($f, 'Current city is required.'); return false; }
        if (v.length < 2) { if (show) showError($f, 'Please enter a valid city name.'); return false; }
        clearError($f); return true;
    }
    function validateExperience(show) {
        var $f = $('#totalExperience'), v = $f.val();
        if (!v) { if (show) showError($f, 'Please select your experience level.'); return false; }
        clearError($f); return true;
    }
    function validateResume(show) {
        var $f = $('#uploadResume');
        var files = $f[0].files;
        if (!files || files.length === 0) {
            if (show) showError($f, 'Please upload your resume.');
            return false;
        }
        var name = files[0].name.toLowerCase();
        var size = files[0].size;
        var validExts = ['pdf', 'doc', 'docx'];
        var ext = name.split('.').pop();
        if (validExts.indexOf(ext) === -1) {
            if (show) showError($f, 'Only PDF, DOC, and DOCX files are allowed.');
            return false;
        }
        if (size > 5 * 1024 * 1024) {
            if (show) showError($f, 'File size must not exceed 5 MB.');
            return false;
        }
        clearError($f); return true;
    }
    function validateMessage(show) {
        var $f = $('#whyShouldHire'), v = $f.val().trim();
        if (!v)            { if (show) showError($f, 'Please tell us why we should hire you.'); return false; }
        if (v.length < 10) { if (show) showError($f, 'Please enter at least 10 characters.'); return false; }
        clearError($f); return true;
    }

    // ── Blur / change events ──────────────────────────────────────────────────
    $('#fullName').on('blur',           function () { validateFullName(true); });
    $('#email').on('blur',              function () { validateEmail(true); });
    $('#phone').on('blur',              function () { validatePhone(true); });
    $('#currentCity').on('blur',        function () { validateCity(true); });
    $('#totalExperience').on('change',  function () { validateExperience(true); });
    $('#uploadResume').on('change',     function () { validateResume(true); });
    $('#whyShouldHire').on('blur',      function () { validateMessage(true); });

    $('#fullName, #email, #phone, #currentCity, #whyShouldHire').on('input', function () {
        resetField($(this));
    });

    // ── Submit ────────────────────────────────────────────────────────────────
    $('#jobApplicationForm').on('submit', function (e) {
        e.preventDefault();

        var valid =
            validateFullName(true)   &
            validateEmail(true)      &
            validatePhone(true)      &
            validateCity(true)       &
            validateExperience(true) &
            validateResume(true)     &
            validateMessage(true);

        if (!valid) {
            var $first = $('#jobApplicationForm .is-invalid').first();
            if ($first.length) {
                $('html, body').animate({ scrollTop: $first.closest('.input-group').offset().top - 120 }, 380);
                $first.focus();
            }
            return;
        }

        // Disable button and show spinner
        var $btn = $('#cainssubmit');
        $btn.prop('disabled', true);
        $btn.find('span').text('Submitting...');
        $btn.append('<span class="btn-spinner"></span>');

        // Submit the actual form (multipart for file upload)
        this.submit();
    });

});
</script>