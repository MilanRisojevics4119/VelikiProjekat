    <!-- Site footer -->
    <div class="footer-separator"></div>
    <footer class="site-footer bg-dark">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
          <div class="col-sm-12 col-md-6">
            <a href="#">About Me</a>
          </div>
          <div class="col-xs-12 col-md-3 mt-4">
            <h4>Quick Links</h4>
            <ul class="footer-links">

              <li><a href="sitemap.xml">Sitemap</a></li>
              <li><a href="documentation.docx">Documentation</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by
              <p>Yours Truly</p>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="https://www.facebook.com/BvanaIzLagune12"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="github" href="https://github.com/TheHandOfKing"><i class="fab fa-github"></i></a></li>
              <li><a class="linkedin" href="https://www.linkedin.com/in/aleksandar-marjanovic-0a4a8318a/"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
  <script src="assets/js/menu.js"></script>
  <script src="assets/js/header.js"></script>
<?php
  if (isset($_GET['page'])) {
    if ($_GET['page'] == 'dashboard') {
      echo '<script src="public/js/dashboard.js"></script>';
    } else if ($_GET['page'] == 'games') {
      echo '<script src="assets/js/pagination.js"></script>';
    }
  }
?>
</html>