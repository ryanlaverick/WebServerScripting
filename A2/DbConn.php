<?php

function OpenConn(){
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "u27a2";
    
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName) or die("Connection failed: $s\n". $conn -> error);
    
    return $conn;
}

function CloseConn($conn) {
    $conn -> close();
}

?>