<!--
     //
     // navigation-bar.php
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
-->

<div>
    <ul class="navigation-bar">
	<?php
	$mode = $_SESSION['mode'];
	$logedin = $_SESSION['logedin'];
	$user_permission_lvl = $_SESSION['user_permission_lvl'];

	switch ($mode) {
	    case 'view-posts':
		echo '<li class="left"><a class="active" href="./index.php">Home</a></li>';
		if (isset($user_permission_lvl) && $user_permission_lvl == 0)
		    echo '<li class="left"><a class="navigation-bar" href="./new-post.php">New post</a></li>';
		if (empty($logedin) || !$logedin)
		    echo '<li class="right"><a class="navigation-bar" href="./login.php">Login</a></li>';
		else {
		    echo '<li class="right"><a class="navigation-bar" href="./logout.php">Logout <b>';
		    echo $_SESSION['username'] . '</b></a></li>';
		}
		break;
	    case 'read-post':
		echo '<li class="left"><a class="navigation-bar" href="./index.php">Home</a></li>';
		if (isset($logedin) && $logedin)
		    echo '<li class="left"><a class="navigation-bar" href="#add-comment">Add Comment</a></li>';
		if (empty($logedin) || !$logedin)
		    echo '<li class="right"><a class="navigation-bar" href="./login.php">Login</a></li>';
		else {
		    echo '<li class="right"><a class="navigation-bar" href="./logout.php">Logout <b>';
		    echo $_SESSION['username'] . '</b></a></li>';
		}
		break;
	    case 'new-post':
		echo '<li class="left"><a class="active">New Post</a><li>';
		echo '<li class="left"><a class="navigation-bar" href="./index.php">Cancel</a></li>';
		echo '<li class="right"><a class="navigation-bar" href="./logout.php">Logout <b>';
		echo $_SESSION['username'] . '</b></a></li>';
		break;
	    case 'login':
		echo '<li class="left"><a class="navigation-bar" href="./index.php">Home</a></li>';
		echo '<li class="left"><a class="navigation-bar" href="./signin.php">Signin</a></li>';
		echo '<li class="right"><a class="active">Login</a></li>';
		break;
	    case 'signin':
		echo '<li class="left"><a class="navigation-bar" href="./index.php">Home</a></li>';
		echo '<li class="left"><a class="active">Signin</a></li>';
		echo '<li class="right"><a class="navigation-bar" href="./login.php">Login</a></li>';
		break;
	}

	if ($mode != 'login') {

	}
	?>
    </ul>
</div>
