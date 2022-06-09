<?php
#############################
# This script is made by: mkgeeky
# Web: https://mkgeeky.xyz
# Git: https://github.com/mkgeeky/
# Mail: contact@mkgeeky.xyz
# Lines above MAY NOT BE removed!
#############################
class CvrAPI
{
  #public function __construct(\PDO $dbh)
  public function __construct()
  {
    #$this->dbh = $dbh;
    $this->country = 'dk';
    $this->agent = 'Piggiee ApS -> 41868724';

    #$this->locate_api = '414416d3eec760fb0ab3728725ef8c72';
    //$this->locate_url = '';
  }

  private function Strip($vat)
  {
    return preg_replace('/[^0-9]/', '', $vat);
  }

  public function Location($Street, $Number, $ZipCode)
  {
    global $API;
    $U = "{$Street} {$Number} {$ZipCode}";
    $URL = "https://api.mapbox.com/geocoding/v5/mapbox.places/{$U}.json?country=dk&limit=1&proximity=ip&types=place%2Cpostcode%2Caddress&access_token={$API["MAP_KEY"]}";
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $URL);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_USERAGENT, $this->agent);
    $res = curl_exec($ch2);
    curl_close($ch2);
    $res = json_decode($res,1);
    $Latitudine = $res["features"][0]["geometry"]["coordinates"][1];
    $Longitudine = $res["features"][0]["geometry"]["coordinates"][0];

    return array("Lat" => $Latitudine, "Long" => $Longitudine);
  }

  public function api($vat)
  {
    global $API;
    $ch = curl_init();
    curl_setopt_array($ch, array(
      CURLOPT_URL => "https://api.cvr.dev/api/cvr/virksomhed?cvr_nummer={$vat}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "Authorization: {$API["CVR_KEY"]}"
      ),
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    #var_dump($response);
    return json_decode($response,1);
  }
}
