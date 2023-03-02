<div class="outter bluebg">
          <footer class=" container flex">
              <section class="column1 flex">
                  <div>
                  <ul>
                      <li><a href="/" class="wait">Inicio</a></li>
                      <li><a href="about.php" class="wait">Nosotros</a></li>
                      <li><a href="" class="wait">Procedimientos</a></li>
                      <li><a href="" class="wait">¿Qué cambio quieres en tí?</a></li>
                </ul>  
                </div>  
                <div class="address">
                  <ul>
                        <li><img src="img/logo.svg" alt="Bytal, turismo médico en bogotá"/></li>
                      <li><?=$bytal->generalInfo->acf->contacto->direccion?></li>
                      <li><?=$bytal->generalInfo->acf->contacto->telefono?> </li>
                      <li><?=$bytal->generalInfo->acf->contacto->correo?> </li>
                      <li><?=$bytal->generalInfo->acf->contacto->ciudad_pais?></li>
                     
                </ul>  
                </div>  
              </section>
              <section class="column2 flex">
              <div>
              <h3>Síguenos en redes sociales</h3>
              <ul class="social">
                <?php if($bytal->generalInfo->acf->contacto->redes_sociales->facebook != ""){ ?>
                  <li><a target="_blank" href="<?=$bytal->generalInfo->acf->contacto->redes_sociales->facebook?>"><img src="img/facebook.svg" alt="Bytal en Facebook"/></a></li>
                <?php } ?>
                <?php if($bytal->generalInfo->acf->contacto->redes_sociales->twitter != ""){ ?>
                  <li><a target="_blank" href="<?=$bytal->generalInfo->acf->contacto->redes_sociales->twitter?>"><img src="img/twitter.svg" alt="Bytal en twitter"/></a></li>
                <?php } ?>
                <?php if($bytal->generalInfo->acf->contacto->redes_sociales->youtube != ""){ ?>
                  <li><a target="_blank" href="<?=$bytal->generalInfo->acf->contacto->redes_sociales->youtube?>"><img src="img/youtube.svg" alt="Bytal en youtube"/></a></li>
                <?php } ?>
                <?php if($bytal->generalInfo->acf->contacto->redes_sociales->instagram != ""){ ?>
                  <li><a target="_blank" href="<?=$bytal->generalInfo->acf->contacto->redes_sociales->instagram?>"><img src="img/instagram.svg" alt="Bytal en youtube"/></a></li>
                <?php } ?>
              </ul>
            </diV>
              </section>
          </footer>
        </div>
        <div class="copyright container flex">
          <a href="<?=$bytal->generalInfo->acf->estados_financieros?>" target="_blank" class="bold">Estados financieros</a>
          <a href="politics.php" class="bold">Políticas de privacidad</a>
        </div>
      
  </body>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/additional-methods.min.js"></script>
  <script src="js/jquery.bxslider.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="js/main.js?v=<?=time()?>"></script>
</html>
