
<script type="text/x-handlebars-template" id="v4_ArticlesEditTemplate">
<form id="v4_ArticlesEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_Articles('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Articles('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Articles('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Articles('{{ID}}', '<?= $inList ?>');">
				<i class="ic-print"></i>
				</button>
			<? } ?>	
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ID" id="ID" class="w100" value="{{ID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Language"><?=LANGUAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Language" id="Language" class="w100" value="{{Language}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Page"><?=PAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Page" id="Page" class="w100" value="{{Page}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Position"><?=POSITION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Position" id="Position" class="w100" value="{{Position}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="HTMLBefore"><?=HTMLBEFORE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="HTMLBefore" id="HTMLBefore" class="w100" value="{{HTMLBefore}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="HTMLAfter"><?=HTMLAFTER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="HTMLAfter" id="HTMLAfter" class="w100" value="{{HTMLAfter}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Classes"><?=CLASSES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Classes" id="Classes" class="w100" value="{{Classes}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Title"><?=TITLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Title" id="Title" class="w100" value="{{Title}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Article"><?=ARTICLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Article" id="Article" class="w100" value="{{Article}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Published"><?=PUBLISHED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Published" id="Published" class="w100" value="{{Published}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LastChange"><?=LASTCHANGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LastChange" id="LastChange" class="w100" value="{{LastChange}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserID"><?=USERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserID" id="UserID" class="w100" value="{{UserID}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Articles('{{ID}}', '<?= $inList ?>');">
    		<i class="ic-cancel-circle"></i> <?= DELETE ?>
    	</button>
    	</div>
    	<? } ?>

	</div>
</form>


	<script>

		//bootstrap WYSIHTML5 - text editor
		$(".textarea").wysihtml5({
				"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
				"emphasis": true, //Italics, bold, etc. Default true
				"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
				"html": true, //Button which allows you to edit the generated HTML. Default false
				"link": true, //Button to insert a link. Default true
				"image": true, //Button to insert an image. Default true,
				"color": true //Button to change color of font 
				
		});
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});
	
	</script>
</script>
	