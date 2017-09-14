<?php
$script = $_SERVER['PHP_SELF'];
print<<<HEADER
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
	<!-- Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Slick Carousel -->
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
	<!-- Custom -->
	<script type="text/javascript" src="Search.js"></script>
	<link rel="stylesheet" type="text/css" href="Homepage.css">
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
HEADER;

if (!isset($_POST['search1'])) {
print<<<MAIN
<body>
	<!-- Consistent Nav Dropdown -->
	<div class="dropdown" style="position: absolute; top: 30%;">
		<button id="side_nav" class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-right"></span></button>
		<ul id="slide_nav_sub" class="dropdown-menu" role="menu">
			<li role="presentation"><a href="./Homepage.php"><button class="btn btn-block">Home</button></a></li>
			<li role="presentation"><a href="./Help.html"><button class="btn btn-block">Help</button></a></li>
			<li role="presentation"><a href="./AdvancedSearch.php"><button class="btn btn-block">Search</button></a></li> 
		</ul>
	</div>
	<div class="container">
		<div class="form-group col-xs-10">
		<form id="titlesearch" name="titlesearch" action="$script" method="post">
			<label>Title Search :</label>
			<input class="form-control input-lg" type="text" name="search_title" id="search_title" placeholder="Enter Title of Movie/TV Show">
			<br>
			<input class="btn btn-default" type="submit" name="search1" value="Search Title">
		</form>
		</div>
		<br>
		<!--
		<div class="form-group col-xs-10">
		<form id="tagsearch" name="tagsearch">
			<label class="control-label">Tag Search :</label>
			<input class="form-control input-lg" type="text" name="search_tag" placeholder="Enter Tag">
			<br>
			<input class="btn btn-default" type="submit" name="search2" value="Search Tag">
		</form>
		</div>
		-->
	</div>
</body>
</html>
MAIN;
}

// Process Title Search
if (isset($_POST['search1'])) {
	$str = $_POST['search_title'];
	print<<<RESULTS
	<body onload="return title_search('$str');">
	<!-- Consistent Nav Dropdown -->
	<div class="dropdown" style="position: absolute; top: 30%;">
		<button id="side_nav" class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-right"></span></button>
		<ul id="slide_nav_sub" class="dropdown-menu" role="menu">
			<li role="presentation"><a href="./Homepage.php"><button class="btn btn-block">Home</button></a></li>
			<li role="presentation"><a href="./Help.html"><button class="btn btn-block">Help</button></a></li>
			<li role="presentation"><a href="./AdvancedSearch.php"><button class="btn btn-block">Search</button></a></li> 
		</ul>
	</div>
	<!-- Content Divs -->
	<input type="hidden" value="" id="imdbid">
	<div class="container">
		<div class="col-xs-6" style="left: 50px;top:50px;">
			<img id="image_side" src="" style="width:300px;height:500px;">
		</div>
		<div class="col-xs-6" id="info_side">
		<h5 id="title_content" style="font-size:300%;"></h5>
			<label>Rated: </label>
			<p id="rating"></p>
			<label>Release Date: </label>
			<p id="release"></p>
			<label>Runtime: </label>
			<p id="runtime"></p>
			<label>Director: </label>
			<p id="director"></p>
			<label>Actors: </label>
			<p id="actors"></p>
			<label>Plot Summary: </label>
			<p id="plot"></p>
			<label>Metascore: </label>
			<p id="metascore"></p>
			<label>IMDB Score: </label>
			<p id="imdb"></p>
			<label>Rotten Tomatoes Score: </label>
			<p id="rotten"></p>
			<label>Related Tags: </label>
			<p id="tags_list"></p>
	</body>
	</html>
RESULTS;
	if (isset($_COOKIE['logged_in'])) {
		print<<<ADDTAG
			</div>
			<div class="container" id="input_side">
				<form action="$script" method="post">
					<label>Add Tag: </label>
					<input type="text" id="tag_input" name="tag_input" value="">
					<input type="submit" name="addtag" id="addtag">
				</form>
			</div>
ADDTAG;
		}
}
if (isset($_POST['addtag'])) {
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
	$get_tags = "select tag from tags where id='$str'";
	$result = $conn->query($get_tags);
	$tags = $result->fetch_assoc();
	$tag = $_POST['tag_input'];
	$c_id = $_COOKIE['c_id'];
		if (!in_array($tag, $tags)) {
			$tag_san = preg_replace('/\s+/', '', $tag);
			$sql = "insert into tags (id, tag) values ('$c_id', '$tag_san')";
			$conn->query($sql);
			print("Tag Added");
		}
}
?>