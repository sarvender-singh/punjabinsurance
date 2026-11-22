    <?php 
        $title = "Super Visa Insurance for Medical condition";
        $meta_description = "If you are Parents or Grandparents travelling to Canada on Super visa category make sure to apply for a Canadian medical Insurance.";
        // Footer CTA overrides
        $footer_cta_heading = "Questions About Pre-existing Condition Coverage?";
        $footer_cta_text = "Our advisors are here to help you understand your options and choose the right plan for your needs.";

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
                            <li class="active">Pre Existing Medical Conditions</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Super visa insurance for
                        <div class="text-accent-300">pre-existing medical condition</div>
                    </h1>
				</div>
			</div>
		</section>

        <!-- Product image Slider & Quote -->
		<section class="product-quote">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-6">
					<div class="col-span-12 lg:col-span-6">
                        <div class="product-slider">
                            <img src="images/product-main/elderly-sikh-couple-reviewing-medical-rates.webp" alt="Elderly Sikh couple reviewing medical rates">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">Travel with Confidence even with Pre-existing Health Issues</h3>
                            <p>Don't let conditions like diabetes, heart disease, or high blood pressure stand in the way of visiting your loved ones in Canada. With the right planning and coverage, you can travel safely and with peace of mind.</p>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="product-quote-form-wrap shadow-xl">
							<?php include 'includes/super-visa-insurance-get-quote-form.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- Get Super Visa Insurance -->
        <section class="product-about bg-brand-linear pb-12 lg:pb-16">
            <div class="container mx-auto px-4">
                <div class="max-w-[1024px] lg:px-8">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title">Can You Get Super Visa Insurance with a Pre-existing Condition?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        <ul class="blogs-list-items">
                            <li>Coverage for pre-existing conditions depends on your specific health situation and the terms of your insurance policy.</li>
                            <li>Some Canadian insurance companies offer plans that cover pre-existing conditions, but this often requires a stability period (the length varies by insurer and plan).</li>
                            <li>Not all pre-existing conditions are covered. Policies may use strict eligibility questions and may exclude certain conditions. Examples may include recent use of implantable cardiac devices (e.g., pacemaker/ICD), oral steroids for lung conditions, recent stroke, blood clots, congestive heart failure, or heart murmur-but this varies by insurer.</li>
                            <li><span class="text-gray-900 font-semibold">Always read your entire policy</span> and consult with your insurance advisor to understand definitions, exclusions, and eligibility rules before purchasing.</li>
                        </ul>
                    </div>
                </div>
			</div>
		</section>

        <!-- Tips -->
        <section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title title-h4">Tips for Travelling Safely with a Pre-existing Condition</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <ul class="blogs-list-items font-medium mt-4">
                        <li>Carry extra medication and keep it in your carry-on bag. Bring a prescription letter from your doctor listing all medications.</li>
                        <li>Protect your medicines from extreme temperatures-especially insulin or heart medications. Store them in a cool, dark place.</li>
                        <li>Track medication timing when flying across time zones. Ask your doctor for help adjusting your schedule.</li>
                        <li>Bring healthy snacks in case meals aren't available while travelling.</li>
                        <li>Request special meals (low sugar, low fat, low salt) in advance from airlines or hotels if needed.</li>
                        <li>See your doctor about a month before travel for a check-up and to stabilize your condition.</li>
                        <li>Wear a medical ID bracelet or card with details about your condition and emergency contacts.</li>
                        <li>Pack first-aid medicines for common travel issues like fever or stomach upset.</li>
                        <li>Stick to your routine as much as possible-even while travelling.</li>
                        <li>Wear comfortable shoes and clothing suitable for the season.</li>
                        <li>For medication and travel-health planning, consult your doctor or pharmacist before travel.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Remember -->
        <section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title title-h4">Remember</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    With proper preparation and the right Super Visa Insurance plan, you can enjoy your trip to Canada safely-even with a pre-existing medical condition. Take care of your health, plan ahead, and travel with confidence.
                </div>
            </div>
        </section>

		<?php include 'includes/google-reviews-section.php'; ?>

        <!-- Fomo Quote -->
        <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="fomo-quote">
                    <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                    Travel with confidence to Canada-even with pre-existing medical conditions. With the right Super Visa Insurance plan, conditions such as diabetes, heart disease, or high blood pressure don't have to limit your visit. Proper coverage and expert guidance help ensure you and your loved ones stay protected, so you can focus on spending quality time together with peace of mind.
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