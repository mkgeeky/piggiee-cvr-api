<?php
#############################
# This script is made by: mkgeeky
# Web: https://mkgeeky.xyz
# Git: https://github.com/mkgeeky/
# Mail: contact@mkgeeky.xyz
# Lines above MAY NOT BE removed!
#############################
require 'Config.php';

try {
$db_options = array(
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
$DB = new PDO("mysql:host={$DATABASE["HOST"]};port={$DATABASE["PORT"]};dbname={$DATABASE["BASE"]};charset=UTF8;",
    $DATABASE["USER"], $DATABASE["PASS"], $db_options);
}
catch(Exception $e) {
    echo $e->getMessage();
}
$DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
