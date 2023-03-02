<?php
include 'includes/config.php'; 
  $about = $bytal->gAbout(); 
  $aboutTitle = 1;
  $seoVariable = $about;
  include "includes/header.php"; 
?>
<div class="bannerSlider">

  <?php 
  $bannersHome = $bytal->gPosts("banners-acerca");
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
<section class="video container">
  <video class="outter" id="videoplayer">
    <source src="<?=$about->acf->video?>" type="video/mp4">
  </video>

  <span class="play-btn" id="playvideo"></span>
  <div id="overlay"></div>
</section>
<section class="zigzag container flex">
  <div class="content">
    <h2 class="bold section-title1"><?=$about->acf->seccion_1->titulo?></h2>
    <p><?=$about->acf->seccion_1->descripcion?></p>
    <a href="" class="button">Ver más</a>
  </div>
  <aside class="gallery">
    <div>
    <?php 
      for ($i = 0; $i < 6; $i++) { 
        $propertyName = "imagen_$i";
        if(isset($about->acf->seccion_1->imagenes->{$propertyName})
          && $about->acf->seccion_1->imagenes->{$propertyName} != "") {
          
          $url = $about->acf->seccion_1->imagenes->{$propertyName};
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
<section class="zigzag container flex">
  <aside class="gallery">
    <div>
    <?php 
      for ($i = 0; $i < 6; $i++) { 
        $propertyName = "imagen_$i";
        if(isset($about->acf->seccion_2->imagenes->{$propertyName})
          && $about->acf->seccion_2->imagenes->{$propertyName} != "") {
          
          $url = $about->acf->seccion_2->imagenes->{$propertyName};
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
  <div class="content">
    <h2 class="bold section-title1"><?=$about->acf->seccion_2->titulo?></h2>
    <p><?=$about->acf->seccion_2->descripcion?></p>
    <a href="" class="button">Ver más</a>
  </div>

</section>
<?php include "includes/attrlist.php"; ?>
<section class="action container">
  <blockquote class="bold italic">
    <?= $about->acf->copy_final?>
  </blockquote>
  <a href="" class="button">Quiero que empiece mi experiencia Bytal</a>
</section>


</div>
</section>
<?php include "includes/footer.php"; ?>