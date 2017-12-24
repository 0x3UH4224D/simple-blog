<?php
//
// add-new-comment.php
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

if (!isset($_POST['post_id']))
    header('Location: ./index.php');
$post_id = $_POST['post_id'];

if (!isset($_POST['text']))
    header('Location: ./index.php');
$text = $_POST['text'];

if (!$_SESSION['logedin'])
    header('Location: ./login.php');
$user_id = $_SESSION['user_id'];

$id_query = $mysqli->query('select max(id) as _max from comments');
$comment_id = 0;
if ($id_query->num_rows > 0)
    $comment_id = $id_query->fetch_assoc()['_max'] + 1;

$sql_stmt = "insert into comments values($post_id, $comment_id, '$text', $user_id, current_timestamp())";
if (!$mysqli->query($sql_stmt)) {
    echo $sql_stmt . '<br>';
    echo $mysqli->errno . ' -> ' . $mysqli->error;
}
else
    header('Location: ./read-post.php?id='. $post_id);
?>
