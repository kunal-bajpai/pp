<?php
	session_start();
	unset($_SESSION['custSess']);
	header("location:editHome.php");
