<form name="headerImages" method="post" action="">
<div class="container">
<div class="box box-info pad1em shadowLight">
<h1><?= HEADER_IMAGES ?></h1>
<br>
<?

	if (is('setImages', 'r') and r('setImages') == 1) {

		$filename = '../headerImages.inc';
		$somecontent = r('firstImage').';'.r('secondImage').';'.r('thirdImage');

		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {

			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'w')) {
				 echo "Cannot open file ($filename)";
				 exit;
			}

			// Write $somecontent to our opened file.
			if (fwrite($handle, $somecontent) === FALSE) {
				echo "Cannot write to file ($filename)";
				exit;
			}

			echo "Success";

			fclose($handle);

		} else {
			echo "The file $filename is not writable";
		}		
				
	
	} else {
		
		// uzmi podatke iz file-a
		$images = file_get_contents('../headerImages.inc',  FILE_USE_INCLUDE_PATH);
		$img = explode(';', $images);
		
		
	?>



	<div class="row">
		<div class="col-md-6"><?= FIRST_IMAGE ?></div>
		<div class="col-md-6"><input type="text" name="firstImage" value="<?= $img[0] ?>"></div>

		<div class="col-md-6"><?= SECOND_IMAGE ?></div>
		<div class="col-md-6"><input type="text" name="secondImage" value="<?= $img[1] ?>"></div>
	
		<div class="col-md-6"><?= THIRD_IMAGE ?></div>
		<div class="col-md-6"><input type="text" name="thirdImage" value="<?= $img[2] ?>"></div>
	
		<div class="col-md-6"></div>
		<div class="col-md-6">
			<br>
			<button name="setImages" type="submit" class="btn btn-primary" value="1"><?= SET_IMAGES ?></button>
		</div>		
	</div>


<? } ?>

</div>
</div>
</form>
