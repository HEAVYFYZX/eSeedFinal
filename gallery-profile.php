<?php
require('req_globals.php');

/*------------------------------
| 2. Run a query
------------------------------*/
$imageID = 1;
if (isset($_GET['imageID']))
{
	$imageID = $_GET['imageID'];
}
$gallery = mysqli_query($con, "SELECT * FROM gallery WHERE imageID = " . $imageID);

/*------------------------------
| 3. Convert result to Associative Array
------------------------------*/
$single_item = mysqli_fetch_assoc($gallery);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Assignment Gallery</title>
		<link rel="stylesheet" type="text/css" href="_css/styles.css">
	</head>
	<body>

		<div id="container">
			<header>Gallery Profile</header>
			<?php include('inc_nav.php'); ?>

			<div class="gallery">
				<a href="index.php">Back to Gallery</a>

				<?php 
				/*------------------------------
				| 4. Display Results
				------------------------------*/
				?>
				<div class="single_item">
					<img src="<?php echo $single_item['imageURL']; ?>">
					<h1><?php echo $single_item['imageTitle']; ?></h1>
					<div class="imageText">
						<?php echo $single_item['imageText']; ?>
					</div>
				</div>

			</div>


			<footer>&copy; 2015. All rights reserved.</footer>
		</div>

	</body>
</html>