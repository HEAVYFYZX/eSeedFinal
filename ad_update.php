<?php
require('req_globals.php');

admin_check(); //do they have the right to be here?

$pageTitle = 'Update Gallery';

/*----------------------------------
| Initialize Variables
----------------------------------*/
$imageTitle = '';
$imageText = '';
$imageURL = '';


/*----------------------------------
| Update Script
----------------------------------*/
if (isset($_POST['imageID']))
{
	// convert posted variables to our initialized variables.
	$imageID = $_POST['imageID'];
	$imageTitle = $_POST['imageTitle'];
	$imageText = $_POST['imageText'];

	// manage the file
	if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] != 4)
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

			/*-----------------------------------
			| Clean Up Older Image
			-----------------------------------*/
			$image = mysqli_query($con, "SELECT * FROM gallery WHERE imageID = " . $imageID);
			$imageDetails = mysqli_fetch_assoc($image);
			unlink($imageDetails['imageURL']);

			// Insert in to DB
			// 1. build the query
			$update_sql = "
					UPDATE gallery SET

					imageURL = '" . $file_and_path . "',
					imageTitle = '" . $imageTitle . "',
					imageText = '" . $imageText . "'

					WHERE imageID = " . $imageID . "
					LIMIT 1
				";

			mysqli_query($con, $update_sql); //2. run the query

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
/*----------------------------------
| Delete Script
----------------------------------*/
if (isset($_POST['imageID2']))
{
	// convert posted variables to our initialized variables.
	$imageID = $_POST['imageID2'];

	// find out the current image
	$profile = mysqli_query($con, "SELECT * FROM gallery WHERE imageID = " . $imageID . " LIMIT 1");
	$image_assoc = mysqli_fetch_assoc($profile);
	unlink($image_assoc['imageURL']);

	// delete sql
	mysqli_query($con, "DELETE FROM gallery WHERE imageID = " . $imageID);

	header("Location:ad_hub.php?fb=Deleted Successfully");
	exit(); //don't make PHP work any harder than it has to.
}

/*----------------------------------
| Which Record Are We Updating?
----------------------------------*/
$imageID = 1; //default record for update
if (isset($_GET['imageID']))
{
	$imageID = $_GET['imageID']; //update default to what was passed through URL
}
else if (isset($_POST['imageID']))
{
	$imageID = $_POST['imageID']; //update default to what was passed from update form
}
else if (isset($_POST['imageID2']))
{
	$imageID = $_POST['imageID2']; //update default to what was passed from delete form
}

/*----------------------------------
| Grab Chosen Record From Database
----------------------------------*/
$image = mysqli_query($con, "SELECT * FROM gallery WHERE imageID = " . $imageID);

$imageDetails = mysqli_fetch_assoc($image); //converts into associative array

/*----------------------------------
| Update Initialized Variables to reflect database chosen one
----------------------------------*/
$imageTitle = $imageDetails['imageTitle'];
$imageText = $imageDetails['imageText'];
$imageURL = $imageDetails['imageURL'];
$imageID = $imageDetails['imageID'];

?>
<?php include('inc_header.php'); ?>
<?php include('inc_nav.php'); ?>

			<div class="main">
				<a href="ad_hub.php">Back to Admin Page</a>

				<?php include('inc_feedback.php'); ?>
				
				<form action="ad_update.php" method="post" enctype="multipart/form-data">
					
					<input type="hidden" name="imageID" value="<?php echo $imageID; ?>">

					<div class="row">
						<label>Image</label>
						<input type="file" name="fileToUpload">
						<img src="<?php echo $imageURL; ?>" width="150">
					</div>
					<div class="row">
						<label>Title</label>
						<input type="text" name="imageTitle" value="<?php echo $imageTitle; ?>">
					</div>
					<div class="row">
						<label>Text</label>
						<textarea name="imageText"><?php echo $imageText; ?></textarea>
					</div>
					<div class="row">
						<button type="submit">Update</button>
					</div>
				</form>

				<form id="deleteImage" action="ad_update.php" method="post">
					<input type="hidden" name="imageID2" value="<?php echo $imageID; ?>">
					Delete the Image.
					<button type="submit">Delete</button>
				</form>

			</div>

<?php include('inc_footer.php'); ?>
