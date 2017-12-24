<?php
//
// signin.php
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
$_SESSION['mode'] = 'signin';
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
	?>
	<div class="box">
	    <form action="./add-new-user.php" method="post">
		Username: <input type="text" name="username"><br>
		e-mail: <input type="text" name="email"><br>
		password: <input type="password" name="password"><br>
		<input type="submit" value="Submit">
	    </form>
	    <?php
	    if (isset($_SESSION['signin_error']))
		echo $_SESSION['signin_error'];
	    ?>
	</div>
    </body>
</html>
