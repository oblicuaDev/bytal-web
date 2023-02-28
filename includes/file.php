<?php
if (!file_exists('cache')) {
    mkdir('cache', 0777, true);
}
    $path = "cache/test.json";
    $jsonString ='{"message":1}';
    //$fp = fopen($path, 'w');
    //fwrite($fp, $jsonString);
    //fclose($fp);
    $bwriting = file_put_contents($path, $jsonString); 
    if(file_exists($path))
    {
        $data = file_get_contents($path);
        echo $data;
    }
?>