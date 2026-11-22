<form id="jobApplicationForm" class="product-quote-form" method="POST" enctype="multipart/form-data">
    <div class="grid grid-cols-12 gap-4 lg:gap-6">
        
        <!-- Auto-filled from Apply Button -->
        <input type="hidden" name="job_title" id="job_title">
        
        <!-- Full Name -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="fullName">Full Name <span>*</span></label>
                <div class="input-wrapper">
                    <input type="text" id="fullName" name="full_name" placeholder="Enter Full Name" class="input-field" required>
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="email">Email <span>*</span></label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="Enter Email Id" class="input-field" required>
                </div>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="phone">Phone Number <span>*</span></label>
                <div class="input-wrapper">
                    <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" class="input-field" required>
                </div>
            </div>
        </div>

        <!-- Location -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="currentCity">Current City <span>*</span></label>
                <div class="input-wrapper">
                    <input type="text" placeholder="Enter Current City" class="input-field" id="currentCity">
                </div>
            </div>
        </div>

        <!-- Experience -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="totalExperience">Total Experience <span>*</span></label>
                <div class="input-wrapper">
                    <select class="input-field" id="totalExperience">
                        <option value="">Select Experience</option>
                        <option value="Fresher">Fresher</option>
                        <option value="1-2 years">1-2 years</option>
                        <option value="2-5 years">2-5 years</option>
                        <option value="5+ years">5+ years</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Resume Upload -->
        <div class="col-span-12 lg:col-span-6">
            <div class="input-group">
                <label class="input-label" for="uploadResume">Upload Resume (PDF or DOC) <span>*</span></label>    
                <div class="input-wrapper">
                    <input type="file" name="resume" id="uploadResume" class="input-field" accept=".pdf, .doc, .docx">
                </div>
            </div>
        </div>

        <!-- Message -->
        <div class="col-span-12">
            <div class="input-group">
                <label class="input-label" for="whyShouldHire">
                    Why should we hire you? <span>*</span>
                </label>
                <div class="input-wrapper">
                    <textarea id="whyShouldHire" class="input-field" name="whyShouldHire" rows="4" placeholder="Write your message..."></textarea>
                </div>
            </div>
        </div>

        <!-- Captcha -->
        <!-- <div class="col-span-12">
            <div class="recaptcha-row">
                <div class="input-group">
                    <div class="checkbox-wrapper">
                        <label for="checkBot" class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="checkBot" class="checkbox-input" required>
                            <span>I'm not a robot</span>
                        </label>
                    </div>
                </div>

                <img src="images/icons/recaptcha-logo.svg" alt="reCAPTCHA" class="recaptcha-logo">
            </div>
        </div> -->

        <!-- Submit -->
        <div class="col-span-12">
            <button type="submit" class="btn btn-lg btn-filled-primary w-full">
                <span>Submit</span>
                <img src="images/icons/send-plane.svg" width="14" alt="">
            </button>
        </div>

    </div>
</form>