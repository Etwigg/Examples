<?php
	$c_id = $_REQUEST["c_id"];
	setcookie('c_id', $c_id, time() + 86400);
	$servername = 'fall-2016.cs.utexas.edu';
	$username = 'etwigg';
	$p = '2+BRPMegFkB0tph2u9XdnA==';
	$dbname = "cs329e_etwigg";
	$key = 'CS329';
	$method = 'aes-128-cbc';
	$password = openssl_decrypt ($p, $method, $key);
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$get_tags = "select tag from tags where id='$c_id'";
	$result = $conn->query($get_tags);
	$tag_list = "";
	while ($tags = $result->fetch_assoc()) {
		$tag_list .= $tags[tag] . ", ";
	}
	echo($tag_list);
?>