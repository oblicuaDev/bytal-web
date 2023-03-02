<?php 

$especialidades = $bytal->gPosts("especialidades"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <base href="/web/" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php  echo $bytal->create_metas($seoVariable)?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
  <link rel="stylesheet" href="css/styles.css?v=<?=time()?>" />
  <script src="https://www.bhrmarketing.com.co/credits/credits.js"></script>
</head>

<body>
  <div id="preloader"></div>
  <header class="outter desktop">

    <nav class="container flex">
      <ul class="first-level flex">
        <li class="submenu bold wait"><a href="/">Inicio</a></li>
        <li class="submenu bold wait"><a href="about.php">Acerca de Bytal</a></li>
        <li class="submenu bold parent">
          <a href="">Procedimientos</a>
          <ul>
            <?php 
                for ($i=0; $i < count($especialidades); $i++) { 
                $especialidad = $especialidades[$i]
              ?>
            <li>
              <a class="submenu bold wait" href="categories.php?espId=<?=$especialidad->id?>"><?=$especialidad->title->rendered?></a>
            </li>
            <?php 
                }
              ?>
          </ul>
        </li>
      </ul>
      <h1>
        <a href="/" class="wait"><img src="img/logo.svg" alt="Bytal, Cirugía Plástica, Oftalmología y odontología en Bogotá" /></a>
      </h1>
      <ul class="right-menu first-level flex">
        <li class="submenu bold">
          <a href="#porque">¿Qué cambio quieres en tí?</a>
        </li>
        <li class="pres submenu">
          <a href="javascript:openCart();"><img src="img/quote.svg" alt="Tu presupuesto" /><span>4</span></a>
        </li>
        <!-- <li class="language submenu">
          <a href=""><span class="current">ES <img src="img/es-flag.svg" /></span></a>
          <ul>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
          </ul>
        </li> -->
      </ul>
    </nav>
  </header>
  <header class="outter mobile">
    <nav>
      <a href="/" class="wait">Inicio</a>
      <a href="about.php" class="wait">Acerca de Bytal</a>
      <details>
        <summary>
          Procedimientos
        </summary>
        <?php 
              for ($i=0; $i < count($especialidades); $i++) { 
              $especialidad = $especialidades[$i]
            ?>
        <a href="categories.php?espId=<?=$especialidad->id?>" class="wait"><?=$especialidad->title->rendered?></a>
        <?php 
            }
        ?>
      </details>
      <a href="">¿Qué cambio quieres en tí?</a>
    </nav>
    <div id="menu-toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <h1>
      <a href="/"><img src="img/logo.svg" alt="Bytal, Cirugía Plástica, Oftalmología y odontología en Bogotá" /></a>
    </h1>
    <div class="right">
      <a href="javascript:openCart();" class="presupuesto"><img src="img/quote.svg"
          alt="Tu presupuesto" /><span>4</span></a>
      <!-- <ul>
        <li class="language submenu">
          <a href=""><span class="current">ES <img src="img/es-flag.svg" /></span></a>
          <ul>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
            <li>
              <span>ES <img src="img/es-flag.svg" /></span>
            </li>
          </ul>
        </li>
      </ul> -->
    </div>
  </header>
  <div id="cart">
    <div class="cart-header">
      <h2>Procedimientos en tu valoración</h2>
      <button type="button" id="closeCart" onclick="openCart()">
        <svg id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.44 15.44">
          <path fill="currentColor" class="cls-1"
            d="m14.73,14.94s-.09,0-.15-.06l-6.87-6.87L.85,14.88c-.05.05-.11.06-.15.06s-.09,0-.15-.06c-.08-.08-.08-.21,0-.29l6.87-6.87L.56.85c-.08-.08-.08-.21,0-.29.05-.05.11-.06.15-.06s.09,0,.15.06l6.87,6.87L14.59.56c.05-.05.11-.06.15-.06s.09,0,.15.06c.08.08.08.21,0,.29l-6.87,6.87,6.87,6.87c.08.08.08.21,0,.29-.05.05-.11.06-.15.06Z" />
          <path fill="currentColor" class="cls-2"
            d="m14.73,0c-.18,0-.36.07-.5.21l-6.51,6.51L1.21.21c-.14-.14-.32-.21-.5-.21S.34.07.21.21C-.07.48-.07.93.21,1.21l6.51,6.51L.21,14.23c-.28.28-.28.72,0,1,.14.14.32.21.5.21s.36-.07.5-.21l6.51-6.51,6.51,6.51c.14.14.32.21.5.21s.36-.07.5-.21c.28-.28.28-.72,0-1l-6.51-6.51L15.23,1.21c.28-.28.28-.72,0-1-.14-.14-.32-.21-.5-.21h0Z" />
        </svg>
      </button>

    </div>
    <ul id="cart-items"></ul>
    <a href="checkout.php" class="button wait">Agendar mi valoración</a>
  </div>
