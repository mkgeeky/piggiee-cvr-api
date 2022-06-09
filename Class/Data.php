<?php
#############################
# This script is made by: mkgeeky
# Web: https://mkgeeky.xyz
# Git: https://github.com/mkgeeky/
# Mail: contact@mkgeeky.xyz
# Lines above MAY NOT BE removed!
#############################
class Data {
  public function __construct(\PDO $dbh) {
    $this->dbh = $dbh;
  }

  public function GetCVR()
  {
    $stmt = $this->dbh->prepare("SELECT CVRnummerREGnummer FROM mytable");
    $stmt->execute();
    return $stmt;
    $stmt = NULL;
  }

  public function Check($CVR)
  {
    $stmt = $this->dbh->prepare("SELECT ID FROM ActiveCVR WHERE CVR = :cvr");
    $stmt->bindParam(":cvr",$CVR);
    $stmt->execute();
    if ($stmt->rowCount()) {
      return true;
    } else {
      return false;
    }
    $stmt = NULL;
  }

  public function Add($CVR, $Street, $HouseNumber, $ZipCode, $Coordinates_X, $Coordinates_Y, $Branche, $Name, $Phone, $Email)
  {
    if (!$this->Check($CVR)) {
      $stmt = $this->dbh->prepare("INSERT INTO ActiveCVR (CVR, Street, HouseNumber, ZipCode, Coordinates_X, Coordinates_Y, Branche, Name, Phone, Email)
      VALUES (:cvr,:street,:house,:zip,:corX,:corY,:branche,:name,:phone,:email)");
      $stmt->bindParam(":cvr",$CVR);
      $stmt->bindParam(":street",$Street);
      $stmt->bindParam(":house",$HouseNumber);
      $stmt->bindParam(":zip",$ZipCode);
      $stmt->bindParam(":corX",$Coordinates_X);
      $stmt->bindParam(":corY",$Coordinates_Y);
      $stmt->bindParam(":branche",$Branche);
      $stmt->bindParam(":name",$Name);
      $stmt->bindParam(":phone",$Phone);
      $stmt->bindParam(":email",$Email);
      $stmt->execute();
      $stmt = NULL;
    }
  }
}
