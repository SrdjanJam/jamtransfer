<?
	$smarty->assign('selectactive',true);
	$smarty->assign('selectactive2',true);
?>	
<script type="text/x-handlebars-template" id="ItemListTemplate">

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

		<div class="col-md-2">
			<i class="fa fa-envelope"></i>
		</div>

		<div class="col-md-2">
			<i class="fa fa-phone"></i>
		</div>

		<div class="col-md-1">
			<?=ACTIVE;?>
		</div>
				
		<div class="col-md-1">
			<a target='_blank' href='plugins/SubDrivers/getRaptorDrivers.php' style="color:blue;background:silver;"><i class="fas fa-external-link"></i>&nbsp;<u>RAPTOR</u></a>
		</div>				
	</div>


	{{#each Item}}
		<div class="one-item-class" onclick="oneItem({{AuthUserID}});">
		
			<div class="row {{color}} pad1em listTile" 
			style="border-top:1px solid #ddd" 
			id="user_{{AuthUserID}}">

				<!-- AUTHUSER_IMAGE: -->
				<div class="col-sm-1 col-xs-4">
					<img src="api/showProfileImage.php?UserID={{AuthUserID}}" 
						style="max-height:60px; max-width:60px;" 
						class="img-thumbnail">
				</div>

				<!-- AUTHUSER_ID -->
				<div class="col-sm-1 col-xs-12">
					{{AuthUserID}}
				</div>
				
				<div class="col-sm-3 col-xs-6">
					<strong>
						{{#compare AuthUserRealName "!==" ""}}
							{{AuthUserRealName}}
						{{else}}
							{{AuthUserCompany}}
						{{/compare}}	
					</strong>
				</div>

				<!-- EMAIL -->
				<div class="col-sm-2 col-xs-12">
					<small>{{AuthUserMail}}</small>
				</div>

				<!-- PHONE -->
				<div class="col-sm-2 col-xs-12">
				<small>
					{{#if AuthUserMob}}
						{{AuthUserMob}}
					{{else}}	
						{{EmergencyPhone}}
					{{/if}}						
				</small>
				</div>

				
				<!-- Active: -->
				<div class="col-sm-1 col-xs-6">
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



</script>