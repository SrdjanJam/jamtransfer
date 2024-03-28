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
		<!-- ID: -->
		<div class="row"> 
			<div class="col-md-3"> <label for="CountryID"><?=ID;?></label> </div>
			<div class="col-md-9"> {{ID}} </div>
		</div>
		<!-- TITLE: -->
		<div class="row">
			<div class="col-md-3"> <label for="Title"><?=TITLE;?></label> </div>
			<div class="col-md-9"> <input type="text" name="Title" id="Title" class="w100" value="{{Title}}"> </div>
		</div>
		<!-- BODY: -->
		<div class="row">
			<div class="col-md-3"> <label for="Body"><?=BODY;?></label> </div>
			<div class="col-md-9"> <input type="text" name="Body" id=Body" class="w100" value="{{Body}}"> </div>
		</div>
		<!-- SER_ID: -->
		<div class="row">
			<div class="col-md-3"> <label for="UserID"><?=SUBDRIVERS;?></label> </div>
            <div class="col-md-6">{{subdriverSelect UserID '<?=$_SESSION['UseDriverID']?>' 'UserID'}}  </div>	
		</div>
		<!-- SEND_RULE: -->
		<div class="row">
			<div class="col-md-3"> <label for="SendRule"><?=SEND_RULE;?></label> </div>
			<div class="col-md-9"> <input type="text" name="SendRule" id="SendRule" class="w100" value="{{SendRule}}"> </div>
		</div>
		<!-- SCHEDULE_TIME:  -->
		<div class="row">
			<div class="col-md-3"> <label for="ScheduleTime"><?=SCHEDULE_TIME;?></label> </div>
			<div class="col-md-9"> <input type="text" name="ScheduleTime" id="ScheduleTime" class="w100" value="{{ScheduleTime}}"> </div>
		</div>
		<!-- SEND_TIME_FIRST: -->
		<div class="row">
			<div class="col-md-3"> <label for="SendTimeFirst"><?=SEND_TIME_FIRST;?></label> </div>
			<div class="col-md-9"> <input type="text" name="SendTimeFirst" id="SendTimeFirst" class="w100" value="{{SendTimeFirst}}"> </div>
		</div>
		<!-- SEND_TIME_LAST: -->
		<div class="row">
			<div class="col-md-3"> <label for="SendTimeLast"><?=SEND_TIME_LAST;?></label> </div>
			<div class="col-md-9"> <input type="text" name="SendTimeLast" id="SendTimeLast" class="w100" value="{{SendTimeLast}}"> </div>
		</div>
		<!-- CONFIRM_TIME: -->
		<div class="row">
			<div class="col-md-3"> <label for="ConfirmTime"><?=CONFIRM_TIME;?></label> </div>
			<div class="col-md-9"> <input type="text" name="ConfirmTime" id="ConfirmTime" class="w100" value="{{ConfirmTime}}"> </div>
		</div>
		<!-- SEND_NUMBER: -->
		<div class="row">
			<div class="col-md-3"> <label for="SendNumber"><?=SEND_NUMBER;?></label> </div>
			<div class="col-md-9"> <input type="text" name="SendNumber" id="SendNumber" class="w100" value="{{SendNumber}}"> </div>
		</div>
		<!-- STATUS: -->
		<div class="row">
			<div class="col-md-3"> <label for="Status"><?=STATUS;?></label> </div>
			<div class="col-md-9"> <input type="text" name="Status" id="Status" class="w100" value="{{Status}}"> </div>
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
	
	</script>
</script>

