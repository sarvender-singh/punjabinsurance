<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Basic Page Needs -->
	<meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <!-- SEO Title & Description -->
<?php 
    // Define fallbacks in case variables aren't set on the specific page
    $page_title = isset($title) ? $title : "Trusted Insurance Plans Canada | Punjab Insurance Inc.";
    $page_description = isset($meta_description) ? $meta_description : 'Protect your future with reliable life, health, travel & investment plans in Canada. Get expert advice and affordable coverage with Punjab Insurance today.';
    $page_image = isset($og_image) ? $og_image : 'https://blog.punjabinsurance.ca/wp-content/uploads/2026/09/punjab-insurance1.png';
?>
<title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>">

<!-- Dynamic Canonical URL -->
<?php
if (!isset($canonical_url)) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $canonical_url = $protocol . "://" . $host . $path;
}
?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="<?php echo isset($og_type) ? htmlspecialchars($og_type, ENT_QUOTES, 'UTF-8') : 'website'; ?>" />
<meta property="og:site_name" content="Punjab Insurance Inc." />
<meta property="og:url" content="<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:image" content="<?php echo htmlspecialchars($page_image, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:locale" content="en_CA" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>" />
<meta name="twitter:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>" />
<meta name="twitter:description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>" />
<meta name="twitter:image" content="<?php echo htmlspecialchars($page_image, ENT_QUOTES, 'UTF-8'); ?>" />


<?php if (basename($_SERVER['PHP_SELF']) === 'life-insurance.php') : ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How much life insurance coverage do I need?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Coverage depends on your family's needs, debts (like a mortgage), future expenses (such as education), and your income. Our advisors can help you calculate the right amount."
    }
  },{
    "@type": "Question",
    "name": "Can I get life insurance if I have health issues?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes! We offer Non Medical Life Insurance plans that require no medical exams and are ideal for people with pre-existing conditions."
    }
  },{
    "@type": "Question",
    "name": "What is the difference between term and permanent life insurance?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Term life insurance provides coverage for a set number of years (e.g., 10, 20, or 30), while permanent life insurance covers you for life and can include an investment or cash value component."
    }
  },{
    "@type": "Question",
    "name": "Is my life insurance policy valid across Canada?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, our policies are available and valid in BC, Alberta, Ontario, Quebec, and most provinces across Canada."
    }
  },{
    "@type": "Question",
    "name": "How do I get a quote or apply for coverage?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You can get a free quote online, call us, or schedule a call with a licensed advisor for personalized guidance."
    }
  },{
    "@type": "Question",
    "name": "Can I review or update my existing policy?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Absolutely! Visit Your Policy to review or update your coverage at any time."
    }
  }]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "BreadcrumbList", 
  "itemListElement": [{
    "@type": "ListItem", 
    "position": 1, 
    "name": "Home",
    "item": "https://www.punjabinsurance.ca/"  
  },{
    "@type": "ListItem", 
    "position": 2, 
    "name": "Life Insurance",
    "item": "https://www.punjabinsurance.ca/life-insurance.php"  
  }]
}
</script>


<?php endif; ?>


<?php if (basename($_SERVER['PHP_SELF']) === 'life-insurance-surrey.php') : ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What factors affect life insurance premiums in Surrey, BC?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Life insurance premiums are generally based on factors such as your age, health, lifestyle, smoking status, occupation, coverage amount, and the type of policy you choose. Purchasing life insurance at a younger age may help you qualify for lower premiums."
    }
  },{
    "@type": "Question",
    "name": "Can I pay monthly?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes - we offer monthly payment plans, with the first two months' premium due upfront. This way you can spread out the cost instead of paying everything at once."
    }
  },{
    "@type": "Question",
    "name": "When is the Best Time to Buy Life Insurance in Surrey, BC?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The earlier you purchase life insurance, the better. Buying coverage at a younger age may help you secure lower premiums and provide long-term financial protection for your family."
    }
  },{
    "@type": "Question",
    "name": "What happens if I miss a life insurance premium payment?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Depending on your policy, there may be a grace period that allows you to make the payment without losing coverage. It's always a good idea to keep your policy payments up to date to maintain uninterrupted protection"
    }
  }]
}
</script>



<?php endif; ?>


<?php if (basename($_SERVER['PHP_SELF']) === 'super-visa-insurance.php') : ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "Is Super Visa Insurance refundable if the visa is denied?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes-full refund if the visa is denied, partial refund for unused months if your parents leave early."
    }
  },{
    "@type": "Question",
    "name": "Can I pay monthly?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes - we offer monthly payment plans, with the first two months' premium due upfront. This way you can spread out the cost instead of paying everything at once."
    }
  },{
    "@type": "Question",
    "name": "Does insurance cover pre-existing conditions?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Some plans cover stable pre-existing conditions. Ask our advisors for details."
    }
  },{
    "@type": "Question",
    "name": "How long should coverage last?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "At least one year from entry to Canada."
    }
  }]
}
</script>



<?php endif; ?>

<?php if (basename($_SERVER['PHP_SELF']) === 'term-life-insurance-surrey.php') : ?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "Can I buy term insurance in Surrey if I am self-employed?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes. Self-employed Surrey residents and business owners can qualify for term insurance; income and business documents may be required during underwriting."
    }
  },{
    "@type": "Question",
    "name": "Can temporary residents or newcomers to Surrey apply?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Many insurers offer term coverage to work permit holders, study permit holders, and new immigrants. Eligibility varies by insurer, so speak with an advisor to confirm."
    }
  },{
    "@type": "Question",
    "name": "Can I get term insurance without a medical exam in British Columbia?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes. Depending on your age, health, and the amount of coverage requested, some insurers offer simplified or no-medical-exam term insurance options."
    }
  },{
    "@type": "Question",
    "name": "Can I have more than one term insurance policy?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes. Depending on your financial needs, it may be possible to have multiple life insurance policies. Some individuals purchase additional coverage after major life events such as buying a home, getting married, or starting a family."
    }
  }]
}
</script>



<?php endif; ?>

    <!-- Colors -->
    <meta name="msapplication-TileColor" content="#ffffff">
  	<meta name="theme-color" content="#ffffff">

	<!-- Favicon -->
  	<link rel="icon" type="image/x-icon" href="favicon.ico">
  	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
  	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
	


	<!-- Tailwind CSS -->
  	<!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="/css/tailwind.min.css">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    
   <link rel="preload" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

<noscript>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css">
</noscript>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1596449392090445'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=1596449392090445&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->


<style>
   /* ==========================================
   PREMIUM MINIMALIST PRELOADER STYLES
   ========================================== */
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  
    background: radial-gradient(circle, rgba(255,255,255,1) 50%, var(--color-primary-50) 100%);
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
}

.preloader-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.25rem;
    max-width: 320px;
    width: 100%;
    padding: 20px;
}


.preloader-logo-area {
    position: relative;
    padding: 10px;
    animation: logoGentlyBreathe 2.5s infinite ease-in-out;
}

.preloader-brand-logo {
    max-width: 180px;
    height: auto;
    display: block;
}

.preloader-progress-container {
    width: 100%;
    height: 3px;
    background-color: var(--color-gray-200);
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

.preloader-progress-bar {
    position: absolute;
    height: 100%;
    width: 50%;
    background: linear-gradient(90deg, var(--color-accent-500) 0%, var(--color-primary-500) 100%);
    border-radius: 10px;
    animation: smoothProgress 1.6s infinite ease-in-out;
}

.preloader-tagline {
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 500;
    color: var(--color-primary-500);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    opacity: 0.8;
    animation: textSoftPulse 2s infinite ease-in-out;
    text-align: center;
}

.preloader-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

body.preloader-active {
    overflow: hidden !important;
}

/* ==========================================
   ELEGANT PRELOADER KEYFRAMES
   ========================================== */


@keyframes smoothProgress {
    0% {
        left: -50%;
        width: 30%;
    }
    50% {
        width: 60%;
    }
    100% {
        left: 100%;
        width: 30%;
    }
}

@keyframes logoGentlyBreathe {
    0%, 100% {
        transform: translateY(0) scale(0.98);
    }
    50% {
        transform: translateY(-4px) scale(1.02);
    }
}


@keyframes textSoftPulse {
    0%, 100% {
        opacity: 0.6;
    }
    50% {
        opacity: 1;
    }
}
    </style>
	<!-- Custom CSS -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
     <link rel="stylesheet" href="css/style.css?v=1.6">
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


<?php if (basename($_SERVER['PHP_SELF']) === 'index.php') : ?>

<!-- <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Is it mandatory to buy insurance from a Canadian Insurance company instead of from a company in their home country?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Canadian medical providers prefer working with Canadian insurance companies due to direct billing. Claims are processed faster and companies are regulated under high standards. They are also backed by Assuris, covering up to $60,000 if an insurer becomes insolvent. Proof of insurance is best provided in English or French."
      }
    },
    {
      "@type": "Question",
      "name": "Who is eligible for the new parent and grandparent super visa?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Parents and grandparents of Canadian citizens or permanent residents who meet admissibility requirements are eligible. Factors include ties to home country, purpose of visit, financial condition, and invitations from Canadian hosts."
      }
    },
    {
      "@type": "Question",
      "name": "What documents are required by the applicant to file a case?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Required documents include a financial support letter from a child or grandchild in Canada, proof of Canadian medical insurance for at least one year, and completion of an Immigration Medical Examination."
      }
    },
    {
      "@type": "Question",
      "name": "Can my parents buy health insurance from their home country?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Proof of Canadian medical insurance is required. Visitors are advised to purchase insurance from a Canadian provider."
      }
    },
    {
      "@type": "Question",
      "name": "Why has the government made it mandatory to purchase visitor's insurance from a Canadian company?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Canadian insurance companies are regulated within Canada, ensuring claims are properly managed and reducing risks for the government and visitors."
      }
    },
    {
      "@type": "Question",
      "name": "What amount of Visitors travel medical insurance should I purchase?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Medical costs in Canada can exceed $3,000 per day. It is recommended to purchase at least $100,000 coverage for financial protection and peace of mind."
      }
    },
    {
      "@type": "Question",
      "name": "Can I purchase a policy for my family members visiting Canada?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, you can purchase a visitors insurance policy on behalf of family members coming to Canada."
      }
    },
    {
      "@type": "Question",
      "name": "Can I get a discount if I buy visitor's insurance for multiple people?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "You can request a quote online or call the toll-free number. Competitive pricing may be offered based on your requirements."
      }
    },
    {
      "@type": "Question",
      "name": "If I have a pre-existing condition, can I get coverage?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Coverage depends on the condition and policy. Some plans cover stable pre-existing conditions if they meet criteria. Others may exclude them. Always review policy details carefully."
      }
    },
    {
      "@type": "Question",
      "name": "Do I need a medical test before purchasing Visitors to Canada insurance?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "No medical exam is required. However, you must answer medical questions honestly, as incorrect information may void your coverage."
      }
    }
  ]
}
</script> -->

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "What types of insurance does Punjab Insurance offer in Canada?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Punjab Insurance helps you explore different insurance options, including life insurance, term life insurance, whole life insurance, universal life insurance, critical illness insurance, disability insurance, Super Visa insurance, and other available coverage options. Our advisors can help you understand which options suit your needs."
    }
  },{
    "@type": "Question",
    "name": "How can I get an insurance quote from Punjab Insurance?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You can submit an inquiry through our website to request an insurance quote. Our team can help you explore available plans based on your needs, age, health, and budget."
    }
  },{
    "@type": "Question",
    "name": "How do I choose the right insurance plan for my needs?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The right insurance plan depends on your financial goals, family responsibilities, age, health, and budget. Comparing coverage, premiums, benefits, and policy terms can help you make an informed decision. You can also speak with an advisor to understand your options."
    }
  },{
    "@type": "Question",
    "name": "What factors affect insurance premiums in Canada?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Insurance premiums depend on several factors, including your age, health, type of insurance, coverage amount, and the insurance company's guidelines. Your actual rate may vary depending on the policy and your personal circumstances."
    }
  },{
    "@type": "Question",
    "name": "Can I compare insurance plans from different companies?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Yes, Punjab Insurance can help you compare available insurance plans from different providers."
    }
  },{
    "@type": "Question",
    "name": "Can I get insurance if I have a pre-existing medical condition?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You may still qualify for certain insurance plans if you have a pre-existing medical condition. Eligibility, premiums, and coverage depend on the type of insurance, your medical history, and the insurer's requirements."
    }
  },{
    "@type": "Question",
    "name": "How can I speak to a Punjab Insurance advisor?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "You can contact through the contact details provided on our website or submit an online inquiry. Our team can answer your questions, explain available insurance options, and help you understand the next steps."
    }
  }]
}
</script>


<meta name="google-site-verification" content="xx1VieIXyAEODLsaMRlO9tT7gPdCdvmE1J7kBf9bb64" />

<?php endif; ?>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-59C876K9');</script>
<!-- End Google Tag Manager -->


<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "xz2a67rs1a");
</script> 



</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-59C876K9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
   
<div id="preloader">
    <div class="preloader-wrapper">
      
        <div class="preloader-logo-area">
            <img src="images/punjabinsurance-logo.gif" width="222" height="106" alt="Punjab Insurance" class="preloader-brand-logo">
        </div>
        
     
        <div class="preloader-progress-container">
            <div class="preloader-progress-bar"></div>
        </div>
        
     
        <span class="preloader-tagline">Securing your future...</span>
    </div>
</div>

	<div class="body-overlay"></div>

	<!-- Header -->
	<header class="header shadow-sm">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-2 items-center gap-6">
					<div class="flex items-center gap-2">
						<img src="images/icons/call-filled-white-16x16.svg">
						<span><span class="font-semibold hidden md:inline-flex">24 x 7 Tollfree:</span> <a href="tel:+18889786522">1-888-978-6522</a></span></span>
					</div>
					<div class="flex items-center justify-end gap-4 md:gap-6">
						<div class="flex items-center" id="searchHeader">
							<div id="searchBoxWrap">
								<input type="text" id="searchBox" placeholder="Search..." autocomplete="off">
							</div>
							<span id="searchToggle">
								<img src="images/icons/search-white-18x18.svg" width="16">
							</span>
							<ul id="searchSuggestions"></ul>
						</div>
						
						<a href="join-us.php" class="font-medium hidden md:inline-flex">Join Us</a>

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
						<a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" class="header-logo" alt="punjabinsurance" width="222" height="106" title="punjabinsurance"></a>
					</div>
					<div class="col-span-9 xl:col-span-10">
						<div class="flex items-center justify-end gap-6">
                            <div class="navlist-wrap">
                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                    <div class="navlist-logo"><a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" width="222" height="106" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                    <div class="navlist-close">&times;</div>
                                </div>
                                <ul class="flex items-center gap-4 navlist">
                                    <li><a href="https://www.punjabinsurance.ca/">Home</a></li>

                                     <li>
                                        <a href="#" class="mega-toggle flex items-center gap-1.5" data-menu="about-menu">
                                            About Us
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </a>

                                        <div id="about-menu" class="mega-menu" style="display: none;">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" width="222" height="106" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>
                                                
                                                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-6 lg:gap-y-0">
                                                    <div class="col-span-12 lg:col-span-4">
                                                        <ul id="megaNav" class="mega-nav flex flex-col gap-4">
                                                            <li data-target="aboutUs" class="active">About Us</li>
                                                            <li data-target="joinUs">Join Us</li>
                                                            <li data-target="megaLocations">Locations</li>
                                                        </ul>

                                                        <div class="mega-lets-talk hidden lg:flex">
                                                            <h2 class="mega-lets-talk-heading">Let's Talk</h2>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-aboutUs" class="content-section mega-content">
                                                            <h2 class="mega-content-heading">About Us</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="about-punjab-insurance.php"><img src="images/icons/company-building-primary-48.svg">About Punjab Insurance</a></li>
                                                                        <li><a href="photo-gallery.php"><img src="images/icons/gallery-primary-48.svg">Photo Gallery</a></li>
                                                                        <li><a href="media-center-press-release.php"><img src="images/icons/newspaper-primary-48.svg">Media Center/Press Release</a></li>
                                                                        <li><a href="privacy-policy.php"><img src="images/icons/document-lock-primary-48.svg">Privacy Policy</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="buy-sell-agreements.php"><img src="images/icons/document-agreement-primary-48.svg">Buy-Sell Agreements</a></li>
                                                                        <!-- <li><a href="google-reviews.php"><img src="images/icons/chat-bubble-primary-48.svg">Google Reviews</a></li> -->
                                                                        <li><a href="blogs.php"><img src="images/icons/writing-primary-48.svg">Blogs</a></li>
                                                                        <li><a href="contact.php"><img src="images/icons/call-primary-48.svg">Contact Us</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-joinUs" class="content-section mega-content hidden">
                                                            <h2 class="mega-content-heading">Join Us</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="classes.php">
                                                                            <img src="images/icons/classes-projector-primary-48.svg">LLQP Classes</a></li>
                                                                        <li><a href="our-commercials.php"><img src="images/icons/video-gallery-primary-48.svg">Our Commercials</a></li>
                                                                        <li><a href="business-ownership.php"><img src="images/icons/ceo-primary-48.svg">Business Ownership</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="companies-we-represent.php"><img src="images/icons/company-double-building-primary-48.svg">Companies We Represent</a></li>
                                                                        <li><a href="our-history.php"><img src="images/icons/book-primary-48.svg">Our History</a></li>
                                                                        <li><a href="join-us.php"><img src="images/icons/user-add-primary-48.svg">Join Us</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-megaLocations" class="content-section mega-content hidden">
    <h2 class="mega-content-heading">Our Locations</h2>
    <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
        <!-- British Columbia -->
        <div class="col-span-12 lg:col-span-6">
            <h5 class="text-body-base font-semibold text-primary-500 mb-3">British Columbia</h5>
            <ul class="flex flex-col gap-6 mega-links-list">
                <li><a href="life-insurance-surrey.php"><img src="images/icons/shield-check-primary-48.svg">Life Insurance in Surrey</a></li>
                <li><a href="term-life-insurance-surrey.php"><img src="images/icons/calendar-user-primary-48.svg">Term Life Insurance in Surrey</a></li>
                <li><a href="super-visa-insurance-surrey.php"><img src="images/icons/elders-primary-48.svg">Super Visa Insurance in Surrey</a></li>
            </ul>
        </div>
        
        <!-- Ontario -->
        <div class="col-span-12 lg:col-span-6">
            <h5 class="text-body-base font-semibold text-primary-500 mb-3">Ontario</h5>
            <ul class="flex flex-col gap-6 mega-links-list">
                <li><a href="life-insurance-toronto.php"><img src="images/icons/shield-check-primary-48.svg">Life Insurance in Toronto</a></li>
            </ul>
        </div>
    </div>
    
    <?php //include 'includes/nav-blogs-section.php'; ?>
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

                                        <div id="life-insurance-menu" class="mega-menu" style="display: none;">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" width="222" height="106" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
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
                                                            <h2 class="mega-lets-talk-heading">Let's Talk</h2>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-lifeInsurance" class="content-section mega-content">
                                                            <h2 class="mega-content-heading">Life Insurance</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="life-insurance.php"><img src="images/icons/shield-check-primary-48.svg">Life Insurance</a></li>
                                                                        <li><a href="term-life-insurance.php"><img src="images/icons/calendar-user-primary-48.svg">Term Life Insurance</a></li>
                                                                        <li><a href="whole-life-insurance.php"><img src="images/icons/shield-lock-primary-48.svg">Whole Life Insurance</a></li>
                                                                        <li><a href="universal-life-insurance.php"><img src="images/icons/umbrella-primary-48.svg">Universal Life Insurance</a></li>
                                                                        <li><a href="permanent-life-insurance.php"><img src="images/icons/shield-user-primary-48.svg">Permanent Life Insurance</a></li>
                                                                        <li><a href="million-dollar-life-insurance-policy.php"><img src="images/icons/shield-dollar-primary-48.svg">Million Dollar Policy</a></li>
                                                                        <li><a href="money-back-life-insurance.php"><img src="images/icons/wallet-primary-48.svg">Money Back Life Insurance</a></li>
                                                                        <li><a href="income-replacement-insurance.php"><img src="images/icons/wallet-arrow-down-primary-48.svg">Income Replacement Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="mortgage-insurance.php"><img src="images/icons/home-shield-primary-48.svg">Mortgage Insurance</a></li>
                                                                        <li><a href="critical-illness-insurance.php"><img src="images/icons/heart-pulse-primary-48.svg">Critical Illness Insurance</a></li>
                                                                        <li><a href="disability-insurance.php"><img src="images/icons/disabled-person-primary-48.svg">Disability Insurance</a></li>
                                                                        <li><a href="non-medical-life-insurance.php"><img src="images/icons/document-check-primary-48.svg">Non Medical Insurance</a></li>
                                                                        <li><a href="drug-dental-insurance.php"><img src="images/icons/shield-tooth-primary-48.svg">Drug and Dental Insurance</a></li>
                                                                        <li><a href="free-insurance-plan.php"><img src="images/icons/baby-primary-48.svg">Free Insurance Plan</a></li>
                                                                        <li><a href="insurance-retirement-plan.php"><img src="images/icons/growth-chart-primary-48.svg">Insurance + Retirement Plan</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-livingBenefits" class="content-section hidden">
                                                            <h2 class="mega-content-heading">Living Benefits</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="critical-illness-insurance.php"><img src="images/icons/heart-pulse-primary-48.svg">Critical Illness Insurance</a></li>
                                                                        <li><a href="disability-insurance.php"><img src="images/icons/disabled-person-primary-48.svg">Disability Insurance</a></li>
                                                                        <li><a href="mortgage-insurance.php"><img src="images/icons/home-shield-primary-48.svg">Mortgage Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="loan-protection-insurance.php"><img src="images/icons/loan-primary-48.svg">Loan Protection Insurance</a></li>
                                                                        <li><a href="emergency-medical-insurance.php"><img src="images/icons/shield-medical-primary-48.svg">Emergency Medical Insurance</a></li>
                                                                        <li><a href="insurance-retirement-plan.php"><img src="images/icons/growth-chart-primary-48.svg">Insurance + Retirement Plan</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-Investments" class="content-section hidden">
                                                            <h2 class="mega-content-heading">Investments</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="registered-retirement-savings-plan.php"><img src="images/icons/piggy-bank-primary-48.svg">Registered Retirement Savings Plan (RRSP)</a></li>
                                                                        <li><a href="tax-free-savings-account.php"><img src="images/icons/growth-plant-primary-48.svg">Tax-Free Savings Account (TFSA)</a></li>
                                                                        <li><a href="registered-education-savings-plan.php"><img src="images/icons/education-cap-primary-48.svg">Registered Education Savings Plan (RESP)</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="rrsp-loan.php"><img src="images/icons/loan-primary-48.svg">RRSP Loan</a></li>
                                                                        <li><a href="buy-sell-agreements.php"><img src="images/icons/document-agreement-primary-48.svg">Buy-Sell Agreements</a></li>
                                                                        <li><a href="new-immigrant-and-rrsp.php"><img src="images/icons/immigrant-primary-48.svg">New Immigrant & RRSP</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-travelInsurance" class="content-section hidden">
                                                            <h2 class="mega-content-heading">Travel Insurance</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="insurance-for-visitors-to-canada.php"><img src="images/icons/tourist-primary-48.svg">Insurance for Visitors to Canada</a></li>
                                                                        <li><a href="travel-insurance-for-canadians.php"><img src="images/icons/flight-hands-primary-48.svg">Travel Insurance for Canadians</a></li>
                                                                        <li><a href="insurance-for-students-in-canada.php"><img src="images/icons/education-cap-primary-48.svg">Insurance for Students</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
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

                                        <div id="super-visa-menu" class="mega-menu" style="display: none;">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" width="222" height="106" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>

                                                <div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-6 lg:gap-y-0">
                                                    <div class="col-span-12 lg:col-span-4">
                                                        <ul id="megaNav" class="mega-nav flex flex-col gap-4">
                                                            <li data-target="superVisaInsurance" class="active">Super Visa Insurance</li>
                                                            <li data-target="onlineRateComparison">Online Rate Comparison</li>
                                                        </ul>

                                                        <div class="mega-lets-talk hidden lg:flex">
                                                            <h2 class="mega-lets-talk-heading">Let's Talk</h2>
                                                            <p>We offer expert, personalized guidance to help you find the right insurance plan for your needs. Our team makes the process simple, transparent, and stress-free.</p>
                                                            <a href="contact.php" class="btn btn-md btn-filled-primary">
                                                                <img src="images/icons/call-filled-white-16x16.svg">
                                                                Schedule a Call
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-span-12 lg:col-span-8">
                                                        <div id="content-superVisaInsurance" class="content-section mega-content">
                                                            <h2 class="mega-content-heading">Super Visa Insurance</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="super-visa-insurance.php"><img src="images/icons/elders-primary-48.svg">Super Visa Insurance</a></li>
                                                                        <li><a href="super-visa-insurance-cost.php"><img src="images/icons/shield-dollar-primary-48.svg">Super Visa Insurance Cost</a></li>
                                                                        <li><a href="income-requirements-for-super-visa.php"><img src="images/icons/wallet-primary-48.svg">Income Requirements for Super Visa (LICO)</a></li>
                                                                        <li><a href="benefits-of-super-visa-insurance.php"><img src="images/icons/checklist-primary-48.svg">Benefits of Super Visa Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="faqs-on-super-visa-insurance-for-parents.php"><img src="images/icons/qa-primary-48.svg">FAQs on Super Visa Insurance for Parents</a></li>
                                                                        <li><a href="super-visa-application.php"><img src="images/icons/document-form-primary-48.svg">Super Visa Application Form</a></li>
                                                                        <li><a href="super-visa-insurance-eligibility.php"><img src="images/icons/user-check-primary-48.svg">Eligibility for Super Visa Insurance</a></li>
                                                                        <li><a href="super-visa-insurance-quote.php"><img src="images/icons/calculator-primary-48.svg">Super Visa Insurance Quote</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            
                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>

                                                        <div id="content-onlineRateComparison" class="content-section mega-content mt-5">
                                                            <h2 class="mega-content-heading">Online Rate Comparison</h2>
                                                            <div class="grid grid-cols-12 gap-x-0 lg:gap-x-9 gap-y-6 lg:gap-y-0">
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="super-visa-insurance-medical-condition.php"><img src="images/icons/medical-history-primary-48.svg">Pre-existing Medical Conditions</a></li>
                                                                        <li><a href="super-visa-insurance-diabetes.php"><img src="images/icons/diabetes-primary-48.svg">Super Visa Insurance for Patients with Diabetes</a></li>
                                                                        <li><a href="tips-buying-super-visa-insurance.php"><img src="images/icons/document-filled-primary-64.svg">Tips Before Buying Super Visa Insurance</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-span-12 lg:col-span-6">
                                                                    <ul class="flex flex-col gap-6 mega-links-list">
                                                                        <li><a href="mistakes-while-buying-super-visa-insurance.php"><img src="images/icons/cross-circle-primary-48.svg">Mistakes While Buying Super Visa Insurance</a></li>
                                                                        <li><a href="how-to-complete-super-visa-application-form.php"><img src="images/icons/document-check-primary-48.svg">How to Complete Super Visa Application Form</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <?php //include 'includes/nav-blogs-section.php'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="rdsp.php" class="flex items-center gap-1.5">
                                            RDSP
                                        </a>
                                    </li>

                                    <li>
                                        <a href="rrsp.php" class="flex items-center gap-1.5">
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

                                        <div id="advisor-menu" class="mega-menu mega-dropdown" style="display: none;">
                                            <div class="container mx-auto px-4">
                                                <div class="navlist-wrap-header-mbl flex lg:hidden">
                                                    <div class="navlist-logo"><a href="https://www.punjabinsurance.ca/"><img src="images/punjabinsurance-logo.gif" width="222" height="106" class="header-logo" alt="punjabinsurance" title="punjabinsurance"></a></div>
                                                    <div class="navlist-close">&times;</div>
                                                </div>

                                                <ul class="flex flex-col gap-6 mega-links-list">
                                                    <li><a href="https://www.quotes.punjabinsurance.ca/users/login"><img src="images/icons/user-checked-primary-48.svg">Login</a></li>
                                                    <li><a href="canadian-insurance-companies.php"><img src="images/icons/company-double-building-primary-48.svg">Canadian Insurance Companies</a></li>
                                                    <li><a href="illustration-softwares.php"><img src="images/icons/software-laptop-primary-48.svg">Illustration Softwares</a></li>
                                                    <li><a href="calculators.php"><img src="images/icons/calculator-primary-48.svg">Calculators</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="flex flex-col lg:hidden bg-primary-100 rounded-lg p-4">
                                        <div class="text-body-base font-semibold mb-4">
                                            <p class="mb-1">Mail Us</p>
                                            <a href="mailt:admin@punjabinsurance.ca" class="text-primary-500 underline">admin@punjabinsurance.ca</a>
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
                                                        <img src="images/icons/icon-facebook.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://x.com/punjabinsurance" title="X" target="_blank">
                                                        <img src="images/icons/icon-x.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/404/" title="pinterest" target="_blank">
                                                        <img src="images/icons/icon-linkedin.svg">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://in.pinterest.com/punjabinsurance/" title="linkedin" target="_blank">
                                                        <img src="images/icons/Icon-pinterest.svg">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="inline-flex lg:hidden">
                                        <a href="get-a-quote.php" class="btn btn-md btn-filled-cta w-full text-center justify-center">
                                            Request a Free Quote
                                        </a>
                                    </li>

                                    <li class="inline-flex lg:hidden">
                                        <a href="contact.php" class="btn btn-md btn-filled-primary w-full" style="justify-content: center;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" style="transform: rotate(0deg);">
                                                <path d="M14.9625 15.75C13.4 15.75 11.8562 15.4095 10.3312 14.7285C8.80625 14.0475 7.41875 13.0817 6.16875 11.8312C4.91875 10.5807 3.95325 9.19325 3.27225 7.66875C2.59125 6.14425 2.2505 4.6005 2.25 3.0375C2.25 2.8125 2.325 2.625 2.475 2.475C2.625 2.325 2.8125 2.25 3.0375 2.25H6.075C6.25 2.25 6.40625 2.3095 6.54375 2.4285C6.68125 2.5475 6.7625 2.688 6.7875 2.85L7.275 5.475C7.3 5.675 7.29375 5.84375 7.25625 5.98125C7.21875 6.11875 7.15 6.2375 7.05 6.3375L5.23125 8.175C5.48125 8.6375 5.778 9.08425 6.1215 9.51525C6.465 9.94625 6.84325 10.362 7.25625 10.7625C7.64375 11.15 8.05 11.5095 8.475 11.841C8.9 12.1725 9.35 12.4755 9.825 12.75L11.5875 10.9875C11.7 10.875 11.847 10.7907 12.0285 10.7347C12.21 10.6787 12.388 10.663 12.5625 10.6875L15.15 11.2125C15.325 11.2625 15.4687 11.3532 15.5812 11.4847C15.6937 11.6162 15.75 11.763 15.75 11.925V14.9625C15.75 15.1875 15.675 15.375 15.525 15.525C15.375 15.675 15.1875 15.75 14.9625 15.75Z" fill="white"></path>
                                            </svg>
                                            Schedule a Call
                                        </a>
                                    </li>
                                </ul>
                            </div>
							
							<a href="get-a-quote.php" class="btn btn-md btn-filled-cta hidden lg:inline-flex">
								<span>Request a Free Quote</span>
							</a>

							<button id="menu-toggle" aria-label="Open Menu" class="block lg:hidden">
								<img src="images/icons/hamburger-menu.svg">
							</button>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</header>