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
		<div class="box-title">
			<? if ($isNew) { ?>
				<h3>New tasks</h3>
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

	<div class="box-body">
        <div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="Datum">Vreme</label>
					</div>
					<div class="col-md-6">
						<input type="text" name="Datum1" id="Datum1" class="w100 datepicker" value="{{Datum1}}">
					</div>
					<div class="col-md-3">
						<input type="text" name="Vreme1" id="Vreme1" class="w100 timepicker" value="{{Vreme1}}">
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="Task">Task</label>
					</div>
					<div class="col-md-9">
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
					<div class="col-md-3">
						<label for="DriverID"><?=DRIVER;?></label>
					</div>
					<div class="col-md-9">
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
				<div class="row">
					<div class="col-md-3">
						<label for="Vehicle">Vehicle</label>
					</div>
					<div class="col-md-9">
						<select class="w100" name="VehicleID">
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
					<div class="col-md-3">
						<label for="Description"><?= DESCRIPTION ?></label>
					</div>
					<div class="col-md-9">
						<textarea name="Description" id="Description" class="w100" style="resize:none">{{Description}}</textarea>
					</div>
				</div>			
			</div>
			<? if (!$isNew) { ?>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label for="Vreme">Finished</label>
					</div>
					<div class="col-md-9">
						{{Vreme}}
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="Note"><?= NOTE ?></label>
					</div>
					<div class="col-md-9">
						{{Note}}
					</div>
				</div>
				<!--<div class="row">
					<div class="col-md-3">
						<label for="DocumentImage">Document Image</label>
                    </div>
					<div class="col-md-9">
						<img  class="small" src="{{DocumentImage}}" alt="" height="50" width="50">		
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="ActionImage">Action Image</label>
                    </div>
					<div class="col-md-9">
						<video width="50" height="50" controls>
							<source src="{{ActionImage}}" type="video/mp4">
						</video>					
					</div>
				</div>	!--->					
				{{#each checklist}}
				<div class="row">
					<div class="col-md-6">
						<label for="Description">{{title}}</label>
					</div>	
					{{#compare active "==" '1'}}
						<div class="col-md-1">
							<input type="checkbox" name="check" style="height: 0.8em" value="1" 
							{{#compare check "==" 1 }} checked {{/compare}} disabled> 
						</div>	
					{{/compare}}		
					{{#compare active "==" '2'}}			
						<div class="col-md-1">
							<img src="{{photo}}" height="50" width="50"/>
						</div>
					{{/compare}}		

				</div>	
				{{/each}}				
				<div class="row">
					<div class="col-md-3">
						<label for="Approved">Approved</label>
					</div>
					<div class="col-md-9">				
						<input type="hidden" name="Approved" id="a{{ID}}" value="{{Approved}}">
						<input type="checkbox" id="{{ID}}" {{#compare Approved "==" 1}} checked {{/compare}} onclick="checkApproved({{ID}})">
					</div>
				</div>					
			</div>

			<? } ?>	

	    </div>
	
		<input type="hidden" name='OwnerID' value='{{OwnerID}}'/>
	</form>				



	<script>	
		var actionid=$('#actionsid').val();
		$("#actionsselect option[value="+actionid+"]").attr("selected", "selected");		 
		
		$('img').click(function() {
			$(this).attr('class','large');	   

		})	
		$('#image_delete').click(function() {
			$("#docimage").val('');	   
			$("#docimage2").hide();	
			$('#image_delete').hide();	
		})			
		

		$('#action_delete').click(function() {
			$("#actimage").val('');	   
			$("#actimage3").hide();	
			$('#action_delete').hide();	
		})
		
		$('img').mouseout(function() {
			$(this).attr('class','small');
		})	
		$('img').dblclick(function() {
			$(this).addClass('rotate');

		})	

		var docimage=$('#docimage').val();
		if (docimage !='' && docimage !='null') {
			$('#docimage2').attr('src',docimage);
		}
		else {
			$("#docimage2").hide();	
			$('#image_delete').hide();	
		}			
	
		var actimage=$('#actimage').val(); 
		if (actimage !='' && actimage !='null') {
			$('#actimage2').attr('src',actimage); 
		}
		else {
			$("#actimage3").hide();	
			$('#action_delete').hide();	
		}	
		
		// uklanja ikonu Saved - statusMessage sa ekrana
		$("form").change(function(){
			$("#statusMessage").html('');
		});

		// CHECK:
		// $(".datepicker").pickadate({format: "yyyy-mm-dd"});

		function selectExpense (expenseID, li) {
			document.getElementById("Expense").value = expenseID;
			document.getElementById("ExpenseText").value = li.innerHTML;
		}

		function selectCurrency (currencyID) {
			document.getElementById("CurrencyID").value = currencyID;
		}

		function checkApproved(id)
		{
		  var checkbox = document.getElementById(id);
		  var Approved = document.getElementById('a'+id);
		  
		  if (checkbox.checked != true)
		  {
			Approved.value = '0';
		  } else Approved.value = '1';
		  
		console.log(Approved.value);
		}		
	</script>
</script>
	
