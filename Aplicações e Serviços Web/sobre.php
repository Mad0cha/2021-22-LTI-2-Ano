<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SOBRE - REFOOD FCUL Edition</title>
  <link href="assets/img/brand/icon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="index.php" class="logo me-auto"><img src="assets/img/brand/logo.png" alt=""></a>
 
      <!-- ======= Navbar ======= -->
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Página Principal</a></li>
          <li><a class="nav-link scrollto" href="instituicoes.php">Instituições</a></li>
          <li><a class="nav-link scrollto nav-active" href="sobre.php">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="contactos.php">Contactos</a></li>
          <?php 
          session_start();
          
          if (isset($_SESSION["login"])){
            echo "<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'> </script>
              <script>
              function updateUserStatus(){
                console.log('Hello world2!');
                jQuery.ajax({
                  url:'/~asw14/projeto/TestesPedro/Proj/chat2/update_user_status.php',
                  success:function(){
                    
                  }
                });
              }
              
              setInterval(function(){
                updateUserStatus();
              },3000);
            </script>";
            if ($_SESSION["tipo_login"] == "voluntario"){
              echo '<li><a class="nav-link scrollto nav-active" href="area_user.php">Área de utilizador</a></li>';
              
            }else if($_SESSION["tipo_login"] == "instituicao"){
              echo '<li><a class="nav-link scrollto nav-active" href="area_instituicao.php">Área de utilizador</a></li>';
              
            }else{
              echo '<li><a class="nav-link scrollto nav-active" href="admin.php">Área de administração</a></li>';
             
            }
          }
        ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- .navbar -->
    
    <?php 
        if (isset($_SESSION["login"])){
          echo '<a href="auxiliares/termina_sessao.php" class="login-btn scrollto" id="sair"><span class="d-none d-md-inline">Sair</a>';
        }else{
          echo '<a href="login.php" class="login-btn scrollto"><span class="d-none d-md-inline">Entrar/</span>Registar</a>';
        }
    ?>

    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title-contact">
          <h2>Sobre nós</h2>
          <p>
            O Movimento REFOOD é independente, sustentável, 100% voluntário, democrático, orientado por cidadãos e organizado 
            em comunidades locais. Dedica-se à recuperação de comida em boas condições e à alimentação de pessoas necessitadas 
            através da inclusão da comunidade local. Em Portugal, a REFOOD encontra-se juridicamente constituída como associação 
            sem fins lucrativos tendo também o estatuto de IPSS. O Movimento REFOOD opera localmente na e para a comunidade, 
            trabalhando sem remuneração, suportando unicamente os custos e investimentos que servem a sua missão. <br><br>
            O REFOOD FCUL surgiu da vontade de 5 alunos de ajudar quem mais precisa e fazer um website que possibilite juntar
            voluntários e instituições da forma mais rápida e fácil possível para que as doações das instituições sejam recolhidas 
            por voluntários e cheguem o mais depressa possível a quem precisa.
          </p>
        </div>

      </div>

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Sede Nacional</h3>
                  <p>R. Manuel Mendes Lote 20 Cave D, 1800-251 Lisboa</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Envie um email</h3>
                  <p>refood-fcul@gmail.com</p>
                  <p>refood-fcul@hotmail.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Contacte-nos</h3>
                  <p>961 472 340</p>
                  <p>213 163 781</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="auxiliares/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
                </div>
                <div class="col form-group mt-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">a enviar...</div>
                <div class="error-message"></div>
                <div class="sent-message">A sua mensagem foi enviada, obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
    <!-- End Contact Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Refood-FCUL</h3>
              <p>
                R. Manuel Mendes,<br>
                Lote 20 Cave D, 1800-251 Lisboa<br><br>
                <strong>Telefone:</strong> 961 472 340<br>
                <strong>Email:</strong> refood-fcul@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Página Principal</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="instituicoes.php">Instituições</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contactos.php">Contactos</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <img class="footerImg" src="assets/img/brand/Cofinanciamento_Lisboa2020_Portugal2020.png" > 
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Refood-FCUL</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>