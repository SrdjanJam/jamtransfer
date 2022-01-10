
<script type="text/x-handlebars-template" id="v4_RatingsEditTemplate">
<form id="v4_RatingsEditForm{{OwnerID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Ratings('{{OwnerID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Ratings('{{OwnerID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Ratings('{{OwnerID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Ratings('{{OwnerID}}', '<?= $inList ?>');">
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
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Average"><?=AVERAGE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Average" id="Average" class="w100" value="{{Average}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Votes"><?=VOTES;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Votes" id="Votes" class="w100" value="{{Votes}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Overall"><?=OVERALL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Overall" id="Overall" class="w100" value="{{Overall}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Punct"><?=PUNCT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Punct" id="Punct" class="w100" value="{{Punct}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Respons"><?=RESPONS;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Respons" id="Respons" class="w100" value="{{Respons}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Kind"><?=KIND;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Kind" id="Kind" class="w100" value="{{Kind}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Vehicle"><?=VEHICLE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Vehicle" id="Vehicle" class="w100" value="{{Vehicle}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Driver"><?=DRIVER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Driver" id="Driver" class="w100" value="{{Driver}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="LastVote"><?=LASTVOTE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="LastVote" id="LastVote" class="w100" value="{{LastVote}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Ratings('{{OwnerID}}', '<?= $inList ?>');">
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
	