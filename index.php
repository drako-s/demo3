<?php
include_once('Db.php');
include_once('Utils.php');
include_once('credentials.php');

function loadConfig() {
if(file_exists('config.ini'))
    {
      $config = parse_ini_file("config.ini");
      return array("orderID" => $config["orderID"]);
    } else
    return array();
}

$configData = loadConfig();

$content = Db::queryOne('SELECT aboutus.*, contacts.*, metatags.*, domains.*, cta.*, headlines.*, opening_time.* FROM aboutus 
          LEFT JOIN contacts ON aboutus.order_id = contacts.order_id
          LEFT JOIN metatags ON aboutus.order_id = metatags.order_id
          LEFT JOIN domains ON aboutus.order_id = domains.order_id
          LEFT JOIN cta ON aboutus.order_id = cta.order_id
          LEFT JOIN headlines ON aboutus.order_id = headlines.order_id
          LEFT JOIN opening_time ON aboutus.order_id = opening_time.order_id
          WHERE aboutus.order_id = ?', array($configData['orderID']));

$features = Db::queryAll('SELECT * FROM `features` WHERE `order_id` = ?', array($configData['orderID']));
$faqs = Db::queryAll('SELECT * FROM `faq` WHERE `order_id` = ?', array($configData['orderID']));
$services = Db::queryAll('SELECT * FROM `services` WHERE `order_id` = ?', array($configData['orderID']));
?>
<!doctype html>
<html lang="cs">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $content['meta_title'] ?></title>
  <meta name="description" content="<?= $content['meta_description']?>">
  <meta name="keywords" content="<?= $content['meta_keywords']?>">

  	<!-- For Facebook -->
	<meta property="og:title" content="<?= $content['og_title']?>" /> <!-- max. 88 characters-->
	<meta property="og:type" content="<?= $content['og_description']?>" /> 
	<meta property="og:image" content="images/drako_facebook_og.png">
	<meta property="og:url" content="https://<?= $content['domain']?>" />
	<meta property="og:description" content="Začněte s levným webem a navyšujte dle potřeby!" /> <!-- around 200 characters-->
	<meta property="og:locale" content="cs_CZ" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="canonical" href="https://<?= $content['domain']?>" />

  <!-- font awesome 6 free -->
  <script src="https://kit.fontawesome.com/a4fa5c84b6.js" crossorigin="anonymous"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Font font from Google -->
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/app.css">

  
</head>
<!-- Google tag (gtag.js) -->
<?= $content['g_analytics'] ?>
<!-- End Google tag (gtag.js) -->
<body>
  <!--Hero ====================================== -->
  <header class="container" id="hero">
    <div class="sticky-wrapper">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="/"><?= $content['c_brand'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <div id="navbar-toggler-icon">
            <i class="fas fa-bars"></i>
          </div>         
        </button>
        <div class="collapse navbar-collapse justify-content-between gap-3" id="navbarScroll">
          <ul class="navbar-nav my-2 my-lg-0 ps-lg-5 gap-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#hero">Úvod</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutus">O nás</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#product">Služby</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pricing">Ceník</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#faq">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-us">Kontakt</a>
            </li>
          </ul>
          <div class="navbar-social-icons">
          <ul class="d-flex list-unstyled m-0 p-0">
            <?php if(!empty($content['c_facebook'])) : ?>
              <li class="mx-2">
              <a href="<?=$content['c_facebook']?>" class="block-44__link m-0">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_twitter'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_twitter'] ?>" class="block-44__link m-0">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_instagram'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_instagram'] ?>" class="block-44__link m-0">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_youtube'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_youtube'] ?>" class="block-44__link m-0">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_discord'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_discord'] ?>" class="block-44__link m-0">
                <i class="fab fa-discord"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_linkedin'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_linkedin'] ?>" class="block-44__link m-0">
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_mastodon'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_mastodon'] ?>" class="block-44__link m-0">
                <i class="fab fa-mastodon"></i>
              </a>
            </li>
            <?php endif; ?>
          </ul>
          </div>
        </div>
      </div>
    </nav>  
    </div> 

  </header>
<div class="hero">
  <div class="container overflow-hidden py-5">
    <div class="row g-5 position-relative">
      <div class="col-lg-8 d-flex flex-column align-items-start justify-content-center gap-3 pt-5 zindex-3">
        <div>
          <span class="d-none d-lg-block ps-5"><img src="https://www.stanislav-drako.cz/public/img/avatar_dancer_right.webp" alt="img" class="img-fluid p-4 p-lg-0"></span>
          <h1>
            <?= $content['hero_title']?>
          </h1>
        </div>
        <p class="subheadline">
        <?= $content['hero_subtitle']?>
        </p>
        <p class="align-self-lg-start">
          <?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?>
        </p>
        
      </div>
      <div class="col-lg-4 pt-lg-5">
        <div class="d-flex align-items-center justify-content-center position-relative">
          <div class="hero-image-wrap"></div>
          <img src="https://www.stanislav-drako.cz/public/img/demo2-hero.png" class="img-fluid zindex-3">
        </div>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#535da1" fill-opacity="1" d="M0,160L24,160C48,160,96,160,144,138.7C192,117,240,75,288,64C336,53,384,75,432,106.7C480,139,528,181,576,208C624,235,672,245,720,240C768,235,816,213,864,186.7C912,160,960,128,1008,133.3C1056,139,1104,181,1152,202.7C1200,224,1248,224,1296,197.3C1344,171,1392,117,1416,90.7L1440,64L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z">
    </path>
  </svg>

</div>
  <!-- ===================================== -->

<section id="aboutus">
    <div class="container overflow-hidden">
      <div class="row gx-5">
      <!-- HEADER -->
      <div class="col-md-4 col-lg-6">
                <!-- IMAGE -->
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="rounded-4">
            <img src="https://www.stanislav-drako.cz/public/img/demo2-aboutus.webp" class="img-fluid zindex-3">
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-start gap-3 h-100">
        <div class="headline d-flex flex-wrap gap-3">
          <h2><?= $content['about_title'] ?></h2>          
        </div>
        <p class="subheadline"><?= $content['about_subtitle'] ?></p>
        <p>
            <?= $content['about_content'] ?>
        </p>
        <p><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
      </div>
    </div>
  </div>
</section>

<section id="product" class="border-top border-bottom">
  <div class="container overflow-hidden">
  <div class="row d-flex justify-content-center pb-5 g-5">
    <div class="d-flex flex-column justify-content-center gap-5">
      <div class="text-center headline d-flex flex-wrap gap-3">
        <h2><?= $content['feat_headline'] ?></h2>
      </div>
      <div class="col-12 align-self-center">
        <div class="bg-white rounded-4 p-3 p-lg-5">
          <p class="subheadline text-center">
            <?= $content['feat_subheadline'] ?>
          </p>
        </div>
      </div>
    </div>
      <!-- Feature -->
      <?php foreach($features as $f) : ?>
      <div class="col-md-6">
        <div class="d-flex flex-column gap-4 h-100 bg-white rounded-4 p-3 p-lg-5 product-card">
          <div class="border-bottom">
            <h3 class="subheadline"><?= $f['f_title'] ?></h3>
          </div>            
          <div>
            <p>
            <?= $f['f_content'] ?>
            </p>
          </div>
        </div>          
      </div>
      <?php endforeach ; ?>

    </div>
    <div class="d-flex justify-content-center pt-5">
      <p><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
    </div>
  </div>
</section>
  <!-- ===================================== -->
  <section id="pricing">
    <div class="container pb-5 overflow-hidden">
      <div class="d-flex flex-column align-items-center gap-3 pb-5">
        <div class="row g-5">
        <div class="col-lg-6 align-self-start">
          <div class="text-center headline">
            <h2><?= $content['price_headline'] ?></h2>
          </div>
        </div>
        <div class="col-lg-6 align-self-end">
          <p class="subheadline">
            <?= $content['price_subheadline'] ?>
          </p>
        </div>
      </div>
      </div>
      <div class="row justify-content-center py-5 g-5">

      <?php foreach($services as $s) : ?>
          <div class="col-md-6">
            <div class="d-flex flex-column justify-content-between gap-2 h-100 p-lg-4 p-3 border rounded-4">
              <div class="pb-3 border-bottom d-flex justify-content-between align-items-center flex-column flex-lg-row">
                <h3 class="subheadline"><?= $s['services_title']?></h3>
                <span class="badge rounded-pill text-bg-light p-2 fs-5"><?= $s['services_price']?></span>
              </div>
              <p>
                  <?= $s['services_content']?>
                </p>
            </div>            
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

  <section id="cta">
  <div class="container-fluid overflow-hidden">
    <div class="row g-5">
      <div class="col-12">
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
          <div class="col-lg-6 bg-white rounded-4 p-lg-4 p-3 shadow-lg">
            <h2 class="text-center border-bottom pb-3"><?= $content['cta_title'] ?></h2>
            <p class="text-center pt-3"><?= $content['cta_subtitle'] ?></p>
          </div>
          <p><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
        </div>

      </div>
    </div>
  </div>
</section>

  <!-- =================================== -->
<section id="faq">
    <div class="container overflow-hidden">
      <!-- HEADER -->
      <div class="d-flex flex-column align-items-center text-center">
        <div class="text-center headline">
          <h2><?= $content['faq_headline'] ?></h2>
        </div>
        <div class="p-lg-5 p-3">
          <p class="subheadline">
            <?= $content['faq_subheadline'] ?>
          </p>
        </div>
      </div>
      <div class="row g-5 pt-5">
        <div class="col-lg-6">
        <img class="w-100" src="https://www.stanislav-drako.cz/public/img/demo2-faq.svg">
        </div>
        <div class="col-lg-6 pb-5">
          <div class="d-flex align-items-start h-100">
          <div class="accordion accordion-flush w-100" id="accordionExample">
                <?php foreach($faqs as $faq) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $faq['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $faq['id'] ?>" aria-expanded="false" aria-controls="faq<?= $faq['id'] ?>">                                                        
                        <?= $faq['faq_question'] ?>  
                    </h2>
                    <div id="faq<?= $faq['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $faq['id'] ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex card-1__paragraph">
                        <?= $faq['faq_answer'] ?>
                        
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
</section>

  <!-- ======================================== -->


  <!-- =================================== -->

  <section id="contact-us">
    <div class="container">
      <div class="row g-3">
        <div class="col-12">
          <div class="headline">
              <h2><?= $content['contact_headline'] ?></h2>
            </div>
        </div>
        <div class="col-lg-6 h-100">
          <div class="col-12 d-flex flex-column gap-3">
            <div class="bg-white p-lg-5 p-3 rounded-4">
              <p class="subheadline">
                <?= $content['contact_subheadline'] ?>
              </p>
            </div>            
            <div class="bg-white p-lg-5 p-3 rounded-4 text-dark">
              <h6 class="fw-bold fs-5 border-bottom"><?= $content['c_person'] ?></h6>
              <p class="d-flex flex-column">
                <span><?= $content['c_address'] ?></span>
                <?php if(!empty($content['c_ico'])) : ?>
                <span><?= 'IČO: ' . $content['c_ico'] ?></span>
                <?php endif; ?>
                <?php if(!empty($content['c_dic'])) : ?>
                <span><?= 'DIČ: ' . $content['c_dic'] ?></span>
                <?php endif; ?>
                <?php if(!empty($content['c_datovka'])) : ?>
                <span><?= 'Datová schránka: ' . $content['c_datovka'] ?></span>
                <?php endif; ?>
              </p>
            </div>

          </div>
        </div>
        <div class="col-lg-6 open-hour">          
        <div class="bg-white p-lg-5 p-3 rounded-4">              
            <p class="d-flex flex-column">
              <?php if(!empty($content['c_phone'])) : ?>
              <span>
                <a href="tel:<?= $content['c_phone'] ?>"><i class="fas fa-phone"></i><span class="mx-2"><?= $content['c_phone'] ?></span></a>
              </span>
              <?php endif; ?>
              <?php if(!empty($content['c_email'])) : ?>
              <span>
                <a href="mailto:<?= $content['c_email'] ?>"><i class="fas fa-envelope"></i><span class="mx-2"><?= $content['c_email'] ?></span></a>
              </span>
              <?php endif; ?>
            </p>
          </div>
          <div class="py-2"></div>
        <?php if(!$content['nonstop']) :  ?> 
          <div class="d-flex flex-column justify-content-center align-items-center p-3 p-lg-5 bg-white rounded-4">  
            <div class="col-12 col-md-8 d-flex flex-column gap-3">                          
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Pondělí: </span>
                  <?php if($content['mon_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['mon_hour_start'] ?></span> : <span><?= $content['mon_min_start'] ?></span></div>
                      <div> - <span><?= $content['mon_hour_end'] ?></span> : <span><?= $content['mon_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div> 
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Úterý: </span>
                  <?php if($content['tue_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['tue_hour_start'] ?></span> : <span><?= $content['tue_min_start'] ?></span></div>
                      <div> - <span><?= $content['tue_hour_end'] ?></span> : <span><?= $content['tue_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div>
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Středa: </span>
                  <?php if($content['wen_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['wen_hour_start'] ?></span> : <span><?= $content['wen_min_start'] ?></span></div>
                      <div> - <span><?= $content['wen_hour_end'] ?></span> : <span><?= $content['wen_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div>     
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Čtvrtek: </span>
                  <?php if($content['thu_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['thu_hour_start'] ?></span> : <span><?= $content['thu_min_start'] ?></span></div>
                      <div> - <span><?= $content['thu_hour_end'] ?></span> : <span><?= $content['thu_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div>
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Pátek: </span>
                  <?php if($content['fri_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['fri_hour_start'] ?></span> : <span><?= $content['fri_min_start'] ?></span></div>
                      <div> - <span><?= $content['fri_hour_end'] ?></span> : <span><?= $content['fri_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div> 
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Sobota: </span>
                  <?php if($content['sat_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['sat_hour_start'] ?></span> : <span><?= $content['sat_min_start'] ?></span></div>
                      <div> - <span><?= $content['sat_hour_end'] ?></span> : <span><?= $content['sat_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div>                                                                     
              <div class="d-flex justify-content-between">
                  <span class="headline-color">Neděle: </span>
                  <?php if($content['sun_hour_start']) : ?>
                  <div class="d-flex gap-2">
                      <div><span><?= $content['sun_hour_start'] ?></span> : <span><?= $content['sun_min_start'] ?></span></div>
                      <div> - <span><?= $content['sun_hour_end'] ?></span> : <span><?= $content['sun_min_end'] ?></span></div>
                  </div>
                  <?php else : ?>
                    <div><span class="text-danger">Zavřeno</span></div>
                  <?php endif; ?>
              </div> 
            </div>
          </div>
            
            <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  </section>

  <!-- =================================== -->

  <div class="footer">
    <div class="container">
      <div class="row flex-column flex-md-row px-2 pt-3 justify-content-center">
        <div class="col-12 col-md-4">
          <ul class="d-flex list-unstyled p-0">
            <?php if(!empty($content['c_facebook'])) : ?>
              <li class="mx-2">
              <a href="<?=$content['c_facebook']?>">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_twitter'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_twitter'] ?>">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_instagram'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_instragram'] ?>" >
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_youtube'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_youtube'] ?>" >
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_discord'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_discord'] ?>" >
                <i class="fab fa-discord"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_linkedin'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_linkedin'] ?>" >
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_mastodon'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_mastodon'] ?>" >
                <i class="fab fa-mastodon"></i>
              </a>
            </li>
            <?php endif; ?>
          </ul>
          
        </div>
        <div class="col-md-8">
          <p class="block-41__copyrights">&copyCopyright 2022 - <?= date('Y')?>. Vytvořil s láskou <a href="https://www.stanislav-drako.cz">Stanislav Drako</a></p>
        </div>
        
      </div>
    </div>

  <!-- =================================== -->



  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.6.3.min.js"></script>

  <script src="assets/js/app.js"></script>


</body>

</html>
