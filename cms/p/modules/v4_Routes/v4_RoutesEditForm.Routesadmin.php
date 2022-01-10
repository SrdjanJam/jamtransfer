
<script type="text/x-handlebars-template" id="v4_RoutesEditTemplate">
<form id="v4_RoutesEditForm{{RouteID}}" class="form box box-info" enctype="multipart/form-data" method="post" onsubmit="return false;">
	<div class="box-header">
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3><?= NEWW ?></h3>
			<? } else { ?>
				<h3><?= EDIT ?> - {{RouteName}}</h3>
			<? } ?>
		</div>
		<div class="box-tools pull-right">
			
			<span id="statusMessage" class="text-info xl"></span>
			
			<? if (!$isNew) { ?>
				<? if ($inList=='true') { ?>
					<button class="btn" title="<?= CLOSE?>" 
					onclick="return editClosev4_Routes('{{RouteID}}', '<?= $inList ?>');">
					<i class="fa fa-chevron-up l"></i>
					</button>
				<? } else { ?>
					<button class="btn btn-danger" title="<?= CANCEL ?>" 
					onclick="return deletev4_Routes('{{RouteID}}', '<?= $inList ?>');">
					<i class="fa fa-ban l"></i>
					</button>
				<? } ?>	
			<? } ?>	
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSavev4_Routes('{{RouteID}}', '<?= $inList ?>');">
			<i class="fa fa-save l"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
        <div class="row">
			<div class="col-md-12">
				<div class="row hidden">
					<div class="col-md-3">
						<label for="OwnerID"><?=OWNERID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="OwnerID" id="OwnerID" class="w100" value="{{OwnerID}}" readonly>
					</div>
				</div>

				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteID"><?=ROUTEID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteID" id="RouteID" class="w100" value="{{RouteID}}" readonly>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="FromID"><?=FROM;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect FromID 'FromID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ToID"><?=TO;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect ToID 'ToID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Approved"><?=APPROVED;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSelect Approved 'Approved'}}
					</div>
				</div>

				<div class="row hidden">
					<div class="col-md-3">
						<label for="RouteNameEN"><?=ROUTENAMEEN;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="RouteNameEN" id="RouteNameEN" class="w100" value="{{RouteNameEN}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Km"><?=KM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Km" id="Km" class="w100" value="{{Km}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Duration"><?=DURATION;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Duration" id="Duration" class="w100" value="{{Duration}}">
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
		
		$("#FromID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();
			$("#RouteNameEN").val(from + ' - ' + to);
		
		});
		$("#ToID").change(function(){
			var from = $("#FromID option:selected").text();
			var to   = $("#ToID option:selected").text();
			$("#RouteNameEN").val(from + ' - ' + to);
		});	
	</script>
</script>

