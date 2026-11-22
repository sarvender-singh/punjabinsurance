<?php

// ================================
// SAFE API FETCH FUNCTION
// ================================
function fetch_wp_api($url) {

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    if (function_exists('curl_init')) {

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ]
        ]);

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            error_log('cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            return false;
        }

        return $response;

    } else {

        return @file_get_contents($url);

    }
}


// ================================
// SAFE JSON DECODE FUNCTION
// ================================
function get_json_data($url) {

    $response = fetch_wp_api($url);

    if (!$response) {
        return [];
    }

    $data = json_decode($response);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return [];
    }

    return $data;
}


// ================================
// SAFE OUTPUT
// ================================
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}


// ================================
// FILTERS
// ================================
$cat_slug = $_GET['cat_slug'] ?? '';
$archive_filter = $_GET['archive'] ?? '';

$category_id = '';
$page_heading = "Recent Blogs";

$start_date = '';
$end_date = '';


// ================================
// CATEGORY FILTER
// ================================
if (!empty($cat_slug)) {

    $cat_data = get_json_data(
        "https://blog.punjabinsurance.ca/wp-json/wp/v2/categories?slug=" . urlencode($cat_slug)
    );

    if (!empty($cat_data)) {

        $category_id = $cat_data[0]->id ?? '';

        $page_heading = strip_tags($cat_data[0]->name ?? '') . " Blogs";
    }
}


// ================================
// ARCHIVE FILTER
// ================================
if (!empty($archive_filter)) {

    $year_month = explode('-', $archive_filter);

    if (count($year_month) === 2) {

        $start_date = "{$year_month[0]}-{$year_month[1]}-01T00:00:00";

        $end_date = date(
            "Y-m-t\T23:59:59",
            strtotime($start_date)
        );

        $page_heading = "Archive: " . date(
            "F Y",
            strtotime($start_date)
        );
    }
}


// ================================
// API DATA
// ================================
$slider_posts = get_json_data(
    "https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_embed&per_page=4"
);

$sidebar_posts = get_json_data(
    "https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_embed&per_page=5"
);

$categories = get_json_data(
    "https://blog.punjabinsurance.ca/wp-json/wp/v2/categories?hide_empty=1"
);

$archive_posts_api = get_json_data(
    "https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_fields=date&per_page=100"
);


// ================================
// ARCHIVES
// ================================
$archives_list = [];

if (!empty($archive_posts_api)) {

    foreach ($archive_posts_api as $ap) {

        $key = date("Y-m", strtotime($ap->date));

        $archives_list[$key] = date(
            "F Y",
            strtotime($ap->date)
        );
    }
}


// ================================
// MAIN POSTS
// ================================
$api_url = "https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_embed&per_page=6&page=1";

if (!empty($category_id)) {
    $api_url .= "&categories={$category_id}";
}

if (!empty($start_date)) {
    $api_url .= "&after={$start_date}&before={$end_date}";
}

$grid_posts = get_json_data($api_url);


// ================================
// SEO
// ================================
$title = $page_heading . " | Expert Guides & Latest Updates";

$meta_description = "Explore our latest blogs covering life, health, mortgage, and disability coverage.";

$current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


// ================================
// DYNAMIC BASE URL GETTER
// ================================
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'] . "/";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title><?= e($title) ?></title>

<meta name="description" content="<?= e($meta_description) ?>">

<link rel="canonical" href="<?= e($current_url) ?>">

<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($meta_description) ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($current_url) ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($title) ?>">
<meta name="twitter:description" content="<?= e($meta_description) ?>">

    <meta name="msapplication-TileColor" content="#ffffff">
  	<meta name="theme-color" content="#ffffff">
  	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css">
	<link rel="stylesheet" href="https://www.punjabinsurance.ca/css/style.css">
	<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "InsuranceAgency",
  "@id": "https://www.punjabinsurance.ca/#insuranceagency",
  "name": "Punjab Insurance Inc.",
  "url": "https://www.punjabinsurance.ca/",
  "logo": "https://www.punjabinsurance.ca/logo.png",
  "image": "https://www.punjabinsurance.ca/office.jpg",
  "telephone": "+1-888-978-6522",
  "email": "admin@punjabinsurance.ca",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "7003 Steeles Ave W Unit 10",
    "addressLocality": "Etobicoke",
    "addressRegion": "ON",
    "postalCode": "M9W 0A2",
    "addressCountry": "CA"
  },
  "areaServed": {
    "@type": "Country",
    "name": "Canada"
  },
  "sameAs": [
    "https://www.facebook.com/PunjabInsurance.ca/",
    "https://x.com/punjabinsurance",
    "https://in.pinterest.com/punjabinsurance/"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Punjab Insurance Inc.",
  "url": "https://www.punjabinsurance.ca/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.punjabinsurance.ca/?s={search_term_string}",
    "query-input": "required name=search_term_string"
  },
  "publisher": {
    "@type": "InsuranceAgency",
    "name": "Punjab Insurance Inc.",
    "url": "https://www.punjabinsurance.ca/"
  }
}
</script>
	<style>
    /* Baki aapka purana style code... */
    
    .recent-posts-list img {
        width: 80px !important;
        height: 60px !important;
        object-fit: cover !important;
        border-radius: 6px; /* Halka sa gol karne ke liye */
    }
</style>
</head>
<body>
	<div class="body-overlay"></div>

<!-- Header -->
	<header class="header shadow-sm">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-2 items-center gap-6">
					<div class="flex items-center gap-2">
						<img src="<?= $base_url ?>images/icons/call-filled-white-16x16.svg">
						<span><span class="font-semibold hidden md:inline-flex">24 x 7 Tollfree:</span> <a href="tel:+18889786522">1-888-978-6522</a></span>
					</div>
					<div class="flex items-center justify-end gap-4 md:gap-6">
						<div class="flex items-center" id="searchHeader">
							<div id="searchBoxWrap">
								<input type="text" id="searchBox" placeholder="Search..." autocomplete="off">
							</div>
							<span id="searchToggle">
								<img src="<?= $base_url ?>images/icons/search-white-18x18.svg" width="16">
							</span>
							<ul id="searchSuggestions"></ul>
						</div>
						
						<a href="<?= $base_url ?>join-us.php" class="font-medium hidden md:inline-flex">Join Us</a>

						<a href="https://www.quotes.punjabinsurance.ca/users/login" class="flex items-center gap-0_5" aria-label="User Login">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
								<path d="M9 3C9.79565 3 10.5587 3.31607 11.1213 3.87868C11.6839 4.44129 12 5.20435 12 6C12 6.79565 11.6839 7.55871 11.1213 8.12132C10.5587 8.68393 9.79565 9 9 9C8.20435 9 7.44129 8.68393 6.87868 8.12132C6.31607 7.55871 6 6.79565 6 6C6 5.20435 6.31607 4.44129 6.87868 3.87868C7.44129 3.31607 8.20435 3 9 3ZM9 10.5C12.315 10.5 15 11.8425 15 13.5V15H3V13.5C3 11.8425 5.685 10.5 9 10.5Z" fill="white"/>
							</svg>
							<span class="font-medium hidden md:inline-flex">Login</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Navbar -->
		<div class="navbar">
			<div class="container mx-auto px-4">
				<nav class="grid grid-cols-12 items-center gap-6">
					<div class="col-span-3 xl:col-span-2">
						<a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a>
					</div>
					<div class="col-span-9 xl:col-span-10">
						<div class="flex items-center justify-end gap-6">
                            <div class="navlist-wrap">
                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                    <div class="navlist-logo"><a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                    <div class="navlist-close">&times;</div>
                                </div>
                                <ul class="flex items-center gap-4 navlist">
                                    <li><a href="<?= $base_url ?>index.php">Home</a></li>

                                    <li>
                                        <a href="#" class="mega-toggle flex items-center gap-1.5" data-menu="about-menu">
                                            About Us
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </a>

                                        <div id="about-menu" class="mega-menu">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>
                                                
                                                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-6 lg:gap-y-0">
                                                    <div class="col-span-12 lg:col-span-4">
                                                        <ul id="megaNav" class="mega-nav flex flex-col gap-4">
                                                            <li data-target="aboutUs" class="active">About Us</li>
                                                            <li data-target="joinUs">Join Us</li>
                                                        </ul>

                                                        <div class="mega-lets-talk hidden lg:flex">
                                                            <h4 class="mega-lets-talk-heading">Let's Talk</h4>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="<?= $base_url ?>contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="<?= $base_url ?>images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-aboutUs" class="content-section mega-content">
                                                            <h4 class="mega-content-heading">About Us</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>about-punjab-insurance.php"><img src="<?= $base_url ?>images/icons/company-building-primary-48.svg">About Punjab Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>photo-gallery.php"><img src="<?= $base_url ?>images/icons/gallery-primary-48.svg">Photo Gallery</a></li>
                                                                        <li><a href="<?= $base_url ?>media-center-press-release.php"><img src="<?= $base_url ?>images/icons/newspaper-primary-48.svg">Media Center/Press Release</a></li>
                                                                        <li><a href="<?= $base_url ?>privacy-policy.php"><img src="<?= $base_url ?>images/icons/document-lock-primary-48.svg">Privacy Policy</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>buy-sell-agreements.php"><img src="<?= $base_url ?>images/icons/document-agreement-primary-48.svg">Buy-Sell Agreements</a></li>
                                                                        <li><a href="<?= $base_url ?>google-reviews.php"><img src="<?= $base_url ?>images/icons/chat-bubble-primary-48.svg">Google Reviews</a></li>
                                                                        <li><a href="<?= $base_url ?>blogs.php"><img src="<?= $base_url ?>images/icons/writing-primary-48.svg">Blogs</a></li>
                                                                        <li><a href="<?= $base_url ?>contact.php"><img src="<?= $base_url ?>images/icons/call-primary-48.svg">Contact Us</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-joinUs" class="content-section mega-content hidden">
                                                            <h4 class="mega-content-heading">Join Us</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>classes.php">
                                                                            <img src="<?= $base_url ?>images/icons/classes-projector-primary-48.svg">LLQP Classes</a></li>
                                                                        <li><a href="<?= $base_url ?>our-commercials.php"><img src="<?= $base_url ?>images/icons/video-gallery-primary-48.svg">Our Commercials</a></li>
                                                                        <li><a href="<?= $base_url ?>business-ownership.php"><img src="<?= $base_url ?>images/icons/ceo-primary-48.svg">Business Ownership</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>companies-we-represent.php"><img src="<?= $base_url ?>images/icons/company-double-building-primary-48.svg">Companies We Represent</a></li>
                                                                        <li><a href="<?= $base_url ?>our-history.php"><img src="<?= $base_url ?>images/icons/book-primary-48.svg">Our History</a></li>
                                                                        <li><a href="<?= $base_url ?>join-us.php"><img src="<?= $base_url ?>images/icons/user-add-primary-48.svg">Join Us</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#" class="mega-toggle flex items-center gap-1.5" data-menu="life-insurance-menu">
                                            Life Insurance
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </a>

                                        <div id="life-insurance-menu" class="mega-menu">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>

                                                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-6 lg:gap-y-0">
                                                    <div class="col-span-12 lg:col-span-4">
                                                        <ul id="megaNav" class="mega-nav flex flex-col gap-4">
                                                            <li data-target="lifeInsurance" class="active">Life Insurance</li>
                                                            <li data-target="livingBenefits">Living Benefits</li>
                                                            <li data-target="Investments">Investment</li>
                                                            <li data-target="travelInsurance">Travel Insurance</li>
                                                        </ul>

                                                        <div class="mega-lets-talk hidden lg:flex">
                                                            <h4 class="mega-lets-talk-heading">Let's Talk</h4>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="<?= $base_url ?>contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="<?= $base_url ?>images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-lifeInsurance" class="content-section mega-content">
                                                            <h4 class="mega-content-heading">Life Insurance</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>life-insurance.php"><img src="<?= $base_url ?>images/icons/shield-check-primary-48.svg">Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>term-life-insurance.php"><img src="<?= $base_url ?>images/icons/calendar-user-primary-48.svg">Term Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>whole-life-insurance.php"><img src="<?= $base_url ?>images/icons/shield-lock-primary-48.svg">Whole Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>universal-life-insurance.php"><img src="<?= $base_url ?>images/icons/umbrella-primary-48.svg">Universal Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>permanent-life-insurance.php"><img src="<?= $base_url ?>images/icons/shield-user-primary-48.svg">Permanent Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>million-dollar-life-insurance-policy.php"><img src="<?= $base_url ?>images/icons/shield-dollar-primary-48.svg">Million Dollar Policy</a></li>
                                                                        <li><a href="<?= $base_url ?>money-back-life-insurance.php"><img src="<?= $base_url ?>images/icons/wallet-primary-48.svg">Money Back Life Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>income-replacement-insurance.php"><img src="<?= $base_url ?>images/icons/wallet-arrow-down-primary-48.svg">Income Replacement Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>mortgage-insurance.php"><img src="<?= $base_url ?>images/icons/home-shield-primary-48.svg">Mortgage Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>critical-illness-insurance.php"><img src="<?= $base_url ?>images/icons/heart-pulse-primary-48.svg">Critical Illness Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>disability-insurance.php"><img src="<?= $base_url ?>images/icons/disabled-person-primary-48.svg">Disability Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>non-medical-life-insurance.php"><img src="<?= $base_url ?>images/icons/document-check-primary-48.svg">Non Medical Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>drug-dental-insurance.php"><img src="<?= $base_url ?>images/icons/shield-tooth-primary-48.svg">Drug and Dental Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>free-insurance-plan.php"><img src="<?= $base_url ?>images/icons/baby-primary-48.svg">Free Insurance Plan</a></li>
                                                                        <li><a href="<?= $base_url ?>insurance-retirement-plan.php"><img src="<?= $base_url ?>images/icons/growth-chart-primary-48.svg">Insurance + Retirement Plan</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-livingBenefits" class="content-section mega-content hidden">
                                                            <h4 class="mega-content-heading">Living Benefits</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>critical-illness-insurance.php"><img src="<?= $base_url ?>images/icons/heart-pulse-primary-48.svg">Critical Illness Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>disability-insurance.php"><img src="<?= $base_url ?>images/icons/disabled-person-primary-48.svg">Disability Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>mortgage-insurance.php"><img src="<?= $base_url ?>images/icons/home-shield-primary-48.svg">Mortgage Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>loan-protection-insurance.php"><img src="<?= $base_url ?>images/icons/loan-primary-48.svg">Loan Protection Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>emergency-medical-insurance.php"><img src="<?= $base_url ?>images/icons/shield-medical-primary-48.svg">Emergency Medical Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>insurance-retirement-plan.php"><img src="<?= $base_url ?>images/icons/growth-chart-primary-48.svg">Insurance + Retirement Plan</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-Investments" class="content-section mega-content hidden">
                                                            <h4 class="mega-content-heading">Investments</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>registered-retirement-savings-plan.php"><img src="<?= $base_url ?>images/icons/piggy-bank-primary-48.svg">Registered Retirement Savings Plan (RRSP)</a></li>
                                                                        <li><a href="<?= $base_url ?>tax-free-savings-account.php"><img src="<?= $base_url ?>images/icons/growth-plant-primary-48.svg">Tax-Free Savings Account (TFSA)</a></li>
                                                                        <li><a href="<?= $base_url ?>registered-education-savings-plan.php"><img src="<?= $base_url ?>images/icons/education-cap-primary-48.svg">Registered Education Savings Plan (RESP)</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>rrsp-loan.php"><img src="<?= $base_url ?>images/icons/loan-primary-48.svg">RRSP Loan</a></li>
                                                                        <li><a href="<?= $base_url ?>buy-sell-agreements.php"><img src="<?= $base_url ?>images/icons/document-agreement-primary-48.svg">Buy-Sell Agreements</a></li>
                                                                        <li><a href="<?= $base_url ?>new-immigrant-and-rrsp.php"><img src="<?= $base_url ?>images/icons/immigrant-primary-48.svg">New Immigrant & RRSP</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-travelInsurance" class="content-section mega-content hidden">
                                                            <h4 class="mega-content-heading">Travel Insurance</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>insurance-for-visitors-to-canada.php"><img src="<?= $base_url ?>images/icons/tourist-primary-48.svg">Insurance for Visitors to Canada</a></li>
                                                                        <li><a href="<?= $base_url ?>travel-insurance-for-canadians.php"><img src="<?= $base_url ?>images/icons/flight-hands-primary-48.svg">Travel Insurance for Canadians</a></li>
                                                                        <li><a href="<?= $base_url ?>insurance-for-students-in-canada.php"><img src="<?= $base_url ?>images/icons/education-cap-primary-48.svg">Insurance for Students</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                        
                                    <li>
                                        <a href="#" class="mega-toggle flex items-center gap-1.5" data-menu="super-visa-menu">
                                            Super Visa Insurance
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </a>

                                        <div id="super-visa-menu" class="mega-menu">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>

                                                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-6 lg:gap-y-0">
                                                    <div class="col-span-12 lg:col-span-4">
                                                        <ul id="megaNav" class="mega-nav flex flex-col gap-4">
                                                            <li data-target="superVisaInsurance" class="active">Super Visa Insurance</li>
                                                            <li data-target="onlineRateComparison">Online Rate Comparison</li>
                                                        </ul>

                                                        <div class="mega-lets-talk hidden lg:flex">
                                                            <h4 class="mega-lets-talk-heading">Let's Talk</h4>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="<?= $base_url ?>contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="<?= $base_url ?>images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-superVisaInsurance" class="content-section mega-content">
                                                            <h4 class="mega-content-heading">Super Visa Insurance</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance.php"><img src="<?= $base_url ?>images/icons/elders-primary-48.svg">Super Visa Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance-cost.php"><img src="<?= $base_url ?>images/icons/shield-dollar-primary-48.svg">Super Visa Insurance Cost</a></li>
                                                                        <li><a href="<?= $base_url ?>income-requirements-for-super-visa.php"><img src="<?= $base_url ?>images/icons/wallet-primary-48.svg">Income Requirements for Super Visa (LICO)</a></li>
                                                                        <li><a href="<?= $base_url ?>benefits-of-super-visa-insurance.php"><img src="<?= $base_url ?>images/icons/checklist-primary-48.svg">Benefits of Super Visa Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>faqs-on-super-visa-insurance-for-parents.php"><img src="<?= $base_url ?>images/icons/qa-primary-48.svg">FAQs on Super Visa Insurance for Parents</a></li>
                                                                        <li><a href="<?= $base_url ?>super-visa-application.php"><img src="<?= $base_url ?>images/icons/document-form-primary-48.svg">Super Visa Application Form</a></li>
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance-eligibility.php"><img src="<?= $base_url ?>images/icons/user-check-primary-48.svg">Eligibility for Super Visa Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance-quote.php"><img src="<?= $base_url ?>images/icons/calculator-primary-48.svg">Super Visa Insurance Quote</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-onlineRateComparison" class="content-section mega-content hidden">
                                                            <h4 class="mega-content-heading">Online Rate Comparison</h4>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance-medical-condition.php"><img src="<?= $base_url ?>images/icons/medical-history-primary-48.svg">Pre-existing Medical Conditions</a></li>
                                                                        <li><a href="<?= $base_url ?>super-visa-insurance-diabetes.php"><img src="<?= $base_url ?>images/icons/diabetes-primary-48.svg">Super Visa Insurance for Patients with Diabetes</a></li>
                                                                        <li><a href="<?= $base_url ?>tips-buying-super-visa-insurance.php"><img src="<?= $base_url ?>images/icons/document-filled-primary-64.svg">Tips Before Buying Super Visa Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="<?= $base_url ?>mistakes-while-buying-super-visa-insurance.php"><img src="<?= $base_url ?>images/icons/cross-circle-primary-48.svg">Mistakes While Buying Super Visa Insurance</a></li>
                                                                        <li><a href="<?= $base_url ?>how-to-complete-super-visa-application-form.php"><img src="<?= $base_url ?>images/icons/document-check-primary-48.svg">How to Complete Super Visa Application Form</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php include 'includes/nav-blogs-section.php'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="<?= $base_url ?>rdsp.php" class="flex items-center gap-1.5">
                                            RDSP
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= $base_url ?>rrsp.php" class="flex items-center gap-1.5">
                                            RESP
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="mega-toggle flex items-center gap-1.5" data-menu="advisor-menu">
                                            Advisor Center
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </a>

                                        <div id="advisor-menu" class="mega-menu mega-dropdown">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="<?= $base_url ?>index.php"><img src="<?= $base_url ?>images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>

                                                <ul class="flex flex-col gap-6 mega-links-list">
                                                    <li><a href="https://www.punjabinsurance.ca/users/login"><img src="<?= $base_url ?>images/icons/user-checked-primary-48.svg">Login</a></li>
                                                    <li><a href="<?= $base_url ?>canadian-insurance-companies.php"><img src="<?= $base_url ?>images/icons/company-double-building-primary-48.svg">Canadian Insurance Companies</a></li>
                                                    <li><a href="<?= $base_url ?>illustration-softwares.php"><img src="<?= $base_url ?>images/icons/software-laptop-primary-48.svg">Illustration Softwares</a></li>
                                                    <li><a href="<?= $base_url ?>calculators.php"><img src="<?= $base_url ?>images/icons/calculator-primary-48.svg">Calculators</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="flex flex-col lg:hidden bg-primary-100 rounded-lg p-4">
                                        <div class="text-body-base font-semibold mb-4">
                                            <p class="mb-1">Mail Us</p>
                                            <a href="mailto:admin@punjabinsurance.ca" class="text-primary-500 underline">admin@punjabinsurance.ca</a>
                                        </div>
                                        <div class="text-body-base font-semibold mb-4">
                                            <p class="mb-1">Call Us</p>
                                            <a href="tel:+18889786522" class="text-primary-500 underline">1-888-978-6522</a>
                                        </div>
                                        <div class="text-body-base font-semibold">
                                            <p class="mb-1">Follow Us</p>
                                            <ul class="footer-social-links">
                                                <li>
                                                    <a href="https://www.facebook.com/PunjabInsurance.ca/" title="facebook" target="_blank">
                                                        <img src="<?= $base_url ?>images/icons/icon-facebook.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://x.com/punjabinsurance" title="X" target="_blank">
                                                        <img src="<?= $base_url ?>images/icons/icon-x.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/404/" title="linkedin" target="_blank">
                                                        <img src="<?= $base_url ?>images/icons/icon-linkedin.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://in.pinterest.com/punjabinsurance/" title="pinterest" target="_blank">
                                                        <img src="<?= $base_url ?>images/icons/Icon-pinterest.svg">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="inline-flex lg:hidden">
                                        <a href="<?= $base_url ?>get-a-quote.php" class="btn btn-md btn-filled-cta w-full text-center justify-center">
                                            Request a Free Quote
                                        </a>
                                    </li>

                                    <li class="inline-flex lg:hidden">
                                        <a href="<?= $base_url ?>contact.php" class="btn btn-md btn-filled-primary w-full" style="justify-content: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" style="transform: rotate(0deg);">
                                                <path d="M14.9625 15.75C13.4 15.75 11.8562 15.4095 10.3312 14.7285C8.80625 14.0475 7.41875 13.0817 6.16875 11.8312C4.91875 10.5807 3.95325 9.19325 3.27225 7.66875C2.59125 6.14425 2.2505 4.6005 2.25 3.0375C2.25 2.8125 2.325 2.625 2.475 2.475C2.625 2.325 2.8125 2.25 3.0375 2.25H6.075C6.25 2.25 6.40625 2.3095 6.54375 2.4285C6.68125 2.5475 6.7625 2.688 6.7875 2.85L7.275 5.475C7.3 5.675 7.29375 5.84375 7.25625 5.98125C7.21875 6.11875 7.15 6.2375 7.05 6.3375L5.23125 8.175C5.48125 8.6375 5.778 9.08425 6.1215 9.51525C6.465 9.94625 6.84325 10.362 7.25625 10.7625C7.64375 11.15 8.05 11.5095 8.475 11.841C8.9 12.1725 9.35 12.4755 9.825 12.75L11.5875 10.9875C11.7 10.875 11.847 10.7907 12.0285 10.7347C12.21 10.6787 12.388 10.663 12.5625 10.6875L15.15 11.2125C15.325 11.2625 15.4687 11.3532 15.5812 11.4847C15.6937 11.6162 15.75 11.763 15.75 11.925V14.9625C15.75 15.1875 15.675 15.375 15.525 15.525C15.375 15.675 15.1875 15.75 14.9625 15.75Z" fill="white"></path>
                                            </svg>
                                            Schedule a Call
                                        </a>
                                    </li>
                                </ul>
                            </div>
							
							<a href="<?= $base_url ?>get-a-quote.php" class="btn btn-md btn-filled-cta hidden lg:inline-flex">
								<span>Request a Free Quote</span>
							</a>

							<button id="menu-toggle" aria-label="Open Menu" class="block lg:hidden">
								<img src="<?= $base_url ?>images/icons/hamburger-menu.svg">
							</button>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</header>
	
	
	<main class="main">
        <!-- Hero Slider -->
        <section class="blogs-hero">
            <div class="owl-carousel" id="blogs-hero-carousel">
                <?php if(!empty($slider_posts)): foreach($slider_posts as $post): 
                    $slug = $post->slug;
                    $title_text = $post->title->rendered;
                    $date = date("F j, Y", strtotime($post->date));
                    $image = isset($post->_embedded->{'wp:featuredmedia'}[0]->source_url) ? $post->_embedded->{'wp:featuredmedia'}[0]->source_url : 'https://www.punjabinsurance.ca/images/national-cancer-institute.webp';
                    $author_img = isset($post->_embedded->author[0]->avatar_urls->{'48'}) ? $post->_embedded->author[0]->avatar_urls->{'48'} : 'https://www.punjabinsurance.ca/images/avatar-face1.webp';
                    $cat_name = isset($post->_embedded->{'wp:term'}[0][0]->name) ? $post->_embedded->{'wp:term'}[0][0]->name : 'Blog';
                ?>
                <div class="item">
                    <div class="hero-overlay blogs-hero-item" style="background-image: url('<?php echo $image; ?>');background-size: cover;background-repeat:no-repeat;">
                        <div class="container mx-auto px-4">
                            <div class="blog-hero-item-content">
                                <nav class="breadcrumb light mt-0" aria-label="Breadcrumb">
                                    <ol><li><a href="/">Home</a></li><li class="active">Blogs</li></ol>
                                </nav>
                                <div class="blog-hero-item-category-chips">
                                    <a href="#" class="blog-category-chip"><?php echo $cat_name; ?></a>
                                </div>
                                <h3 class="blog-hero-item-title"><?php echo $title_text; ?></h3>
                                <div class="blog-hero-item-meta">
                                    <div class="blog-thumb-author"><img src="<?php echo $author_img; ?>"><span>Team Punjab Insurance</span></div>
                                    <div class="blog-thumb-date"><img src="https://www.punjabinsurance.ca/images/icons/calendar-white.svg" width="15"><span><?php echo $date; ?></span></div>
                                </div>
                                <div class="blog-hero-item-cta"><a href="/blog/<?php echo $slug; ?>" class="btn btn-sm btn-outline-primary"><span>View Blog</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </section>

        <!-- Recent Blogs -->
        <section class="mt-16 lg:mt-20 mb-16 md:mb-0">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-12 gap-0 lg:gap-6">
                    <!-- Sidebar -->
                    <div class="col-span-12 lg:col-span-3">
                        <div class="sidebar" id="blogSidebar">
                            
                            <!-- Widget: Recent Posts -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-widget-heading">Recent Posts</h3>
                                <ul class="sidebar-links-list recent-posts-list">
                                    <?php if(!empty($sidebar_posts)): foreach($sidebar_posts as $sp): 
                                        $sp_img = isset($sp->_embedded->{'wp:featuredmedia'}[0]->source_url) ? $sp->_embedded->{'wp:featuredmedia'}[0]->source_url : 'https://www.punjabinsurance.ca/images/default-blog.webp';
                                    ?>
		                            <li>
                                        <a href="/blog/<?php echo $sp->slug; ?>">
                                            <img width="80" height="80" src="<?php echo $sp_img; ?>" class="rpwwt-thumb" style="object-fit:cover;">
                                            <div class="rpwwt-copy">
                                                <h6 class="rpwwt-post-title"><?php echo mb_strimwidth($sp->title->rendered, 0, 45, "..."); ?></h6>
                                                <div class="rpwwt-post-date"><?php echo date("F j, Y", strtotime($sp->date)); ?></div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; endif; ?>
	                            </ul>
                            </div>

                            <!-- Widget: Categories -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-widget-heading">Categories</h3>
                                <ul class="sidebar-links-list">
                                    <li><a href="/blogs" class="<?php echo empty($category_id) ? 'font-bold text-blue-600' : ''; ?>">All Blogs</a></li>
                                    <?php if(!empty($categories)): foreach($categories as $cat): ?>
                                        <li>
                                            <a href="/blog/category/<?php echo $cat->slug; ?>" class="<?php echo ($category_id == $cat->id) ? 'font-bold text-blue-600' : ''; ?>">
                                                <?php echo $cat->name; ?> (<?php echo $cat->count; ?>)
                                            </a>
                                        </li>
                                    <?php endforeach; endif; ?>
	                            </ul>
                            </div>

                            <!-- DYNAMIC Widget: Archives -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-widget-heading">Archives</h3>
                                <ul class="sidebar-links-list">
                                    <?php if(!empty($archives_list)): foreach($archives_list as $label => $val): ?>
                                        <li>
                                            <a href="/blogs?archive=<?php echo $val; ?>" class="<?php echo ($archive_filter == $val) ? 'font-bold text-blue-600' : ''; ?>">
                                                <?php echo $label; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; else: ?>
                                        <li><a href="#">No Archives Found</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- Main Grid -->
                    <div class="col-span-12 lg:col-span-9">
                        <div class="section-heading">
                            <div class="heading-copy"><h1 class="title title-h4"><?php echo $page_heading; ?></h1></div><hr>
                        </div>
                                
                        <div class="loadmore-wrapper">
                            <div class="grid grid-cols-12 gap-4 loadmore-items" id="dynamic-blog-grid">
                                <?php if(!empty($grid_posts)): foreach($grid_posts as $bp): 
                                    $b_img = isset($bp->_embedded->{'wp:featuredmedia'}[0]->source_url) ? $bp->_embedded->{'wp:featuredmedia'}[0]->source_url : 'https://www.punjabinsurance.ca/images/default-blog.webp';
                                    $b_cat = isset($bp->_embedded->{'wp:term'}[0][0]->name) ? $bp->_embedded->{'wp:term'}[0][0]->name : 'Blog';
                                    $b_author_img = isset($bp->_embedded->author[0]->avatar_urls->{'48'}) ? $bp->_embedded->author[0]->avatar_urls->{'48'} : 'https://www.punjabinsurance.ca/images/avatar-face1.webp';
                                ?>
                                <div class="col-span-12 md:col-span-6 blog-item">
                                    <div class="blog-card">
                                        <div class="blog-thumb">
                                            <a href="/blog/<?php echo $bp->slug; ?>"><img loading="lazy" decoding="async" src="<?= e($b_img) ?>" alt="<?= e(strip_tags($bp->title->rendered)) ?>" style="width:100%; height:240px; object-fit:cover;"></a>
                                        </div>
                                        <div class="blog-thumb-content">
                                            <div class="blog-thumb-category-chips"><a href="#" class="blog-category-chip"><?php echo $b_cat; ?></a></div>
                                            <h3 class="blog-thumb-title"><a href="/blog/<?php echo $bp->slug; ?>"><?= e(strip_tags($bp->title->rendered)) ?></a></h3>
                                            <div class="blog-thumb-meta">
                                                <div class="blog-thumb-author"><img src="<?php echo $b_author_img; ?>"><span>Team Punjab Insurance</span></div>
                                                <div class="blog-thumb-date"><img src="https://www.punjabinsurance.ca/images/icons/calendar.svg" width="15"><span><?php echo date("F j, Y", strtotime($bp->date)); ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; else: ?>
                                    <p class="col-span-12 text-gray-500">No blogs found.</p>
                                <?php endif; ?>
                            </div>

                            <div id="blog-loader" class="loader" style="display:none; margin: 30px auto;"></div>

                            <div class="container mx-auto px-4 mt-16">
    <?php if(!empty($grid_posts) && !isset($grid_posts->code) && count($grid_posts) >= 6): ?>
    <button id="load-more-btn" class="btn btn-lg btn-outline-primary mt-16 flex mx-auto loadmore-btn">
        <span>Load More Blogs</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 9l6 6 6-6" style="fill: none" />
        </svg>
    </button>
    <?php endif; ?>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</main>

    <!-- Load More Script -->
    <script>
        let currentPage = 1;
        const catId = '<?php echo $category_id; ?>';
        const startDate = '<?php echo $start_date; ?>';
        const endDate = '<?php echo $end_date; ?>';
        
        const loadMoreBtn = document.getElementById('load-more-btn');
        const blogGrid = document.getElementById('dynamic-blog-grid');
        const loader = document.getElementById('blog-loader');

        if(loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                currentPage++;
                loader.style.display = 'block';
                loadMoreBtn.style.display = 'none';

                let fetchUrl = `https://blog.punjabinsurance.ca/wp-json/wp/v2/posts?_embed&per_page=6&page=${currentPage}`;
                if(catId !== '') { fetchUrl += `&categories=${catId}`; }
                if(startDate !== '') { fetchUrl += `&after=${startDate}&before=${endDate}`; }

                fetch(fetchUrl)
                    .then(res => {
                        const totalPages = res.headers.get('X-WP-TotalPages');
                        if (currentPage >= parseInt(totalPages)) { loadMoreBtn.classList.add('hidden'); } 
                        else { loadMoreBtn.style.display = 'flex'; }
                        return res.json();
                    })
                    .then(posts => {
                        let html = '';
                        posts.forEach(post => {
                            let imgUrl = post._embedded && post._embedded['wp:featuredmedia'] ? post._embedded['wp:featuredmedia'][0].source_url : 'https://www.punjabinsurance.ca/images/default-blog.webp';
                            let date = new Date(post.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                            let catName = post._embedded && post._embedded['wp:term'] ? post._embedded['wp:term'][0][0].name : 'Blog';
                            let authorImg = post._embedded && post._embedded.author ? post._embedded.author[0].avatar_urls['48'] : 'https://www.punjabinsurance.ca/images/avatar-face1.webp';
                            
                            html += `
                            <div class="col-span-12 md:col-span-6 blog-item">
                                <div class="blog-card">
                                    <div class="blog-thumb"><a href="/blog/${post.slug}"><img src="${imgUrl}" style="width:100%; height:240px; object-fit:cover;"></a></div>
                                    <div class="blog-thumb-content">
                                        <div class="blog-thumb-category-chips"><a href="#" class="blog-category-chip">${catName}</a></div>
                                        <h3 class="blog-thumb-title"><a href="/blog/${post.slug}">${post.title.rendered}</a></h3>
                                        <div class="blog-thumb-meta">
                                            <div class="blog-thumb-author"><img src="${authorImg}"><span>Team Punjab Insurance</span></div>
                                            <div class="blog-thumb-date"><img src="https://www.punjabinsurance.ca/images/icons/calendar.svg" width="15"><span>${date}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        });
                        blogGrid.insertAdjacentHTML('beforeend', html);
                        loader.style.display = 'none';
                    })
                    .catch(err => { console.error(err); loader.style.display = 'none'; });
            });
        }
    </script>

    <!-- Floating Sidebar Button -->
    <button id="sidebarToggle" class="blog-sidebar-toggle lg:hidden">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6" />
            <line x1="3" y1="12" x2="21" y2="12" />
            <line x1="3" y1="18" x2="21" y2="18" />
        </svg>
    </button>

	<!-- Footer -->
    <?php
        $footer_cta_heading = $footer_cta_heading ?? "Start Protecting Your Family's Future Today";
        $footer_cta_text = $footer_cta_text ?? "Find the right insurance and investment solutions at the best rates-personalized for your needs, budget, and lifestyle. Request your free, no-obligation quote from Punjab Insurance and take the first step toward peace of mind for you and your loved ones.";
    ?>
	<footer class="footer">
		<div class="footer-cta">
			<div class="footer-cta-inner">
				<div class="grid grid-cols-12 items-center gap-6">
					<div class="col-span-12 md:col-span-6">
						<div class="footer-cta-copy">
							<h5 class="footer-cta-heading"><?= htmlspecialchars($footer_cta_heading) ?></h5>
							<p><?= htmlspecialchars($footer_cta_text) ?></p>
                            <div class="hero-cta-buttons">
								<a href="https://www.punjabinsurance.ca/get-a-quote.php" class="btn btn-lg btn-filled-cta">
								    <span>Get a Free Quote</span>
									<img src="https://www.punjabinsurance.ca/images/icons/arrow-right-white-22.svg" class="rotate-35">
								</a>
								<a href="https://www.punjabinsurance.ca/contact.php" class="btn btn-lg btn-outline-gray">
								    Contact Us
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-cta-linear-circle"></div>
			</div>
            <img src="https://www.punjabinsurance.ca/images/sikh-family-child-on-shoulders-smiling.webp" class="footer-cta-image" alt="Sikh family, child on shoulders, smiling">
		</div>
		
		<div class="footer-main">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
				    <div class="col-span-12 md:col-span-6 lg:col-span-4">
					    <div class="footer-column flex flex-col gap-6">
						    <h6 class="heading-h6 font-semibold text-white">About Punjab Insurance Inc.</h6>
							<div class="footer-column-content footer-about">
								<p>Punjab Insurance Inc. was established in late 2006, as a company that provides protection to all Canadians.</p>
								<ul class="flex flex-col gap-4 footer-contact-list">
								    <li>
									    <div><img src="https://www.punjabinsurance.ca/images/icons/location-filled-white-16x16.svg">Address</div>
										<a href="https://maps.app.goo.gl/XJ3VvzZu1fAFv3Fh6" target="_blank">7003 Steeles Ave.W Unit 10, Etobicoke, Ontario M9W 0A2</a>
									</li>
									<li>
										<div><img src="https://www.punjabinsurance.ca/images/icons/call-filled-white-16x16.svg">24x7 Tollfree</div>
										<a href="tel:+18889786522">1-888-978-6522</a>
									</li>
									<li>
										<div><img src="https://www.punjabinsurance.ca/images/icons/mail-filled-white-16x16.svg">Email</div>
										<a href="mailto:admin@punjabinsurance.ca">admin@punjabinsurance.ca</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					
                    <div class="col-span-12 md:col-span-6 lg:col-span-2">
						<div class="footer-column flex flex-col gap-6">
						    <h6 class="heading-h6 font-semibold text-white">Company</h6>
							<div class="footer-column-content">
								<ul class="footer-links-list">
							        <li><a href="https://www.punjabinsurance.ca/about-punjab-insurance.php">About Us</a></li>
									<li><a href="https://www.punjabinsurance.ca/contact.php">Contact Us</a></li>
									<li><a href="https://www.punjabinsurance.ca/blogs.php">Blogs</a></li>
									<li><a href="https://www.punjabinsurance.ca/faq.php">Faq's</a></li>
                                    <li><a href="https://www.punjabinsurance.ca/join-us.php">Careers</a></li>
									<li><a href="https://www.punjabinsurance.ca/google-reviews.php">Google Reviews</a></li>
									<li><a href="https://www.punjabinsurance.ca/privacy-policy.php">Privacy Policy</a></li>
									<li><a href="https://www.punjabinsurance.ca/terms-of-service.php">Terms of Service</a></li>
								</ul>
							</div>
						</div>
					</div>
					
                    <div class="col-span-12 md:col-span-6 lg:col-span-2">
						<div class="footer-column flex flex-col gap-6">
						    <h6 class="heading-h6 font-semibold text-white">Get Insurance</h6>
							<div class="footer-column-content">
							    <ul class="footer-links-list">
									<li><a href="https://www.punjabinsurance.ca/life-insurance.php">Life Insurance</a></li>
									<li><a href="https://www.punjabinsurance.ca/super-visa-insurance.php">Super Visa Insurance</a></li>
									<li><a href="https://www.punjabinsurance.ca/critical-illness-insurance.php">Critical Illness Insurance</a></li>
									<li><a href="https://www.punjabinsurance.ca/non-medical-life-insurance.php">Non-Medical Insurance</a></li>
									<li><a href="https://www.punjabinsurance.ca/disability-insurance.php">Disability Insurance</a></li>
                                    <li><a href="https://www.punjabinsurance.ca/emergency-medical-insurance.php">Health Insurance</a></li>
									<li><a href="https://www.punjabinsurance.ca/rdsp.php">RDSP (Registered Disability Savings Plan)</a></li>
                                    <li><a href="https://www.punjabinsurance.ca/mortgage-insurance.php">Mortgage Insurance</a></li>
                                    <li><a href="https://www.punjabinsurance.ca/insurance-for-visitors-to-canada.php">Visitor Insurance</a></li>
                                    <li><a href="https://www.punjabinsurance.ca/travel-insurance-for-canadians.php">Travel Insurance</a></li>
								</ul>
							</div>
						</div>
					</div>
					
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
						<div class="footer-column flex flex-col gap-6">
						    <h6 class="heading-h6 font-semibold text-white">Newsletter</h6>
                            <p>Subscribe to our free newsletter and stay up to date</p>
                            <form id="newsletter-compact" class="newsletter" novalidate>
                                <label for="email-compact" class="sr-only">Email address</label>
                                <input id="email-compact" name="email" type="email" required class="newsletter-input" placeholder="Your email address" aria-describedby="compact-help" />
                                <button type="submit" class="btn btn-md btn-filled-primary">Subscribe</button>
                            </form>
						</div>
						<div class="footer-column flex flex-col gap-6">
							<h6 class="heading-h6 font-semibold text-white">Follow Us</h6>
							<ul class="footer-social-links">
								<li><a href="https://www.facebook.com/PunjabInsurance.ca/" target="_blank"><img src="https://www.punjabinsurance.ca/images/icons/icon-facebook.svg"></a></li>
								<li><a href="https://x.com/punjabinsurance" target="_blank"><img src="https://www.punjabinsurance.ca/images/icons/icon-x.svg"></a></li>
								<li><a href="https://www.linkedin.com/404/" target="_blank"><img src="https://www.punjabinsurance.ca/images/icons/icon-linkedin.svg"></a></li>
								<li><a href="https://in.pinterest.com/punjabinsurance/" target="_blank"><img src="https://www.punjabinsurance.ca/images/icons/Icon-pinterest.svg"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
        <div class="footer-copyrights">
		    <div class="container mx-auto px-4">&copy; <?php echo date('Y');?> Punjab Insurance All Rights Reserved.</div>
		</div>
	</footer>

    <a id="whatsapp-float" href="tel:+18889786522" target="_blank" rel="noopener noreferrer" aria-label="Call Us">
        <svg viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false">
            <path fill="#25D366" d="M.057 24l1.687-6.163A11.88 11.88 0 010 12.012C0 5.373 5.373 0 12.014 0c3.2 0 6.2 1.245 8.457 3.502a11.88 11.88 0 013.507 8.46c-.003 6.64-5.376 12.012-12.017 12.012a11.9 11.9 0 01-6.741-2.022L.057 24z"/>
            <path fill="#FFF" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.472-.149-.67.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.151-.173.201-.298.301-.497.1-.198.05-.372-.025-.52-.074-.148-.67-1.612-.918-2.21-.242-.579-.487-.5-.67-.51l-.57-.01c-.198 0-.52.074-.793.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487 2.981 1.294 2.981.862 3.517.81.538-.049 1.758-.718 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.273-.198-.57-.347z"/>
        </svg>
    </a>	 

  	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
	<script src="https://www.punjabinsurance.ca/js/main.js?tp=3"></script>

<style>
.newsletter-msg { font-size: 0.82rem; font-weight: 600; margin-top: -30px; display: none; align-items: center; gap: 6px; animation: fadeIn 0.2s ease; }
.newsletter-msg.success { color: #4ade80; display: flex; }
.newsletter-msg.error   { color: #f87171; display: flex; }
.newsletter-input.nl-invalid { border-color: #f87171 !important; }
.newsletter-input.nl-valid   { border-color: #4ade80 !important; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-3px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
$(document).ready(function () {
    $('#newsletter-compact').after('<div class="newsletter-msg" id="newsletter-msg"></div>');
    function showNlMsg(type, text) {
        var $msg = $('#newsletter-msg');
        $msg.removeClass('success error').addClass(type).text(text).css('display', 'flex');
        setTimeout(function () { $msg.fadeOut(400, function () { $msg.css('display', 'none'); }); }, 5000);
    }
    $('#newsletter-compact').on('submit', function (e) {
        e.preventDefault();
        var $input = $('#email-compact');
        var $btn   = $(this).find('button[type="submit"]');
        var email  = $input.val().trim();
        var $msg   = $('#newsletter-msg');
        $msg.css('display', 'none').removeClass('success error');
        $input.removeClass('nl-invalid nl-valid');
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $input.addClass('nl-invalid');
            showNlMsg('error', 'Please enter a valid email address.');
            $input.focus();
            return;
        }
        var origText = $btn.text();
        $btn.prop('disabled', true).text('Subscribing...');
        $.ajax({
            url:  'newsletter-subscribe.php',
            type: 'POST',
            data: { email: email },
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    $input.val('').addClass('nl-valid');
                    showNlMsg('success', '✓ ' + res.message);
                } else {
                    $input.addClass('nl-invalid');
                    showNlMsg('error', res.message);
                }
            },
            error: function () { showNlMsg('error', 'Connection error. Please try again.'); },
            complete: function () { $btn.prop('disabled', false).text(origText); }
        });
    });
    $('#email-compact').on('input', function () {
        $(this).removeClass('nl-invalid nl-valid');
        $('#newsletter-msg').css('display', 'none').removeClass('success error');
    });
});
</script>

</body>
</html>