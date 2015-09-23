<?php
/*------------------------------
| 1. Make a connection
------------------------------*/
$con = mysqli_connect('localhost', 'root', 'root', 'eSeedFinal');

/*------------------------------
| always start a session before using it.
------------------------------*/
session_start();

/*------------------------------
| Admin Access Check
------------------------------*/
function admin_check() {
	if (!isset($_SESSION['privs']) || $_SESSION['privs'] != 'Yes')
	{
		header('Location:login.php?fb=Access Denied.');
		exit();
	}
}


/*------------------------------
| Form Processing and Feedback
------------------------------*/
$error = false;
$messages = array();

// URL feedback
if (isset($_GET['fb']))
{
	$messages[] = $_GET['fb'];
}
?>