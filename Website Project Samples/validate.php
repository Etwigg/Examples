<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Login to DB
$servername = 'fall-2016.cs.utexas.edu';
$username = 'etwigg';
$p = '2+BRPMegFkB0tph2u9XdnA==
';
$dbname = "cs329e_etwigg";
$key = 'CS329';
$method = 'aes-128-cbc';
$password = openssl_decrypt ($p, $method, $key);
$conn = new mysqli($servername, $username, $password, $dbname);
// Send Request to DB
$sql = "select username from users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$u = $_REQUEST["u"];
$usr_i = array_search($u, $row);
if ($usr_i != FALSE){
	echo (" Username Taken");
} 
$conn->close();
?>