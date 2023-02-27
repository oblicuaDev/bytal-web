<?php
extract($_POST);
$curl = curl_init();


$data = array(
    'title' => $name,
    'content' => "",
    'status' => 'publish'
);

$data = json_encode($data);

$ch = curl_init('https://webadminbytal.bhrmarketing.com.co/wp-json/wp/v2/leads');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ZGV2ZWxvcGVyOjVIWnQgR2twaSBGZE1FIFdCTGggUXpPRSBuZGlP',
'Content-Type: application/json'));

$response = curl_exec($ch);
curl_close($ch);

$var = json_decode($response);
$data = array(
    'fields' => array(
        "telefono"=>$phone,
        "correo"=>$email,
        "pais"=>$country,
        "fecha"=>$date,
        "procedimientos"=> array($procedimientos)
    )
);

$data = json_encode($data);

$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => 'https://webadminbytal.bhrmarketing.com.co/wp-json/wp/v2/leads/'.$var->id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ZGV2ZWxvcGVyOjVIWnQgR2twaSBGZE1FIFdCTGggUXpPRSBuZGlP',
    'Content-Type: application/json'
  ),
));

$lead = curl_exec($curl2);
curl_close($curl2);

echo $lead;