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
	
	<div class="box-body coupons-edit">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="Code"><?=CODE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Code" id="Code" class="w100" value="{{Code}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Discount"><?=DISCOUNT;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="Discount" id="Discount" class="w100" value="{{Discount}}">
					</div>
				</div>				
				
				<div class="row">
					<div class="col-md-3">
						<label for="Description"><?=DESCRIPTION;?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Description" id="Description" rows="3" 
					class="textarea" cols="50" style="width:100%">{{Description}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ValidFrom"><?=VALIDFROM;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ValidFrom" id="ValidFrom" class="w100 datepicker" value="{{ValidFrom}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ValidTo"><?=VALIDTO;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="ValidTo" id="ValidTo" class="w100 datepicker" value="{{ValidTo}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferFromDate"><?=TRANSFERFROMDATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferFromDate" id="TransferFromDate" class="w100 datepicker" value="{{TransferFromDate}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TransferToDate"><?=TRANSFERTODATE;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="TransferToDate" id="TransferToDate" class="w100 datepicker" value="{{TransferToDate}}">
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeID"><?=VEHICLECLASS;?></label>
					</div>
					<div class="col-md-9">
						{{vehicleClassSelect VehicleTypeID 'VehicleTypeID'}}
					</div>
				</div>			
			
				<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeID"><?=DRIVER_ID;?></label>
					</div>
					<div class="col-md-9">
						<input type="text" name="DriverID" id="DriverID" class="w100" value="{{DriverID}}">
					</div>
				</div>		
				
				<!---<div class="row">
					<div class="col-md-3">
						<label for="VehicleTypeID"><?=VEHICLETYPEID;?></label>
					</div>
					<div class="col-md-9">
						{{vehicleTypeSelect VehicleTypeID 'VehicleTypeID'}}
					</div>
				</div>!--->

				<div class="row">
					<div class="col-md-3">
						<label for="LimitLocationID"><?=LIMITLOCATIONID;?></label>
					</div>
					<div class="col-md-9">
						{{placeSelect LimitLocationID 'LimitLocationID'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="WeekdaysOnly"><?=WEEKDAYSONLY;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit WeekdaysOnly 'WeekdaysOnly'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="ReturnOnly"><?=RETURNONLY;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit ReturnOnly 'ReturnOnly'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Active"><?=ACTIVE;?></label>
					</div>
					<div class="col-md-9">
						{{yesNoSliderEdit Active 'Active'}}
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="TimesUsed"><?=TIMESUSED;?></label>
					</div>
					<div class="col-md-9">
						{{TimesUsed}}
					</div>
				</div>
			</div>
	    </div>
</form>
</script>

