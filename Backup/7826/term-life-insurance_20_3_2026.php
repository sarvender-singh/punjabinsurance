    <?php 
        $title = "Term Life Insurance";
        $meta_description = "Life insurance provide protection for the ones you love, for a Term or Whole life Insurance Quote";
        
        // Footer CTA overrides
        $footer_cta_heading = "Ready to Protect Your Family?";
        $footer_cta_text = "Contact us today for a free, no-obligation quote and expert guidance. Punjab Insurance makes it easy to compare plans and secure your family's future.";

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
                            <li class="active">Term Life Insurance</li>
                        </ol>
                    </nav>

                    <h1 class="hero-heading text-white">
                        Flexible, Affordable
                        <div class="text-accent-300">Protection for Every Stage of Life</div>
                    </h1>

                    <h2 class="hero-subheading text-white mb-0 lg:mb-6">
                        Get peace of mind with term life insurance-affordable, customizable, and designed to protect your loved ones when it matters most.
                    </h2>

					<p class="hero-desc text-white mb-0 lg:mb-9">
					    Punjab Insurance has been helping Canadian families with term life insurance for over 25 years. We compare multiple Canadian insurers to find coverage that fits your budget and needs.
					</p>
				</div>
			</div>
		</section>

        <!-- Product image Slider & Quote -->
		<section class="product-quote">
			<div class="container mx-auto px-4">
				<div class="grid grid-cols-12 gap-x-0 lg:gap-x-6">
					<div class="col-span-12 lg:col-span-6">
                        <div class="product-slider">
                            <img src="images/product-main/sikh-family-walking-on-lakeside-beach.webp" alt="Sikh family walking on lakeside beach">
                        </div>

                        <div class="product-main-info">
                            <h3 class="title">What Is Term Life Insurance?</h3>
                            <p class="desc">Term life insurance provides coverage for a fixed period-usually 10, 20, or 30 years. If the policyholder passes away during the term, their beneficiaries receive a generally tax-free lump sum (under current Canadian tax rules). If the policy expires before a claim, coverage ends, though many plans offer renewal or conversion to permanent insurance.</p>
                            <ul class="features">
                                <li><span class="text-primary-500">Simple, transparent</span> Coverage</li>
                                <li><span class="text-primary-500">Low premiums</span> for high protection</li>
                                <li>Ideal for <span class="text-primary-500">families, mortgages, and income</span> replacement</li>
                            </ul>
                        </div>
					</div>
					<div class="col-span-12 lg:col-span-6">
						<div class="product-quote-form-wrap shadow-xl">
                            <div id="quoteFormPlaceholder"></div>

                            <div id="inlineFormContainer">
							    <h3 class="product-quote-form-heading">Term Life Insurance</h3>
                                <form class="product-quote-form" method="POST">
                                    <div class="grid grid-cols-12 gap-4">

                                        <!-- Insurance Type -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="instype">Insurance Type <span>*</span></label>

                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 20" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.298 0.126819C8.69262 -0.0208285 9.12379 -0.040077 9.53 0.0718195L9.702 0.126819L16.702 2.75182C17.0569 2.88491 17.3667 3.11613 17.5953 3.41852C17.8239 3.72092 17.9618 4.08205 17.993 4.45982L18 4.62482V9.98782C18 11.6082 17.5624 13.1986 16.7336 14.591C15.9048 15.9834 14.7154 17.1262 13.291 17.8988L13.025 18.0378L9.671 19.7148C9.48632 19.807 9.28461 19.8601 9.07847 19.8708C8.87233 19.8815 8.66621 19.8495 8.473 19.7768L8.329 19.7148L4.975 18.0378C3.52561 17.3131 2.29878 16.2105 1.424 14.8464C0.549233 13.4824 0.0589805 11.9074 0.00500011 10.2878L0 9.98782V4.62482C5.81505e-06 4.24595 0.107627 3.87487 0.310334 3.55479C0.513041 3.23471 0.802495 2.97879 1.145 2.81682L1.298 2.75182L8.298 0.126819ZM9 1.99982L2 4.62482V9.98782C2.00003 11.2428 2.33745 12.4747 2.97696 13.5546C3.61646 14.6345 4.53451 15.5225 5.635 16.1258L5.87 16.2488L9 17.8138L12.13 16.2488C13.2527 15.6876 14.2039 14.8347 14.8839 13.7797C15.5638 12.7246 15.9476 11.5061 15.995 10.2518L16 9.98782V4.62482L9 1.99982ZM8.508 5.44782C8.77879 5.34647 9.07433 5.33145 9.354 5.40482L9.492 5.44782L12.292 6.49782C12.5376 6.58995 12.7524 6.74923 12.9119 6.95751C13.0714 7.16579 13.1691 7.41468 13.194 7.67582L13.2 7.80882V9.95382C13.2 10.6971 13.0027 11.4271 12.6283 12.0692C12.254 12.7114 11.7159 13.2427 11.069 13.6088L10.879 13.7108L9.537 14.3808C9.39165 14.4536 9.23302 14.4961 9.07075 14.5057C8.90848 14.5154 8.74594 14.4919 8.593 14.4368L8.463 14.3818L7.122 13.7108C6.45728 13.3784 5.89266 12.8756 5.48577 12.2537C5.07889 11.6318 4.84432 10.913 4.806 10.1708L4.8 9.95382V7.80882C4.80003 7.54656 4.87373 7.28958 5.0127 7.06717C5.15166 6.84475 5.35031 6.66584 5.586 6.55082L5.708 6.49782L8.508 5.44782ZM9 7.39982L6.8 8.22482V9.95482C6.80011 10.335 6.89873 10.7087 7.08626 11.0394C7.27378 11.3701 7.54381 11.6465 7.87 11.8418L8.016 11.9218L9 12.4138L9.984 11.9218C10.3243 11.7517 10.6146 11.4963 10.8267 11.1804C11.0388 10.8646 11.1653 10.4992 11.194 10.1198L11.2 9.95382V8.22482L9 7.39982Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <select class="input-field" name="instype" id="instype" aria-describedby="instype_status" required>
                                                        <option value="">Please choose</option>
                                                        <option value="1">Life Insurance</option>
                                                        <option value="2" selected="">Term Life Insurance</option>
                                                        <option value="3">Whole Life Insurance</option>
                                                        <option value="4">Universal Life Insurance</option>
                                                        <option value="5">Permanent Life Insurance</option>
                                                        <option value="6">Mortgage Insurance</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product Type -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="pi">Product Type <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 19 20" fill="none">
                                                            <path d="M3.5 9L9 0L14.5 9H3.5ZM14.5 20C13.25 20 12.1877 19.5627 11.313 18.688C10.4383 17.8133 10.0007 16.7507 10 15.5C9.99933 14.2493 10.437 13.187 11.313 12.313C12.189 11.439 13.2513 11.0013 14.5 11C15.7487 10.9987 16.8113 11.4363 17.688 12.313C18.5647 13.1897 19.002 14.252 19 15.5C18.998 16.748 18.5607 17.8107 17.688 18.688C16.8153 19.5653 15.7527 20.0027 14.5 20ZM0 19.5V11.5H8V19.5H0ZM14.5 18C15.2 18 15.7917 17.7583 16.275 17.275C16.7583 16.7917 17 16.2 17 15.5C17 14.8 16.7583 14.2083 16.275 13.725C15.7917 13.2417 15.2 13 14.5 13C13.8 13 13.2083 13.2417 12.725 13.725C12.2417 14.2083 12 14.8 12 15.5C12 16.2 12.2417 16.7917 12.725 17.275C13.2083 17.7583 13.8 18 14.5 18ZM2 17.5H6V13.5H2V17.5ZM7.05 7H10.95L9 3.85L7.05 7Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <select class="input-field" name="pi" id="pi" aria-describedby="pi_status" required>
                                                        <option value="">Please choose</option>
				                                        <option value="0">Life Pay</option>
                                                        <option value="1">Pay to 65</option>
                                                        <option value="2">25 to Pay</option>
                                                        <option value="3">20 to Pay</option>
                                                        <option value="4">15 to Pay</option>
                                                        <option value="5">Quick Pay</option>
                                                        <option value="6">Adjustable Life Pay</option>
                                                        <option value="7">Adjustable Pay to 65</option>
                                                        <option value="8">Adjustable 10-20 Pay</option>
                                                        <option value="9">Unique Whole Life</option>
                                                        <option value="10">All Products</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Face Amount -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="faceamount">Face Amount <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 21 18" fill="none">
                                                            <path d="M2 18C1.45 18 0.979333 17.8043 0.588 17.413C0.196667 17.0217 0.000666667 16.5507 0 16V5C0 4.71667 0.0960001 4.47933 0.288 4.288C0.48 4.09667 0.717333 4.00067 1 4C1.28267 3.99933 1.52033 4.09533 1.713 4.288C1.90567 4.48067 2.00133 4.718 2 5V16H16C16.2833 16 16.521 16.096 16.713 16.288C16.905 16.48 17.0007 16.7173 17 17C16.9993 17.2827 16.9033 17.5203 16.712 17.713C16.5207 17.9057 16.2833 18.0013 16 18H2ZM6 14C5.45 14 4.97933 13.8043 4.588 13.413C4.19667 13.0217 4.00067 12.5507 4 12V1C4 0.716667 4.096 0.479333 4.288 0.288C4.48 0.0966668 4.71733 0.000666667 5 0H20C20.2833 0 20.521 0.0960001 20.713 0.288C20.905 0.48 21.0007 0.717333 21 1V12C21 12.55 20.8043 13.021 20.413 13.413C20.0217 13.805 19.5507 14.0007 19 14H6ZM6 12H19V2H6V12ZM9 9H11C11.2833 9 11.521 8.904 11.713 8.712C11.905 8.52 12.0007 8.28267 12 8V5C12 4.71667 11.904 4.47933 11.712 4.288C11.52 4.09667 11.2827 4.00067 11 4H9C8.71667 4 8.47933 4.096 8.288 4.288C8.09667 4.48 8.00067 4.71733 8 5V8C8 8.28333 8.096 8.521 8.288 8.713C8.48 8.905 8.71733 9.00067 9 9ZM14 9H16C16.2833 9 16.521 8.904 16.713 8.712C16.905 8.52 17.0007 8.28267 17 8C16.9993 7.71733 16.9033 7.48 16.712 7.288C16.5207 7.096 16.2833 7 16 7H14C13.7167 7 13.4793 7.096 13.288 7.288C13.0967 7.48 13.0007 7.71733 13 8C12.9993 8.28267 13.0953 8.52033 13.288 8.713C13.4807 8.90567 13.718 9.00133 14 9ZM14 6H16C16.2833 6 16.521 5.904 16.713 5.712C16.905 5.52 17.0007 5.28267 17 5C16.9993 4.71733 16.9033 4.48 16.712 4.288C16.5207 4.096 16.2833 4 16 4H14C13.7167 4 13.4793 4.096 13.288 4.288C13.0967 4.48 13.0007 4.71733 13 5C12.9993 5.28267 13.0953 5.52033 13.288 5.713C13.4807 5.90567 13.718 6.00133 14 6Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <select class="input-field" name="faceamount" id="faceamount" aria-describedby="faceamount_status" required>
                                                        <option value="">Please choose</option>
                                                        <option value="25000">$25,000</option>
                                                        <option value="30000">$30,000</option>
                                                        <option value="35000">$35,000</option>
                                                        <option value="40000">$40,000</option>
                                                        <option value="45000">$45,000</option>
                                                        <option value="50000">$50,000</option>
                                                        <option value="55000">$55,000</option>
                                                        <option value="60000">$60,000</option>
                                                        <option value="65000">$65,000</option>
                                                        <option value="70000">$70,000</option>
                                                        <option value="75000">$75,000</option>
                                                        <option value="80000">$80,000</option>
                                                        <option value="85000">$85,000</option>
                                                        <option value="90000">$90,000</option>
                                                        <option value="95000">$95,000</option>
                                                        <option value="100000" selected="">$100,000</option>
                                                        <option value="125000">$125,000</option>
                                                        <option value="150000">$150,000</option>
                                                        <option value="175000">$175,000</option>
                                                        <option value="200000">$200,000</option>
                                                        <option value="225000">$225,000</option>
                                                        <option value="250000">$250,000</option>
                                                        <option value="275000">$275,000</option>
                                                        <option value="300000">$300,000</option>
                                                        <option value="325000">$325,000</option>
                                                        <option value="350000">$350,000</option>
                                                        <option value="375000">$375,000</option>
                                                        <option value="400000">$400,000</option>
                                                        <option value="425000">$425,000</option>
                                                        <option value="450000">$450,000</option>
                                                        <option value="475000">$475,000</option>
                                                        <option value="500000">$500,000</option>
                                                        <option value="550000">$550,000</option>
                                                        <option value="600000">$600,000</option>
                                                        <option value="650000">$650,000</option>
                                                        <option value="700000">$700,000</option>
                                                        <option value="750000">$750,000</option>
                                                        <option value="800000">$800,000</option>
                                                        <option value="850000">$850,000</option>
                                                        <option value="900000">$900,000</option>
                                                        <option value="950000">$950,000</option>
                                                        <option value="1000000">$1,000,000</option>
                                                        <option value="1250000">$1,250,000</option>
                                                        <option value="1500000">$1,500,000</option>
                                                        <option value="1750000">$1,750,000</option>
                                                        <option value="2000000">$2,000,000</option>
                                                        <option value="2250000">$2,250,000</option>
                                                        <option value="2500000">$2,500,000</option>
                                                        <option value="2750000">$2,750,000</option>
                                                        <option value="3000000">$3,000,000</option>
                                                        <option value="3500000">$3,500,000</option>
                                                        <option value="4000000">$4,000,000</option>
                                                        <option value="4500000">$4,500,000</option>
                                                        <option value="5000000">$5,000,000</option>
                                                        <option value="6000000">$6,000,000</option>
                                                        <option value="7000000">$7,000,000</option>
                                                        <option value="8000000">$8,000,000</option>
                                                        <option value="9000000">$9,000,000</option>
                                                        <option value="10000000">$10,000,000</option>
                                                        <option value="11000000">$11,000,000</option>
                                                        <option value="12000000">$12,000,000</option>
                                                        <option value="13000000">$13,000,000</option>
                                                        <option value="14000000">$14,000,000</option>
                                                        <option value="15000000">$15,000,000</option>
                                                        <option value="16000000">$16,000,000</option>
                                                        <option value="17000000">$17,000,000</option>
                                                        <option value="18000000">$18,000,000</option>
                                                        <option value="19000000">$19,000,000</option>
                                                        <option value="20000000">$20,000,000</option>
                                                        <option value="21000000">$21,000,000</option>
                                                        <option value="22000000">$22,000,000</option>
                                                        <option value="23000000">$23,000,000</option>
                                                        <option value="24000000">$24,000,000</option>
                                                        <option value="25000000">$25,000,000</option>
                                                        <option value="26000000">$26,000,000</option>
                                                        <option value="27000000">$27,000,000</option>
                                                        <option value="28000000">$28,000,000</option>
                                                        <option value="29000000">$29,000,000</option>
                                                        <option value="30000000">$30,000,000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Smoker -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="smoker">Are you a smoker? <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg width="24px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#111827" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#111827" d="M256 576v128h640V576H256zm-32-64h704a32 32 0 0 1 32 32v192a32 32 0 0 1-32 32H224a32 32 0 0 1-32-32V544a32 32 0 0 1 32-32z"></path><path fill="#111827" d="M704 576h64v128h-64zM256 64h64v320h-64zM128 192h64v192h-64zM64 512h64v256H64z"></path></g></svg>
                                                    </span>

                                                    <select class="input-field" name="smoker" id="smoker" aria-describedby="smoker_status" required>
                                                        <option value="">Please choose</option>
                                                        <option>Smoker</option>
                                                        <option selected="">Non Smoker</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="gender">Gender <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg width="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#111827"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.5 8.5C18.5 12.0899 15.5899 15 12 15C8.41015 15 5.5 12.0899 5.5 8.5C5.5 4.91015 8.41015 2 12 2C15.5899 2 18.5 4.91015 18.5 8.5Z" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7.5 19H16.5" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M12 22L12 15" stroke="#111827" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </span>

                                                    <select class="input-field" name="gender" id="gender" aria-describedby="gender_status" required>
                                                        <option value="">Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                                    
                                        <!-- First Name -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="firstname">First Name <span>*</span></label>

                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none">
                                                            <path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="text" class="input-field" name="firstname" id="firstname" placeholder="Enter First Name" aria-describedby="firstname_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="lastname">Last Name <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 19" fill="none">
                                                            <path d="M9 0C8.01109 0 7.04439 0.293245 6.22215 0.842652C5.3999 1.39206 4.75904 2.17295 4.3806 3.08658C4.00216 4.00021 3.90315 5.00555 4.09607 5.97545C4.289 6.94536 4.7652 7.83627 5.46447 8.53553C6.16373 9.2348 7.05464 9.711 8.02455 9.90393C8.99445 10.0969 9.99979 9.99784 10.9134 9.6194C11.827 9.24096 12.6079 8.6001 13.1573 7.77785C13.7068 6.95561 14 5.98891 14 5C14 3.67392 13.4732 2.40215 12.5355 1.46447C11.5979 0.526784 10.3261 0 9 0ZM9 8C8.40666 8 7.82664 7.82405 7.33329 7.49441C6.83994 7.16476 6.45542 6.69623 6.22836 6.14805C6.0013 5.59987 5.94189 4.99667 6.05764 4.41473C6.1734 3.83279 6.45912 3.29824 6.87868 2.87868C7.29824 2.45912 7.83279 2.1734 8.41473 2.05764C8.99667 1.94189 9.59987 2.0013 10.1481 2.22836C10.6962 2.45542 11.1648 2.83994 11.4944 3.33329C11.8241 3.82664 12 4.40666 12 5C12 5.79565 11.6839 6.55871 11.1213 7.12132C10.5587 7.68393 9.79565 8 9 8ZM18 19V18C18 16.1435 17.2625 14.363 15.9497 13.0503C14.637 11.7375 12.8565 11 11 11H7C5.14348 11 3.36301 11.7375 2.05025 13.0503C0.737498 14.363 0 16.1435 0 18V19H2V18C2 16.6739 2.52678 15.4021 3.46447 14.4645C4.40215 13.5268 5.67392 13 7 13H11C12.3261 13 13.5979 13.5268 14.5355 14.4645C15.4732 15.4021 16 16.6739 16 18V19H18Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="text" class="input-field" name="last_name" id="lastname" placeholder="Enter Last Name" aria-describedby="lastname_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-span-12 lg:col-span-6">
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
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="sphone">Phone Number <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 18 18" fill="none">
                                                            <path d="M16.95 18C14.8667 18 12.8083 17.546 10.775 16.638C8.74167 15.73 6.89167 14.4423 5.225 12.775C3.55833 11.1077 2.271 9.25767 1.363 7.225C0.455 5.19233 0.000666667 3.134 0 1.05C0 0.75 0.0999999 0.5 0.3 0.3C0.5 0.0999999 0.75 0 1.05 0H5.1C5.33333 0 5.54167 0.0793332 5.725 0.238C5.90833 0.396667 6.01667 0.584 6.05 0.8L6.7 4.3C6.73333 4.56667 6.725 4.79167 6.675 4.975C6.625 5.15833 6.53333 5.31667 6.4 5.45L3.975 7.9C4.30833 8.51667 4.704 9.11233 5.162 9.687C5.62 10.2617 6.12433 10.816 6.675 11.35C7.19167 11.8667 7.73333 12.346 8.3 12.788C8.86667 13.23 9.46667 13.634 10.1 14L12.45 11.65C12.6 11.5 12.796 11.3877 13.038 11.313C13.28 11.2383 13.5173 11.2173 13.75 11.25L17.2 11.95C17.4333 12.0167 17.625 12.1377 17.775 12.313C17.925 12.4883 18 12.684 18 12.9V16.95C18 17.25 17.9 17.5 17.7 17.7C17.5 17.9 17.25 18 16.95 18ZM3.025 6L4.675 4.35L4.25 2H2.025C2.10833 2.68333 2.225 3.35833 2.375 4.025C2.525 4.69167 2.74167 5.35 3.025 6ZM11.975 14.95C12.625 15.2333 13.2877 15.4583 13.963 15.625C14.6383 15.7917 15.3173 15.9 16 15.95V13.75L13.65 13.275L11.975 14.95Z" fill="#111827"/>
                                                        </svg>
                                                    </span>

                                                    <input type="tel" class="input-field" name="sphone" id="sphone" placeholder="Enter Phone Number" aria-describedby="sphone_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="DOB">Date of Birth <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 18 18" fill="none">
                                                            <path d="M1.5 9C1.5 6.17175 1.5 4.75725 2.379 3.879C3.258 3.00075 4.67175 3 7.5 3H10.5C13.3282 3 14.7427 3 15.621 3.879C16.4992 4.758 16.5 6.17175 16.5 9V10.5C16.5 13.3282 16.5 14.7427 15.621 15.621C14.742 16.4992 13.3282 16.5 10.5 16.5H7.5C4.67175 16.5 3.25725 16.5 2.379 15.621C1.50075 14.742 1.5 13.3282 1.5 10.5V9Z" stroke="#111827" stroke-width="1.75"/>
                                                            <path d="M5.25 3V1.875M12.75 3V1.875M1.875 6.75H16.125" stroke="#111827" stroke-width="1.75" stroke-linecap="round"/>
                                                            <path d="M13.5 12.75C13.5 12.9489 13.421 13.1397 13.2803 13.2803C13.1397 13.421 12.9489 13.5 12.75 13.5C12.5511 13.5 12.3603 13.421 12.2197 13.2803C12.079 13.1397 12 12.9489 12 12.75C12 12.5511 12.079 12.3603 12.2197 12.2197C12.3603 12.079 12.5511 12 12.75 12C12.9489 12 13.1397 12.079 13.2803 12.2197C13.421 12.3603 13.5 12.5511 13.5 12.75ZM13.5 9.75C13.5 9.94891 13.421 10.1397 13.2803 10.2803C13.1397 10.421 12.9489 10.5 12.75 10.5C12.5511 10.5 12.3603 10.421 12.2197 10.2803C12.079 10.1397 12 9.94891 12 9.75C12 9.55109 12.079 9.36032 12.2197 9.21967C12.3603 9.07902 12.5511 9 12.75 9C12.9489 9 13.1397 9.07902 13.2803 9.21967C13.421 9.36032 13.5 9.55109 13.5 9.75ZM9.75 12.75C9.75 12.9489 9.67098 13.1397 9.53033 13.2803C9.38968 13.421 9.19891 13.5 9 13.5C8.80109 13.5 8.61032 13.421 8.46967 13.2803C8.32902 13.1397 8.25 12.9489 8.25 12.75C8.25 12.5511 8.32902 12.3603 8.46967 12.2197C8.61032 12.079 8.80109 12 9 12C9.19891 12 9.38968 12.079 9.53033 12.2197C9.67098 12.3603 9.75 12.5511 9.75 12.75ZM9.75 9.75C9.75 9.94891 9.67098 10.1397 9.53033 10.2803C9.38968 10.421 9.19891 10.5 9 10.5C8.80109 10.5 8.61032 10.421 8.46967 10.2803C8.32902 10.1397 8.25 9.94891 8.25 9.75C8.25 9.55109 8.32902 9.36032 8.46967 9.21967C8.61032 9.07902 8.80109 9 9 9C9.19891 9 9.38968 9.07902 9.53033 9.21967C9.67098 9.36032 9.75 9.55109 9.75 9.75ZM6 12.75C6 12.9489 5.92098 13.1397 5.78033 13.2803C5.63968 13.421 5.44891 13.5 5.25 13.5C5.05109 13.5 4.86032 13.421 4.71967 13.2803C4.57902 13.1397 4.5 12.9489 4.5 12.75C4.5 12.5511 4.57902 12.3603 4.71967 12.2197C4.86032 12.079 5.05109 12 5.25 12C5.44891 12 5.63968 12.079 5.78033 12.2197C5.92098 12.3603 6 12.5511 6 12.75ZM6 9.75C6 9.94891 5.92098 10.1397 5.78033 10.2803C5.63968 10.421 5.44891 10.5 5.25 10.5C5.05109 10.5 4.86032 10.421 4.71967 10.2803C4.57902 10.1397 4.5 9.94891 4.5 9.75C4.5 9.55109 4.57902 9.36032 4.71967 9.21967C4.86032 9.07902 5.05109 9 5.25 9C5.44891 9 5.63968 9.07902 5.78033 9.21967C5.92098 9.36032 6 9.55109 6 9.75Z" fill="#374151"/>
                                                        </svg>
                                                    </span>
                                                    <input type="text" class="input-field" name="DOB" id="DOB" placeholder="DD/MM/YYYY" aria-describedby="DOB_status" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Your Location -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="province">Your Location <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="10" r="3" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle> <path d="M19 9.75C19 15.375 12 21 12 21C12 21 5 15.375 5 9.75C5 6.02208 8.13401 3 12 3C15.866 3 19 6.02208 19 9.75Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </span>

                                                    <select class="input-field" name="province" id="province" aria-describedby="province_status" required>
                                                        <option value="">Select Province</option>
                                                        <option value="0">British Columbia</option>
                                                        <option value="1">Alberta</option>
                                                        <option value="2">Saskatchewan</option>
                                                        <option value="3">Northwest Territories</option>
                                                        <option value="4">Yukon</option>
                                                        <option value="5">Nunavut</option>
                                                        <option value="6">Manitoba</option>
                                                        <option value="7" selected="">Ontario</option>
                                                        <option value="8">Quebec</option>
                                                        <option value="9">Nova Scotia</option>
                                                        <option value="10">New Brunswick</option>
                                                        <option value="11">Prince Edward Island</option>
                                                        <option value="12">Newfoundland &amp; Labrador</option>
                                                        <option value="13">All Provinces</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Payment Mode -->
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="input-group">
                                                <label class="input-label" for="paymentmode">Payment Mode <span>*</span></label>
                                                <div class="input-wrapper">
                                                    <span class="input-icon">
                                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="3" y="6" width="18" height="13" rx="2" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect> <path d="M3 10H20.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7 15H9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </span>

                                                    <select class="input-field" name="paymentmode" id="paymentmode" aria-describedby="paymentmode_status" required>
                                                        <option value="0">Annual</option> 
                                                        <option value="1">Semi annual</option>
                                                        <option value="2">Quarterly</option>
                                                        <option value="3">Monthly</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-span-12">
                                            <a id="lifeinssubmit" class="btn btn-lg btn-filled-primary w-full lg:w-auto">
                                                <span>Compare Rates</span>
                                                <img src="images/icons/send-plane.svg" width="14" alt="">
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

        <!-- Product Types -->
		<section class="product-about bg-brand-linear pb-12 lg:pb-16">
			<div class="container max-w-[1024px] mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title">Types of Term Life Insurance</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-check-duotone-48.svg" alt="Icon representing Standard Term life insurance with fixed coverage period">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Standard Term</h6>
                                <p class="pointer-card__desc">Fixed coverage for 10, 20, or 30 years</p>
                            </div>
                        </div>
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-refresh-duotone-48.svg" alt="Icon representing Annual Renewable Term life insurance with yearly renewable coverage">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Annual Renewable Term</h6>
                                <p class="pointer-card__desc">Year-by-year protection, renewable each year</p>
                            </div>
                        </div>
                        <div class="pointer-card hp-services-card">
                            <div class="pointer-card__icon hp-services-card__icon">
                                <img src="images/icons/calendar-decrease-duotone-48.svg" alt="Icon representing Decreasing Term life insurance where coverage reduces over time">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Decreasing Term</h6>
                                <p class="pointer-card__desc">Coverage amount decreases over time (often used for mortgages)</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- Benefits -->
		<section class="max-w-[1024px] mx-auto mt-16 lg:mt-20">
			<div class="container mx-auto px-4">
                <div class="section-heading center">
                    <div class="heading-copy">
                        <h2 class="title">Why Choose Term Life Insurance?</h2>
                    </div>
                    <hr>
                </div>

                <div class="section-content">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/piggy-bank-multicolor-48.svg" alt="Icon representing affordability with lower premiums for term life insurance">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Affordability</h6>
                                <p class="pointer-card__desc">Lower premiums compared to permanent insurance</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/choose-options-multicolor-48.svg" alt="Icon representing flexibility to choose term and coverage amount for term life insurance">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Flexibility</h6>
                                <p class="pointer-card__desc">Choose the term and coverage amount that fits your needs.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/family-multicolor-48.svg" alt="Icon representing family protection to replace lost income and cover debts">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Family Protection</h6>
                                <p class="pointer-card__desc">Replace lost income, cover debts, and safeguard your family's.</p>
                            </div>
                        </div>
                        <div class="pointer-card values-card">
                            <div class="pointer-card__icon">
                                <img src="images/icons/mortgage-loan-multicolor-48.svg" alt="Icon representing mortgage and loan coverage aligned with insurance term">
                            </div>
                            <div class="pointer-card__copy">
                                <h6 class="card-common_heading">Mortgage & Loan Coverage</h6>
                                <p class="pointer-card__desc">Match your coverage term to your mortgage or other major debts.</p>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <!-- How Does it Work -->
		<section class="bg-primary-50 mt-16 lg:mt-20 py-12 lg:py-16">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">How Does Term Life Insurance Work?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        You pay regular premiums for the term you choose. If you pass away during this period, your beneficiaries receive the full benefit. There is no cash value-term life is designed for straightforward, cost-effective protection.
                    </div>
                </div>
            </div>
		</section>

        <!-- How Much Cost -->
        <section class="mt-16 lg:mt-20">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">How Much Does Term Life Insurance Cost?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        Premiums vary by age, health, coverage amount, and term. Get a personalized quote from a Punjab Insurance advisor for accurate pricing.
                    </div>
                </div>
            </div>
		</section>

        <!-- What Does -->
        <section class="mt-16 lg:mt-20">
            <div class="max-w-[1140px] mx-auto">
                <div class="container mx-auto px-4">
                    <div class="section-heading left-hr">
                        <div class="heading-copy">
                            <h2 class="title title-h4">What Does Term Life Insurance Cover?</h2>
                        </div>
                        <hr>
                    </div>
                    <div class="section-content">
                        <ul class="blogs-list-items mt-4">
                            <li>Provides a death benefit for most causes of death, subject to policy terms, conditions, and exclusions</li>
                            <li>Financial support for dependents</li>
                            <li>Mortgage payoff, education costs, daily living expenses</li>
                            <li>Optional riders: accidental death, disability, critical illness</li>
                        </ul>
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
                        <h2 class="title title-h4">Frequently Asked Questions about<br>Term Life Insurance</h2>
                    </div>
                    <hr>
                </div>
                <div class="section-content">
                    <div class="faq-accordion pb-8">
                        <div class="faq-item">
                            <div class="faq-question">How much coverage do I need?</div>
                            <div class="faq-answer">
                                Consider your family's living expenses, debts, future goals, and income replacement needs. Our advisors can help you calculate the right amount.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Does term life insurance cover accidental death?</div>
                            <div class="faq-answer">
                                Yes, the death benefit is paid for most causes, including accidents. Some plans offer extra accidental death riders for additional protection.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Does term life insurance cover disability?</div>
                            <div class="faq-answer">
                                Standard term life does not, but you can add riders for disability or critical illness coverage.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">Can I renew or convert my policy?</div>
                            <div class="faq-answer">
                                Many term policies allow you to renew at the end of the term or convert to permanent insurance without a medical exam.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">What happens if my policy expires?</div>
                            <div class="faq-answer">
                                Coverage ends, but you can often renew or convert. It's wise to review your needs before your term ends.
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question">How are premiums calculated?</div>
                            <div class="faq-answer">
                                Age, health, coverage amount, term length, gender, and smoking status all affect your rates. Annual payment is usually the most cost-effective.
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
                    Protect your family's future with affordable term life coverage. Get high-value protection for a defined period, ensuring your loved ones stay financially secure during life's most important years. Smart choices today create stability for tomorrow.
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