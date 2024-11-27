<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="FAQTitlePage">FAQ Page</title>
</head>
<body>
    <?php include '../partials/header.php'; ?>
    
    <main class="container py-5">
        <h1 class="display-4 fw-bold text-center" data-translate="FAQTitlePageFrequentlyAskedQuestions" style="color: var(--blue)">Frequently Asked Questions</h1>
        <p class="lead text-muted text-center" data-translate="FAQParagraphSubtitleCommonDoubts">Here are some common doubts, if you need more please visit <a href="supportView.php" style="color: var(--blue);" data-translate="FAQParagraphSubtitleCommonDoubtsLinkSupport">support</a></p>
        <div class="accordion" id="faqAccordion">
            <!-- FAQ Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        <span data-translate="FAQ-QuestionTrackingHowToTrack">How can I track my shipment?</span>
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" data-translate="FAQAnswerTrackingUseTrackingNumber">
                        You can track your shipment using the tracking number previously provided.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        <span data-translate="FAQ-QuestionDelayPackageDelayed">What should I do if my package is delayed?</span>
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" data-translate="FAQAnswerDelayContactSupport">
                        If your package is delayed, please contact our support team for assistance.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        <span data-translate="FAQ-QuestionAddressChangeAfterDispatch">Can I change the delivery address after the shipment has been dispatched?</span>
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" data-translate="FAQAnswerAddressRequestWithin24Hours">
                        Address changes can be requested within 24 hours of dispatch. Please contact support.
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        <span data-translate="FAQ-QuestionShippingOptionsAvailable">What are the shipping options available?</span>
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" data-translate="FAQAnswerShippingStandardOnly">
                        For the moment, we only offer standard shipping.
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include '../partials/footerViews.php'; ?>
    </footer>
</body>
</html>
