<?php
require('req_globals.php');
admin_check();
$pageTitle = 'Placement Quiz';
// quiz
// initialize vars
$userID = $_SESSION['userID'];
// manage q id
$questionID = 1; //def ques
if (isset($_GET['questionID']))
{
	$questionID = $_GET['questionID'];
}

if (isset($_POST['questionID']))
{
	$questionID = $_POST['questionID'];	
}

// get question
$result = mysqli_query($con, "SELECT * FROM quiz WHERE questionID = $questionID");
$question = mysqli_fetch_assoc($result);
// grab all questions to paginate
$all_questions = mysqli_query($con, "SELECT * FROM quiz");
//get user stuff
$answer = 'optoion1'; //default
if (isset($_POST['answer']))
{
	$answer = $_POST['answer'];
}

//process quiz
if (isset($_POST['answer']))
{
	$userID = $_POST['userID'];
	$questionID = $_POST['questionID'];
	$answer = $_POST['answer'];
//is there already an amswer?
	$result = mysqli_query($con, "SELECT * FROM quiz_results WHERE userID = $userID AND questionID = $questionID");
	if (mysqli_num_rows($result) >0) //if answer is already in db, lets update it
	{
		//update
		$user_answer = mysqli_fetch_assoc($result);

		$updateSQL = "UPDATE quiz_results SET
						userID = '$userID',
						questionID= '$questionID',
						answer = '$answer'
						WHERE resultID = " . $user_answer['resultID'];
		mysqli_query($con, $updateSQL);
	}
	else
	{
		echo 'hello';
		//insert
		$insertSQL = "INSERT INTO quiz_results (userID, questionID, answer) VALUES ('$userID',  '$questionID', '$answer')";
		mysqli_query($con, $insertSQL);
	}

}


// results
//get stored answer
$result = mysqli_query($con, "SELECT * FROM quiz_results WHERE userID = $userID AND questionID = $questionID");
if (mysqli_num_rows($result) > 0) //if we find an answer stored in db - lets update the answer
{
	$user_answer = mysqli_fetch_assoc($result);
	$answer = $user_answer['answer'];
}


?>
<?php include('inc_header.php'); ?>
<?php include('inc_nav.php'); ?>

		<div class="main quiz">
			<nav>
				<?php while($the_question = mysqli_fetch_assoc($all_questions)) : ?>
					<a href="ad_quiz.php?questionID=<?php echo $the_question['questionID']; ?>">
						<?php echo $the_question['questionID'];  ?>
					</a>
				<?php endwhile; ?>
				<a href="ad_quiz_results.php">View Results</a>

				<!-- replaced with the above loop -->
				<!-- <a href="ad_quiz.php?questionID=1">1</a>
				<a href="ad_quiz.php?questionID=2">2</a>
				<a href="ad_quiz.php?questionID=3">3</a>
				<a href="ad_quiz.php?questionID=4">4</a>
				<a href="ad_quiz.php?questionID=5">5</a> -->
			</nav>

			<div class="questions">
				<h2><?php echo $question['question']; ?></h2>
				<img src="<?php echo $question['content']; ?>">
			</div>

			<div class="options">
				<ol type="a">
					<li><?php echo $question['option1']; ?></li>
					<li><?php echo $question['option2']; ?></li>
					<li><?php echo $question['option3']; ?></li>
				</ol>
			</div>

			<form action="ad_quiz.php" method="post">
				<input type="hidden" name="userID" value="<?php echo $userID; ?>">
				<input type="hidden" name="questionID" value="<?php echo $questionID; ?>">

				<div class="row">
					<label for="answer">Pick one:</label>
					<select name="answer" id="answer">
						<option value="option1"<?php if ($answer == 'option1') {echo ' selected="selected"'; } ?>>OPTION A</option>
						<option value="option2"<?php if ($answer == 'option2') {echo ' selected="selected"'; } ?>>OPTION B</option>
						<option value="option3"<?php if ($answer == 'option3') {echo ' selected="selected"'; } ?>>OPTION C</option>
					</select>
				</div>
				<div class="row">
					<button>Submit Answer</button>
				</div>
			</form>

<?php include('inc_footer.php'); ?>
