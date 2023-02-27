<?php include "includes/header.php"; $resultado = $bytal->gPosts("resultados", $_GET['id']);
?>
<div class="spacer"></div>


  <section class="zigzag container flex">
    <aside class="gallery">
      <div>
        <figure>
          <img src="<?=$resultado->acf->foto_para_pagina_interna?>" alt="<?=$resultado->title->rendered?>" />
        </figure>
      </div>
    </aside>
    <div class="content">
      <h2 class="bold section-title1 bluetitle"><?=$resultado->title->rendered?></h2>
      <p>
      <?=$resultado->content->rendered?>
      </p>
      <a href="" class="button">Ver más</a>
    </div>
  </section>
    <?php 
      $procedimientos = $resultado->acf->procedimientos_relacionados;
      if(is_array($procedimientos)){
    ?>
  <section class="circle-list container" >
    <div class="flex">
      <?php for ($a=0; $a < count($procedimientos); $a++) { $procedimiento= $bytal->gPosts("procedimientos", $procedimientos[$a]); ?>
        <article>
          <img src="<?=$procedimiento->acf->imagen_cuadrada_para_el_listado == "" ? "https://via.placeholder.com/400" : $procedimiento->acf->imagen_cuadrada_para_el_listado ?>" alt="Nombre especialidad" />
          <a class="button bold uppercase" href="service.php?id=<?=$procedimiento->id?>"><?=$procedimiento->title->rendered?></a>
        </article>
      <?php } ?>
    </div>
  </section>
<?php 
  }
?> 

<?php include "includes/footer.php"; ?>
