<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="AboutUsViewTitle">About Us</title>
</head>
<body>
    <?php include '../partials/header.php'; ?>
    
    <!-- Banner Section -->
    <div class="container-fluid p-0">
        <div class="position-relative">
            <img src="../../assets/img/about-banner.jpg" class="w-100" style="height: 400px; object-fit: cover;" alt="About Us Banner">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-4 fw-bold" data-translate="AboutUsBannerTitle">Our Story</h1>
                <p class="lead" data-translate="AboutUsBannerDesc">Building the future of logistics together</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container my-5">
            <!-- Company Overview -->
            <div class="row mb-5 align-items-center" data-aos="fade-up">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4" style="color: var(--blue);" data-translate="AboutUsOverviewTitle">Who We Are</h2>
                    <p class="lead" data-translate="AboutUsOverviewDesc">CAFPATH is a leading logistics and supply chain management company dedicated to providing innovative solutions for businesses worldwide.</p>
                    <p class="mb-4" data-translate="AboutUsOverviewContent">Founded with a vision to revolutionize the logistics industry, we combine cutting-edge technology with extensive expertise to deliver exceptional service to our clients.</p>
                </div>
                <div class="col-lg-6">
                    <img src="../../assets/img/company-overview.jpg" class="img-fluid rounded shadow" alt="Company Overview">
                </div>
            </div>

            <!-- Values Section -->
            <div class="row g-4 mb-5" data-aos="fade-up">
                <h2 class="text-center fw-bold mb-4" style="color: var(--blue);" data-translate="AboutUsValuesTitle">Our Core Values</h2>
                
                <!-- Value 1 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-star text-primary fs-1 mb-3"></i>
                            <h3 class="h5 fw-bold" data-translate="AboutUsValue1Title">Excellence</h3>
                            <p class="text-muted" data-translate="AboutUsValue1Desc">We strive for excellence in every aspect of our operations, ensuring the highest quality service.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-shield-check text-primary fs-1 mb-3"></i>
                            <h3 class="h5 fw-bold" data-translate="AboutUsValue2Title">Reliability</h3>
                            <p class="text-muted" data-translate="AboutUsValue2Desc">Trust and dependability are at the core of our relationships with clients.</p>
                        </div>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-lightning text-primary fs-1 mb-3"></i>
                            <h3 class="h5 fw-bold" data-translate="AboutUsValue3Title">Innovation</h3>
                            <p class="text-muted" data-translate="AboutUsValue3Desc">Continuously evolving and implementing new technologies to improve our services.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row g-4 py-5 text-center bg-body rounded-3 mb-5" data-aos="fade-up">
                <div class="col-md-3">
                    <i class="bi bi-globe text-primary fs-1 mb-3"></i>
                    <h3 class="display-4 fw-bold text-primary">
                        <span class="counter" data-target="150">0</span>+
                    </h3>
                    <p class="text-muted" data-translate="AboutUsStats1">Global Partners</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-truck text-primary fs-1 mb-3"></i>
                    <h3 class="display-4 fw-bold text-primary">
                        <span class="counter" data-target="50">0</span>K+
                    </h3>
                    <p class="text-muted" data-translate="AboutUsStats2">Deliveries Monthly</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-emoji-smile text-primary fs-1 mb-3"></i>
                    <h3 class="display-4 fw-bold text-primary">
                        <span class="counter" data-target="98">0</span>%
                    </h3>
                    <p class="text-muted" data-translate="AboutUsStats3">Customer Satisfaction</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-flag text-primary fs-1 mb-3"></i>
                    <h3 class="display-4 fw-bold text-primary">
                        <span class="counter" data-target="25">0</span>+
                    </h3>
                    <p class="text-muted" data-translate="AboutUsStats4">Countries Served</p>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center py-5" data-aos="fade-up">
                <h2 class="fw-bold mb-4" data-translate="AboutUsCtaTitle">Ready to Transform Your Logistics?</h2>
                <a href="../public/contactForm.php" class="btn btn-primary btn-lg" data-translate="AboutUsCtaButton">Get Started Today</a>
            </div>
        </div>
    </div>

    <?php include '../partials/footerViews.php'; ?>

    <!-- AOS Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        let started = false;

        function startCount(counter) {
            const target = parseInt(counter.getAttribute('data-target'));
            const count = +counter.innerText;
            const increment = target / 150;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(() => startCount(counter), 30);
            } else {
                counter.innerText = target;
            }
        }

        function checkScroll() {
            const statsSection = document.querySelector('.counter').closest('.row');
            const position = statsSection.getBoundingClientRect();

            if (position.top < window.innerHeight && position.bottom >= 0 && !started) {
                started = true;
                counters.forEach(counter => startCount(counter));
            }
        }

        window.addEventListener('scroll', checkScroll);
        checkScroll();
    });
    </script>
</body>
</html>
