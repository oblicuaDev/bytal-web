<?php include 'includes/config.php';  include "includes/header.php";?>
<div class="bannerSlider">
  <?php 
  $bannersHome = $bytal->gPosts("banners-home");
  for ($i=0; $i < count($bannersHome); $i++) { 
  ?>
  <section
    class="mainbanner outter"
    style="background-image: url(<?=$bannersHome[$i]->acf->imagen?>)"
  >
    <div class="container">
      <div>
        <h1 class="bold"><?=$bannersHome[$i]->title->rendered?></h1>
        <p><?=$bannersHome[$i]->content->rendered?></p>
        <a href="<?=$bannersHome[$i]->acf->link_boton?>" class="button"><?=$bannersHome[$i]->acf->texto_boton?></a>
      </div>
    </div>
  </section>
  <?php
  } 
  ?>

</div>
<section class="circle-list container">
  <h2 class="bold section-title1">Especialidades que encuentras en Bytal</h2>
  <div class="flex">
    <?php 
              for ($i=0; $i < count($especialidades); $i++) { 
                $especialidad = $especialidades[$i]
              ?>
                <article>
                  <a href="categories.php?espId=<?=$especialidad->id?>" class="wait">
                  <img
                    src="<?=$especialidad->acf->imagen_cuadrada?>"
                    alt="<?=$especialidad->title->rendered?>"
                  />
                  <h1 class="bold uppercase"><?=$especialidad->title->rendered?></h1>
                  <?=$especialidad->content->rendered?>
                </a>
                </article>
    <?php 
    }
    ?>
  </div>
  <a href="categories.php" class="button wait">Quiero conocer todos los servicios</a>
</section>
<?php include "includes/attrlist.php"; ?>
<section class="circle-list container" >
  <h2 class="bold section-title1">¿Qué cambio deseas en tí?</h2>
  <div class="flex">
    <?php 
    $resultados = $bytal->gPosts("resultados");
    for ($i=0; $i < count($resultados); $i++) { $resultado = $resultados[$i]; ?>
      <article>
        <a href="result.php?id=<?=$resultado->id?>" class="wait"
          ><img src="<?=$resultado->acf->foto_cuadrada_para_listado?>" alt="Nombre especialidad"
        /></a>
        <h1 class="bold uppercase"><?=$resultado->title->rendered?></h1>
        <p><?= $bytal->shortenText($resultado->content->rendered, 50);?></p>
      </article>
    <?php }?>
  </div>
  <!-- <a href="" class="button">Quiero conocer todos los servicios</a> -->
</section>

<section class="zigzag container flex" id="porque">
  <div class="content">
    <h2 class="bold section-title1">
      ¿Por qué hacerse un procedimiento médico en Bogotá?
    </h2>
    <p><?=$bytal->generalInfo->acf->por_que_en_bogota->descripcion?></p>
    <a href="" class="button">Ver más</a>
  </div>
  <aside class="gallery">
    <div>
    <?php 

  for ($i = 0; $i < 6; $i++) { 
    $propertyName = "imagen_$i";
    if(isset($bytal->generalInfo->acf->por_que_en_bogota->{$propertyName})
      && $bytal->generalInfo->acf->por_que_en_bogota->{$propertyName} != "") {
      
      $url = $bytal->generalInfo->acf->por_que_en_bogota->{$propertyName};
      $headers = get_headers($url);
      $content_type = null;
      
      foreach($headers as $header) {
        if (strpos($header, 'Content-Type:') === 0) {
          $content_type = trim(substr($header, strlen('Content-Type:')));
          break;
        }
      }
      if ($content_type === 'image/jpeg' || $content_type === 'image/png' || $content_type === 'image/gif') {
        echo '<figure>';
        echo '<img src="' . $url . '" alt="Colpatria">';
        echo '</figure>';
      } else if ($content_type === 'video/mp4' || $content_type === 'video/webm' || $content_type === 'video/ogg') {
        echo '<video controls>';
        echo '<source src="' . $url . '">';
        echo '</video>';
      }
    }
  }
?>

    </div>
  </aside>
</section>
<section class="testimonials container">
  <h2 class="bold section-title1">Testimonios de pacientes Bytal</h2>
  <div class="t-slider outter">
    <section class="flex outter">
      <?php 
      $testimonios = $bytal->gPosts("testimonios");
      for ($i=0; $i < count($testimonios); $i++) { 
        $testimonio = $testimonios[$i];
      ?>
      <article class="flex">
        <!-- HTML5 video custom dimensions -->
        <?php if(isset($testimonio->acf->video) && $testimonio->acf->video != ""){ ?>
          <a href="<?=$testimonio->acf->video?>" data-fancybox="video-gallery" data-width="640" data-height="360">
          <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="0.5" y="0.5" width="34" height="34" rx="17" stroke="white"/>
          <g filter="url(#filter0_d_183_761)">
          <path d="M23.8703 17.3519L14.2452 11.5249C13.5787 11.1214 12.7273 11.6013 12.7273 12.3803V22.8075C12.7273 23.5432 13.4948 24.027 14.1585 23.7098L23.7836 19.1095C24.5012 18.7666 24.5507 17.7637 23.8703 17.3519Z" fill="white"/>
          </g>
          <defs>
          <filter id="filter0_d_183_761" x="10.7273" y="9.37866" width="19.6252" height="20.4302" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
          <feFlood flood-opacity="0" result="BackgroundImageFix"/>
          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
          <feOffset dx="2" dy="2"/>
          <feGaussianBlur stdDeviation="2"/>
          <feComposite in2="hardAlpha" operator="out"/>
          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_183_761"/>
          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_183_761" result="shape"/>
          </filter>
          </defs>
          </svg>
            <figure>
              <img src="<?=$testimonio->acf->foto?>" alt="sadfasdf" />
            </figure>
          </a>
        <?php }else{ ?>
          <a href="javascript:;">
            <figure>
              <img src="<?=$testimonio->acf->foto?>" alt="sadfasdf" />
            </figure>
          </a>
        <?php } ?>
        <div class="description">
          <h1><?=$testimonio->title->rendered?></h1>
          <h4><?=$testimonio->acf->fecha?></h4>
          <p>
          <?=$testimonio->content->rendered?>
          </p>
        </div>
      </article>
      <?php } ?>
    </section>
  </div>
</section>
<?php include "includes/footer.php"; ?>
