<?php
header('Content-Type: text/html; charset=utf-8');
$url = $_POST['d_url'];
$contents = file_get_contents($url); 
$contents = utf8_encode($contents); 
$results = json_decode($contents); 


//echo $results->data->aqi;
$aqi_data = $results->data->aqi; $time_data = $results->data->time->s;

$json_data = array();
$json_data['aqi_data'] = $aqi_data; $json_data['time_data'] = $time_data;

echo json_encode($json_data);

?>