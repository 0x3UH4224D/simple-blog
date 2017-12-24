<?php
//
// new-post.php
// This file is part of simple-blog
//
// Copyright (C) 2017 Muhannad Alrusayni 0x3UH4224D@gmail.com
//
// simple-blog is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// simple-blog is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with simple-blog. If not, see <http://www.gnu.org/licenses/>.


include('config.php');
session_start();
$_SESSION['mode'] = 'new-post';

$auther = $_SESSION['user_id'];
if (!isset($auther))
    header('Location: ./login.php');
?>

<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" contenet="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/default.css">
    </head>
    <body>
	<?php
	include('navigation-bar.php');
	$error_message = $_SESSION['new-post-error'];
	if (!empty($error_message))
	    echo $error_message;
	?>
	<br>
	<form action="./add-new-post.php" method="post">
	    Title: <input type="text" name="title"><br>
	    Summary: <input type="text" name="summary"><br>
	    Contenet: <textarea name="contenet"></textarea><br>
	    <br>
	    <input type="submit" value="Submit">
	</form>

    </body>
</html>
