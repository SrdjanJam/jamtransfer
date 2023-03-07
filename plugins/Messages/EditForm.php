<script type="text/x-handlebars-template" id="ItemEditTemplate">
<form id="ItemEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editSaveItem('{{ID}}');">
					<i class="fa fa-save"></i>
				</button>

		</div>
	</div>
	
	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<!-- MESSAGE_ID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="TerminalID"><?=MESSAGE_ID;?></label>
					</div>
					<div class="col-md-9">
						{{ID}}
					</div>
				</div>
				<br>
				<!-- FROM_NAME: -->
				<div class="row">
					<div class="col-md-3">
						<label for="FromName"><?=FROM_NAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FromName" id="FromName" class="w100" value="{{FromName}}">
					</div>
				</div>
				<br>
				<!-- MSG: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Msg"><?=MSG;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Msg" id="Msg" class="w100" value="{{Msg}}">
					</div>
				</div>
				<br>
				<!-- BODY: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Body"><?=BODY;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Body" id="Body" style="resize:none;width:100%;min-height:200px;">{{Body}}</textarea>
					</div>
				</div>
				<br>
				<!-- USER_ID: -->
				<div class="row">
					<div class="col-md-3">
						<label for="UserID"><?=USER_ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserID" id="UserID" class="w100" value="{{UserID}}">
					</div>
				</div>
				<br>
				<!-- DATE_TIME: -->
				<div class="row">
					<div class="col-md-3">
						<label for="DateTime"><?=DATE_TIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DateTime" id="DateTime" class="w50 datepicker w-edit" value="{{DateTime}}" data-id="{{ID}}">
					</div>
				</div>
				<br>
				<!-- USER_LEVEL: -->
				<div class="row">
					<div class="col-md-3">
						<label for="UserLevel"><?=USER_LEVEL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserLevel" id="UserLevel" class="w100" value="{{UserLevel}}">
					</div>
				</div>
				<br>
				<!-- STATUS: -->
				<div class="row">
					<div class="col-md-3">
						<label for="Status"><?=STATUS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Status" id="Status" class="w100" value="{{Status}}">
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

