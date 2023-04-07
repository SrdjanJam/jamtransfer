<style>


.small {
	width: auto;
	height: 25px;
	background-color: #d6edfc;
}
	.large {
	width: 700px;
	height: auto;

	background-color: #fc0;
	margin: 10px auto;
}
.rotate {
  -moz-transform: rotate(90deg);
  -webkit-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}
  </style>

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

			<button id="save_button" class="btn btn-info" title="<?= SAVE_CHANGES ?>" 
				onclick="return editSaveItem('{{ID}}');">
				<i class="fa fa-save"></i>
			</button>

		</div>
	</div>

	<div class="box-body">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-4">
						<label for="Datum">Date & Time</label>
					</div>
					<div class="col-md-4">
						<input type="text" name="Datum1" id="Datum1" class="w100 datepicker" value="{{Datum1}}">
					</div>
					<div class="col-md-4">
						<input type="text" name="Vreme1" id="Vreme1" class="w100 timepicker" value="{{Vreme1}}">
					</div>
				</div>
				<? if ($isNew) { ?>
				<div class="row">
					<div class="col-md-4">
						<label for="Task">Task</label>
					</div>
					<div class="col-md-8">
						<input type="hidden" name="actionsid" id="actionsid" value="{{Expense}}">
						<select class="w100" name="Expense" id='actionsselect' value="{{Expense}}">
							<?
							foreach ($opis as $key=>$o) {
								echo '<option value="'.$key.'">'.$o.'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="DriverID"><?=DRIVER;?></label>
					</div>
					<div class="col-md-8">
						<select class="w100" name="DriverID">
						{{#select DriverID}}
							<?
							foreach ($driverArr as $driver) {
								echo '<option value="'.$driver->AuthUserID.'">'.$driver->AuthUserRealName.'</option>';
							}
							?>
						{{/select}}
						</select>
					</div>
				</div>
				<? } ?>	
				
				<div class="row">
					<div class="col-md-4">
						<label for="Vehicle">Vehicle</label>
					</div>
					<div class="col-md-8">
						<select class="w100" name="VehicleID" <? if (!$isNew) { ?> disabled<? } ?> >
						{{#select VehicleID}}
							<?
							foreach ($vehicleArr as $vehicle) {
								echo '<option value="'.$vehicle->VehicleID.'">'.$vehicle->VehicleDescription.'</option>';
							}
							?>
						{{/select}}
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-4">
						<label for="Description"><?= DESCRIPTION ?></label>
					</div>
					<div class="col-md-8">
						<textarea name="Description" id="Description" class="w100" style="resize:none">{{Description}}</textarea>
					</div>
				</div>	
				<? if (!$isNew) { ?>				
				<div class="row">
					<div class="col-md-4">
						<label for="Vreme">Finished</label>
					</div>
					<div class="col-md-8">
						{{Vreme}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="Note"><?= NOTE ?></label>
					</div>
					<div class="col-md-8">
						{{Note}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="Mark">Mark</label>
					</div>
					<div class="col-md-1">
						<span id="MarkDisplay">{{Mark}}</span> 
					</div>	
					<div class="col-md-3">
						<input id="Mark" type="range" min="1" max="5" name="Mark" value="{{Mark}}"/>
					</div>
				</div>					
				<div class="row">
					<div class="col-md-4">
						<label for="Approved">Approved</label>
					</div>
					<div class="col-md-8 approved">
						<large>{{yesNoSliderEdit Approved 'Approved' }}</large>
					</div>
				</div>								
				<? } else { ?>
				<input type="hidden" name="approved" value="0"/>
				<? } ?>

			</div>
			<? if (!$isNew) { ?>
			<div class="col-md-6">
				{{#each checklist}}
				<div class="row">	
					{{#compare active "==" '1'}}
						<div class="col-md-6">
							<input type="checkbox" name="check" style="height: 0.8em" value="1" 
							{{#compare check "==" 1 }} checked {{/compare}} disabled> 
						</div>	
					{{/compare}}		
					{{#compare active "==" '2'}}			
						<div class="col-md-2">
							<img src="{{photo}}" height="50" width="50" style="margin:2px"/>
						</div>
					{{/compare}}		
					<div class="col-md-2">
						<label for="Description">{{title}}</label>
					</div>
				</div>	
				{{/each}}				
			</div>

			<? } ?>	

	    </div>
	
		<input type="hidden" name='OwnerID' value='{{OwnerID}}'/>
	</form>				
	<script>
		$('img').click(function() {
			$(this).toggleClass("large");
		})
		$('img').dblclick(function() {
			$(this).toggleClass("rotate");
		})
		$('.approved input').change(function() {
			$('#save_button').trigger('click');
		})		
		$('#Mark').change(function() {
			$('#MarkDisplay').html($(this).val());
		})
	
	</script>
</script>
	
