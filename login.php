<?php
require('req_globals.php');

/*----------------------------
| User Login
----------------------------*/
// initialize
$uname = '';
$pass = '';

if (isset($_POST['uname'])) 
{	
	// convert posted variables to our initialized variables
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];

	// validation
	if (empty($uname) || empty($pass))
	{
		$error = true;
		$messages[] = 'You forgot to fill out a required field.';
	} /*ends validation*/

	// if no errors
	if (!$error)
	{
		// check the db for the records
		// $user = mysqli_query($con, "SELECT * FROM users WHERE uname = 'uname' AND pass = 'pass' LIMIT 1");
		if (!$user = mysqli_query($con, "SELECT * FROM users WHERE uname = '" . $uname . "' AND pass = '" . $pass . "' LIMIT 1"))
		{
			echo("Error description: " . mysqli_error($con));
		}

		// count the results
		$user_count = mysqli_num_rows($user);

		if ($user_count < 1)
		{
			$error = true;
			$messages[] = 'You do not exist.';
		}
		else
		{
			// Log em in
			$user_assoc = mysqli_fetch_assoc($user);
			
			$_SESSION['userID'] = $user_assoc['userID'];
			$_SESSION['fname'] = $user_assoc['fname'];
			$_SESSION['lname'] = $user_assoc['lname'];
			$_SESSION['privs'] = $user_assoc['privs'];

			// print_r($_SESSION);

			header("Location:ad_hub.php?fb=login success"); //send em into the hub page.
			exit(); //don't make PHP work harder than it has to.


		} /*ends user count*/

		 
	} /*ends our error check*/

} /*ends out isset*/

$pageTitle = 'Log In';
?>
<?php include('inc_header.php'); ?>
<?php include('inc_nav.php'); ?>

			<div class="main">
				<?php include('inc_feedback.php'); ?>
				
				<form id="login" action="login.php" method="post">
					<div class="row">
						<label for="uname">Username</label>
						<input type="text" name="uname" id="uname" placeholder="username" value="<?php echo $uname; ?>">
					</div>
					<div class="row">
						<label for="pass">Password</label>
						<input type="text" name="pass" id="pass" placeholder="password">
					</div>
					<div class="row">
						<button type="submit">Log In</button>
					</div>

				</form>


			</div>

<?php include('inc_footer.php'); ?>
