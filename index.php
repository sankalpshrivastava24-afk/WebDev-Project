<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImportHub - Premium Imported Goods</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#home">
                <div class="brand-icon me-2">
                    <i class="bi bi-globe-americas"></i>
                </div>
                <div>
                    <h4 class="mb-0 brand-title">ImportHub</h4>
                    <small class="brand-subtitle">Premium Imported Goods</small>
                </div>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="search-container position-relative">
                        <input type="text" id="searchInput" class="form-control search-input" placeholder="Search products...">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                    <button class="btn btn-primary cart-btn position-relative" id="cartBtn">
                        <i class="bi bi-bag-heart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count" id="cartCount">0</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content text-white">
                        <span class="hero-badge mb-3">Premium Quality Since 2010</span>
                        <h1 class="hero-title mb-4">Discover World's Finest <span class="text-gradient">Imported Delicacies</span></h1>
                        <p class="hero-description mb-4">From exotic chocolates to rare beverages, explore our curated collection of premium imported goods sourced directly from master artisans worldwide.</p>
                        <div class="hero-buttons">
                            <button class="btn btn-primary btn-lg me-3" onclick="scrollToProducts()">
                                <i class="bi bi-bag-plus me-2"></i>Shop Now
                            </button>
                            <button class="btn btn-outline-light btn-lg">
                                <i class="bi bi-play-circle me-2"></i>Watch Story
                            </button>
                        </div>
                        <div class="hero-stats mt-5">
                            <div class="row">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">500+</h3>
                                        <p class="stat-label">Products</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">50+</h3>
                                        <p class="stat-label">Countries</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number">10K+</h3>
                                        <p class="stat-label">Happy Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container">
                        <div class="hero-image-wrapper">
                            <img src="https://images.pexels.com/photos/4109743/pexels-photo-4109743.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Premium imported goods" class="img-fluid hero-image">
                            <div class="floating-card floating-card-1">
                                <i class="bi bi-award text-warning"></i>
                                <span>Premium Quality</span>
                            </div>
                            <div class="floating-card floating-card-2">
                                <i class="bi bi-truck text-success"></i>
                                <span>Fast Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">Categories</span>
                <h2 class="section-title">Shop by Category</h2>
                <p class="section-description">Discover our carefully curated selection of premium imported goods</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="category-card h-100" data-category="drinks">
                        <div class="category-image">
                            <img src="https://images.pexels.com/photos/544961/pexels-photo-544961.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Premium Drinks" class="img-fluid">
                            <div class="category-overlay">
                                <i class="bi bi-cup-straw category-icon"></i>
                            </div>
                        </div>
                        <div class="category-content">
                            <h4>Premium Drinks</h4>
                            <p>Exotic beverages from around the world</p>
                            <span class="category-count">25+ Products</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="category-card h-100" data-category="chocolate">
                        <div class="category-image">
                            <img src="https://images.pexels.com/photos/918327/pexels-photo-918327.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Artisan Chocolates" class="img-fluid">
                            <div class="category-overlay">
                                <i class="bi bi-heart-fill category-icon"></i>
                            </div>
                        </div>
                        <div class="category-content">
                            <h4>Artisan Chocolates</h4>
                            <p>Handcrafted chocolates from master chocolatiers</p>
                            <span class="category-count">30+ Products</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="category-card h-100" data-category="snacks">
                        <div class="category-image">
                            <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Gourmet Snacks" class="img-fluid">
                            <div class="category-overlay">
                                <i class="bi bi-star-fill category-icon"></i>
                            </div>
                        </div>
                        <div class="category-content">
                            <h4>Gourmet Snacks</h4>
                            <p>Unique snacks and delicacies</p>
                            <span class="category-count">20+ Products</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="category-card h-100" data-category="coffee">
                        <div class="category-image">
                            <img src="https://images.pexels.com/photos/894695/pexels-photo-894695.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Specialty Coffee" class="img-fluid">
                            <div class="category-overlay">
                                <i class="bi bi-cup-hot category-icon"></i>
                            </div>
                        </div>
                        <div class="category-content">
                            <h4>Specialty Coffee</h4>
                            <p>Premium coffee beans from exotic locations</p>
                            <span class="category-count">15+ Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <span class="section-badge">Products</span>
                    <h2 class="section-title">Featured Products</h2>
                    <p class="section-description">Handpicked selection of our most popular imported items</p>
                </div>
                <div class="col-lg-6">
                    <div class="filter-tabs d-flex flex-wrap justify-content-lg-end gap-2">
                        <button class="btn btn-outline-primary filter-btn active" data-filter="all">All Products</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="drinks">Drinks</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="chocolate">Chocolate</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="snacks">Snacks</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="coffee">Coffee</button>
                    </div>
                </div>
            </div>
            
            <div class="row g-4" id="productsGrid">
                <!-- Products will be loaded dynamically -->
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <span class="section-badge">About ImportHub</span>
                        <h2 class="section-title">Your Trusted Source for Premium Imports</h2>
                        <p class="section-description">For over a decade, ImportHub has been your trusted source for premium imported goods. We carefully curate products from around the world, ensuring only the finest quality items reach our customers.</p>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5>Fast Shipping</h5>
                                        <p>Quick and secure delivery worldwide with tracking</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5>Quality Guaranteed</h5>
                                        <p>100% authentic imported products with quality assurance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5>24/7 Support</h5>
                                        <p>Customer service whenever you need assistance</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="bi bi-award"></i>
                                    </div>
                                    <div class="feature-content">
                                        <h5>Award Winning</h5>
                                        <p>Recognized for excellence in import trade</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <img src="https://images.pexels.com/photos/3962285/pexels-photo-3962285.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Our warehouse" class="img-fluid about-image">
                        <div class="about-badge">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span>Certified Quality</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">Contact Us</span>
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-description">Have questions? We'd love to hear from you</p>
            </div>
            
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Address</h5>
                                <p>123 Import Street<br>Trade City, TC 462044</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Phone</h5>
                                <p>+91 9109814758</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Email</h5>
                                <p>info@importhub.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Business Hours</h5>
                                <p>Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="contact-form-container">
                        <form id="contactForm" class="contact-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
                                        <label for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Email" required>
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="subject" required>
                                            <option value="">Choose a subject</option>
                                            <option value="general">General Inquiry</option>
                                            <option value="product">Product Question</option>
                                            <option value="order">Order Support</option>
                                            <option value="partnership">Partnership</option>
                                        </select>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" placeholder="Message" style="height: 120px" required></textarea>
                                        <label for="message">Your Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <div class="d-flex align-items-center mb-3">
                            <div class="brand-icon me-2">
                                <i class="bi bi-globe-americas"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 text-white">ImportHub</h4>
                                <small class="text-muted">Premium Imported Goods</small>
                            </div>
                        </div>
                        <p class="text-muted">Your trusted source for premium imported goods from around the world. Quality guaranteed, satisfaction assured.</p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="footer-links">
                        <li><a href="#">Premium Drinks</a></li>
                        <li><a href="#">Artisan Chocolates</a></li>
                        <li><a href="#">Gourmet Snacks</a></li>
                        <li><a href="#">Specialty Coffee</a></li>
                        <li><a href="#">Gift Sets</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Support</h5>
                    <ul class="footer-links">
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Newsletter</h5>
                    <p class="text-muted small">Subscribe to get updates on new products and offers</p>
                    <div class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email">
                            <button class="btn btn-primary" type="button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; 2025 ImportHub. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-legal">
                        <a href="#" class="text-muted me-3">Privacy Policy</a>
                        <a href="#" class="text-muted me-3">Terms of Service</a>
                        <a href="#" class="text-muted">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-bag-heart me-2"></i>Shopping Cart
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="cartItems"></div>
                    <div class="cart-total mt-4 p-3 bg-light rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Total: <span class="text-primary">Rs<span id="cartTotal">0.00</span></span></h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" id="clearCart">
                        <i class="bi bi-trash me-2"></i>Clear Cart
                    </button>
                    <button type="button" class="btn btn-primary" id="checkout">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductName"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <img id="modalProductImage" src="" alt="" class="img-fluid rounded">
                        </div>
                        <div class="col-md-6">
                            <div class="product-details">
                                <p id="modalProductDescription" class="text-muted mb-3"></p>
                                <div class="product-price mb-3">
                                    <h3 class="text-primary mb-0">Rs<span id="modalProductPrice"></span></h3>
                                </div>
                                <div class="quantity-selector mb-4">
                                    <label class="form-label">Quantity:</label>
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                                        <input type="number" id="modalQuantity" class="form-control text-center" value="1" min="1" max="10">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-lg w-100" id="modalAddToCart">
                                    <i class="bi bi-bag-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>


    <!-- New Products -->
    <script>
    (function() {
        try {
            // Ensure base data and functions exist
            if (typeof products !== 'undefined' && Array.isArray(products)) {
                const newProducts = [
    {
        "id": 9,
        "name": "Ethiopian Yirgacheffe Coffee",
        "price": 1099,
        "category": "coffee",
        "image": "images/coffee1.jpg",
        "description": "Floral, citrusy notes with a clean finish. Single-origin Arabica from Yirgacheffe.",
        "badge": "Single-Origin"
    },
    {
        "id": 10,
        "name": "Italian Tiramisu Squares",
        "price": 649,
        "category": "snacks",
        "image": "images/image2.webp",
        "description": "Classic creamy tiramisu in bite-sized layers of coffee-soaked goodness.",
        "badge": "Bestseller"
    },
    {
        "id": 11,
        "name": "Hazelnut Praline Chocolate",
        "price": 899,
        "category": "chocolate",
        "image": "images/image3.jpg",
        "description": "Velvety praline center wrapped in rich milk chocolate with roasted hazelnuts.",
        "badge": "New"
    },
    {
        "id": 12,
        "name": "Himalayan Herbal Tea Blend",
        "price": 499,
        "category": "drinks",
        "image": "images/image5.webp",
        "description": "Soothing blend of mountain herbs—perfect for calm evenings.",
        "badge": "Caffeine-Free"
    },
    {
        "id": 13,
        "name": "Belgian Caramel Sea Salt Fudge",
        "price": 749,
        "category": "snacks",
        "image": "images/image2.jpg",
        "description": "Soft, chewy fudge balanced with sea salt crystals and buttery caramel.",
        "badge": "Gourmet"
    },
    {
        "id": 14,
        "name": "Nitro Cold Brew (Can)",
        "price": 299,
        "category": "drinks",
        "image": "images/image7.jpg.webp",
        "description": "Ultra-smooth nitrogen-infused cold brew with a creamy head.",
        "badge": "Nitro"
    },
    {
        "id": 15,
        "name": "Mexican Hot Chocolate Mix",
        "price": 559,
        "category": "chocolate",
        "image": "images/image4.jpg",
        "description": "Spiced cocoa blend with cinnamon for a cozy, authentic cup.",
        "badge": "Spiced"
    },
    {
        "id": 16,
        "name": "Pistachio Baklava Bites",
        "price": 899,
        "category": "snacks",
        "image": "images/image6.jpg",
        "description": "Crispy layers of phyllo with pistachios and honey—mini, flaky, irresistible.",
        "badge": "Limited"
    }
];
                
                // Avoid ID collisions if the base data changes
                const ids = new Set(products.map(p => p.id));
                let nextId = Math.max(0, ...products.map(p => p.id));
                newProducts.forEach(p => {
                    if (ids.has(p.id)) {
                        nextId += 1;
                        p.id = nextId;
                    }
                });
                
                // Append and re-render so the new items appear immediately
                products.push(...newProducts);
                if (typeof displayProducts === 'function') {
                    displayProducts(products);
                }
            }
        } catch (e) {
            console.error('New products injection failed:', e);
        }
    })();
    </script>
    <!--End New Products -->
</body>
</html>