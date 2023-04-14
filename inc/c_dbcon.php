<?php
    $hostname = "localhost";
    $dbuserid = "uauu";
    $dbpassword = "p72657265!";
    $dbname = "uauu";

    $mysqli = new mysqli($hostname, $dbuserid, $dbpassword, $dbname);
  
    if($mysqli -> connect_errno){
        die("connect error:".$mysqli->connect_error);
    }
?>