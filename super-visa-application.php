    <?php 
        $title = "Super Visa Application Canada | Toronto & Surrey, BC";
        $meta_description = "Apply for a Super Visa with expert help and get Super Visa insurance Canada coverage. Trust Punjab Insurance Inc. for fast processing and reliable support.";
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
                            <li class="active">Super Visa Application</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Super Visa <span class="text-accent-300">Application</span>
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
                            <img src="images/product-main/family-completing-super-visa-application-together.webp" alt="Family completing super visa application together">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">Step-by-Step Guide to Applying for a Super Visa</h3>
                            <p class="desc">Planning to apply for a Super Visa for your parents or grandparents? Here's how to complete the application process, what documents you need, and tips to make your application smooth and successful.</p>
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
                    <div>
                        <h3 class="heading-h6 text-gray-900 font-bold">1. Download the Required Forms and Checklists</h3>
                        <p class="font-medium mt-4 mb-4">Before you start your application, download and review the checklist to help you cross-check your forms and supporting documents.</p>
                        <p class="text-body-base-plus text-gray-900 font-semibold mt-4 mb-4">Essential Documents:</p>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>Super Visa Application Form (IMM5257-E)</li>
                            <li>Checklist</li>
                            <li>Schedule 1 Application</li>
                            <li>Statutory Declaration of Common Law Union (if applicable)</li>
                            <li>Use of Representative (if applicable)</li>
                            <li>Photograph Specifications</li>
                        </ul>
                        <p class="font-medium mt-4 italic">Download all forms directly from the official CIC website.</p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">2. Prepare Your Application</h3>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>Clearly indicate on the IMM5257-E form that you are applying for a Super Visa (multiple entry category).</li>
                            <li>Attach all required supporting documents as listed in the checklist.</li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">3. Meet the Super Visa Requirements</h3>
                        <p class="font-medium mt-4 mb-4">In addition to being found admissible to Canada, the parent or grandparent applicant must:</p>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>Provide a written commitment of financial support from their child or grandchild in Canada who meets the minimum income threshold</li>
                            <li>Provide proof of Canadian medical insurance coverage for at least one year</li>
                            <li>Complete an Immigration Medical Examination</li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <h3 class="heading-h6 text-gray-900 font-bold">4. Tips for a Successful Application</h3>
                        <ul class="blogs-list-items with-check font-medium mt-4">
                            <li>State all facts and figures clearly and honestly.</li>
                            <li>Get insurance coverage from a Canadian insurance company.</li>
                            <li>Double-check all forms and documents before submitting.</li>
                            <li>For a free, no-obligation quote on Super Visa insurance, fill out our online form or call us for assistance.</li>
                        </ul>
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