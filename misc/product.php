    <?php 
        $title = "Term Life Insurance - Punjab Insurance";
        include 'includes/header.php';
    ?>

	<!-- Main -->
	<main class="main">
		<!-- Hero -->
		<section class="hero-with-bg-image hero-overlay py-12 lg:pb-32 text-left lg:text-center product-hero-bg">
			<div class="hero-content">
				<div class="container mx-auto px-4">
                    <nav class="breadcrumb light mt-0 flex justify-start lg:justify-center" aria-label="Breadcrumb">
                        <ol>
                            <li><a href="/">Home</a></li>
                            <li class="active">Term Life Insurance</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Protect your loved ones with
                        <div class="text-accent-300">Canada's most trusted Term Insurance</div>
                    </h1>

					<p class="hero-desc text-white mb-0 lg:mb-9">
					    Secure high coverage at low premiums - because peace of mind shouldn't cost a fortune.
					</p>
				</div>
			</div>
		</section>

        <!-- Product Quote -->
		<section class="product-quote">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-6">
					<div class="col-span-12 lg:col-span-6">
                        <div class="product-slider">
                            <div class="owl-carousel" id="product-carousel">
                                <div class="item">
                                    <img src="images/national-cancer-institute.webp" alt="...">
                                </div>
                                <div class="item">
                                    <img src="images/nguy-n.webp" alt="...">
                                </div>
                                <div class="item">
                                    <img src="images/care-assure.webp" alt="...">
                                </div>
                            </div>

                            <div class="custom-carousel-nav parent-center bg-transparent p-0 light">
                                <button id="customPrdctHeroNavPrev">
                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg);"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.25 16.25C10.1493 16.2466 10.0503 16.2227 9.95921 16.1797C9.86807 16.1367 9.78668 16.0756 9.72001 16C9.57956 15.8594 9.50067 15.6688 9.50067 15.47C9.50067 15.2713 9.57956 15.0806 9.72001 14.94L12.72 11.94L9.72001 8.94002C9.66069 8.79601 9.64767 8.63711 9.68277 8.48536C9.71786 8.33361 9.79933 8.19656 9.91586 8.09322C10.0324 7.98988 10.1782 7.92538 10.3331 7.90868C10.4879 7.89198 10.6441 7.92391 10.78 8.00002L14.28 11.5C14.4205 11.6407 14.4994 11.8313 14.4994 12.03C14.4994 12.2288 14.4205 12.4194 14.28 12.56L10.78 16C10.7133 16.0756 10.6319 16.1367 10.5408 16.1797C10.4497 16.2227 10.3507 16.2466 10.25 16.25Z" fill="none"></path> </g></svg>
                                </button>

                                <button id="customPrdctHeroNavNext">
                                    <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.25 16.25C10.1493 16.2466 10.0503 16.2227 9.95921 16.1797C9.86807 16.1367 9.78668 16.0756 9.72001 16C9.57956 15.8594 9.50067 15.6688 9.50067 15.47C9.50067 15.2713 9.57956 15.0806 9.72001 14.94L12.72 11.94L9.72001 8.94002C9.66069 8.79601 9.64767 8.63711 9.68277 8.48536C9.71786 8.33361 9.79933 8.19656 9.91586 8.09322C10.0324 7.98988 10.1782 7.92538 10.3331 7.90868C10.4879 7.89198 10.6441 7.92391 10.78 8.00002L14.28 11.5C14.4205 11.6407 14.4994 11.8313 14.4994 12.03C14.4994 12.2288 14.4205 12.4194 14.28 12.56L10.78 16C10.7133 16.0756 10.6319 16.1367 10.5408 16.1797C10.4497 16.2227 10.3507 16.2466 10.25 16.25Z" fill="none"></path> </g></svg>
                                </button>
                            </div>
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">Term Life Insurance</h3>
                            <p class="desc">Term Life Insurance provides financial protection for your loved ones in case of an unfortunate event. With affordable premiums and customizable terms, you can ensure your family's financial stability for years to come.</p>
                            <ul class="features">
                                <li><span class="text-primary-500">Affordable</span> Premiums, <span class="text-primary-500">Higher</span> Coverage</li>
                                <li><span class="text-primary-500">Simple & Transparent</span> Protection</li>
                                <li><span class="text-primary-500">Flexible</span> Policy Options</li>
                            </ul>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="product-quote-form-wrap shadow-xl">
							<h3 class="product-quote-form-heading">Get a Quote</h3>
                            <?php include 'includes/get-quote-form.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

         <!-- Product About -->
		<section class="product-about bg-brand-linear pb-12 lg:pb-16">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-12 gap-y-9 lg:gap-y-0 items-center">
					<div class="col-span-12 lg:col-span-5">
                        <div class="about-company-video">
                            <iframe
                            src="https://www.youtube.com/embed/VIDEO_ID"
                            title="Punjab Insurance"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                            ></iframe>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-7">
						<div class="hp-about-right">
							<div class="section-heading">
								<div class="heading-copy">
									<h4 class="subheading">ABOUT TERM LIFE INSURANCE</h4>
									<h2 class="title">What is Term Life Insurance</h2>
								</div>
								<hr>
							</div>
                            <div class="section-content">
                                <div class="section-desc">
                                    <strong>Term Life Insurance is one of the simplest and most affordable ways to secure your family's financial future.</strong> It provides a fixed coverage amount for a specific period, ensuring that your loved ones are financially protected in the unfortunate event of your passing during the policy term.
                                    <br><br>
                                    <strong>The biggest advantage of term life insurance is the high coverage at low premiums.</strong> With just a small monthly payment, you can secure a substantial sum assured, often running into lakhs or even crores. This money can help your family cover essential expenses like home loans, education costs, daily living expenses, and even long-term financial goals, providing peace of mind during uncertain times.
                                    <br><br>
                                    <strong>Flexibility is another key feature of term insurance.</strong> You can choose the coverage amount and policy term that best matches your needs, whether it's 10, 20, or 30 years.
                                </div>

                                <a href="get-a-quote.php" class="btn btn-lg btn-filled-cta flex sm:inline-flex mt-12">
                                    <span>Get a Free Quote</span>
                                    <img src="images/icons/arrow-right-white-24.svg">
                                </a>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- Values -->
		<section class="values-section mt-16 lg:mt-20">
			<div class="container mx-auto px-4">
                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/protection-shield.svg" alt="Pure Protection"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Pure Protection</h6>
                                <p class="pointer-card__desc">Your policy focuses only on financial security for your family, without any investment or savings element.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/premium-money-hand.svg" alt="High Coverage at Low Premium"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">High Coverage at Low Premium</h6>
                                <p class="pointer-card__desc">Get high coverage at low cost, an economical way to protect your loved ones.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/terms-check-document.svg" alt="Flexible Policy Terms"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Flexible Policy Terms</h6>
                                <p class="pointer-card__desc">Choose the duration that suits your needs-10, 20, or even 30 years of protection.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon"><img src="images/icons/family-man.svg" alt="Peace of Mind for Your Family"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Peace of Mind for Your Family</h6>
                                <p class="pointer-card__desc">Ensure that your loved ones remain financially stable, even in your absence.</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- Advantages -->
		<section class="bg-brand-linear mt-16 lg:mt-20 pt-12 pb-12 lg:pt-16 lg:pb-16">
			<div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h4 class="subheading">TERM INSURANCE BENEFITS</h4>
                        <h2 class="title">Advantages of Choosing Our<br>Term Life Insurance Plans</h2>
                    </div>
                    <hr>
                </div>

				<div class="section-content">
					<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 items-start">
						<div class="pointer-card advantages-card">
							<div class="pointer-card__icon"><img src="images/comprehensive-coverage-illustration.webp"></div>
							<div class="pointer-card__copy">
								<h6 class="card-common_heading">Comprehensive Coverage Options</h6>
								<p class="pointer-card__desc">From life and health to travel and motor insurance, we offer a wide range of policies to suit your needs and lifestyle.</p>
							</div>
						</div>
                        <div class="pointer-card advantages-card">
							<div class="pointer-card__icon"><img src="images/affordable-illustration.webp"></div>
							<div class="pointer-card__copy">
								<h6 class="card-common_heading">Affordable Premiums</h6>
								<p class="pointer-card__desc">Flexible plans and competitive pricing ensure you get maximum protection without straining your budget.</p>
							</div>
						</div>
                        <div class="pointer-card advantages-card">
							<div class="pointer-card__icon"><img src="images/comprehensive-coverage-illustration.webp"></div>
							<div class="pointer-card__copy">
								<h6 class="card-common_heading">Quick & Hassle-Free Claims</h6>
								<p class="pointer-card__desc">Our streamlined claim settlement process ensures you get support when you need it the most-without unnecessary delays.</p>
							</div>
						</div>
                        <div class="pointer-card advantages-card">
							<div class="pointer-card__icon"><img src="images/expert-guidance-illustration.webp"></div>
							<div class="pointer-card__copy">
								<h6 class="card-common_heading">Expert Guidance</h6>
								<p class="pointer-card__desc">Our experienced advisors provide personalized recommendations, helping you choose the right plan for your future.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <!-- Plans -->
		<section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="grid sm:grid-cols-2 gap-6 items-center section-heading-with-right-col">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h4 class="subheading">OUR PLANS</h4>
                            <h2 class="title">Most Popular Term Life Insurance Plans</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="custom-carousel-nav hidden sm:flex">
                        <button id="customMppNavPrev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none" style="transform: rotate(180deg);">
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
                        </button>

                        <button id="customMppNavNext">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none">
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
                        </button>
                    </div>
                </div>
            </div>
            <div class="section-content pl-4 lg:pl-12">
                <div class="owl-carousel" id="mpp-carousel">
                    <div class="item">
					    <div class="plan-card peach">
						    <div class="plan-chip">Life Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Secure Term Life Plan</h5>
								<ul class="plan-features">
								    <li>Coverage: Up to $50,000 (Medical + Trip Delay)</li>
									<li>Flexible Terms: 10 / 20 / 30 years</li>
									<li>Premium From: ₹550/month</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
							</a>
						</div>
					</div>
					<div class="item">
					    <div class="plan-card blue">
						    <div class="plan-chip">Travel Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Global Travel Shield</h5>
								<ul class="plan-features">
								    <li>Coverage: Up to $100,000 (Medical + Trip Delay)</li>
								    <li>Duration: 7 days - 180 days</li>
									<li>Premium From: ₹300/month</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
						    </a>
						</div>
					</div>
					<div class="item">
						<div class="plan-card lavender">
							<div class="plan-chip">Mortgage Insurance</div>
							<div class="plan-copy">
								<h5 class="card-common_heading">Home Loan Protection Plan</h5>
								<ul class="plan-features">
									<li>Coverage: Equal to loan amount (₹20L - ₹1Cr)</li>
									<li>Policy Term: Matches loan tenure</li>
								    <li>Premium From: ₹800/month</li>
							    </ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
						    </a>
					    </div>
					</div>
					<div class="item">
					    <div class="plan-card green">
						    <div class="plan-chip">Health Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Family Health Plus</h5>
								<ul class="plan-features">
								    <li>Coverage: ₹10 Lakh</li>
									<li>Benefits: Cashless hospitals, No-claim bonus</li>
								    <li>Premium From: ₹1,200/month</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
							</a>
						</div>
					</div>
					<div class="item">
					    <div class="plan-card pink">
						    <div class="plan-chip">Home Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Home Protect Plan</h5>
								<ul class="plan-features">
								    <li>Coverage: ₹5 Lakh - ₹25 Lakh (Building + Contents)</li>
									<li>Policy Term: 1 year</li>
								    <li>Premium From: ₹600/year</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
							</a>
						</div>
					</div>
					<div class="item">
					    <div class="plan-card beige">
						    <div class="plan-chip">Motor Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Comprehensive Car Insurance</h5>
								<ul class="plan-features">
								    <li>Coverage: Vehicle damage, third-party liability, theft, fire</li>
									<li>Policy Term: 1 year</li>
									<li>Premium From: ₹350/year</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
							</a>
						</div>
					</div>
                    <div class="item">
					    <div class="plan-card yellow">
						    <div class="plan-chip">Motor Insurance</div>
							<div class="plan-copy">
							    <h5 class="card-common_heading">Two-Wheeler Insurance</h5>
								<ul class="plan-features">
								    <li>Coverage: Vehicle damage, third-party liability, theft</li>
									<li>Policy Term: 1 year</li>
									<li>Premium From: ₹850/year</li>
								</ul>
							</div>
                            <a href="product.php" class="btn btn-sm btn-filled-primary w-full">
							    View Plan
							</a>
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
                        <h2 class="title title-h4">Term Life Insurance FAQ's</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="faq-accordion">
                        <div class="faq-item">
                            <div class="faq-question">What industries does Cancard serve?</div>
                            <div class="faq-answer">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Who is eligible for the new parent and grandparent super visa?</div>
                            <div class="faq-answer">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">What documents are required by the applicant to file a case?</div>
                            <div class="faq-answer">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Can my parents buy health insurance from their home country?</div>
                            <div class="faq-answer">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Can I purchase a policy for my family members who are planning to come for a visit?</div>
                            <div class="faq-answer">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process -->
        <section class="bg-brand-linear mt-16 lg:mt-20 pt-12 pb-12 lg:pt-16 lg:pb-16">
            <div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h4 class="subheading">HOW IT WORKS</h4>
                        <h2 class="title">Get Your Term Life Insurance<br>In 5 Easy Steps</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid lg:grid-cols-5 gap-6">
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon"><img src="images/icons/forms-document.svg"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Fill Out a Quick Form</h6>
                                <p class="pointer-card__desc">Share your basic details like age, and contact information.</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon"><img src="images/icons/search-review.svg"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Our Team Reviews</h6>
                                <p class="pointer-card__desc">We assess your requirements and match them with suitable plans.</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon"><img src="images/icons/files-document.svg"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Get a Free Quote</h6>
                                <p class="pointer-card__desc">Receive a personalized insurance quote directly from our experts.</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon"><img src="images/icons/customer-support-multicolor-48.svg"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Connect with Advisor</h6>
                                <p class="pointer-card__desc">Our advisor contacts you to explain benefits and answer your questions.</p>
                            </div>
                        </div>
                        <div class="pointer-card process-card">
                            <div class="pointer-card__icon"><img src="images/icons/options-dots.svg"></div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Choose Freely</h6>
                                <p class="pointer-card__desc">No pressure - take your time to review and choose what fits best.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Reviews -->
		<section class="mt-16 lg:mt-20">
            <div class="container mx-auto px-4">
                <div class="grid sm:grid-cols-2 gap-6 items-center section-heading-with-right-col">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h4 class="subheading">GOOGLE REVIEWS</h4>
                            <h2 class="title title-h4">Trusted by Thousands</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="custom-carousel-nav hidden sm:flex">
                        <button id="customgReviewsNavPrev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none" style="transform: rotate(180deg);">
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
                        </button>

                        <button id="customgReviewsNavNext">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none">
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
                        </button>
                    </div>
                </div>
            </div>
            <div class="section-content pl-4 lg:pl-12">
                <div class="owl-carousel" id="g-reviews-carousel">
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img1.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Aisha Malik</h6>
                                        <p class="review-date">Sep 18, 2025</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "I purchased a term life insurance plan and was impressed by the professionalism and clarity. The advisor patiently explained all options and helped me choose the right coverage. The process was smooth, and I now feel confident that my family's financial future is well protected."
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img2.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Emily Carter</h6>
                                        <p class="review-date">July 12, 2025</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "Getting my health insurance was quick and hassle-free. The team guided me through multiple plans, explained benefits in detail, and answered all my questions. I felt reassured throughout the process. Their transparency and responsiveness made selecting the right policy."
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img3.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Owen Mitchelle</h6>
                                        <p class="review-date">Feb 14, 2025</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "I recently filed a small claim and was impressed with how efficient and smooth the process was. The staff guided me step by step, and I received the payout promptly. The experience gave me full confidence in their service and made me feel secure about my coverage."
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img4.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Arjun Patel</h6>
                                        <p class="review-date">Nov 28, 2024</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "Choosing a term insurance plan felt overwhelming at first, but the team made it simple and straightforward. They explained exactly what was covered and addressed all my questions. Premiums are affordable, and I now feel confident that my family is financially protected."
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img5.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Rahul Mehta</h6>
                                        <p class="review-date">Aug 27, 2025</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "Overall, I had a positive experience purchasing health insurance. The policies were explained clearly, and I felt no pressure to decide quickly. Some email responses were slightly delayed, but the staff was friendly and helpful. I am satisfied with the coverage."
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="g-review-card">
                            <div class="g-review-card-head">
                                <div class="g-review-card-user">
                                    <img src="images/review-img6.webp" class="user-profile-image">
                                    <div>
                                        <h6 class="user-name">Meera Kapoor</h6>
                                        <p class="review-date">Mar 22, 2025</p>
                                    </div>
                                </div>
                                <img src="images/icons/google-g-logo.svg" class="g-review-g-logo">
                            </div>
                            <div class="g-review-card-rating">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                                <img src="images/icons/rating-star.svg">
                            </div>
                            <div class="g-review-copy">
                                "I was looking for reliable health insurance and found the team very supportive. They explained all policy benefits and helped me select the best coverage for my needs. It took a little longer than expected to receive all documents, but the overall process was smooth and reassuring."
                            </div>
						</div>
					</div>
				</div>
                <div class="flex justify-center">
                    <a href="google-reviews.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto">
                        <span>View all Google Reviews</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none">
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
		</section>

        <!-- Blogs -->
		<section class="blogs-section bg-primary-100 mt-16 lg:mt-20 pt-12 pb-12 lg:pt-16 lg:pb-16">
            <div class="container mx-auto px-4">
                <div class="grid sm:grid-cols-2 gap-6 items-center section-heading-with-right-col">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h4 class="subheading">OUR BLOGS</h4>
                            <h2 class="title title-h4">Recent Term Life Insurance Blogs</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="custom-carousel-nav hidden sm:flex">
                        <button id="customBlogsNavPrev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none" style="transform: rotate(180deg);">
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
                        </button>

                        <button id="customBlogsNavNext">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none">
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
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="section-content pl-4 lg:pl-12">
                <div class="owl-carousel" id="blogs-carousel">
                    <div class="item">
					    <div class="blog-card">
                            <div class="blog-thumb">
                                <img src="images/national-cancer-institute.webp">
                            </div>
                            <div class="blog-thumb-content">
                                <div class="blog-thumb-category-chips">
                                    <a href="blogs-archive.php" class="blog-category-chip">Term Insurance</a>
                                    <a href="blogs-archive.php" class="blog-category-chip">Health Insurance</a>
                                </div>
                                <h3 class="blog-thumb-title"><a href="blogs-single.php">Why Term Life Insurance is the Smartest Choice for Young Families</a></h3>
                                <div class="blog-thumb-meta">
                                    <div class="blog-thumb-author">
                                        <img src="images/avatar-face1.webp">
                                        <span>Ethan Carter</span>
                                    </div>
                                    <div class="blog-thumb-date">
                                        <img src="images/icons/calendar.svg" width="15">
                                        <span>March 12, 2025</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="blog-card">
                            <div class="blog-thumb">
                                <img src="images/nguy-n.webp">
                            </div>
                            <div class="blog-thumb-content">
                                <div class="blog-thumb-category-chips">
                                    <a href="blogs-archive.php" class="blog-category-chip">Health Insurance</a>
                                </div>
                                <h3 class="blog-thumb-title"><a href="blogs-single.php">7 Reasons Why Health Insurance is a Must-Have in Today's World</a></h3>
                                <div class="blog-thumb-meta">
                                    <div class="blog-thumb-author">
                                        <img src="images/avatar-face2.webp">
                                        <span>Olivia Hayes</span>
                                    </div>
                                    <div class="blog-thumb-date">
                                        <img src="images/icons/calendar.svg" width="15">
                                        <span>January 15, 2025</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="blog-card">
                            <div class="blog-thumb">
                                <img src="images/towfiqu-barbhuiya.webp">
                            </div>
                            <div class="blog-thumb-content">
                                <div class="blog-thumb-category-chips">
                                    <a href="blogs-archive.php" class="blog-category-chip">Mortgage Insurance</a>
                                </div>
                                <h3 class="blog-thumb-title"><a href="blogs-single.php">Mortgage Insurance: What It Is and Why You Need It</a></h3>
                                <div class="blog-thumb-meta">
                                    <div class="blog-thumb-author">
                                        <img src="images/avatar-face3.webp">
                                        <span>Liam Foster</span>
                                    </div>
                                    <div class="blog-thumb-date">
                                        <img src="images/icons/calendar.svg" width="15">
                                        <span>October 21, 2024</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="blog-card">
                            <div class="blog-thumb">
                                <img src="images/care-assure.webp">
                            </div>
                            <div class="blog-thumb-content">
                                <div class="blog-thumb-category-chips">
                                    <a href="blogs-archive.php" class="blog-category-chip">Disability Insurance</a>
                                </div>
                                <h3 class="blog-thumb-title"><a href="blogs-single.php">How Disability Insurance Works: A Complete Guide</a></h3>
                                <div class="blog-thumb-meta">
                                    <div class="blog-thumb-author">
                                        <img src="images/avatar-face4.webp">
                                        <span>Mason Brooks</span>
                                    </div>
                                    <div class="blog-thumb-date">
                                        <img src="images/icons/calendar.svg" width="15">
                                        <span>August 3, 2024</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="item">
					    <div class="blog-card">
                            <div class="blog-thumb">
                                <img src="images/caroline-lm.webp">
                            </div>
                            <div class="blog-thumb-content">
                                <div class="blog-thumb-category-chips">
                                    <a href="blogs-archive.php" class="blog-category-chip">Drug & Dental Insurance</a>
                                </div>
                                <h3 class="blog-thumb-title"><a href="blogs-single.php">How Drug Insurance Helps Manage Chronic Illnesses</a></h3>
                                <div class="blog-thumb-meta">
                                    <div class="blog-thumb-author">
                                        <img src="images/avatar-face5.webp">
                                        <span>Sophia Bennet</span>
                                    </div>
                                    <div class="blog-thumb-date">
                                        <img src="images/icons/calendar.svg" width="15">
                                        <span>March 19, 2024</span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
                <div class="flex justify-center">
                    <a href="blogs.php" class="btn btn-sm btn-outline-primary flex sm:inline-flex mx-auto">
                        <span>View all Blogs</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 14" fill="none">
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
		</section>

        <!-- Fomo Quote -->
        <section class="max-w-[800px] mx-auto mt-16 lg:mt-20 mb-16 lg:mb-0">
            <div class="container mx-auto px-4">
                <div class="fomo-quote">
                    <img src="images/icons/oui_quote_muted.svg" class="fomo-quote-icon" width="48">
                    Protect your family's future with affordable term insurance. Get high coverage at low premiums, ensuring financial security for your loved ones even in your absence. Peace of mind today means stability tomorrow.
                </div>
            </div>
        </section>
	</main>

    <!-- Get a Quote Modal -->
    <div id="quoteModal" class="modal-container">
        <div class="modal-box">
            <span id="modalClose" class="modal-close">&times;</span>
            <h3 class="product-quote-form-heading mb-8">Get a Quote</h3>
            <?php include 'includes/get-quote-form.php'; ?>
        </div>
    </div>

    <!-- Floating Get a Quote Button -->
    <button id="quote-float-btn" class="flex lg:hidden">Get a Quote</button>

    <?php include 'includes/footer.php'; ?>