<?php
require('req_globals.php');
session_destroy();
header("Location:login.php?fb=Log Out Success");
exit();
?>