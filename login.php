<?php
session_start();

// Show success message if redirected from signup
$success = false;
if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
    $success = true;
}

// Handle login form submission
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $hashed_password = $row['password'];

        if (password_verify($pass, $hashed_password)) {
            // ✅ Login successful
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login — ImportHub</title>
  <meta name="description" content="Log in to ImportHub to manage your account and explore premium imported goods." />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Site CSS -->
  <link rel="stylesheet" href="styles.css" />

  <style>
    .auth-page {
      min-height: 100vh;
      background: var(--light-color);
      padding-top: 120px;
      display: flex;
      align-items: center;
    }
    .auth-card {
      border: 1px solid #e5e7eb;
      border-radius: 20px;
      box-shadow: var(--shadow-lg);
      transition: transform .2s ease, box-shadow .2s ease;
      background: #fff;
    }
    .auth-card:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-xl);
    }
    .auth-title {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: var(--dark-color);
    }
    .auth-subtitle {
      color: #6b7280;
    }
    .form-control {
      border-radius: 15px;
      border: 2px solid #e5e7eb;
      padding: 0.875rem 1rem;
      transition: all .25s ease;
      background: rgba(255, 255, 255, 0.95);
    }
    .form-control:hover {
      border-color: #d1d5db;
    }
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(99,102,241,.25);
      background: #fff;
    }
    .auth-meta a {
      text-decoration: none;
      font-weight: 600;
    }
    .auth-meta a:hover {
      color: var(--primary-color);
    }
  </style>
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
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <div class="search-container position-relative d-none d-md-block">
            <input type="text" class="form-control search-input" placeholder="Search products..." />
            <i class="bi bi-search search-icon"></i>
          </div>
          <button class="btn btn-primary cart-btn position-relative" id="cartBtn" type="button">
            <i class="bi bi-bag-heart"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count" id="cartCount">0</span>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Auth Section -->
  <main class="auth-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
          <div class="card auth-card p-4 p-md-5">
            <div class="text-center mb-4">
              <span class="badge hero-badge">Welcome back</span>
              <h1 class="auth-title mt-3">Login</h1>
              <p class="auth-subtitle mb-0">Access your ImportHub account</p>
            </div>

            <!-- ✅ Alerts -->
            <?php if ($success): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Account created successfully. Please log in.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            <?php endif; ?>

            <!-- ✅ Fixed Login Form -->
            <form action="login.php" method="POST" novalidate>
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your password" required />
              </div>

              <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" />
                  <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="small auth-meta">Forgot password?</a>
              </div>

              <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
              </button>

              <p class="text-center small mt-3 auth-meta">
                Don’t have an account? <a href="signup.php">Sign up</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer bg-dark text-light py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <div class="footer-brand">
            <div class="d-flex align-items-center mb-3">
              <div class="brand-icon me-2"><i class="bi bi-globe-americas"></i></div>
              <div>
                <h4 class="mb-0 text-white">ImportHub</h4>
                <small class="text-muted">Premium Imported Goods</small>
              </div>
            </div>
            <p class="text-muted">Your trusted source for curated products from around the world. Quality guaranteed, satisfaction assured.</p>
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
            <li><a href="#">Luxury Skincare</a></li>
            <li><a href="#">Lifestyle</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6">
          <h5 class="footer-title">Newsletter</h5>
          <p class="text-muted small">Subscribe to get updates on new products and offers</p>
          <div class="newsletter-form">
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Your email" />
              <button class="btn btn-primary" type="button">
                <i class="bi bi-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-4 border-secondary" />
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

  <!-- Bootstrap JS + your site JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
