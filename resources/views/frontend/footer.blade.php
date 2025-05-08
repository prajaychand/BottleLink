<!-- Footer -->
<footer class="text-center text-lg-start text-light">


  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-top border-bottom border-dark-subtle">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span class="fw-semibold">Connect with us on social media</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div class="social-icons">
      <a href="" class="me-4 social-icon">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 social-icon">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 social-icon">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 social-icon">
        <i class="fab fa-pinterest"></i>
      </a>
      <a href="" class="me-4 social-icon">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="" class="me-4 social-icon">
        <i class="fab fa-tiktok"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="py-5">
    <div class="container text-center text-md-start">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <div class="footer-brand mb-4">
            <h5 class="text-uppercase fw-bold mb-2">
              <i class="fas fa-wine-bottle me-2 accent-color"></i>Bottle<span class="accent-color">Link</span>
            </h5>
            <div class="brand-divider"></div>
          </div>
          <p class="text-light-muted lh-base">
            Your premium destination for exceptional spirits, fine wines, and craft beers. We curate the finest selections from around the world, delivering unforgettable experiences for connoisseurs and casual enthusiasts alike.
          </p>
          <div class="mt-4 payment-methods">
            <i class="fab fa-cc-visa me-2"></i>
            <i class="fab fa-cc-mastercard me-2"></i>
            <i class="fab fa-cc-amex me-2"></i>
            <i class="fab fa-cc-paypal me-2"></i>
            <i class="fab fa-cc-apple-pay"></i>
          </div>
        </div>
        <!-- Grid column -->


        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 accent-color">
            Quick Links
          </h6>
          <p>
            <a href="{{route('about')}}" class="footer-link">About Us</a>
          </p>

          <p>
            <a href="{{route('terms&conditions')}}" class="footer-link">Terms and Conditions</a>
          </p>
          <p>
            <a href="{{route('awareness')}}" class="footer-link">Awareness</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 accent-color">Contact</h6>
          <p class="d-flex align-items-center mb-3">
            <i class="fas fa-map-marker-alt me-3 icon-muted"></i> Kathmandu, KTM 44600, NEP
          </p>
          <p class="d-flex align-items-center mb-3">
            <i class="fas fa-envelope me-3 icon-muted"></i>
            info@bottlelink.com
          </p>
          <p class="d-flex align-items-center mb-3">
            <i class="fas fa-phone-alt me-3 icon-muted"></i> + 977 234 567 88
          </p>


        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="copyright-section d-flex justify-content-center align-items-center p-4" style="min-height: 80px;">
    © 2024 BottleLink | All rights reserved
  </div>

  <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- Add this style section to your head or CSS file -->
<style>
  /* Footer Base Styling */
  footer {
    background-color: #161a1d;
    color: #e0e0e0;
    box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
    font-family: 'Poppins', sans-serif;
  }

  /* Accent Color */
  .accent-color {
    color: #e6a919 !important;
  }

  /* Text Colors */
  .text-light-muted {
    color: #adb5bd;
  }

  .icon-muted {
    color: #e6a919;
    opacity: 0.8;
  }


  /* Social Icons */
  .social-icons {
    display: flex;
    align-items: center;
  }

  .social-icon {
    color: #e0e0e0;
    font-size: 1.1rem;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .social-icon:hover {
    background-color: #e6a919;
    color: #161a1d;
    transform: translateY(-3px);
  }

  /* Footer Links */
  .footer-link {
    color: #e0e0e0;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
    padding-left: 0;
  }

  .footer-link:before {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 1px;
    background-color: #e6a919;
    transition: width 0.3s ease;
    opacity: 0;
  }

  .footer-link:hover {
    color: #e6a919;
    padding-left: 5px;
  }

  .footer-link:hover:before {
    width: 100%;
    opacity: 1;
  }

  /* Footer Brand */
  .footer-brand {
    position: relative;
  }

  .brand-divider {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #e6a919, transparent);
    margin-bottom: 20px;
  }

  /* Payment Methods */
  .payment-methods {
    color: #adb5bd;
    font-size: 1.5rem;
  }

  .payment-methods i {
    transition: all 0.3s ease;
  }

  .payment-methods i:hover {
    color: #e6a919;
    transform: translateY(-2px);
  }

  /* Age Verification Badge */
  .age-verification-badge {
    display: inline-block;
    background-color: rgba(230, 169, 25, 0.1);
    border: 1px solid rgba(230, 169, 25, 0.3);
    color: #e6a919;
    padding: 8px 15px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
  }

  /* Copyright Section */
  .copyright-section {
    background-color: rgba(0, 0, 0, 0.2);
    font-size: 0.9rem;
  }

  .footer-legal-links a {
    color: #adb5bd;
    text-decoration: none;
    transition: color 0.3s ease;
    font-size: 0.85rem;
  }

  .footer-legal-links a:hover {
    color: #e6a919;
  }

  /* Border Colors */
  .border-dark-subtle {
    border-color: rgba(255, 255, 255, 0.05) !important;
  }

  /* Responsive Adjustments */
  @media (max-width: 767.98px) {
    .social-icons {
      justify-content: center;
      margin-top: 15px;
    }

    .footer-legal-links {
      margin-top: 10px;
    }
  }
</style>
