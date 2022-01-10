
<script type="text/x-handlebars-template" id="v4_SurveyEditTemplate">
<form id="v4_SurveyEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_Survey('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Survey('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Survey('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_Survey('{{ID}}', '<?= $inList ?>');">
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
						<label for="Date"><?=DATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Date" id="Date" class="w100" value="{{Date}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="OrderID"><?=ORDERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OrderID" id="OrderID" class="w100" value="{{OrderID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserEmail"><?=USEREMAIL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserEmail" id="UserEmail" class="w100" value="{{UserEmail}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="UserName"><?=USERNAME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="UserName" id="UserName" class="w100" value="{{UserName}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Comment"><?=COMMENT;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Comment" id="Comment" rows="5" 
					class="textarea" cols="50" style="width:100%">{{Comment}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreService"><?=SCORESERVICE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreService" id="ScoreService" class="w100" value="{{ScoreService}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreDriver"><?=SCOREDRIVER;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreDriver" id="ScoreDriver" class="w100" value="{{ScoreDriver}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreClean"><?=SCORECLEAN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreClean" id="ScoreClean" class="w100" value="{{ScoreClean}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreValue"><?=SCOREVALUE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreValue" id="ScoreValue" class="w100" value="{{ScoreValue}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreWebsite"><?=SCOREWEBSITE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreWebsite" id="ScoreWebsite" class="w100" value="{{ScoreWebsite}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ScoreTotal"><?=SCORETOTAL;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ScoreTotal" id="ScoreTotal" class="w100" value="{{ScoreTotal}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="DriverOnTime"><?=DRIVERONTIME;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverOnTime" id="DriverOnTime" class="w100" value="{{DriverOnTime}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Recommend"><?=RECOMMEND;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Recommend" id="Recommend" class="w100" value="{{Recommend}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="BookAgain"><?=BOOKAGAIN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="BookAgain" id="BookAgain" class="w100" value="{{BookAgain}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Approved"><?=APPROVED;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Approved" id="Approved" class="w100" value="{{Approved}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_Survey('{{ID}}', '<?= $inList ?>');">
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
	