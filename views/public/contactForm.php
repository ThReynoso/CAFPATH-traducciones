<?php include '../partials/header.php'; ?>
<title>Contact Us</title>
<main class="container py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold" style="color: var(--blue)" data-translate="ContactFormTitleHero">Contact Us</h1>
            <p class="lead text-muted" data-translate="ContactFormDescHero">Choose how you prefer to get in touch with us</p>
        </div>
    </div>

    <!-- Contact Forms Section -->
    <div class="row">
        <!-- Existing Contact Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 text-center pt-4">
                    <h3 data-translate="ContactFormTitleSendMessage">Send us a message</h3>
                </div>
                <div class="card-body p-4">
                    <form action="../../app/Handlers/saveMessage.php" method="post" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label" data-translate="ContactFormLabelName">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="name" name="name" required 
                                    data-translate-placeholder="ContactFormPlaceholderName" placeholder="Enter your name">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label" data-translate="ContactFormLabelEmail">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" required 
                                    data-translate-placeholder="ContactFormPlaceholderEmail" placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label" data-translate="ContactFormLabelSubject">Subject</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat"></i></span>
                                <input type="text" class="form-control" id="subject" name="subject" required 
                                    data-translate-placeholder="ContactFormPlaceholderSubject" placeholder="Message subject">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label" data-translate="ContactFormLabelMessage">Message</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                <textarea class="form-control" id="message" name="message" rows="5" required 
                                    data-translate-placeholder="ContactFormPlaceholderMessage" placeholder="Your message"></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 py-3 hover-scale" 
                                style="background-color: var(--blue)" data-translate="ContactFormBtnSendMessage">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- New Request Contact Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 text-center pt-4">
                    <h3 data-translate="ContactFormTitleRequestCallback">Request a callback</h3>
                </div>
                <div class="card-body p-4">
                    <form action="#" method="post" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="callback_name" class="form-label" data-translate="ContactFormLabelName">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="callback_name" name="callback_name" required 
                                    data-translate-placeholder="ContactFormPlaceholderName" placeholder="Enter your name">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="contact_method" class="form-label" data-translate="ContactFormPreferredTimeLabel">Preferred Contact Method</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <select class="form-select" id="contact_method" name="contact_method" required>
                                    <option value="" data-translate="ContactFormSelectOption">Select an option</option>
                                    <option value="phone">Phone</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dynamic Contact Input (will be shown/hidden based on selection) -->
                        <div class="mb-4 contact-input" id="phone_input" style="display: none;">
                            <label for="phone" class="form-label" data-translate="ContactFormLabelPhone">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="phone" data-translate-placeholder="ContactFormPlaceholderPhone" name="phone" placeholder="Enter your phone number">
                            </div>
                        </div>

                        <div class="mb-4 contact-input" id="email_input" style="display: none;">
                            <label for="callback_email" class="form-label" data-translate="ContactFormLabelEmail">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="callback_email" data-translate-placeholder="ContactFormPlaceholderEmail" name="callback_email" placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="preferred_time" class="form-label" data-translate="ContactFormPreferredTimeLabel">Preferred Contact Time</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                <select class="form-select" id="preferred_time" name="preferred_time" required>
                                    <option value="morning" data-translate="ContactFormPreferredTimeMorning">Morning (9:00 - 12:00)</option>
                                    <option value="afternoon" data-translate="ContactFormPreferredTimeAfternoon">Afternoon (12:00 - 17:00)</option>
                                    <option value="evening" data-translate="ContactFormPreferredTimeEvening">Evening (17:00 - 20:00)</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 py-3 hover-scale" 
                                style="background-color: var(--blue)" data-translate="ContactFormBtnRequestCallback">
                                Request Callback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include '../partials/footerViews.php'; ?>

<!-- Add this JavaScript at the bottom of the file, before closing body tag -->
<script>
document.getElementById('contact_method').addEventListener('change', function() {
    // Hide all contact inputs first
    document.querySelectorAll('.contact-input').forEach(input => {
        input.style.display = 'none';
    });
    
    // Show the relevant input based on selection
    const selectedMethod = this.value;
    if (selectedMethod === 'phone' || selectedMethod === 'whatsapp') {
        document.getElementById('phone_input').style.display = 'block';
    } else if (selectedMethod === 'email') {
        document.getElementById('email_input').style.display = 'block';
    }
});

// Form validation and submission
document.querySelector('form.needs-validation').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!this.checkValidity()) {
        e.stopPropagation();
        this.classList.add('was-validated');
        return;
    }

    try {
        const formData = new FormData(this);
        const response = await fetch(this.action, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        
        if (result.success) {
            // Show success message
            alert('Message sent successfully!');
            this.reset();
            this.classList.remove('was-validated');
        } else {
            throw new Error(result.message);
        }
    } catch (error) {
        // Show error message
        alert('Error sending message: ' + error.message);
    }
});
</script>
