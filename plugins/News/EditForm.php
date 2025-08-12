
<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{NewsID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<button class="btn btn-warning" title="<?= CLOSE?>" 
				onclick="return editCloseItem('{{NewsID}}');">
				<i class="fa fa-close"></i>
				</button>

				<button class="btn btn-danger" title="<?= CANCEL ?>" 
				onclick="return deleteItem('{{NewsID}}');">
				<i class="fa fa-ban"></i>
				</button>
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{NewsID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<input type="hidden" name="NewsID" id="NewsID" class="w100" value="{{NewsID}}">
				<input type="hidden" name="CreatedDate" id="CreatedDate" class="w100" value="<?= date("Y-m-d",time())?>">


				<div class="row">
					<div class="col-md-3">
						<label for="Header"><?=TITLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Header" id="Header" class="w100" value="{{Header}}">
					</div>
				</div>		
				<div class="row">
					<div class="col-md-3"><label><?= PUBLISHING_DATE ?></label></div>
					<div class="col-md-9">
						<input type="text" name="PublishingDate" id="PublishingDate" class="w75 datepicker" value="{{PublishingDate}}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="Parent"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Active 'Active' }}
					</div>
				</div>					
				<div class="row">
					<div class="col-md-3">
						<label for="Content"><?=SHORT_CONTENT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="ShortHtml" id="ShortHtml" rows="15" 
					class="textarea" style="width:100%">{{ShortHtml}}</textarea>
					</div>
				</div>
				

				<div class="row">
					<div class="col-md-3">
						<label for="Content"><?=CONTENT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Html" id="Html" rows="15" 
					class="textarea" style="width:100%">{{Html}}</textarea>
					</div>
				</div>				

				<div class="row">
					<div class="col-md-3">
						<label for="LastChange"><?=LASTCHANGE;?></label>
					</div>
					<div class="col-md-9">
						{{CreatedDate}}
					</div>
				</div>


			</div>
	    </div>
		    

	
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
	
