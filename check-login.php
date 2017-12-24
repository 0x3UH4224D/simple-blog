<?php
//
// check-login.php
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
$password = $_POST['password'];
if (empty($username) || empty($password)) {
    $_SESSION['login-error'] = 'No such user with these information.';
    header('Location: ./login.php');
}

$md5_password = md5($password);

$result = $mysqli->query('select * from users ' .
			 "where username = '$username' and password = '$md5_password'");
if ($result->num_rows == 0) {
    $_SESSION['login-error'] = 'Wrong password or username.';
    /* echo 'not found';*/
    header('Location: ./login.php');
} else {
    /* echo 'found';*/
    $row = $result->fetch_assoc();
    $_SESSION['logedin'] = true;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_permission_lvl'] = $row['permission_lvl'];
    header('Location: ./index.php');
}
?>
