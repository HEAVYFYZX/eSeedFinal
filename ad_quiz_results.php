<?php
require('req_globals.php');
admin_check();
$pageTitle = 'QUiz Results';
?>
<?php include('inc_header.php'); ?>
<?php include('inc_nav.php'); ?>

			<div class="main">
				<a href="ad_quiz.php">Back to Quiz</a>
				<table width="100%" border="1">
					<tr>
						<th>#</th>
						<th>Questions</th>
						<th>Your Answer</th>
						<th>Correct Answer</th>
					</tr>

					<?php 
					$userID = $_SESSION['userID'];
					$result = mysqli_query($con, "SELECT
													quiz.answer as answerKey,
													quiz_results.answer as answerUser,
													quiz.question, quiz.questionID
													FROM quiz, quiz_results
													WHERE quiz_results.userID = $userID
													AND quiz_results.questionID = quiz.questionID
													ORDER BY quiz.questionID ASC
													");
					$numQs = 0;
					$numCorr = 0;
					
					while ($row = mysqli_fetch_assoc($result)) :

					$numQs++;//incriment with each q
					if($row['answerUser'] == $row['answerKey'])
					{
						$numCorr++; //incriment if right
					}
					?>
					<tr>
						<td><?php echo $row['questionID']; ?></td>
						<td><?php echo $row['question']; ?></td>
						<td><?php echo $row['answerUser']; ?></td>
						<td><?php echo $row['answerKey']; ?></td>
					</tr>
				<?php endwhile; ?>
					<tr>
						<td colspan="3">Your Score</td>
						<td colspan="1">
							<?php echo $numCorr; ?>/<?php echo $numQs; ?> :
							<?php echo ($numCorr/$numQs*100); ?>%
							</td>
					</tr>
				</table>
			</div>

<?php include('inc_footer.php'); ?>
