    <?php 
        $title = "TFSA in Canada | Toronto & Surrey, BC | Tax-Free Savings Account";
        $meta_description = "Open a Tax-Free Savings Account (TFSA) in Toronto or Surrey across Canada. Grow wealth tax-free, flexible withdrawals & expert investment advice across Canada.";
        // Footer CTA overrides
        $footer_cta_heading = "Start Saving-Get a TFSA Quote Today";
        $footer_cta_text = "Grow your savings tax-free with a TFSA from Punjab Insurance. Contact us for a personalized review and investment strategy session.";

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
                            <li class="active">Tax Free Savings Account</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Grow Your Wealth
                        <div class="text-accent-300">Tax-Free and Flexible</div>
                    </h1>

                    <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                        Maximize your savings with a TFSA from Punjab Insurance. Enjoy tax-free investment growth, flexible withdrawals, and personalized advice to help you reach your financial goals at every stage of life.
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
                            <img src="images/product-main/sikh-couple-reviewing-tax-free-investments.webp" alt="Sikh couple reviewing tax-free investments">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">What Is an TFSA?</h3>
                            <p class="desc">A Tax-Free Savings Account (TFSA) is a registered account that allows Canadians to save and invest money-completely tax-free. Whether you're saving for a big purchase, retirement, or just building an emergency fund, a TFSA gives you the flexibility and freedom to withdraw funds at any time, for any reason, with no tax penalties.</p>
                            <ul class="features">
                                <li><span class="text-primary-500">Tax-free investment growth</span>- no tax on interest, dividends, or capital gains</li>
                                <li><span class="text-primary-500">Flexible contributions and withdrawals</span>- access your money anytime, tax-free</li>
                                <li><span class="text-primary-500">Can hold a wide variety of investments</span>- GICs, stocks, bonds, mutual funds, ETFs, and more</li>
                                <!-- <li><span class="text-primary-500">Unused contribution room</span> carries forward each year</li> -->
                            </ul>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="product-quote-form-wrap shadow-xl">
                            <div id="quoteFormPlaceholder"></div>

                            <div id="inlineFormContainer">
							    <h3 class="product-quote-form-heading">Tax Free Savings Account (TFSA)</h3>
                                <form class="product-quote-form" method="POST">
                                    <div class="grid grid-cols-12 gap-4">

                                        <!-- Name -->
                                        <div class="col-span-12">
                                            <div class="input-group">
                                                <label class="input-label" for="tname">Name <span>*</span></label>

                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none">
                                                            <path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="text" class="input-field" name="tname" id="tname" placeholder="Enter Name" aria-describedby="tname_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-span-12">
                                            <div class="input-group">
                                                <label class="input-label" for="contact_email">Email <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 16" fill="none">
                                                            <path d="M2 16C1.45 16 0.979333 15.8043 0.588 15.413C0.196667 15.0217 0.000666667 14.5507 0 14V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196666 1.45067 0.000666667 2 0H18C18.55 0 19.021 0.196 19.413 0.588C19.805 0.98 20.0007 1.45067 20 2V14C20 14.55 19.8043 15.021 19.413 15.413C19.0217 15.805 18.5507 16.0007 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V14V4Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="email" class="input-field" name="contact_email" id="contact_email" placeholder="Enter Email Id" aria-describedby="contact_email_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-span-12">
                                            <div class="input-group">
                                                <label class="input-label" for="tphone">Phone Number <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 18" fill="none">
                                                            <path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 5.15833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="tel" class="input-field" name="tphone" id="tphone" placeholder="Enter Phone Number" aria-describedby="tphone_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Deposit -->
                                        <div class="col-span-12">
                                            <div class="input-group">
                                                <label class="input-label" for="deposit">How Much Your Like to Deposit? $63,500 Max. <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg fill="#111827" width="22px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.4 489.4" xml:space="preserve" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M354.1,179.4c0-14.2,11.5-25.7,25.7-25.7s25.7,11.5,25.7,25.7s-11.5,25.7-25.7,25.7S354.1,193.6,354.1,179.4z M109.6,205.1 c14.2,0,25.7-11.5,25.7-25.7s-11.5-25.7-25.7-25.7s-25.7,11.5-25.7,25.7C83.8,193.6,95.4,205.1,109.6,205.1z M0,288.5V70.3 c0-23.4,19-42.4,42.4-42.4h404.5c23.4,0,42.4,19,42.4,42.4v218.2c0,23.4-19,42.4-42.4,42.4H42.4C19.1,330.9,0,311.9,0,288.5z M36.2,244.5c2.4-0.4,5-0.7,7.5-0.7c23.7,0,42.9,19.2,42.9,42.9c0,2.7-0.3,5.3-0.7,7.9h314c-0.2-1.7-0.3-3.5-0.3-5.3 c0-23.7,19.2-42.9,42.9-42.9c3.7,0,7.2,0.5,10.6,1.3V116.2c-3.4,0.9-6.9,1.3-10.6,1.3c-23.7,0-42.9-19.2-42.9-42.9 c0-3.6,0.5-7.1,1.3-10.5h-315c0.5,2.6,0.7,5.2,0.7,7.9c0,23.7-19.2,42.9-42.9,42.9c-2.6,0-5.1-0.2-7.5-0.7 C36.2,114.2,36.2,244.5,36.2,244.5z M471.3,359.6H18.8c-10,0-18.1,8.1-18.1,18.1s8.1,18.1,18.1,18.1h452.5c10,0,18.1-8.1,18.1-18.1 S481.3,359.6,471.3,359.6z M471.3,425.3H18.8c-10,0-18.1,8.1-18.1,18.1s8.1,18.1,18.1,18.1h452.5c10,0,18.1-8.1,18.1-18.1 S481.3,425.3,471.3,425.3z M151.8,179.4c0-51.2,41.7-92.9,92.9-92.9s92.9,41.7,92.9,92.9s-41.7,92.9-92.9,92.9 S151.8,230.6,151.8,179.4z M197.2,182.5l17.4,17.5l18,18.1l18.1-18l41.5-41.3l-18-18.1L232.7,182l-17.4-17.5L197.2,182.5z"></path> </g> </g></svg>
                                                    </span>

                                                    <input type="text" class="input-field" name="deposit" id="deposit" placeholder="Enter Deposit Amount" aria-describedby="deposit_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Extra Information -->
                                        <div class="col-span-12">
                                            <div class="input-group">
                                                <label class="input-label" for="extrainfo">Extra Information for TFSA Account Plan <span>*</span></label>

                                                <div class="input-wrapper">
                                                    <span class="input-icon textarea-icon">
                                                        <svg height="16px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#111827;} </style> <g> <path class="st0" d="M396.138,85.295c-13.172-25.037-33.795-45.898-59.342-61.03C311.26,9.2,280.435,0.001,246.98,0.001 c-41.238-0.102-75.5,10.642-101.359,25.521c-25.962,14.826-37.156,32.088-37.156,32.088c-4.363,3.786-6.824,9.294-6.721,15.056 c0.118,5.77,2.775,11.186,7.273,14.784l35.933,28.78c7.324,5.864,17.806,5.644,24.875-0.518c0,0,4.414-7.978,18.247-15.88 c13.91-7.85,31.945-14.173,58.908-14.258c23.517-0.051,44.022,8.725,58.016,20.717c6.952,5.941,12.145,12.594,15.328,18.68 c3.208,6.136,4.379,11.5,4.363,15.574c-0.068,13.766-2.742,22.77-6.603,30.442c-2.945,5.729-6.789,10.813-11.738,15.744 c-7.384,7.384-17.398,14.207-28.634,20.479c-11.245,6.348-23.365,11.932-35.612,18.68c-13.978,7.74-28.77,18.858-39.701,35.544 c-5.449,8.249-9.71,17.686-12.416,27.641c-2.742,9.964-3.98,20.412-3.98,31.071c0,11.372,0,20.708,0,20.708 c0,10.719,8.69,19.41,19.41,19.41h46.762c10.719,0,19.41-8.691,19.41-19.41c0,0,0-9.336,0-20.708c0-4.107,0.467-6.755,0.917-8.436 c0.773-2.512,1.206-3.14,2.47-4.668c1.29-1.452,3.895-3.674,8.698-6.331c7.019-3.946,18.298-9.276,31.07-16.176 c19.121-10.456,42.367-24.646,61.972-48.062c9.752-11.686,18.374-25.758,24.323-41.968c6.001-16.21,9.242-34.431,9.226-53.96 C410.243,120.761,404.879,101.971,396.138,85.295z"></path> <path class="st0" d="M228.809,406.44c-29.152,0-52.788,23.644-52.788,52.788c0,29.136,23.637,52.772,52.788,52.772 c29.136,0,52.763-23.636,52.763-52.772C281.572,430.084,257.945,406.44,228.809,406.44z"></path> </g> </g></svg>
                                                    </span>

                                                    <textarea class="input-field" name="extrainfo" id="extrainfo" placeholder="Please Enter Extra Info if there is any." aria-describedby="extrainfo_status" required></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-span-12">
                                            <a id="lifeinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                                                <span>Submit</span>
                                                <img src="images/icons/send-plane.svg" width="14" alt="send-plane">
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- How it Works -->
        <section class="product-about bg-brand-linear pb-12 lg:pb-16">
			<div class="container max-w-[1140px] mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title">How Does TFSA Work?</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid lg:grid-cols-4 gap-6">
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon bg-primary-50">
                                <img src="images/icons/wallet-multicolor-48.svg" alt="Contribute">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Contribute</h6>
                                <p class="pointer-card__desc">Add funds up to your annual TFSA limit (set by the government; unused room carries forward)</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon bg-primary-50">
                                <img src="images/icons/growth-hand-multicolor-48.svg" alt="Grow">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Grow</h6>
                                <p class="pointer-card__desc">Investments inside your TFSA grow tax-free-no taxes on earnings or withdrawals</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon bg-primary-50">
                                <img src="images/icons/money-down-multicolor-48.svg" alt="Withdraw">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Withdraw</h6>
                                <p class="pointer-card__desc">Take money out at any time, for any purpose, with no tax consequences</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon bg-primary-50">
                                <img src="images/icons/return-premium-multicolor-48.svg" alt="Spousal RRSPs">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Re-contribute</h6>
                                <p class="pointer-card__desc">Amounts withdrawn are added back to your contribution room in the following year</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- TFSA vs. RRSP-Which Is Better? -->
        <section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading left-hr">
                    <div class="heading-copy">
                        <h2 class="title title-h4">TFSA vs. RRSP-Which Is Better?</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <h3 class="heading-h6 text-gray-900 font-bold">Both TFSAs and RRSPs are powerful savings tools, but they serve different purposes:</h3>
                    <ul class="blogs-list-items mt-4">
                        <li><span class="text-gray-900 font-semibold">TFSA</span>: Best for flexible savings, short-term goals, or if you expect to be in a higher tax bracket later. Withdrawals are tax-free and do not affect government benefits.</li>
                        <li><span class="text-gray-900 font-semibold">RRSP</span>: Best for long-term retirement savings, especially if you're in a higher tax bracket now and expect to be in a lower bracket in retirement. Contributions are tax-deductible, but withdrawals are taxed.</li>
                    </ul>
                    <p><span class="text-gray-900 font-semibold">Tip</span>: Many Canadians benefit from using both accounts as part of a balanced savings strategy.</p>
                </div>
            </div>
		</section>
        
        <!-- Benefits About Punjabinsurance -->
		<section class="bg-brand-linear mt-16 lg:mt-20 py-12 lg:py-16">
            <div class="max-w-[1024px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading center">
                        <div class="heading-copy">
                            <h2 class="title title-h4">Why Choose Punjab Insurance?</h2>
                        </div>
                        <hr>
                    </div>

                    <div class="section-content">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                            <div class="pointer-card values-card">
                                <div class="pointer-card__icon">
                                    <img src="images/icons/shield-user-multicolor-48.svg" alt="shield-user-multicolor">    
                                </div>
                                <div class="pointer-card__copy">
                                    <h6 class="card-common_heading">Access to Canada's top insurers and competitive quotes</h6>
                                </div>
                            </div>
                            <div class="pointer-card values-card">
                                <div class="pointer-card__icon">
                                    <img src="images/icons/hand-mortgage-multicolor-48.svg" alt="hand-mortgage-multicolor">
                                </div>
                                <div class="pointer-card__copy">
                                    <h6 class="card-common_heading">Expert advisors to help you compare options and choose the right coverage</h6>
                                </div>
                            </div>
                            <div class="pointer-card values-card">
                                <div class="pointer-card__icon">
                                    <img src="images/icons/slider-multicolor-48.svg" alt="Transparent advice">
                                </div>
                                <div class="pointer-card__copy">
                                    <h6 class="card-common_heading">Transparent advice on the pros and cons of each option</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</section>

        <!-- FAQ -->
        <section class="max-w-[960px] mx-auto mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h4 class="subheading">FREQUENTLY ASKED QUESTIONS</h4>
                        <h2 class="title title-h4">Frequently Asked Questions about<br>TFSA</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="faq-accordion pb-8">
                        <div class="faq-item">
                            <div class="faq-question">How much can I contribute to my TFSA?</div>
                            <div class="faq-answer">
                                Your annual limit is set by the government and unused room accumulates-ask us for your personalized limit.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">What investments can I hold in my TFSA?</div>
                            <div class="faq-answer">
                                You can invest in GICs, mutual funds, stocks, bonds, ETFs, and more.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Do TFSA withdrawals affect government benefits?</div>
                            <div class="faq-answer">
                                No-withdrawals are tax-free and do not impact OAS, GIS, or other income-tested benefits.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">How do I get started?</div>
                            <div class="faq-answer">
                                <a href="get-a-quote.php" class="text-primary-500 underline">Get a free quote</a> or <a href="contact.php" class="text-primary-500 underline">schedule a call</a> with a licensed Punjab Insurance advisor for personalized help.
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="faq.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto">
                            <span>View all Faq's</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 14" fill="none" class="rotate-35">
                                <g clip-path="url(#clip0_1032_10019)">
                                    <path d="M18.7495 7.49939H5.25052C4.83055 7.49939 4.50058 7.16942 4.50058 6.74945C4.50058 6.32949 4.83055 5.99951 5.25052 5.99951H18.7495C19.1694 5.99951 19.4994 6.32949 19.4994 6.74945C19.4994 7.16942 19.1694 7.49939 18.7495 7.49939Z" fill="white"/>
                                    <path d="M14.9998 12.749C14.9014 12.7502 14.8039 12.7308 14.7135 12.6921C14.6231 12.6533 14.5418 12.5961 14.4748 12.524C14.1748 12.2241 14.1748 11.7591 14.4748 11.4591L19.1994 6.7345L14.4748 2.00987C14.1748 1.70989 14.1748 1.24493 14.4748 0.944953C14.7748 0.644977 15.2397 0.644977 15.5397 0.944953L20.7893 6.19454C21.0893 6.49452 21.0893 6.95948 20.7893 7.25946L15.5397 12.5091C15.3897 12.659 15.1947 12.734 15.0148 12.734L14.9998 12.749Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1032_10019">
                                        <rect width="24" height="13.4989" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
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
                    Grow your wealth with a tax-free and flexible TFSA. Enjoy tax-free investment growth, convenient withdrawals, and personalized guidance to help you achieve your financial goals-today and at every stage of life.
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