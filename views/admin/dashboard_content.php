<div class="dashboard-welcome">
    <!-- Welcome Message -->
    <div class="welcome-message" data-aos="fade-up">
        <h2 class="mb-3">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h2>
        <p class="mb-0">Here's what's happening with your store today.</p>
    </div>

    <!-- Quick Stats -->
    <div class="quick-stats row g-3 mb-4">
        <div class="col-12 col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stats-card">
                <h6 class="text-muted">Daily Orders</h6>
                <h3 class="mb-0">24</h3>
                <small class="text-success">↑ 12%</small>
            </div>
        </div>
        <div class="col-12 col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stats-card">
                <h6 class="text-muted">Revenue</h6>
                <h3 class="mb-0">$2,405</h3>
                <small class="text-success">↑ 8%</small>
            </div>
        </div>
        <div class="col-12 col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stats-card">
                <h6 class="text-muted">Low Stock Items</h6>
                <h3 class="mb-0">5</h3>
                <small class="text-warning">Action needed</small>
            </div>
        </div>
        <div class="col-12 col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stats-card">
                <h6 class="text-muted">Active Users</h6>
                <h3 class="mb-0">18</h3>
                <small class="text-success">Online now</small>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <h4 class="mb-3">Quick Actions</h4>
    <div class="quick-links-grid">
        <div class="card quick-link-card" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex align-items-center">
                <i class="bi bi-box fs-1 me-3 text-primary"></i>
                <div>
                    <h5 class="mb-1">Manage Stock</h5>
                    <p class="mb-0 text-muted">Update inventory and check stock levels</p>
                </div>
            </div>
        </div>
        
        <div class="card quick-link-card" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex align-items-center">
                <i class="bi bi-cart3 fs-1 me-3 text-success"></i>
                <div>
                    <h5 class="mb-1">New Order</h5>
                    <p class="mb-0 text-muted">Process a new customer order</p>
                </div>
            </div>
        </div>
        
        <div class="card quick-link-card" data-aos="fade-up" data-aos-delay="300">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-text fs-1 me-3 text-warning"></i>
                <div>
                    <h5 class="mb-1">Generate Report</h5>
                    <p class="mb-0 text-muted">Create sales and inventory reports</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Getting Started Guide -->
    <div class="card mt-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card-body">
            <h4 class="card-title">Getting Started</h4>
            <p class="card-text">Here's how to make the most of your dashboard:</p>
            <ul class="list-unstyled">
                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Use the sidebar to navigate between different sections</li>
                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Monitor your stock levels and set up alerts</li>
                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Process orders and manage customer information</li>
                <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Generate reports for business insights</li>
            </ul>
        </div>
    </div>
</div> 