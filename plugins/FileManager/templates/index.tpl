<link rel="stylesheet" href="css/progress.css">
<br><br>
<div class="container"> 

<div class="upload-edit">
	<div class="row btn blue fileinput-button"  style="height:200px;padding-top:50px;display: block;border:none;">
		<!-- Button to select & upload files -->
		{* <span class="btn blue fileinput-button"> *}
			<div style="font-size:30px;color:#2d84f1;"><i class="fa fa-cloud-upload xl" ></i><b> Select or {$UPLOAD_IMAGES }</b></div>
			<!-- The file input field used as target for the file upload widget -->
			<input id="fileupload" type="file" name="files[]" multiple > 
		{* </span> *}
		
	</div>
</div>

	<style>
		.upload-edit{
			background:rgb(227 231 241);
		}
		.upload-edit:hover{
			background:rgb(191 202 231);
		}
	</style>

	<div class="row">
		<!-- The global progress bar -->
		<br>
		<p style="color:rgb(51, 157, 219);font-weight:bold;font-style:italic;">Upload progress</p>
		<div id="progress" class="progress progress-info progress-striped">
			<div class="bar"></div>
		</div>
	</div>  
  
	<div class="row">  
		<!-- The list of files uploaded -->
		<h2>Uploaded:</h2>
		<br><br>
	</div>
	
	<div class="row">
		<div class="col-md-12"id="files"></div>
	</div>
  
	<div class="row">
		<br><br>
		<h2>Images on Server:</h2>
		<br>
		{section name=pom loop=$file_arr}		
			<div class="col-md-12" id="{$file_arr[pom].count}" >
				<button class="btn red" onclick="DeleteFile('{$file_arr[pom].file}','{$file_arr[pom].count}');">
					<i class="fa fa-times-circle l"></i>
				</button>
				<a href="../i/website/'.$file.'" target="_blank" border="0">
					<img style="max-width:100%; padding:1em" class="thumbnail" src="{$dir}{$file_arr[pom].file}" title="{$dir}{$file_arr[pom].file}">
				</a>
				<h4>{$ROOT_WEB}/i/website/{$file_arr[pom].file}</h4> 
				<br><br>
			</div>
		{/section}	
	</div>
	<!-- Load jQuery and the necessary widget JS files to enable file upload 
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
	<script src="js/vendor/jquery.ui.widget.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<!-- JavaScript used to call the fileupload widget to upload files -->
	<script>

	function DeleteFile(filex,id) {
		$.get("plugins/FileManager/fileManagerDelete.php?file="+filex,
				function(data){ 
				$("#"+id).html('<p class="alert alert-danger">' + filex + ' ' + data + '</p><br><br>');
				});
				
	}


	// File Manager - Upload Manager AJAX LOAD
	function GetFileManager() {

		$.get("plugins/FileManager/index.php",
			function(data){ 
				$("#fileManager").html(data); 
				
			}
		);
	}


	// When the server is ready...
	$(function () {
		'use strict';
		
		// Define the url to send the image data to
		var url = 'i/index.php';
		// Call the fileupload widget and set some parameters
		$('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			done: function (e, data) {
				// Add each uploaded file name to the #files list
				$.each(data.result.files, function (index, file) {
					$('<div/>').html(' <img src="i/website/'+file.name+'" style="max-width:100%"><br> ' + file.name).appendTo('#files');
					GetFileManager();
					
				});
			},
			progressall: function (e, data) {
				// Update the progress bar while files are being uploaded
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .bar').css(
					'width',
					progress + '%'
				);
			}
		});
		
	});

	</script>
</div>
