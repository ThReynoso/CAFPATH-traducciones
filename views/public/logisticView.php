<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="LogisticViewTitle">Logistics - CAFPATH</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include '../partials/header.php'; ?>
    
    <div class="container-fluid p-0">
        <!-- Banner Section -->
        <div class="banner position-relative">
            <img src="../../assets/img/logistics-banner.png" class="w-100" style="height: 400px; object-fit: cover;" alt="Logistics Operations Banner">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-4 fw-bold" data-translate="LogisticViewBannerTitle">Logistics Operations</h1>
                <p class="lead" data-translate="LogisticViewBannerDesc">Optimizing supply chain operations through advanced logistics solutions</p>
            </div>
        </div>

        <!-- Main Content Container -->
        <div class="container my-5">
            <!-- Introduction Section -->
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewSystemTitle">CAFPATH Logistics Network: Excellence in Operations</h2>
                    <p class="lead text-center" data-translate="LogisticViewIntro">
                        At CAFPATH, our logistics network represents the backbone of our operations...
                    </p>
                </div>
            </div>

            <!-- Warehouse Section -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h3 style="color: var(--darkgrey);" data-translate="LogisticViewWarehouseNetworkTitle">Strategic Warehouse Network</h3>
                    <p data-translate="LogisticViewWarehouseNetworkDesc">Our warehouse network is strategically positioned to optimize distribution:</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewWarehouseList1">Automated storage and retrieval systems (AS/RS)</span></li>
                        <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewWarehouseList2">Climate-controlled facilities for sensitive goods</span></li>
                        <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewWarehouseList3">Climate-controlled facilities for sensitive goods</span></li>
                        <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewWarehouseList4">Cross-docking capabilities for efficient transit</span></li>
                        <!-- ... otros elementos de la lista ... -->
                    </ul>
                </div>
                <div class="col-lg-6">
                    <img src="../../assets/img/warehouse-operations.jpg" class="img-fluid rounded hover-scale" alt="Warehouse operations">
                </div>
            </div>

            <!-- Fleet Management Cards -->
            <div class="row mb-5">
                <h3 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewFleetManagementTitle">Advanced Fleet Management</h3>
                
                <!-- Primera tarjeta -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--darkgrey);"><i class="fas fa-truck-loading"></i> <span data-translate="LogisticViewFleetType1Title">Heavy-Duty Fleet</span></h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType1List1">Long-haul trucks for interstate transport</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType1List2">Specialized containers for sensitive cargo</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType1List3">GPS tracking and route optimization</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Segunda tarjeta -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--darkgrey);"><i class="fas fa-shuttle-van"></i> <span data-translate="LogisticViewFleetType2Title">Local Distribution Fleet</span></h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType2List1">Efficient last-mile delivery vehicles</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType2List2">Eco-friendly electric vehicles</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewFleetType2List3">Real-time delivery tracking</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technology Integration Cards -->
            <div class="row mb-5">
                <h3 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewTechIntegrationTitle">Technology Integration</h3>
                
                <!-- Primera tarjeta de tecnología -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--darkgrey);"><i class="fas fa-satellite"></i> <span data-translate="LogisticViewTechType1Title">GPS Tracking</span></h5>
                            <p class="card-text" data-translate="LogisticViewTechType1Desc">Real-time fleet monitoring and route optimization for maximum efficiency</p>
                        </div>
                    </div>
                </div>

                <!-- Segunda tarjeta de tecnología -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--darkgrey);"><i class="fas fa-warehouse"></i> <span data-translate="LogisticViewTechType2Title">Warehouse Automation</span></h5>
                            <p class="card-text" data-translate="LogisticViewTechType2Desc">Advanced robotics and automated systems for inventory management</p>
                        </div>
                    </div>
                </div>

                <!-- Tercera tarjeta de tecnología -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--darkgrey);"><i class="fas fa-chart-line"></i> <span data-translate="LogisticViewTechType3Title">Analytics Platform</span></h5>
                            <p class="card-text" data-translate="LogisticViewTechType3Desc">Data-driven insights for continuous operational improvement</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quality Control Section -->
            <div class="row align-items-center mb-5">
                <h3 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewQualityControlTitle">Quality Control Measures</h3>
                
                <div class="col-lg-6">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <p class="card-text" data-translate="LogisticViewQualityControlDesc">
                                Our comprehensive quality control system ensures operational excellence:
                            </p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewQualityControlList1">Regular audits and inspections</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewQualityControlList2">Standard Operating Procedures (SOPs)</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewQualityControlList3">Performance metrics monitoring</span></li>
                                <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> <span data-translate="LogisticViewQualityControlList4">Continuous improvement programs</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <img src="../../assets/img/quality-control.jpeg" class="img-fluid rounded hover-scale" alt="Quality control operations">
                </div>
            </div>

            <!-- Sustainability Section -->
            <div class="row mb-5">
                <h3 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewSustainabilityTitle">Sustainable Operations</h3>
                
                <div class="col-lg-12">
                    <div class="card h-100 hover-scale">
                        <div class="card-body">
                            <p class="card-text mb-4" data-translate="LogisticViewSustainabilityDesc">
                                Our commitment to sustainability is reflected in our logistics operations:
                            </p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-leaf me-3" style="color: var(--skyblue);"></i>
                                        <span data-translate="LogisticViewSustainabilityList1">Energy-efficient warehouse facilities</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-gas-pump me-3" style="color: var(--skyblue);"></i>
                                        <span data-translate="LogisticViewSustainabilityList2">Alternative fuel vehicle fleet</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-recycle me-3" style="color: var(--skyblue);"></i>
                                        <span data-translate="LogisticViewSustainabilityList3">Waste reduction and recycling programs</span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-box me-3" style="color: var(--skyblue);"></i>
                                        <span data-translate="LogisticViewSustainabilityList4">Green packaging initiatives</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action Section -->
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h3 class="mb-4" style="color: var(--blue);" data-translate="LogisticViewCTATitle">Ready to Optimize Your Logistics?</h3>
                    <p class="mb-4" data-translate="LogisticViewCTADesc">Let us help you streamline your supply chain operations with our advanced logistics solutions.</p>
                    <a href="contactForm.php" class="btn btn-primary btn-lg hover-scale" data-translate="LogisticViewCTAButton">Contact Us Today</a>
                </div>
            </div>

            <div class="row">
                <h3 class="text-center mb-4" style="color: var(--blue);" data-translate="LogisticViewRelatedTitle">Related Services</h3>
                <div class="col-md-4 mb-4">
                    <div class="card hover-scale">
                        <div class="text-center pt-4">
                            <i class="bi bi-headset display-1 text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" data-translate="LogisticViewRelatedSupportTitle">Support Service</h5>
                            <p class="card-text" data-translate="LogisticViewRelatedSupportDesc">24/7 customer support to assist you with any queries or concerns</p>
                            <a href="supportView.php" class="btn btn-outline-primary" data-translate="LogisticViewRelatedSupportButton">More Information</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card hover-scale">
                        <div class="text-center pt-4">
                            <i class="bi bi-geo-alt display-1 text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" data-translate="LogisticViewRelatedTrackingTitle">Tracking Service</h5>
                            <p class="card-text" data-translate="LogisticViewRelatedTrackingDesc">With our tracking service, clients can monitor shipments in real-time</p>
                            <a href="trackingView.php" class="btn btn-outline-primary" data-translate="LogisticViewRelatedTrackingButton">More Information</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card hover-scale">
                        <div class="text-center pt-4">
                            <i class="bi bi-truck display-1 text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" data-translate="LogisticViewRelatedLogisticsTitle">Delivery Service</h5>
                            <p class="card-text" data-translate="LogisticViewRelatedLogisticsDesc">We provide seamless management of inventory, orders, and shipments</p>
                            <a href="deliveryView.php" class="btn btn-outline-primary" data-translate="LogisticViewRelatedLogisticsButton">More Information</a>
                        </div>
                    </div>
                </div>

        </div>
    </div>

    <?php include '../partials/footerViews.php'; ?>
</body>
</html>