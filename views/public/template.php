<?php include '../partials/header.php'; ?>
<div class="container-fluid p-0">
    <!-- Banner Section -->
    <div class="banner position-relative">
        <img src="path/to/banner-image.jpg" class="w-100" style="height: 400px; object-fit: cover;" alt="Article Banner">
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
            <h1 class="display-4 fw-bold">Article Title</h1>
            <p class="lead">Brief description or subtitle</p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container my-5">
        <!-- Introduction Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-center mb-4" style="color: var(--blue);">Introduction</h2>
                <p class="lead text-center">Opening paragraph that introduces the topic...</p>
            </div>
        </div>

        <!-- Content Section with Image -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h3 style="color: var(--darkgrey);">Section Title</h3>
                <p>Detailed content goes here...</p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> Key point 1</li>
                    <li><i class="bi bi-check-circle-fill me-2" style="color: var(--skyblue);"></i> Key point 2</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="path/to/image1.jpg" class="img-fluid rounded hover-scale" alt="Section Image">
            </div>
        </div>

        <!-- Quote Section -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <blockquote class="p-4 border-start border-5" style="border-color: var(--skyblue) !important; background-color: var(--lightgrey);">
                    <p class="mb-0 fs-5 fst-italic">"Important quote or highlight text goes here..."</p>
                    <footer class="blockquote-footer mt-2">Quote Author</footer>
                </blockquote>
            </div>
        </div>

        <!-- Card Section -->
        <div class="row mb-5">
            <h3 class="text-center mb-4" style="color: var(--blue);">Key Features</h3>
            <div class="col-md-4 mb-4">
                <div class="card h-100 hover-scale">
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--darkgrey);">Feature 1</h5>
                        <p class="card-text">Feature description...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 hover-scale">
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--darkgrey);">Feature 2</h5>
                        <p class="card-text">Feature description...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 hover-scale">
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--darkgrey);">Feature 3</h5>
                        <p class="card-text">Feature description...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="mb-4" style="color: var(--blue);">Ready to Learn More?</h3>
                <p class="mb-4">Engaging call-to-action text goes here...</p>
                <button class="btn btn-primary btn-lg hover-scale">Take Action Now</button>
            </div>
        </div>

        <!-- Related Content Section -->
        <div class="row">
            <h3 class="text-center mb-4" style="color: var(--blue);">Related Topics</h3>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card hover-scale">
                    <img src="path/to/related1.jpg" class="card-img-top" alt="Related Topic 1">
                    <div class="card-body">
                        <h5 class="card-title">Related Topic 1</h5>
                        <p class="card-text">Brief description...</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            <!-- Add more related content cards as needed -->
        </div>
    </div>
</div>
<?php include '../partials/footerViews.php'; ?>

 <!-- Live Chat Widget -->
 <div class="chat-widget" id="chat-widget">
            <div class="chat-header">
                <div class="chat-title">
                    <i class="fas fa-comments"></i>
                    <span data-translate="chatTitle">Live Support</span>
                </div>
                <div class="chat-controls">
                    <button class="close-chat" id="toggle-chat"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="chat-body">
                <div class="chat-messages" id="chat-messages">
                    <div class="message support">
                        <div class="message-content">
                            <p data-translate="chatWelcome">Hello! How can we help you today?</p>
                            <span class="message-time">10:00</span>
                        </div>
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="chat-input" placeholder="Type your message..." data-translate="chatInputPlaceholder">
                    <button class="send-message" id="send-message"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
</div>
