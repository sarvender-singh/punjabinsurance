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
								<a href="get-a-quote.php" class="btn btn-lg btn-filled-cta">
								    <span>Get a Free Quote</span>
									<img src="images/icons/arrow-right-white-22.svg" loading="lazy" class="rotate-35">
								</a>
								<a href="contact.php" class="btn btn-lg btn-outline-gray">
								    Contact Us
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-cta-linear-circle"></div>
			</div>

            <img src="images/sikh-family-child-on-shoulders-smiling.webp"  loading="lazy" class="footer-cta-image" alt="Sikh family, child on shoulders, smiling">
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
									    <div>
										    <img src="images/icons/location-filled-white-16x16.svg" loading="lazy">
											Address
										</div>
										<a href="https://maps.app.goo.gl/XJ3VvzZu1fAFv3Fh6" target="_blank">7003 Steeles Ave.W Unit 10, Etobicoke, Ontario M9W 0A2</a>
									</li>
									<li>
										<div>
									        <img src="images/icons/call-filled-white-16x16.svg">
											24x7 Tollfree
										</div>
										<a href="tel:+18889786522">1-888-978-6522</a>
									</li>
									<li>
										<div>
									        <img src="images/icons/mail-filled-white-16x16.svg" loading="lazy">
											Email
										</div>
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
							        <li><a href="about-punjab-insurance.php">About Us</a></li>
									<li><a href="contact.php">Contact Us</a></li>
									<li><a href="blogs.php">Blogs</a></li>
									<li><a href="faq.php">Faq's</a></li>
                                    <li><a href="join-us.php">Careers</a></li>
									<!-- <li><a href="google-reviews.php">Google Reviews</a></li> -->
									<li><a href="privacy-policy.php">Privacy Policy</a></li>
									<li><a href="terms-of-service.php">Terms of Service</a></li>
								</ul>
							</div>
						</div>
					</div>
					
                    <div class="col-span-12 md:col-span-6 lg:col-span-2">
						<div class="footer-column flex flex-col gap-6">
						    <h6 class="heading-h6 font-semibold text-white">Get Insurance</h6>
							<div class="footer-column-content">
							    <ul class="footer-links-list">
									<li><a href="life-insurance.php">Life Insurance</a></li>
									<li><a href="super-visa-insurance.php">Super Visa Insurance</a></li>
									<li><a href="critical-illness-insurance.php">Critical Illness Insurance</a></li>
									<li><a href="non-medical-life-insurance.php">Non-Medical Insurance</a></li>
									<li><a href="disability-insurance.php">Disability Insurance</a></li>
                                    <li><a href="emergency-medical-insurance.php">Health Insurance</a></li>
									<li><a href="rdsp.php">RDSP (Registered Disability Savings Plan)</a></li>
                                    <li><a href="mortgage-insurance.php">Mortgage Insurance</a></li>
                                    <li><a href="insurance-for-visitors-to-canada.php">Visitor Insurance</a></li>
                                    <li><a href="travel-insurance-for-canadians.php">Travel Insurance</a></li>
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
								<li>
								    <a href="https://www.facebook.com/PunjabInsurance.ca/" title="facebook" target="_blank">
									    <img src="images/icons/icon-facebook.svg" loading="lazy">
									</a>
								</li>
								<li>
									<a href="https://x.com/punjabinsurance" title="X" target="_blank">
										<img src="images/icons/icon-x.svg" loading="lazy">
									</a>
								</li>
								<li>
									<a href="https://www.linkedin.com/company/punjabinsurance/" title="linkedin" target="_blank" >
										<img src="images/icons/icon-linkedin.svg" loading="lazy">
									</a>
								</li>
								<li>
									<a href="https://pin.it/4OnfUJLa1" title="pinterest" target="_blank" >
										<img src="images/icons/Icon-pinterest.svg" loading="lazy">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
        <div class="footer-copyrights">
		    <div class="container mx-auto px-4">
			    &copy; <?php echo date('Y');?> Punjab Insurance All Rights Reserved.
			</div>
		</div>
	</footer>

    <!-- Floating WhatsApp Button -->

    <a id="whatsapp-float" 
        href="tel:+18889786522"
        target="_blank" rel="noopener noreferrer" aria-label="Call Us">
        <!-- WhatsApp SVG -->
        <svg viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false">
            <path fill="#25D366" d="M.057 24l1.687-6.163A11.88 11.88 0 010 12.012C0 5.373 5.373 0 12.014 0c3.2 0 6.2 1.245 8.457 3.502a11.88 11.88 0 013.507 8.46c-.003 6.64-5.376 12.012-12.017 12.012a11.9 11.9 0 01-6.741-2.022L.057 24z"/>
            <path fill="#FFF" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.472-.149-.67.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.151-.173.201-.298.301-.497.1-.198.05-.372-.025-.52-.074-.148-.67-1.612-.918-2.21-.242-.579-.487-.5-.67-.51l-.57-.01c-.198 0-.52.074-.793.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487 2.981 1.294 2.981.862 3.517.81.538-.049 1.758-.718 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.273-.198-.57-.347z"/>
        </svg>
    </a>	 
    <!-- <a id="whatsapp-float" 
        href="https://wa.me/911234567890?text=Hello%2C%20I%20am%20interested%20in%20your%20insurance%20services.%20Please%20help%20me%20with%20the%20best%20suitable%20plan"
        target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <!-- WhatsApp SVG  
        <svg viewBox="0 0 24 24" width="48" height="48" aria-hidden="true" focusable="false">
            <path fill="#25D366" d="M.057 24l1.687-6.163A11.88 11.88 0 010 12.012C0 5.373 5.373 0 12.014 0c3.2 0 6.2 1.245 8.457 3.502a11.88 11.88 0 013.507 8.46c-.003 6.64-5.376 12.012-12.017 12.012a11.9 11.9 0 01-6.741-2.022L.057 24z"/>
            <path fill="#FFF" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.472-.149-.67.149-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.151-.173.201-.298.301-.497.1-.198.05-.372-.025-.52-.074-.148-.67-1.612-.918-2.21-.242-.579-.487-.5-.67-.51l-.57-.01c-.198 0-.52.074-.793.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487 2.981 1.294 2.981.862 3.517.81.538-.049 1.758-.718 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.273-.198-.57-.347z"/>
        </svg>
    </a> -->

    <!-- jQuery -->
  	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>     
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
	<script src="js/main.js?tp=1.1"></script> -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js" defer></script>
<script src="js/main.js?tp=1.1" defer></script>
	
<?php 
if(!empty($load_super_visa_form_script)){
include 'includes/load_super_visa_form_script.php';
}else if(!empty($load_life_insurance_script)){
include 'includes/load_life_insurance_script.php';
}	
?>

<!-- Newsletter Subscribe JS — paste this just before </body> in footer.php -->
<style>
.newsletter-msg {
    font-size: 0.82rem;
    font-weight: 600;
    margin-top: -30px;
    display: none;
    align-items: center;
    gap: 6px;
    animation: fadeIn 0.2s ease;
}
.newsletter-msg.success { color: #4ade80; display: flex; }
.newsletter-msg.error   { color: #f87171; display: flex; }
.newsletter-input.nl-invalid { border-color: #f87171 !important; }
.newsletter-input.nl-valid   { border-color: #4ade80 !important; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-3px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
   $(document).ready(function () {

    // Insert message element after the newsletter form
    $('#newsletter-compact').after('<div class="newsletter-msg" id="newsletter-msg"></div>');

    function showNlMsg(type, text) {
        var $msg = $('#newsletter-msg');
        $msg.removeClass('success error').addClass(type).text(text).css('display', 'flex');
        // Auto-hide after 5 seconds
        setTimeout(function () { $msg.fadeOut(400, function () { $msg.css('display', 'none'); }); }, 5000);
    }

    $('#newsletter-compact').on('submit', function (e) {
        e.preventDefault();

        var $input = $('#email-compact');
        var $btn   = $(this).find('button[type="submit"]');
        var email  = $input.val().trim();
        var $msg   = $('#newsletter-msg');

        // Hide previous message
        $msg.css('display', 'none').removeClass('success error');
        $input.removeClass('nl-invalid nl-valid');

        // Client-side validation
        if (!email) {
            $input.addClass('nl-invalid');
            showNlMsg('error', 'Please enter your email address.');
            $input.focus();
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $input.addClass('nl-invalid');
            showNlMsg('error', 'Please enter a valid email address.');
            $input.focus();
            return;
        }

        // Show loading state
        var origText = $btn.text();
        $btn.prop('disabled', true).text('Subscribing...');

        // AJAX to newsletter-subscribe.php
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
            error: function () {
                showNlMsg('error', 'Connection error. Please try again.');
            },
            complete: function () {
                $btn.prop('disabled', false).text(origText);
            }
        });
    });

    // Clear error state on input
    $('#email-compact').on('input', function () {
        $(this).removeClass('nl-invalid nl-valid');
        $('#newsletter-msg').css('display', 'none').removeClass('success error');
    });

});
});
</script>


</body>
</html>