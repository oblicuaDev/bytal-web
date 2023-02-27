<?php
include '../includes/config.php';

$service = $bytal->gPosts("procedimientos", $_GET["id"]);

echo json_encode($service);


