<?php
#############################
# This script is made by: mkgeeky
# Web: https://mkgeeky.xyz
# Git: https://github.com/mkgeeky/
# Mail: contact@mkgeeky.xyz
# Lines above MAY NOT BE removed!
#############################
require "Class/CvrAPI.php";
require "Class/Data.php";
require "Class/ConnectDB.php";

$CVR = new CvrAPI();
$Data = new Data($DB);
foreach ($Data->GetCVR() AS $OriCvr) {
  //Er det allerede kørt?
  if (!$Data->Check($CVR->api($OriCvr["CVRnummerREGnummer"]))) {
    $Find = $CVR->api($OriCvr["CVRnummerREGnummer"]);
    $Street = $Find[0]["virksomhedMetadata"]["nyesteBeliggenhedsadresse"]["vejnavn"];
    $Number = $Find[0]["virksomhedMetadata"]["nyesteBeliggenhedsadresse"]["husnummerFra"];
    $ZipCode = $Find[0]["virksomhedMetadata"]["nyesteBeliggenhedsadresse"]["postnummer"];
    $CVRNumber = $Find[0]["cvrNummer"];
    $Name = $Find[0]["virksomhedMetadata"]["nyesteNavn"]["navn"];
    $Email = $Find[0]["elektroniskPost"][0]["kontaktoplysning"];
    $Phone = $Find[0]["telefonNummer"][0]["kontaktoplysning"];
    $Branche = $Find[0]["virksomhedMetadata"]["nyesteHovedbranche"]["branchetekst"];
    $Corrdinats = $CVR->Location("{$Street}",$Number,$ZipCode);
    $Data->Add($CVRNumber,$Street,$Number,$ZipCode,$Corrdinats["Lat"],$Corrdinats["Long"],$Branche,$Name,$Phone,$Email);
  }
}
