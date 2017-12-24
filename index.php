<?php
//
// index.php
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
$_SESSION['mode'] = 'view-posts';
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

	$result = $mysqli->query("SELECT * FROM posts");

	if ($result->num_rows > 0) {
	    for ($row_no = 0; $row_no <= $result->num_rows - 1; $row_no++) {
		$result->data_seek($row_no);
		$row = $result->fetch_assoc();
		echo '<div class="box">';
		echo '<h1 class="post-title">' . $row['title'] . '</h1>';
		echo '<p class="post-summary">';
		echo $row['summary'];
		echo '</p>';
		echo '<a class="read-more" href="./read-post.php?id=' . $row['id'] . '">read more</a>';
		if (isset($_SESSION['logedin']) && $_SESSION['logedin'] && $_SESSION['user_permission_lvl'] == 0) {
		    echo ' <a class="read-more" href="./delete-post.php?id=' . $row['id'] . '">delete</a>';
		}
		echo '</div>';
	    }
	} else {
	    echo '<h2>No post have been published yet!</h2>';
	}
	?>
    </body>
</html>
