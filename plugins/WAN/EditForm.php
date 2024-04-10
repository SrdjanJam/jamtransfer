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
			<button class="btn btn-primary" title="<?= SEND?>"
				onclick="return sendItem('{{ID}}');">
				<i class="fa fa-whatsapp"></i>
			</button>
			<button class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
			onclick="return editSaveItem('{{ID}}');">
			<i class="fa fa-save"></i>
			</button>
		</div>
	</div>

	<div class="box-body ">
		<!-- ID: -->
		<div class="row"> 
			<div class="col-md-3"> <label for="ID"><?=ID;?></label> </div>
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
			<div class="col-md-6"> <textarea name="Body" id="Body" class="w100">{{Body}}</textarea> </div>
		</div>
		<!-- SER_ID: -->
		<div class="row">
			<div class="col-md-3"> <label for="UserID"><?=DRIVERS;?></label> </div>
            <div class="col-md-6">
				<? if (!isset($_SESSION['UseDriverID'])) {  ?> {{userSelect UserID '31' 'UserID'}}<? } else { ?>  
				{{subdriverSelect UserID '<?=$_SESSION['UseDriverID']?>' 'UserID'}} <? } ?>
			</div>	
									

		</div>
		<!-- SEND_RULE: -->
		<div class="row">
			<div class="col-md-3"> <label for="Phone"><?=Phone;?></label> </div>
			<div class="col-md-6"> <input type="text" name="Phone" id="Phone" class="w100" value="{{Phone}}"> </div>

		</div>		
		<!-- SEND_RULE: -->
		<div class="row">
			<div class="col-md-3"> <label for="SendRule"><?=SEND_RULE;?></label> </div>
			<div class="col-md-3"> <input type="text" name="SendRule" id="SendRule" class="w100" value="{{SendRule}}"> </div>
			<div class="col-md-6"> e.g 3/10 means "send 3 times every 10 minutes"</div>
		</div>
		<!-- SCHEDULE_TIME:  -->
		<div class="row">
			<div class="col-md-3"> <label for="ScheduleTime"><?=SCHEDULE_TIME;?></label> </div>
			<div class="col-md-9"> 
				<input type="text" name="ScheduleTime1" id="ScheduleTime1" class="w100 datepicker" value="{{ScheduleTime1}}">
				<input type="text" name="ScheduleTime2" id="ScheduleTime2" class="w100 timepicker" value="{{ScheduleTime2}}"> 
			</div>
		</div>

		<?if(!$isNew){ ?>
			<!-- SEND_TIME_FIRST: -->
			<div class="row">
				<div class="col-md-3"> <label for="SendTimeFirst"><?=SEND_TIME_FIRST;?></label> </div>
				<div class="col-md-9"> <input readonly type="text" name="SendTimeFirst" id="SendTimeFirst" class="w100" value="{{SendTimeFirst}}"> </div>
			</div>
			<!-- SEND_TIME_LAST: -->
			<div class="row">
				<div class="col-md-3"> <label for="SendTimeLast"><?=SEND_TIME_LAST;?></label> </div>
				<div class="col-md-9"> <input readonly type="text" name="SendTimeLast" id="SendTimeLast" class="w100" value="{{SendTimeLast}}"> </div>
			</div>
			<input type="hidden" name="OwnerID" value="{{OwnerID}}">
		<? } else { ?>
			<input type="hidden" name="Direction" value="1">
		<? } ?>
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
		$('#UserID').change(function() {
			$('#Phone').val($("#UserID option:selected").attr('data-mob'));
		})	
	</script>
</script>

