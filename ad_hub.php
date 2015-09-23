<?php
require('req_globals.php');

admin_check(); //do they have the right to be here?

$pageTitle = 'Admin Hub';

/*----------------------------------
| File Upload Insert Processing
----------------------------------*/
// initialize variables
$imageTitle = '';
$imageText = '';

if (isset($_POST['imageTitle']))
{
	// convert posted variables to our initialized variables.
	$imageTitle = $_POST['imageTitle'];
	$imageText = $_POST['imageText'];

	// check for required fields
	if (empty($imageTitle))
	{
		$messages[] = 'You missed the required <b>Title</b> field.';
		$error = true;
	}
	if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 4)
	{
		$messages[] = 'You must provide an image.';
		$error = true;
	}

	// manage the file
	if ($error == false)
	{
		// testing the file upload variables
		$messages[] = print_r( $_FILES['fileToUpload'], true);

		// convert to simple variables
		$file_name = $_FILES['fileToUpload']['name'];
		$file_tmp_name = $_FILES['fileToUpload']['tmp_name'];

		// create a new path which includes the file name
		$file_and_path = '_img/gallery/' . $file_name;

		// move the file.
		if (move_uploaded_file($file_tmp_name, $file_and_path))
		{
			$messages[] = 'File Uploaded Successfully.';

			// Insert in to DB
			// 1. build the query
			$insert_sql = "
					INSERT INTO gallery
					(imageURL, imageTitle, imageText)
					VALUES (
							'" . $file_and_path . "', 
							'" . $imageTitle . "', 
							'" . $imageText . "'
							)
			";

			mysqli_query($con, $insert_sql); //2. run the query

		}
		else
		{
			$messages[] = 'Unable to Upload File.';
		}
	}	
	else
	{
		$error = true;
		$messages[] = 'You must submit a file.';
	}
}

?>
<?php include('inc_header.php'); ?>
<?php include('inc_nav.php'); ?>

			<div class="main">
				<?php include('inc_feedback.php'); ?>
				
				<form id="insertImage" action="ad_hub.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<label>Image</label>
						<input id="fileToUpload" type="file" name="fileToUpload">
					</div>
					<div class="row">
						<label>Title</label>
						<input id="imageTitle" type="text" name="imageTitle" value="<?php echo $imageTitle; ?>">
					</div>
					<div class="row">
						<label>Text</label>
						<textarea name="imageText"><?php echo $imageText; ?></textarea>
					</div>
					<div class="row">
						<button type="submit">Insert</button>
					</div>
				</form>


				<?php
				/*----------------------------------
				| Get Existing Gallery Records
				----------------------------------*/
				$gallery = mysqli_query($con, "SELECT * FROM gallery");
				while($image = mysqli_fetch_assoc($gallery)):
				?>
					<a href="ad_update.php?imageID=<?php echo $image['imageID']; ?>">
						<img src="<?php echo $image['imageURL']; ?>" width="150">
					</a>
				<?php endwhile; ?>
				
			</div> <!-- here is where main ends -->




<?php include('inc_footer.php'); ?>
