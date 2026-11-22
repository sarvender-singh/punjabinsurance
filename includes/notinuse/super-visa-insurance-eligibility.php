    <?php 
        $title = "Eligibility Criteria for applicants applying for Super Visa";
        $meta_description = "Super Visa Insurance eligibility criteria and requirements for parents visiting Canada. Understand coverage rules, documentation, and how to qualify easily.";
        // Footer CTA overrides
        $footer_cta_heading = "Need Help?";
        $footer_cta_text = "Our advisors are here to answer your questions and guide you through the application process.";

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
                            <li class="active">Super Visa Eligibility</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Super Visa Insurance<span class="text-accent-300"> Eligibility</span>
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
                            <img src="images/product-main/elderly-couple-reviewing-super-visa-eligibility-with-advisor.webp" alt="Elderly couple reviewing super visa eligibility with advisor">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">Who is Eligible for Super Visa Insurance?</h3>
                            <p class="desc">To apply for the Parent and Grandparent Super Visa, you must meet specific requirements set by the Canadian government-including purchasing qualifying medical insurance coverage. Here's what you need to know to ensure your eligibility.</p>
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

        <!-- Checklist -->
        <section class="product-about">
            <div class="container max-w-[960px] mx-auto px-4">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title title-h4">Document Checklist</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">Super Visa Insurance Requirements</h3>
                        <p class="font-medium mt-4 mb-4">When you apply for a Super Visa, you must provide proof that you have purchased medical insurance (Super Visa insurance) from a Canadian insurance company. The insurance policy must:</p>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>Be valid for a minimum period of one year from the date of entry to Canada</li>
                            <li>Provide at least $100,000 in coverage</li>
                            <li>Cover health care, hospitalization, and repatriation costs (the cost to return you to your home country, if necessary)</li>
                            <li>Be purchased for each parent or grandparent individually</li>
                            <li>Be valid for each entry to Canada and must be available for review by point of entry officers</li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">Background: Super Visa Health Insurance</h3>
                        <p class="font-medium mt-4 mb-4">The Super Visa program was introduced on December 1, 2011, to help clear the backlog of parents and grandparents waiting to join family in Canada. Under this plan:</p>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>Parents and grandparents are granted a 10-year visa, renewable after every 2 years</li>
                            <li>Applicants (or their sponsors) must purchase private Canadian health insurance covering at least $100,000 for each parent during their stay</li>
                            <li>Sponsors must show they can financially support their visiting relatives</li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">Permanent Residency Applicants</h3>
                        <p class="font-medium mt-4 mb-4">If you have applied for permanent residency, you are still eligible for the Super Visa-provided you meet all other conditions. The Canadian government has clarified that applying for permanent residency does not disqualify you from receiving a Super Visa.</p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">Why the Insurance Requirement Matters</h3>
                        <p class="font-medium mt-4 mb-4">The new health insurance requirement makes it easier for visa officers to approve applications, as it ensures visitors are protected and do not impose a financial burden on the Canadian healthcare system.</p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">Support from Punjab Insurance</h3>
                        <p class="font-medium mt-4 mb-4">Punjab Insurance supports families by offering affordable Super Visa insurance quotes and personalized service. We understand your needs and are here to help you find the right plan.</p>
                    </div>
                </div>
            </div>
        </section>

		<?php include 'includes/google-reviews-section.php'; ?>

        <!-- Fomo Quote -->
        <section class="max-w-[800px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="fomo-quote">
                    <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                    Apply for a Super Visa with confidence using a clear, step-by-step approach. This guide walks you through the application process, outlines the required documents, and shares practical tips to help ensure a smooth and successful Super Visa application for your parents or grandparents.
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