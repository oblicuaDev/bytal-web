<div class="outter <?php echo isset($white) ? "" : "bluebg" ?>" >
         <section class="attr-list container <?php echo isset($white) ? "" : "bluebg" ?>" >
            <h2 class="bold section-title2"><?= !isset($aboutTitle) ? "Además de tu procedimiento, la experiencia Bytal incluye los siguientes servicios": "Todos los procedimientos que te realizas con Bytal incluyen"?></h2>
            <div class="flex">
              <?php 
              for ($i=1; $i < 7; $i++) { 
                $property = "servicio_" . $i;
                $item = $bytal->generalInfo->acf->experiencia_bytal->$property;
              ?>
              <article>
                <figure>
                  <img src="<?=$item->icono?>" alt="Titulo atributo" />
                </figure>
                <h1 class="bold"><?=$item->nombre?></h1>
                <?php if(!isset($noDesc)){ ?>
                  <p><?=$item->descripcion?></p>
                  <?php } ?>
              </article>
              <?php 
              }
              ?>
            </div>
         </section></div>