<?php
//
// add-new-user.php
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

$username = $_POST['username'];
if (empty($username)) {
    $_SESSION['signin_error'] = 'username can not be empty';
    header('Location: ./signin.php');
}

$email = $_POST['email'];
if (empty($email)) {
    $_SESSION['signin_error'] = 'email can not be empty';
    header('Location: ./signin.php');
}

$password = $_POST['password'];
if (empty($password)) {
    $_SESSION['signin_error'] = 'password can not be empty';
    header('Location: ./signin.php');
}
$md5_password = md5($password);

$user_id_query = $mysqli->query('select max(id) as _max from users');
$user_id = 0;
if ($user_id_query->num_rows > 0)
    $user_id = $user_id_query->fetch_assoc()['_max'] + 1;

$sql_stmt = "insert into users values($user_id, '$username', '$md5_password', 1)";
if(!$mysqli->query($sql_stmt)) {
    echo $sql_stmt . '<br>';
    echo $mysqli->errno . ' -> ' . $mysqli->error;
}
else
    header('Location: ./login.php');
?>
