<?php
//
// add-new-post.php
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

$title = $_POST['title'];
$content = $_POST['contenet'];
$summary = $_POST['summary'];
$auther = $_SESSION['user_id'];

if (empty($title) || empty($content) || empty($summary)) {
    $_SESSION['new-post-error'] = 'You have to fill all the filed to submit the post, please make sure you do so before submiting';
    header('Location: ./new-post.php');
}
$_SESSION['new-post-error'] = null;

$result = $mysqli->query('select max(id) as _max from posts');
$post_id = 0;
if ($result->num_rows > 0)
    $post_id = $result->fetch_assoc()['_max'] + 1;

$sql_stmt = "insert into posts values($post_id, '$title', '$content', $auther, current_timestamp(), '$summary')";
if(!$mysqli->query($sql_stmt)) {
    echo $sql_stmt . '<br>';
    echo $mysqli->errno . ' -> ' . $mysqli->error;
}
else
    header('Location: ./index.php');
?>
