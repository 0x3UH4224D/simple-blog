<?php
//
// read-post.php
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
$_SESSION['mode'] = 'read-post';

if (!isset($_GET['id']))
    header('Location: ./index.php');
$post_id = $_GET['id'];

$result = $mysqli->query('select max(id) as _max from posts');
$max_post_id = 0;
if ($result->num_rows == 0)
    header('Location: ./index.php');
else
    $max_post_id = $result->fetch_assoc()['_max'];

if ($post_id > $max_post_id)
    header('Location: ./index.php');
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

	// print post information
	$post_query = $mysqli->query("select * from posts where id = $post_id");
	$post_row = $post_query->fetch_assoc();

	// we need to get auther name first
	$auther_id = $post_row['auther'];
	$auther_query = $mysqli->query("select username from users where id = $auther_id");
	$auther_name = $auther_query->fetch_assoc()['username'];

	echo '<div class="box">';
	echo '<div class="auther">Auther ' . $auther_name . '</div>';
	echo '<h1 class="post-title">' . $post_row['title'] . '</h1>';
	echo '<p class="post-summary">';
	echo $post_row['content'];
	echo '</p>';
	echo '</div>';

	// print comments that belong to this post
	$comment_query = $mysqli->query("select * from comments where post_id = $post_id");
	if ($comment_query->num_rows > 0) {
	    for ($comment_index = 0; $comment_index <= $comment_query->num_rows - 1; $comment_index++) {
		$comment_query->data_seek($comment_index);
		$comment = $comment_query->fetch_assoc();
		echo '<div class="comment">';

		// get comment auther
		$comment_auther_query = $mysqli->query("select * from users where id = " . $comment['auther_id']);
		$comment_auther = $comment_auther_query->fetch_assoc()['username'];
		echo '<div class="auther"> Writer ' . $comment_auther . '<br>'
		   . 'Publish date: ' . $comment['date'] . '<br>'
		   . '</div>';

		echo '<p class="post-summary">';
		echo $comment['text'];
		echo '</p>';
		echo '</div>';
	    }
	}

	if (isset($_SESSION['logedin']) && $_SESSION['logedin']) {
	    echo '<div class="box" id="add-comment">';
	    echo '<form action="./add-new-comment.php" method="post">';
	    echo 'Comment: <textarea name="text"></textarea><br>';
	    echo '<input type="hidden" name="post_id" value="' . $post_id .'"?>';
	    echo '<input type="submit" value="Submit">';
	    echo '</form>';
	    echo '</div>';
	} else {
	    echo '<h5>Login to add comments, <a href="./login.php">go to Login page</a></h5>';
	}
	?>
    </body>
</html>
