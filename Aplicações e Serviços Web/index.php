<!DOCTYPE html>
<html lang="pt">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>HOME - REFOOD FCUL Edition</title>
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
          <li><a class="nav-link scrollto nav-active" href="index.php">Página Principal</a></li>
          <li><a class="nav-link scrollto" href="instituicoes.php">Instituições</a></li>
          <li><a class="nav-link scrollto" href="sobre.php">Sobre nós</a></li>
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
      // session_start();
      if (isset($_SESSION["login"])){
        echo '<a href="auxiliares/termina_sessao.php" class="login-btn scrollto" id="sair"><span class="d-none d-md-inline">Sair</a>';
      }else{
        echo '<a href="login.php" class="login-btn scrollto"><span class="d-none d-md-inline">Entrar/</span>Registar</a>';
      }
    ?>

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <!-- <div class="heroOverlay"></div> -->
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/hero/bici.png)">
          <div class="container">
            <h2>A nossa <span>Missão</span></h2>
            <p>A REFOOD tem como missão resgatar alimentos, alimentar as pessoas e incluir toda a comunidade local,<br>
               criando uma sociedade mais sustentável, justa e solidária. 
            </p>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/hero/pao.jpg)">
          <div class="container">
            <h2>os bens que recolhemos</h2>
            <p>Cada refeição resgatada alimenta alguém necessitado ao mesmo tempo que protege o nosso meio ambiente.</p>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/hero/volunt.jpg)">
          <div class="container">
            <h2>Os nossos voluntários</h2>
            <p>Com apenas 2h do seu tempo, semanalmente os nossos voluntários
               garantem o <br> apoio alimentar para cerca de 10 pessoas necessitadas
               na sua própria comunidade.
            </p>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="section-title">
          <h2>O movimento</h2>
          <p> Aspiramos a um mundo novo, onde todos têm a comida de que necessitam; onde os alimentos produzidos 
              vão primeiramente alimentar pessoas; os cidadãos participam ativamente na gestão dos preciosos 
              recursos da comunidade, e todos assumem o seu poder, direito e obrigação de transformar o mundo 
              num lugar melhor.<br><br>
          </p>
          <a class="cta-btn scrollto" href="sobre.php">Saber mais</a>
        </div>

      </div>
    </section>
    <!-- End Cta Section -->

    <!-- ======= Account Options ======= -->
    <section id="account-options" class="account-options">
      <div class="container" data-aos="fade-up">

        <div class="row d-flex justify-content-center">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="fa fa-male"></i></div>
              <h4 class="title"><a href="">Voluntários</a></h4>
              <p class="description">
                Ser um voluntário é atuar na comunidade com propósito. É investir o seu próprio tempo e energia 
                ao serviço dos outros e causar um impacto real na sua comunidade. 
              </p>
              <a href="registar_voluntario.php" class="account-btn">Ser Voluntário</a>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="fa fa-home"></i></div>
              <h4 class="title"><a href="">Instituições</a></h4>
              <p class="description">
                Ser instituição parceira é abraçar a sua responsabilidade social e ambiental, capacitando os 
                cidadãos locais para mudar o mundo na sua própria comunidade. 
              </p>
              <a href="registar_instituicao.php" class="account-btn">Ser Parceiro</a>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Account Options -->

    <!-- ======= Values ======= -->
    <section id="values" class="values values">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Os nossos valores</h2><br>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="fa fa-handshake" aria-hidden="true"></i></div>
            <h4 class="title"><a>IGUALDADE</a></h4>
            <p class="description"> Acreditamos que todas as pessoas compartilham uma dignidade humana comum e todos têm o direito de ter acesso a uma boa alimentação. </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
            <h4 class="title"><a>SERVIÇO VOLUNTÁRIO</a></h4>
            <p class="description">Acreditamos no valor do serviço voluntário aos outros e à comunidade com um espírito de generosidade, amizade e harmonia.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class="fa fa-hand-peace" aria-hidden="true"></i></div>
            <h4 class="title"><a>RESPEITO</a></h4>
            <p class="description">Acreditamos que todas as pessoas merecem ser tratadas com respeito e que devemos ser um espelho da benevolência respeitosa, visível e constante na comunidade. </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
            <h4 class="title"><a>INCLUSÃO</a></h4>
            <p class="description">Acreditamos que toda a comunidade – pessoas e instituições – deve ser convidada a participar e devemos incluir todos os que abraçam nossos valores e missão.</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class="fa fa-recycle" aria-hidden="true"></i></div>
            <h4 class="title"><a>SUSTENTABILIDADE</a></h4>
            <p class="description">Acreditamos que devemos trabalhar para sermos sustentáveis social, ambiental e financeiramente, e também ao nível local, nacional e internacional. </p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
            <h4 class="title"><a>GRATIDÃO</a></h4>
            <p class="description">Acreditamos que a gratidão está no nosso coração e deve estar presente em todas as interações entre voluntários, beneficiários, parceiros e a comunidade.</p>
          </div>
        </div>

      </div>
    </section>
    <!-- Values -->

    <!-- ======= Info Section ======= -->
    <section id="information" class="information">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                  <h4>IMPACTO REFOOD</h4>
                  <p>O impacto Refood é mobilizar, unir e transformar a comunidade.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                  <h4>SUSTENTABILIDADE</h4>
                  <p>Para o Movimento REFOOD, a sustentabilidade manifesta-se em três vertentes: social, ambiental e financeira.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                  <h4>INOVAÇÃO</h4>
                  <p>O Movimento Refood é inovador por natureza, conceptualmente, e em resposta à necessidade.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                  <h4>PRÉMIOS E MENÇÕES</h4>
                  <p>O Movimento REFOOD foi reconhecido pela primeira vez logo após seis meses de atividade. Desde então, anualmente, temos sido homenageados.</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-8">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <h3>IMPACTO REFOOD</h3>
                <img src="assets/img/info/rodas.jpg" alt="" class="img-fluid">
                <p>
                  A nossa ação diária tem efeitos imediatos: a boa comida não é desperdiçada,
                  as pessoas não passam fome, os cidadãos podem doar uma pequena parte do seu 
                  tempo para mudar o mundo na sua vizinhança, as empresas locais ativam
                  o seu dever de responsabilidade social e ambiental e todos podem participar 
                  ativamente numa economia circular que produz um bem social na sua própria 
                  comunidade local. Os resultados quantitativos e qualitativos produzidos são
                  visíveis tanto nos números, sempre em crescimento, como na vida de todas as
                  pessoas envolvidas.
                </p>
              </div>
              <div class="tab-pane" id="tab-2">
                <h3>SUSTENTABILIDADE</h3>
                <img src="assets/img/info/laranja.jpg" alt="" class="img-fluid">
                <p>A <b>sustentabilidade social</b> surge num convite a toda a comunidade local, 
                   desafiando voluntários a participar, uma vez por semana. Invariavelmente, 
                   essa experiência resulta em felicidade e vontade de continuar.
                   <br>
                   A <b>sustentabilidade ambiental</b> é a base do modelo operacional, 
                   pois cada refeição resgatada não só protege o ambiente, como contribui 
                   para neutralizar a nossa pegada de carbono.
                   <br>
                   A <b>sustentabilidade financeira</b> é assegurada pela eficiência económica do
                   nosso modelo operacional único, de baixo custo e alta produtividade 
                   juntamente com o nosso modelo de abordagem e inclusão da comunidade 
                </p>
              </div>
              <div class="tab-pane" id="tab-3">
                <h3>INOVAÇÃO</h3>
                <img src="assets/img/info/comida.jpg" alt="" class="img-fluid">
                <ul>
                  <li class="inovation">
                    <i class="bi bi-arrow-right"></i>
                    É uma organização independente, sustentável, 100% voluntária. Gerida por
                    uma rede de núcleos autónomos
                  </li>
                  <br>
                  <li class="inovation">
                    <i class="bi bi-arrow-right"></i>
                    Transforma o problema do desperdício alimentar numa solução para o 
                    combate à fome.
                  </li>
                  <br>
                  <li class="inovation">
                    <i class="bi bi-arrow-right"></i>
                    O Movimento Refood nutre uma cultura de inovação onde as melhores práticas
                    e soluções locais são partilhadas entre a sua rede interna, resultando na
                    melhoria contínua de todos os Núcleos Locais. 
                  </li>
                  
                </ul>
              </div>
              <div class="tab-pane" id="tab-4">
                <h3>PRÉMIOS E MENÇÕES</h3>
                <img src="assets/img/info/premio.jpg" alt="" class="img-fluid">
                <p>
                  Muito agradecemos essa consideração e o apoio que nos tem sido concedido. 
                  O reconhecimento e apoio são fundamentais para a concretização da nossa missão, 
                  mas o maior reconhecimento está nas interações diárias entre voluntários, 
                  beneficiários e parceiros, onde testemunhamos a transformação do nosso trabalho 
                  compartilhado.
                  <br><br>
                  <b>Alguns prémios:</b>
                  <br>
                  <li class="awards">
                    <i class="bi bi-arrow-right"></i>
                    The Futures Project.
                  </li>
                  <li class="awards">
                    <i class="bi bi-arrow-right"></i>
                    Parcerias para Impacto da Portugal Inovação Social.
                  </li>
                  <li class="awards">
                    <i class="bi bi-arrow-right"></i>
                    BAYER – Ideias que Mudam o Mundo.
                  </li>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
    <!-- End Info Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class='fas fa-drumstick-bite'></i>
              <span data-purecounter-start="0" data-purecounter-end="150000" data-purecounter-duration="1" class="purecounter"></span> 
              <p><strong>Refeições por mês</strong> salvas e distribuídas pelos nossos voluntários</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              <span data-purecounter-start="0" data-purecounter-end="6800" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Beneficiários</strong> apoiados por nós</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fa fa-users" aria-hidden="true"></i>
              <span data-purecounter-start="0" data-purecounter-end="7500" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Voluntários</strong> que ajudam a recolher e a distribuír refeições</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span data-purecounter-start="0" data-purecounter-end="2500" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Instituições</strong>  que doam refeições</p>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testemunhos</h2>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Ser voluntária é oferecer um pouco de nós para o bem de muitos.<br>
                  É uma actividade gratificante que nos faz sair da nossa zona de conforto, 
                  o que se torna fácil pelo excelente espírito de equipa que se cria.<br> 
                  No fim de cada turno regresso a casa com a sensação de que fiz a diferença na vida 
                  de alguém.								
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testemonials/marta.jpg" class="testimonial-img" alt="">
                <h3>Marta Lopes</h3>
                <h4>Voluntária</h4>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Na Refood, não lutamos só contra o desperdício alimentar. Colaboramos para
                  que dezenas de famílias tenham o que comer, promovemos a entre ajuda com os
                  nossos parceiros e inspiramos quem ainda não faz voluntariado e, não 
                  precisamos sair sequer da nossa cidade, porque se cada um de nós fizer a sua
                  parte, em cada canto do mundo, este será um lugar muito melhor.								
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testemonials/carlos.jpg" class="testimonial-img" alt="">
                <h3>Carlos Almeida</h3>
                <h4>Estudante</h4>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Para mim fazer voluntariado é dedicar o meu tempo aos mais que mais precisam.
                  O meu trabalho na Refood permite-me ajudar pessoas necessitadas, ser uma parte
                  ativa da comunidade e crescer como pessoa, enfrentando e conquistando novos 
                  desafios.								
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testemonials/luisa.jpg" class="testimonial-img" alt="">
                <h3>Luísa Martins</h3>
                <h4>Estudante &#38; voluntária </h4>
              </div>
            </div>
            <!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Desde o início, fiquei impressionado com a simplicidade do Projeto  
                  (não precisava de grandes recursos financeiros), com o entusiasmo dos 
                  voluntários e o calor da equipa de voluntários-gestores. Vi esse mesmo 
                  entusiasmo multiplicar-se na medida em que novas equipas pioneiras levaram
                  a ideia a outras comunidades.								
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testemonials/jorge.jpg" class="testimonial-img" alt="">
                <h3>Jorge Santos</h3>
                <h4>Empresário &#38; Voluntário</h4>
              </div>
            </div>
            <!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= Institutions Section ======= -->
    <section id="institutions" class="institutions section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Instituições</h2>
          <p>
            Pode encontrar as nossas instituições por todo o país, há uma perto de si! <br>
            Aqui estão alguns dos nossos pareceiros:
          </p>
        </div>

        <div class="row">

          <?php
            include "auxiliares/abreconexao.php";
            $query = "SELECT * FROM instituicao";

            $res = mysqli_query($conn, $query);

            if ($res){} 
            else {
                echo "Erro: failed" . $query . "<br>" . mysqli_error($conn);
            }
          
            $res = mysqli_query($conn, $query);

            for ($i = 1; $i <= 4; $i++) { 
              $row = $res-> fetch_assoc()
            ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
              <div class="member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                  <img src="assets/img/institutions/instituicao.jpg" class="img-fluid" alt="">
                </div>
                <div class="member-info">
                  <a href="perfil-instituicao.php?id=<?php echo $row['email'];?>" class="stretched-link">
                    <h4><?php echo $row['nome']?></h4>
                    <p><?php echo $row['concelho']?></p>
                  </a>
                </div>
              </div>
            </div>

          <?php
          }
          ?>

        <div class="text-center"><a href="instituicoes.php" class="account-btn">Ver todas</a></div>
      </div>
    </section>
    <!-- End Institutions Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Galeria</h2>
          <p>
            Algumas fotos do nosso trabalho 
          </p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="gallery-lightbox" href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    <!-- End Gallery Section -->

    <!-- ======= Frequently Asked Questioins Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Perguntas Frequentes</h2>
        </div>

        <ul class="faq-list">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Como posso ajudar? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                A melhor ajuda é o seu tempo, no caso de querer ser um voluntário, ou as suas doações se tiver um restaurante.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Como posso saber quais as instituições mais perto de mim? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Pode ver as <a href="instituicoes.php">instiuições parceiras</a>, divididas por distrito, no separador "Instituições"
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">A partir de que idade é que me posso inscrever como voluntário <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Os voluntários podem inscrever-se a partir dos 18 anos, mas devem ser portadores de carta de condução
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <!-- End Frequently Asked Questioins Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>A nossa sede</h2>
          <p><b>Horário:</b> Segunda a Sexta-feira 9h30-13h30 <br>
            Sábados, Domingos e Feriados: Fechado</p>
        </div>
      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://maps.google.com/maps?q=R.%20Manuel%20Mendes%20Lote%2020%20Cave%20D,%201800-251%20Lisboa&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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

<?php 
  mysqli_close($conn);
?>