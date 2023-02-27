<?php 
    include "includes/header.php"; 
    $servicio = $bytal->gPosts("procedimientos", $_GET["id"]);
?>

<div class="topservice flex">
  <section class="content">
    <h1><?=$servicio->title->rendered?></h1>
    <div>
        <?=$servicio->content->rendered?>
        <a data-doctor='<?=json_encode($doctor)?>' data-id="<?=$servicio->id?>" data-title="<?=$servicio->title->rendered?>" data-img="<?=$servicio->acf->imagen_cuadrada_para_el_listado == "" ? "https://via.placeholder.com/400" : $servicio->acf->imagen_cuadrada_para_el_listado ?>" href="javascript:;" class="add-to-cart button invert"><?=$servicio->acf->textos_de_cta->cta_1?></a>
    </div>
  </section>
  <section class="thumbnail">
    <img src="<?=$servicio->acf->imagen_silueta_para_la_interna?>" />
  </section>
</div>
<section class="service-info bluebg">
  <div class="container flex">
    <article>
      <img src="img/beforeservice.svg" />
      <h1 class="bold">Antes del procedimiento debes saber...</h1>
      <p>
          <?=$servicio->acf->antes_del_procedimiento?>
      </p>
    </article>
    <article>
      <img src="img/afterservice.svg" />
      <h1 class="bold">Después del procedimiento debes saber...</h1>
      <p>
          <?=$servicio->acf->despues_del_procedimiento?>
      </p>
    </article>
    <article>
      <img src="img/warningservice.svg" />
      <h1 class="bold">Otras recomendaciones...</h1>
      <p>
          <?=$servicio->acf->lo_que_debes_saber?>
      </p>
    </article>
    <a data-doctor='<?=json_encode($doctor)?>' data-id="<?=$servicio->id?>" data-title="<?=$servicio->title->rendered?>" data-img="<?=$servicio->acf->imagen_cuadrada_para_el_listado == "" ? "https://via.placeholder.com/400" : $servicio->acf->imagen_cuadrada_para_el_listado ?>" href="javascript:;" class="add-to-cart button invert"><?=$servicio->acf->textos_de_cta->cta_2?></a>
  </div>
</section>
<?php 
   $doctor = $bytal->gPosts("doctores", $servicio->acf->doctor_relacionado[0]);
?>
<div class="doctorcontainer container">
  <h2 class="bold section-title1">
    Conoce al profesional a cargo de tu procedimiento Bytal
  </h2>
  <section class="doctor flex">
    <div class="photo">
      <img src="<?=$doctor->acf->foto?>" />
    </div>
    <div class="profile">
      <article class="outter">
        <h1><?=$doctor->title->rendered?></h1>
        <p><?=$doctor->acf->especialidad?></p>
        <p><?=$doctor->acf->universidad?></p>
        <?=$doctor->content->rendered?>
      </article>
      <a data-doctor='<?=json_encode($doctor)?>' data-id="<?=$servicio->id?>" data-title="<?=$servicio->title->rendered?>" data-img="<?=$servicio->acf->imagen_cuadrada_para_el_listado == "" ? "https://via.placeholder.com/400" : $servicio->acf->imagen_cuadrada_para_el_listado ?>" href="javascript:;" class="add-to-cart button"><?=$servicio->acf->textos_de_cta->cta_3?></a>
    </div>
  </section>
</div>
<section class="zigzag container flex">
  <div class="content">
    <h2 class="bold section-title1"><?=$servicio->acf->titulo_casos_de_exito?></h2>
    <p>
     <?=$servicio->acf->descripcion_casos_de_exito?>
    </p>
    <a data-doctor='<?=json_encode($doctor)?>' data-id="<?=$servicio->id?>" data-title="<?=$servicio->title->rendered?>" data-img="<?=$servicio->acf->imagen_cuadrada_para_el_listado == "" ? "https://via.placeholder.com/400" : $servicio->acf->imagen_cuadrada_para_el_listado ?>" href="javascript:;" class="add-to-cart button"><?=$servicio->acf->textos_de_cta->cta_4?></a>
  </div>
  <aside class="gallery">
    <div>
    <?php 
    for ($i = 0; $i < 5; $i++) { 
        $propertyName = "imagen_$i";
        if(isset($servicio->acf->imagenes_antesdespues->{$propertyName}) && 
        $servicio->acf->imagenes_antesdespues->{$propertyName} != "") {
    ?>
    <figure>
        <img src="<?= $servicio->acf->imagenes_antesdespues->{$propertyName} ?>" alt="<?= $servicio->acf->imagenes_antesdespues->{$propertyName} ?>" />
    </figure>
    <?php 
        }
    }
    ?>
    </div>
  </aside>
</section>
<div class="spacer"></div>
<?php $white = 1; $noDesc=1; include "includes/attrlist.php"; ?>
<?php include "includes/footer.php"; ?>
