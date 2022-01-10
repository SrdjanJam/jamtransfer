
<script type="text/x-handlebars-template" id="v4_DaySettingsEditTemplate">
<form id="v4_DaySettingsEditForm{{ID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
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
					onclick="return editClosev4_DaySettings('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-arrow-up"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_DaySettings('{{ID}}', '<?= $inList ?>');">
					<i class="fa fa-ban"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_DaySettings('{{ID}}', '<?= $inList ?>');">
			<i class="ic-disk"></i>
			</button>
			<? if (!$isNew) { ?>
				<button class="btn btn-danger" title="<?= PRINTIT ?>" 
				onclick="return editPrintv4_DaySettings('{{ID}}', '<?= $inList ?>');">
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
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MonPercent"><?=MONPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MonPercent" id="MonPercent" class="w100" value="{{MonPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="MonAmount"><?=MONAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="MonAmount" id="MonAmount" class="w100" value="{{MonAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TuePercent"><?=TUEPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TuePercent" id="TuePercent" class="w100" value="{{TuePercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TueAmount"><?=TUEAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TueAmount" id="TueAmount" class="w100" value="{{TueAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WedPercent"><?=WEDPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WedPercent" id="WedPercent" class="w100" value="{{WedPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WedAmount"><?=WEDAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="WedAmount" id="WedAmount" class="w100" value="{{WedAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ThuPercent"><?=THUPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ThuPercent" id="ThuPercent" class="w100" value="{{ThuPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ThuAmount"><?=THUAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ThuAmount" id="ThuAmount" class="w100" value="{{ThuAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FriPercent"><?=FRIPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FriPercent" id="FriPercent" class="w100" value="{{FriPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FriAmount"><?=FRIAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="FriAmount" id="FriAmount" class="w100" value="{{FriAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SatPercent"><?=SATPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SatPercent" id="SatPercent" class="w100" value="{{SatPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SatAmount"><?=SATAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SatAmount" id="SatAmount" class="w100" value="{{SatAmount}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SunPercent"><?=SUNPERCENT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SunPercent" id="SunPercent" class="w100" value="{{SunPercent}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="SunAmount"><?=SUNAMOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="SunAmount" id="SunAmount" class="w100" value="{{SunAmount}}">
					</div>
				</div>


			</div>
	    </div>
		    

	<!-- Statuses and messages -->
	<div class="box-footer">
		<? if (!$isNew) { ?>
		<div>
    	<button class="btn btn-default" onclick="return deletev4_DaySettings('{{ID}}', '<?= $inList ?>');">
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
	