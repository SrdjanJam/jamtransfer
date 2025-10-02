<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{ID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{ID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">

				<input type="hidden" name="ID" id="ID" class="w100" value="{{ID}}">
				
				<div class="row">
					<div class="col-md-3">
						<label for="ID"><?=ID;?></label>
					</div>
					<div class="col-md-9">
						{{ID}}
					</div>
				</div>

				<div class="row {{hidden}}">
					<div class="col-md-3">
						<label for="Language"><?=LANGUAGE;?></label>
					</div>
					<div class="col-md-9">
						{{languageSelect Language}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Title"><?=TITLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Title" id="Title" value="{{Title}}">
					</div>
				</div>


				<div class="row">
					<div class="col-md-3">
						<label for="Content"><?=ARTICLE;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Article" id="Article" rows="15" 
					class="textarea" style="width:100%">{{Article}}</textarea>
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
						<label for="Published"><?=PUBLISHED;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Published 'Published' }}
					</div>
				</div>				
				
				<div class="row">
					<div class="col-md-3">
						<label for="Published">Schema</label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Scheme 'Scheme' }}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LastChange"><?=LASTCHANGE;?></label>
					</div>
					<div class="col-md-9">
						{{LastChange}}
					</div>
				</div>	

			</div>
	    </div>
		    

	<!-- Statuses and messages -->

	
	<input type="hidden" name="UserID" id="UserID"  value="{{UserID}}">
	<input type="hidden" name="LastChange" id="LastChange"  value="<?= date("Y-m-d H:i:s") ?>">
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
	
