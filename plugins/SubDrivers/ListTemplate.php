<?
	$smarty->assign('selectactive',true);
	$smarty->assign('selectactive2',true);
?>	
<script type="text/x-handlebars-template" id="ItemListTemplate">
	<? if (!PARTNERLOG) { ?>
	<div>
		<a target='_blank' href='plugins/SubDrivers/getRaptorDrivers.php' style="color:blue;background:silver;"><i class="fas fa-external-link"></i>&nbsp;<u><?=RAPTOR;?></u></a>
	</div>				

	<div class="row row-edit">
		<div class="col-md-1">
			<?=AUTHUSER_IMAGE;?>
		</div>

		<div class="col-md-1">
			<?=ID;?>
		</div>
		
		<div class="col-md-3">
			<?=NAME;?>
		</div>

		<div class="col-md-1">
			<i class="fa fa-envelope"></i>
			<?=EMAIL;?>
		</div>

		<div class="col-md-1">
			<i class="fa fa-phone"></i>
			<?=PHONE;?>
		</div>

		<div class="col-md-1">
			<?=ACTIVE;?>
		</div>
				
		<div class="col-md-1">
			<?=DRIVES;?>
		</div>		
		
		<div class="col-md-1">
			<?=VEHICLES;?>
		</div>

		<div class="col-md-1">
			<?=EXPENSES;?>
		</div>		
		
		<div class="col-md-1">
			<?=TASKS;?>
		</div>		
	</div>
	<? } ?>
	<? if (PARTNERLOG) { ?>
	<div class="col-md-12 newone">
		<div class="col-md-1">
			<button id="newone" class="btn btn-primary btn-xs btn-xs-edit"><i class="fa fa-plus" aria-hidden="true"></i></button>
		</div>	
	</div>	
	<? } ?>
	{{#each Item}}
		<div class="one-item-class" onclick="oneItem({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="user_{{AuthUserID}}">

				<!-- AUTHUSER_IMAGE: -->
				<div class="col-md-1 col-xs-3">
					<img src="api/showProfileImage.php?UserID={{AuthUserID}}" 
						style="max-height:60px; max-width:60px;" 
						class="img-thumbnail">
				</div>

				<!-- AUTHUSER_ID -->
				<div class="col-md-1 col-xs-3">
					{{AuthUserID}}
				</div>
				
				<div class="col-md-3 col-xs-3">
					<strong>
						{{#compare AuthUserRealName "!==" ""}}
							{{AuthUserRealName}}
						{{else}}
							{{AuthUserCompany}}
						{{/compare}}	
					</strong>
				</div>

				<!-- EMAIL -->
				<div class="col-md-1 col-xs-3">
					<small>{{AuthUserMail}}</small>
				</div>

				<!-- PHONE -->
				<div class="col-md-1 col-xs-3">
				<small>
					{{#if AuthUserMob}}
						{{AuthUserMob}}
					{{else}}	
						{{EmergencyPhone}}
					{{/if}}						
				</small>
				</div>

				
				<!-- Active: -->
				<div class="col-md-1 col-xs-3">
					{{#compare Active "==" 1}}
						<i class="fa fa-circle text-green"></i>
					{{/compare}}
					{{#compare Active "==" 2}}
						<i class="fa fa-circle text-yellow"></i>
					{{/compare}}						
					{{#compare Active "==" 0}}
						<i class="fa fa-circle text-red"></i>					
					{{/compare}}
				</div>
				<? if (!PARTNERLOG) { ?>
				<!-- Drives: -->
				<div class="col-md-1 col-xs-3">
					<span><a target='_blank' href='drives/subdrivers/{{AuthUserID}}'><?=DRIVES;?></a></span>
				</div>				
				
				<!-- Vehicles: -->
				<div class="col-md-1 col-xs-3">
					<span><a target='_blank' href='vehicleAssignHistory/subdrivers/{{AuthUserID}}'><?=VEHICLES;?></a></span>
				</div>
				<!-- Expenses: -->
				<div class="col-md-1 col-xs-3">
					<span><a target='_blank' href='expenses/subdrivers/{{AuthUserID}}'><?=EXPENSES;?></a></span>
				</div>				
				
				<!-- Tasks: -->
				<div class="col-md-1 col-xs-3">
					<span><a target='_blank' href='tasks/subdrivers/{{AuthUserID}}'><?=TASKS;?></a></span>
				</div>					
				<? } ?>
			</div>
		</div>
		<div id="ItemWrapper{{AuthUserID}}" class="editFrame" style="display:none">
			<div id="inlineContent{{AuthUserID}}" class="row">
				<div id="one_Item{{AuthUserID}}" >
					<?= THERE_ARE_NO_DATA ?>
				</div>
			</div>
		</div>

	{{/each}}

	<script>
		$("#newone").click(function(){
			window.location.href = 'subDrivers/new';
		});
	</script>	
</script>