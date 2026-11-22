
    <?php 
        $title = "Tips Buying Super Visa Insurance";
        $meta_description = "We advise that you keep the following tips in mind before applying for a insurance policy.";
        // Footer CTA overrides
        $footer_cta_heading = "Need Help?";
        $footer_cta_text = "Our advisors are ready to answer your questions and guide you through the process.";
		$canonical_url = "";

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
                            <li class="active">Tips Buying Super Visa Insurance</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Tips Before Buying
                        <div class="text-accent-300">Super Visa Insurance</div>
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
                            <img src="images/product-main/sikh-man-and-elder-woman-reviewing-super-visa-tips.webp" alt="Sikh man and elder woman reviewing super visa tips">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">Key Suggestions Before You Purchase Super Visa Insurance</h3>
                            <p>Punjab Insurance partners with all major Canadian insurance companies to provide Super Visa Insurance that fully meets IRCC Super Visa insurance requirements. Before you apply, keep these essential tips in mind to ensure a smooth process and the right coverage.</p>
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

        <!-- Tips for Buying Super Visa Insurance -->
        <section class="product-about bg-brand-linear pb-12 lg:pb-16">
            <div class="container mx-auto px-4">
                <div class="max-w-[1024px] lg:px-8">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title">Top Tips for Buying Super Visa Insurance</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        <ul class="blogs-list-items">
                            <li><span class="text-gray-900 font-medium">Purchase Insurance Before Applying</span>: You must have proof of medical insurance before submitting your Super Visa application. Coverage must be at least $100,000 and valid for a minimum of one year.</li>
                            <li><span class="text-gray-900 font-medium">Choose the Right Policy Start Date</span>: Applicants can select the insurance start date. You have flexibility to adjust this date before the policy becomes effective-just call or email your insurance agent. The coverage should begin on the day your parents or grandparents arrive in Canada.</li>
                            <li><span class="text-gray-900 font-medium">Refunds for Visa Denial</span>: If the Super Visa application is declined, most insurers provide a full refund once proof of refusal is received (subject to insurer terms and conditions). Punjab Insurance will help you submit the required documents and request the refund.</li>
                            <li><span class="text-gray-900 font-medium">Refunds for Early Departure</span>: If your parents or grandparents leave Canada early, a pro-rated refund for the unused portion may be available (typically if no claims are made and subject to insurer terms).</li>
                            <li><span class="text-gray-900 font-medium">Coverage for Pre-existing Conditions</span>: Some plans cover pre-existing conditions such as diabetes, high blood pressure, and heart conditions-but only if the condition is stable. “Stable” generally means no change in medication, no pending tests, and no new symptoms or concerns as per your doctor. Always review the policy and consult your advisor for clarification.</li>
                            <li><span class="text-gray-900 font-medium">Renewing for Longer Stays</span>: If your stay in Canada will exceed one year, you must purchase a new policy at least 8 days before your existing policy expires.</li>
                        </ul>
                    </div>
                </div>
			</div>
		</section>

        <!-- Our Commitment -->
        <section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title title-h4">Our Commitment</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    The Punjab Insurance team works hard to deliver the best Super Visa Insurance plans for your peace of mind. We're here to help you find the right coverage at your convenience.
                </div>
            </div>
        </section>

		<?php include 'includes/google-reviews-section.php'; ?>

        <!-- Fomo Quote -->
        <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="fomo-quote">
                    <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                    Make informed choices before purchasing Super Visa Insurance with confidence. Punjab Insurance works with leading Canadian insurers to provide coverage that meets IRCC Super Visa requirements. Reviewing these essential tips before you apply can help ensure a smooth application process and the right protection for your parents or grandparents.
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