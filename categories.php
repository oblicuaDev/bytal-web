<?php include 'includes/config.php';  include "includes/header.php";

$categorias = $bytal->categories;

$relacion = [];
foreach ($categorias as $categoria) {
    $idEspecialidad = $categoria->acf->relacion_a_especialidad[0];
    $nombreEspecialidad = null;
    $idEsp = null;
    foreach ($especialidades as $especialidad) {
        if ($especialidad->id == $idEspecialidad) {
            $idEsp = $especialidad->id;
            $nombreEspecialidad = $especialidad->title->rendered;
            break;
        }
    }
    if (!isset($relacion[$nombreEspecialidad])) {
        $relacion[$nombreEspecialidad] = [
            'id' => $idEsp ,
            'title' => $nombreEspecialidad,
            'categorias' => []
        ];
    }
    $relacion[$nombreEspecialidad]['categorias'][] = [
        'title' => $categoria->title->rendered,
        'procedimientos' => $categoria->acf->procedimientos_rel
    ];
}
$relacion = array_values($relacion);
?>
<div class="spacer"></div>
<section class="container categories">
  <div class="tabs">
    <div class="tab-list">
        <?php 
        $i = 1;
        foreach ($relacion as $especialidad) { ?>
        <div class="tab-item <?php echo (isset($_GET["espId"]) && $_GET["espId"] == $especialidad["id"]) || (!isset($_GET["espId"]) && $i == 1) ? 'active' : ''; ?>" data-tab="tab-<?php echo $i; ?>">
            <?php echo $especialidad["title"] ?>
        </div>
        <?php $i++; } ?>
    </div>
    <div class="tab-content">
        <?php 
        $open = 0;
        $j = 1;
        foreach ($relacion as $especialidad) { ?>
        <div class="tab-pane <?php echo (isset($_GET["espId"]) && $_GET["espId"] == $especialidad["id"]) || (!isset($_GET["espId"]) && $j == 1) ? 'active' : ''; ?>" id="tab-<?php echo $j; ?>">
          <?php foreach ($especialidad['categorias'] as $categoria) { ?>
              <details <?php echo ($open == 0) ? 'open' : ''; ?>  data-services="<?=json_encode($categoria['procedimientos'])?>" >
                  <summary><svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.7" d="M1 1L5 5L9 1" stroke="#484848" stroke-width="2" stroke-linecap="round"/></svg><?php echo $categoria['title']; ?></summary>
                  <div class="grid"></div>
              </details>
              <?php $open++; } 
            $open = 0;
            ?>
        </div>
        <?php $j++; } ?>
    </div>
  </div>
</section>
<?php include "includes/footer.php"; ?>
