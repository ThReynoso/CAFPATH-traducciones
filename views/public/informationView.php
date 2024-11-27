<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="InformationViewTitle">Information</title>
</head>
<?php include '../partials/header.php'; ?>
<body>
    <main class="container py-5">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold" style="color: var(--blue)" data-translate="InformationViewTitleCenter">Information Center</h1>
                <p class="lead text-muted" data-translate="InformationViewDescription">Discover everything you need to know about our services and solutions.</p>
            </div>
        </div>

        <!-- Info Cards Section -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-info-circle-fill fs-4 me-2" style="color: var(--skyblue)"></i>
                            <h5 class="card-title mb-0" data-translate="InformationViewAboutUsTitle">About Us</h5>
                        </div>
                        <p class="card-text" data-translate="InformationViewAboutUsDescription">Learn about our company's history, mission, and values.</p>
                        <a href="aboutUsView.php" class="btn btn-outline-primary" data-translate="InformationViewReadMoreButton">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-gear-fill fs-4 me-2" style="color: var(--skyblue)"></i>
                            <h5 class="card-title mb-0" data-translate="InformationViewSupportTitle">Support</h5>
                        </div>
                        <p class="card-text" data-translate="InformationViewSupportDescription">Need help? We're here to assist you.</p>
                        <a href="supportView.php" class="btn btn-outline-primary" data-translate="InformationViewCheckButton">Check</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-scale">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-question-circle-fill fs-4 me-2" style="color: var(--skyblue)"></i>
                            <h5 class="card-title mb-0" data-translate="InformationViewFAQTitle">FAQ</h5>
                        </div>
                        <p class="card-text" data-translate="InformationViewFAQDescription">Find answers to frequently asked questions.</p>
                        <a href="FAQ.php" class="btn btn-outline-primary" data-translate="InformationViewViewFAQButton">View FAQ</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accordion Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="infoAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" data-translate="InformationViewKeyFeaturesButton">
                                Key Features
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#infoAccordion">
                            <div class="accordion-body" data-translate="InformationViewKeyFeaturesDetails">
                                Details about key features and benefits...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" data-translate="InformationViewPricingInformationButton">
                                Pricing Information
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#infoAccordion">
                            <div class="accordion-body" data-translate="InformationViewPricingDetails">
                                Pricing details and packages...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <h3 class="mb-4" data-translate="InformationViewNeedMoreInformationTitle">Need More Information?</h3>
                <p class="text-muted mb-4" data-translate="InformationViewContactSupportDescription">Contact our support team for additional details</p>
                <a href="contactForm.php" class="btn btn-primary px-4 py-2" style="background-color: var(--blue)" data-translate="InformationViewContactUsButton">Contact Us</a>
            </div>
        </div>
    </main>
</body>
<?php include '../partials/footerViews.php'; ?>
</html>