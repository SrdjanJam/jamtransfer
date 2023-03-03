<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{TerminalID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NNEW.' '.EXPENSE ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{ID}}</h3>
			<? } ?>
		</div>

		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>

				<button class="btn btn-warning" title="<?= CLOSE?>"
					onclick="return editCloseItem('{{ID}}');">
					<i class="fa fa-close"></i>
				</button>

				<? } ?>	

				<button class="btn btn-info" title="<?= SAVE_CHANGES ?>"
					onclick="return editSaveItem('{{TerminalID}}');">
					<i class="fa fa-save"></i>
				</button>

		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<!-- TERMINAL_ID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="TerminalID"><?=TERMINAL_ID;?></label>
					</div>
					<div class="col-md-9">
						{{TerminalID}}
					</div>
				</div>
				<br>
				<!-- MP: -->
				<div class="row">
					<div class="col-md-3">
						<label for="MP"><?=MP;?></label>
					</div>
					<div class="col-md-9 MP data-id="{{MP}}">
						{{yesNoSliderEdit MP 'MP' }}
					</div>
				</div>
				<br>
				<!-- IMAGE_MP: -->
				<div class="row">
					<div class="col-md-3">
						<label for="ImageMP"><?=IMAGE_MP;?></label>
					</div>
					<div class="col-md-6">
						<input type="text" name="ImageMP" id="ImageMP" class="w100" value="{{ImageMP}}">
					</div>
					<div class="col-md-3">					
						<img height="100px" src="{{ImageMP}}">					
					</div>		
				</div>
				<br>
				<!-- IMAGE_BG: -->
				<div class="row">
					<div class="col-md-3">
						<label for="ImageBG"><?=IMAGE_BG;?></label>
					</div>
					<div class="col-md-6">
						<input type="text" name="ImageBG" id="ImageBG" class="w100" value="{{ImageBG}}">
					</div>
					<div class="col-md-3">					
						<img height="100px" src="{{ImageBG}}">					
					</div>		
				</div>
				<br>
				<!-- MP_ORDER: -->
				<div class="row">
					<div class="col-md-3">
						<label for="MPorder"><?=MP_ORDER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MPOrder" id="MPOrder" class="w100" value="{{MPOrder}}">
					</div>
				</div>
				<br>
				<!-- DESCRIPTION: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Description"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Description" id="Description" style="resize:none;width:100%;min-height:200px;">{{Description}}</textarea>
					</div>
				</div>

				
			</div>
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
	
	
		$("#PlaceNameEN").keyup(function(){
			var place = $("#PlaceNameEN").val();
			$("#PlaceNameSEO").val( getSlug( place , '+') );
		});
		
		$("#PlaceCountry").change(function(){
			$("#CountryNameEN").val( $("#PlaceCountry option:selected").text());
		});
	</script>
</script>

