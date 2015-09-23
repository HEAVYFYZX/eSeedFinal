$('#deleteImage').submit(function(e){

	var result = confirm('Are You Crazy?');

	console.log(result);

	if (result == false)
	{
		e.preventDefault();
	}
});

$('#insertImage').submit(function(e){

	var errors = false;

	// grab current values from required inputs
	var title = $('#imageTitle').val();
	console.log(title);

	var theFile = $('#fileToUpload').val();
	console.log(theFile);

	// get rid fo existing errors
	$('.error').remove();

	// manage missing requirements for title.
	if (title.length < 1)
	{
		errors = true;
		var titleParent = $('#imageTitle').parent();
		$('<span class="error">Title Is Required</span>').appendTo(titleParent);
	}

	// manage missing requirements for title.
	if (theFile.length < 1)
	{
		errors = true;
		$('#fileToUpload').after($('<span class="error">An Image Is Required</span>'));
	}

	// kill the form
	if (errors)
	{
		e.preventDefault();
	}

});







