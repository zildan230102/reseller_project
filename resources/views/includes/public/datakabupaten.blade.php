<?php

$id_provinsi_terpilih = "";
if (isset($_POST["id_provinsi"])) {
  $id_provinsi_terpilih = $_POST["id_provinsi"];
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 8ce20510281a61e87303aed434ce6be1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $array_response = json_decode($response,TRUE);
    $datakabupaten = $array_response["rajaongkir"]["results"];

    // echo "<pre>";
    // print_r($data_kabupaten);
    // echo "</pre>";

    echo "<option value=''disabled selected>Pilih Kabupaten</option>";

  foreach ($datakabupaten as $key => $tiap_kabupaten)
  {
    echo "<option value=''
    id_kabupaten='".$tiap_kabupaten["city_id"]."' 
    provinsi='".$tiap_kabupaten["province"]."' 
    nama_kabupaten='".$tiap_kabupaten["city_name"]."' 
    tipe_kabupaten='".$tiap_kabupaten["type"]."' 
    kodepos='".$tiap_kabupaten["postal_code"]."' >";
    echo $tiap_kabupaten["city_name"];
    echo "</option>";
  }
}