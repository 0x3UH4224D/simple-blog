<?php
//
// delete-post.php
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

if (!isset($_GET['id']))
    header('Location: ./index.php');
$post_id = $_GET['id'];

if (!isset($_SESSION['logedin']) || !$_SESSION['logedin'] || $_SESSION['permission_lvl'] != 0)
    header('Location: ./logedin.php');

$sql_stmt = "delete from comments where post_id = $post_id";
if(!$mysqli->query($sql_stmt)) {
    echo $sql_stmt . '<br>';
    echo $mysqli->errno . ' -> ' . $mysqli->error . '<br>';
}

$sql_stmt = "delete from posts where id = $post_id";
if(!$mysqli->query($sql_stmt)) {
    echo $sql_stmt . '<br>';
    echo $mysqli->errno . ' -> ' . $mysqli->error;
}
else
    header('Location: ./index.php');
?>
